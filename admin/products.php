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

  if(isset($_POST["btnDel"])){
    $id = $_POST["id"];
    // xóa sản phẩm
    $sql_product_delete = "UPDATE products SET deleted = 1 WHERE id = $id";
    $query_product_delete = mysqli_query($conn, $sql_product_delete);

    if($query_product_delete){
      toast('products__toast', 'success', 'Xóa thành công');
    }else{
      toast('products__toast', 'error', 'Xóa thất bại');
    }
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

  // lấy sản phẩm theo phân trang
  $sql_product_list_pagination = "SELECT * FROM products WHERE deleted = 0 ORDER BY id DESC limit $offset, $limit";
  $query_product_list_pagination = mysqli_query($conn, $sql_product_list_pagination);
  
  $row_num_product_list_pagination = mysqli_num_rows($query_product_list_pagination);
  if($row_num_product_list_pagination <= 0){
    $page--;
    if($page >= 1){
      // tự động lùi trang nếu bị xóa hết sản phẩm tại trang đó
      redirect("products.php?page=$page&limit=$limit");
      exit();
    }
  }

  // lấy toàn bộ sản phẩm
  $sql_product_all = "SELECT * FROM products WHERE deleted = 0";
  $query_product_all = mysqli_query($conn, $sql_product_all);
  $totalRecord = mysqli_num_rows($query_product_all);
  $totalPage = ceil($totalRecord / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Sản phẩm</title>
  <?php include_once('../partials/admin/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="../assets/css/_base.css">
  <link rel="stylesheet" href="../assets/css/admin/_app.css">
  <link rel="stylesheet" href="../assets/css/admin/sidebar.css">
  <link rel="stylesheet" href="../assets/css/admin/header.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>

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
      <h2 class="title">Sản phẩm</h2>

      <div class="box">
        <div class="table__head">
          <div class="input-field search">
            <input type="text" class="input-field__input search__input" placeholder=" ">
            <label class="input-field__label">Tìm kiếm theo tên</label>
          </div>

          <a href="./read-add-edit-product.php" class="link btn btn--primary">Thêm mới</a>
        </div>


        <!-- table -->
        <table>
          <thead>
            <tr>
              <th>Ảnh sản phẩm</th>
              <th width="350px">Tên sản phẩm</th>
              <th>Giá</th>
              <th>Giảm giá</th>
              <th>Số lượng</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $totalRecord <= 0 ? "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Không có sản phẩm nào</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>" : '';
            ?>
            <?php
              while($row_product = mysqli_fetch_assoc($query_product_list_pagination)){
            ?>
            <tr>
              <td>
                <img src="../uploads/<?php echo $row_product["thumbnail"];?>"
                  alt="<?php echo $row_product["thumbnail"];?>" class="img">
              </td>
              <td>
                <?php echo $row_product["name"];?>
              </td>
              <td>
                <div class="price"><?php echo number_format($row_product["price"]);?>đ</div>
              </td>
              <td>
                <?php echo number_format($row_product["discount"]);?>đ
              </td>
              <td>
                <?php echo number_format($row_product["quantity"]);?>
              </td>
              <td>
                <?php
                  $product_id = $row_product['id'];

                  $sql_product_status_list_by_product_id = "SELECT status_id FROM product_status WHERE product_id = $product_id";
                  $query_product_status_list_by_product_id = mysqli_query($conn, $sql_product_status_list_by_product_id);

                  while($row_product_status_by_product_id = mysqli_fetch_assoc($query_product_status_list_by_product_id)) {
                    $status_id = $row_product_status_by_product_id['status_id'];

                    $sql_status_by_id = "SELECT name, box_name FROM status WHERE id = $status_id";
                    $query_status_by_id= mysqli_query($conn, $sql_status_by_id);
                    $row_status_by_id = mysqli_fetch_assoc($query_status_by_id);

                    $name_status = $row_status_by_id['name'];
                    $box_name = $row_status_by_id['box_name'];

                    echo "<div class='box__status box--$box_name'>$name_status</div>";
                  }
                ?>
              </td>
              <td>
                <div class="action">
                  <a href="./read-add-edit-product.php?action=read&id=<?php echo $row_product['id']; ?>"
                    class="link tooltip action__btn" tooltip-title="Xem chi tiết">
                    <i class='bx bx-detail action__icon'></i>
                  </a>
                  <a href="./read-add-edit-product.php?action=edit&id=<?php echo $row_product['id']; ?>"
                    class="link tooltip action__btn" tooltip-title="Chỉnh sửa">
                    <i class='bx bx-edit-alt action__icon'></i>
                  </a>
                  <span class="tooltip action__btn modal__btn-open" tooltip-title="Xóa"
                    data-id="<?php echo $row_product["id"];?>" data-name="<?php echo $row_product["name"];?>">
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
            <a href="./products.php?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-left"></i>
            </a>
          </li>

          <?php
            for($i = 1; $i <= $totalPage; $i++){
          ?>
          <li class="pagination__item <?php echo $page == $i ? 'active' : ''; ?>">
            <a href="./products.php?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link"><?php echo $i; ?></a>
          </li>
          <?php
            }
          ?>

          <li class="pagination__item <?php echo $page == $totalPage ? 'hidden' : ''; ?>">
            <a href="./products.php?page=<?php echo $page + 1 ?>&limit=<?php echo $limit ?>"
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
          <span class="delete__modal-text">Bạn chắc chắn muốn xóa sản phẩm <span class="delete__modal-name"></span>
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
    // hiện thông báo
    if(isset($_SESSION['products__toast'])){
      echo $_SESSION['products__toast'];
      unset($_SESSION['products__toast']);
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