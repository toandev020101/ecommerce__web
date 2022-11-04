<?php
  require_once('../database/connectdb.php');
  require_once('../helper/function.php');
  
  session_start();

  if(checkAuth()){
    $role = checkPermission($conn);
    if($role != 'admin'){
      toast('index__toast', 'error', 'Bạn không có quyền truy cập');
      redirect('../index.php');
    }
  }else {
    toast('login__toast', 'error', 'Bạn chưa đăng nhập');
    redirect('../login.php');
  }

  if(isset($_SESSION['refresh'])){
    // trang đã làm mới
    $_SESSION['refresh'] = true;
  }

  if(isset($_GET['page'])){
    // lấy page và limit trên url
    $page = $_GET['page'];
    $limit = $_GET['limit'];
  }else {
    // page và limit mặc định
    $page = 1;
    $limit = 5;
  }

  $offset = ($page - 1) * $limit;

  // lấy danh mục theo phân trang
  $sql_category_list_pagination = "SELECT * FROM categories limit $offset, $limit";
  $query_category_list_pagination = mysqli_query($conn, $sql_category_list_pagination);
  
  $row_num_category_list_pagination = mysqli_num_rows($query_category_list_pagination);
  if($row_num_category_list_pagination <= 0){
    $page--;
    if($page >= 1){
      // tự động lùi trang nếu bị xóa hết danh mục tại trang đó
      $_SESSION['refresh'] = false;
      redirect("categories.php?page=$page&limit=$limit");
      exit();
    }
  }
  
  // lấy toàn bộ danh mục
  $sql_category_all = "SELECT * FROM categories";
  $query_category_all = mysqli_query($conn, $sql_category_all);
  $totalRecord = mysqli_num_rows($query_category_all);
  $totalPage = ceil($totalRecord / $limit);

  if(isset($_POST["btnDel"])){
    $id = $_POST["id"];
    // tắt auto commit
    mysqli_autocommit($conn, false);

    try{
      function deleteProductListByCategoryId($conn, $category_id){
        // tìm sản phẩm thuộc danh mục
        $sql_product_list_by_category_id = "SELECT id FROM products WHERE category_id = $category_id";
        $query_product_list_by_category_id = mysqli_query($conn, $sql_product_list_by_category_id);

        if(mysqli_num_rows($query_product_list_by_category_id) > 0){
          // có sản phẩm
          while($row_product_by_category_id = mysqli_fetch_assoc($query_product_list_by_category_id)){
            $product_id = $row_product_by_category_id["id"];

            // xóa sản phẩm
            $sql_product_delete = "UPDATE products SET category_id = null, deleted = 1 WHERE id = $product_id";
            mysqli_query($conn, $sql_product_delete);
          }
        }
      }

      // lấy ảnh danh mục theo parent id
      $sql_category_list_by_parent_id = "SELECT id, thumbnail FROM categories WHERE parent_id = $id";
      $query_category_list_by_parent_id = mysqli_query($conn, $sql_category_list_by_parent_id);

      if(mysqli_num_rows($query_category_list_by_parent_id) > 0){
        // có danh mục con
        while($row_category_by_parent_id = mysqli_fetch_assoc($query_category_list_by_parent_id)){
          // xóa sản phẩm thuộc danh mục
          deleteProductListByCategoryId($conn, $row_category_by_parent_id["id"]);

          // xóa ảnh của danh mục con đã xóa
          unlink('../uploads/' . $row_category_by_parent_id["thumbnail"]);
        }

        // xóa danh mục con
        $sql_delete_category_by_parent_id = "DELETE FROM categories WHERE parent_id = $id";
        mysqli_query($conn, $sql_delete_category_by_parent_id);
      }

      // xóa sản phẩm thuộc danh mục
      deleteProductListByCategoryId($conn, $id);
      
      // lấy ảnh danh mục theo id
      $sql_category_by_id = "SELECT thumbnail FROM categories WHERE id = $id";
      $query_category_by_id = mysqli_query($conn, $sql_category_by_id);
      $row_category_by_id = mysqli_fetch_assoc($query_category_by_id);

      // xóa danh mục
      $sql_delete_category_by_id = "DELETE FROM categories WHERE id = $id";
      mysqli_query($conn, $sql_delete_category_by_id);

      // xóa ảnh danh mục đã xóa
      unlink('../uploads/' . $row_category_by_id["thumbnail"]);

      // bật tự động commit sql
      mysqli_autocommit($conn, true);

      toast('categories__toast-refresh', 'success', 'Xóa thành công');
      $_SESSION['refresh'] = false;
      refresh();
    }catch(mysqli_sql_exception $exception){
      mysqli_rollback($conn);
      toast('categories__toast-refresh', 'error', 'Xóa thất bại');
      throw $exception;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Danh mục</title>
  <?php include_once('../partials/admin/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="../assets/css/_base.css">
  <link rel="stylesheet" href="../assets/css/admin/_app.css">
  <link rel="stylesheet" href="../assets/css/admin/sidebar.css">
  <link rel="stylesheet" href="../assets/css/admin/header.css">
  <!-- main css -->
</head>

<body>
  <div id="toast">
  </div>

  <div class="bg-main">
    <!-- sidebar -->
    <?php include_once('../partials/admin/sidebar.php') ?>
    <!-- end sidebar -->
  </div>

  <div class="bg-second container">
    <!-- header -->
    <?php include_once('../partials/admin/header.php') ?>
    <!-- end header -->

    <!-- content -->
    <div class="content">
      <h2 class="title">Danh mục</h2>

      <div class="box">
        <div class="table__head">
          <div class="input-field search">
            <input type="text" class="input-field__input search__input" placeholder=" ">
            <label class="input-field__label">Tìm kiếm theo tên</label>
          </div>

          <a href="./add-edit-category.php" class="link btn btn--primary">Thêm mới</a>
        </div>


        <!-- table -->
        <table>
          <thead>
            <tr>
              <th>Ảnh danh mục</th>
              <th>Tên danh mục</th>
              <th>Slug dường dẫn</th>
              <th>Danh mục cha</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $totalRecord <= 0 ? "<tr>
            <td></td>
            <td></td>
            <td>Không có danh mục nào</td>
            <td></td>
            <td></td>
            </tr>" : '';?>
            <?php
              while($row_category = mysqli_fetch_assoc($query_category_list_pagination)){
            ?>
            <tr>
              <td>
                <?php
                  $thumbnail = $row_category['thumbnail'];
                  
                  echo $thumbnail ? "<img src='../uploads/$thumbnail' alt='$thumbnail' class='img'>" : '';
                ?>
              </td>
              <td>
                <?php echo $row_category["name"]; ?>
              </td>
              <td>
                <?php echo $row_category["slug"]; ?>
              </td>
              <td>
                <?php
                  $parent_id = $row_category["parent_id"];
                  if($parent_id != "0"){
                    $sql_category_by_parent_id = "SELECT * FROM categories WHERE id = $parent_id";
                    $query_category_by_parent_id = mysqli_query($conn, $sql_category_by_parent_id);
                    $row_category_by_parent_id = mysqli_fetch_assoc($query_category_by_parent_id);
                    
                    echo $row_category_by_parent_id["name"];
                  }
                ?>
              </td>
              <td>
                <div class="action">
                  <a href="./add-edit-category.php?action=edit&id=<?php echo $row_category["id"]; ?>"
                    class="link tooltip action__btn" tooltip-title="Chỉnh sửa">
                    <i class='bx bx-edit-alt action__icon'></i>
                  </a>
                  <span class="tooltip action__btn modal__btn-open" tooltip-title="Xóa"
                    data-id="<?php echo $row_category["id"];?>" data-name="<?php echo $row_category["name"];?>">
                    <i class='bx bx-trash-alt action__icon'></i>
                  </span>
                </div>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        <!-- end table -->

        <!-- pagination -->
        <?php
          if($totalPage > 1){
        ?>
        <ul class="pagination table__pagination <?php echo $totalRecord <= 0 ? 'hidden' : '';?>">
          <li class="pagination__item <?php echo $page == 1 ? 'hidden' : ''; ?>">
            <a href="./categories.php?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-left"></i>
            </a>
          </li>

          <?php
            for($i = 1; $i <= $totalPage; $i++){
          ?>
          <li class="pagination__item <?php echo $page == $i ? 'active' : ''; ?>">
            <a href="./categories.php?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link"><?php echo $i; ?></a>
          </li>
          <?php
            }
          ?>

          <li class="pagination__item <?php echo $page == $totalPage ? 'hidden' : ''; ?>">
            <a href="./categories.php?page=<?php echo $page + 1 ?>&limit=<?php echo $limit ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-right"></i>
            </a>
          </li>
        </ul>
        <?php
          }
        ?>
        <!-- end pagination -->
      </div>
    </div>
    <!-- end content -->
  </div>

  <!-- modal delete -->
  <div class="modal">
    <div class="modal__overlay">
    </div>
    <div class="modal__body">
      <div class="delete__modal">
        <div class="delete__modal-text-wrapper">
          <i class='bx bx-error delete__modal-icon'></i>
          <span class="delete__modal-text">Bạn chắc chắn muốn xóa danh mục <span class="delete__modal-name"></span>
            ?</span>
        </div>
        <form action="" method="post" class="delete__modal-form">
          <input type="text" name="id" class="delete__modal-id" hidden>
          <button class="btn btn--primary delete__btn" name="btnDel">Đồng ý</button>
          <button type="button" class="btn modal__btn-close delete__btn">Hủy</button>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal delete -->

  <!-- js -->
  <script src="../assets/js/_base.js"></script>
  <script>
  <?php
    if(isset($_SESSION['categories__toast'])){
      echo $_SESSION['categories__toast'];
      unset($_SESSION['categories__toast']);
    }

    if(isset($_SESSION['categories__toast-refresh']) && isset($_SESSION['refresh']) && $_SESSION['refresh']){
      echo $_SESSION['categories__toast-refresh'];
      unset($_SESSION['categories__toast-refresh']);
      unset($_SESSION['refresh']);
    }
  ?>
  </script>
  <script src="../assets/js/admin/_app.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>