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
    $limit = 2;
  }

  $offset = ($page - 1) * $limit;

  // lấy tài khoản theo phân trang
  $sql_user_list_pagination = "SELECT * FROM users limit $offset, $limit";
  $query_user_list_pagination = mysqli_query($conn, $sql_user_list_pagination);
  
  $row_num_user_list_pagination = mysqli_num_rows($query_user_list_pagination);
  if($row_num_user_list_pagination <= 0){
    $page--;
    if($page >= 1){
      // tự động lùi trang nếu bị xóa hết tài khoản tại trang đó
      $_SESSION['refresh'] = false;
      redirect("users.php?page=$page&limit=$limit");
      exit();
    }
  }
  
  // lấy toàn bộ tài khoản
  $sql_user_all = "SELECT * FROM users";
  $query_user_all = mysqli_query($conn, $sql_user_all);
  $totalRecord = mysqli_num_rows($query_user_all);
  $totalPage = ceil($totalRecord / $limit);

  if(isset($_POST["btnDel"])){
    $id = $_POST["id"];
      
    // lấy ảnh tài khoản theo id
    $sql_user_by_id = "SELECT avatar FROM users WHERE id = $id";
    $query_user_by_id = mysqli_query($conn, $sql_user_by_id);
    $row_user_by_id = mysqli_fetch_assoc($query_user_by_id);

    // xóa tài khoản
    $sql_delete_user_by_id = "DELETE FROM users WHERE id = $id";
    $query_delete_user_by_id = mysqli_query($conn, $sql_delete_user_by_id);

    if($query_delete_user_by_id){
      if($row_user_by_id['avatar'] != 'no_avatar.img'){
        // xóa ảnh tài khoản đã xóa
        unlink('../uploads/' . $row_user_by_id["avatar"]);
      }

      toast('users__toast-refresh', 'success', 'Xóa thành công');
      $_SESSION['refresh'] = false;
      refresh();
    }else{
      toast('users__toast-refresh', 'error', 'Xóa thất bại');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Tài khoản</title>
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
      <h2 class="title">Tài khoản</h2>

      <div class="box">
        <div class="table__head">
          <div class="input-field search">
            <input type="text" class="input-field__input search__input" placeholder=" ">
            <label class="input-field__label">Tìm kiếm theo tên</label>
          </div>

          <a href="./read-add-edit-user.php" class="link btn btn--primary">Thêm mới</a>
        </div>


        <!-- table -->
        <table>
          <thead>
            <tr>
              <th>Ảnh đại diện</th>
              <th>Họ và tên</th>
              <th>Tên đăng nhập</th>
              <th>Số điện thoại</th>
              <th>Giới tính</th>
              <th>Vai trò</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $totalRecord <= 0 ? "<tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Không có tài khoản nào</td>
            <td></td>
            <td></td>
            <td></td>
            </tr>" : '';?>
            <?php
              while($row_user = mysqli_fetch_assoc($query_user_list_pagination)){
            ?>
            <tr>
              <td>
                <img
                  src="<?php echo $row_user['avatar'] != 'no_avatar.img' ? '../uploads/' . $row_user['avatar'] : '../assets/images/no_avatar.jpg';?>"
                  alt="<?php echo $row_user['avatar'];?>" class="img">
              </td>
              <td>
                <?php echo $row_user['fullname'];?>
              </td>
              <td>
                <?php echo $row_user['username'];?>
              </td>
              <td>
                <?php echo $row_user['phone_num'];?>
              </td>
              <td>
                <?php echo $row_user['gender'] == "0" ? 'Nam' : 'Nữ' ;?>
              </td>
              <td>
                <?php
                  $role_id = $row_user['role_id'];

                  $sql_role_by_id = "SELECT name FROM roles WHERE id = $role_id";
                  $query_role_by_id = mysqli_query($conn, $sql_role_by_id);
                  $row_role_by_id = mysqli_fetch_assoc($query_role_by_id);

                  echo $row_role_by_id['name'];
                ?>
              </td>
              <td>
                <div class="action">
                  <a href="./read-add-edit-user.php?action=read&id=<?php echo $row_user['id'];?>"
                    class="link tooltip action__btn" tooltip-title="Xem chi tiết">
                    <i class='bx bx-detail action__icon'></i>
                  </a>
                  <a href="./read-add-edit-user.php?action=edit&id=<?php echo $row_user['id'];?>"
                    class="link tooltip action__btn" tooltip-title="Chỉnh sửa">
                    <i class='bx bx-edit-alt action__icon'></i>
                  </a>
                  <span class="tooltip action__btn modal__btn-open" tooltip-title="Xóa"
                    data-id="<?php echo $row_user["id"];?>" data-name="<?php echo $row_user["username"];?>">
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
        <ul class="pagination table__pagination <?php echo $totalRecord <= 0 ? 'hidden' : '';?>">
          <li class="pagination__item <?php echo $page == 1 ? 'hidden' : ''; ?>">
            <a href="./users.php?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-left"></i>
            </a>
          </li>

          <?php
            for($i = 1; $i <= $totalPage; $i++){
          ?>
          <li class="pagination__item <?php echo $page == $i ? 'active' : ''; ?>">
            <a href="./users.php?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link"><?php echo $i; ?></a>
          </li>
          <?php
            }
          ?>

          <li class="pagination__item <?php echo $page == $totalPage ? 'hidden' : ''; ?>">
            <a href="./users.php?page=<?php echo $page + 1 ?>&limit=<?php echo $limit ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-right"></i>
            </a>
          </li>
        </ul>
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
          <span class="delete__modal-text">Bạn chắc chắn muốn xóa tài khoản <span class="delete__modal-name"></span>
            ?</span>
        </div>
        <form action="" method="post" class="delete__modal-form">
          <input type="text" name="id" class="delete__modal-id" hidden>
          <button class="btn btn--primary" name="btnDel">Đồng ý</button>
          <button type="button" class="btn modal__btn-close">Hủy</button>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal delete -->

  <!-- js -->
  <script src="../assets/js/_base.js"></script>
  <script>
  <?php
    if(isset($_SESSION['users__toast'])){
      echo $_SESSION['users__toast'];
      unset($_SESSION['users__toast']);
    }

    if(isset($_SESSION['users__toast-refresh']) && isset($_SESSION['refresh']) && $_SESSION['refresh']){
      echo $_SESSION['users__toast-refresh'];
      unset($_SESSION['users__toast-refresh']);
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