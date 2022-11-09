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

  $action = 'add';
  if(isset($_GET["action"])){
    // lấy action và id trên url
    $action = $_GET["action"];
    $id = $_GET["id"];

    // lấy tài khoản theo id
    $sql_user_by_id = "SELECT * FROM users WHERE id = $id";
    $query_user_by_id = mysqli_query($conn, $sql_user_by_id);
    $row_user_by_id = mysqli_fetch_assoc($query_user_by_id);
  }

  if(isset($_POST["btnSubmit"])){
    if($action == 'read'){
      // chuyển trang
      redirect('users.php');
    }else {
      // upload file
      $file_name = uploadFileSingle('../uploads', 'avatar', 'add-edit-user__toast');

      // xử lý file
      if($action == "edit" && $_POST['avatar_edit_empty'] == "0" && empty($file_name)){
        // giữ nguyên nếu không chỉnh sửa ảnh
        $avatar = $row_user_by_id["avatar"];
      }else {
        // thêm hoặc sửa ảnh
        $avatar = $file_name;

        if($action == "edit"){
          // xóa ảnh cũ nếu chỉnh sửa
          if(!empty( $row_user_by_id["avatar"]))
            unlink('../uploads/' . $row_user_by_id["avatar"]);
        }
      }

      if(empty($avatar)){
        $avatar = 'no_avatar.jpg';
      }

      $fullname = $_POST["fullname"];
      $phone_num = $_POST["phone_num"];
      $username = $_POST["username"];
      if(isset($_POST["password"])){
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
      }

      $gender = $_POST["gender"]; 
      $address = $_POST["address"];
      $role_id = $_POST["role_id"];

      if($action == "add"){
        // thêm tài khoản mới
        $sql_submit = "INSERT INTO users(avatar, fullname, username, password, phone_num, address, gender, role_id) VALUES ('$avatar', '$fullname', '$username', '$password', '$phone_num', '$address', $gender, $role_id)";
      }else{
        // Sửa tài khoản
        $sql_submit = "UPDATE users SET avatar = '$avatar', fullname = '$fullname', phone_num = '$phone_num', address = '$address', gender = $gender, role_id = $role_id WHERE id = $id";
      }
  
      $query_submit = mysqli_query($conn, $sql_submit);
  
      if ($query_submit) {
        // thông báo
        toast('users__toast', 'success', $action == 'add' ? 'Thêm mới thành công' : 'Chỉnh sửa thành công');

        // chuyển trang
        redirect("users.php");
      } else {
        toast('add-edit-user__toast', 'error', $action == 'add' ? 'Thêm mới thất bại' : 'Chỉnh sửa thất bại');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: <?php echo $action == 'read' ? 'Chi tiết' : ($action == 'edit' ? 'Chỉnh sửa' : 'Thêm'); ?> tài khoản
  </title>
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
      <h2 class="title"><?php echo $action == 'read' ? 'Chi tiết' : ($action == 'edit' ? 'Chỉnh sửa' : 'Thêm'); ?> tài
        khoản</h2>

      <form method="post" enctype="multipart/form-data" class="box">
        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Ảnh đại diện
          </div>
          <div class="upload">
            <img
              src="<?php echo $action != "add" && $row_user_by_id["avatar"] != 'no_avatar.jpg' ? '../uploads/' . $row_user_by_id["avatar"] : 'no-image'; ?>"
              alt="<?php echo $action != "add" ? $row_user_by_id["avatar"] : ''; ?>" class="upload__img">
            <div class="upload__content">
              <i class='bx bx-cloud-upload upload__icon'></i>
              <span class='upload__text'>Tải ảnh lên</span>
            </div>
            <input type="file" name="avatar" class="upload__input">
            <?php echo $action == "edit" ? '<input type="text" class="upload__edit-empty" name="avatar_edit_empty" value="0" hidden>' : '' ?>
            <i class='bx bx-x upload__close <?php echo $action == "read" ? 'hidden' : '';?>'></i>
            <div class="upload__name">
              <?php echo $action != "add" ? $row_user_by_id["avatar"] : ''; ?>
            </div>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Họ và tên<span class="required">*</span>
            </div>
            <input type="text" name="fullname" class="input read-add-edit__input" placeholder="Họ và tên"
              value="<?php echo $action != 'add' ? $row_user_by_id["fullname"] : ''; ?>" required
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Số điện thoại <span class="required">*</span>
            </div>
            <input type="tel" name="phone_num" class="input read-add-edit__input" placeholder="Số điện thoại"
              value="<?php echo $action != 'add' ? $row_user_by_id["phone_num"] : ''; ?>" required
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Tên đăng nhập <span class="required">*</span>
            </div>
            <input type="text" name="username" class="input read-add-edit__input" placeholder="Tên đăng nhập"
              value="<?php echo $action != 'add' ? $row_user_by_id["username"] : ''; ?>" required
              <?php echo $action != "add" ? 'readonly' : '';?>>
          </div>
          <div class="read-add-edit__col">
            <?php echo $action == "add" ? '<div class="read-add-edit__name">
              Mật khẩu <span class="required">*</span>
            </div>' : '';?>
            <div class="input-field">
              <input type="password" name="password" class="input read-add-edit__input input-field__input"
                placeholder="Mật khẩu" value="<?php echo $action != 'add' ? $row_user_by_id["password"] : ''; ?>"
                required <?php echo $action != "add" ? 'hidden' : '';?>>
              <?php echo $action == "add" ? "<i class='bx bx-hide read-add-edit__input-icon input-field__icon'></i>" : '';?>
            </div>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Giới tính <span class="required">*</span>
            </div>

            <span>
              <label for="male" class="radio">
                <input type="radio" id="male" name="gender" class="radio__input" value="0"
                  <?php echo $action == 'add' || ($action != 'add' && $row_user_by_id['gender'] == "0") ? 'checked' : '';?>
                  <?php  echo $action == 'read' ? 'disabled' : '';?>>
                <div class="radio__box"></div>
                Nam
              </label>
              <label for="female" class="radio">
                <input type="radio" id="female" name="gender" class="radio__input" value="1" <?php 
                  echo $action != 'add' && $row_user_by_id['gender'] == "1" ? 'checked' : '';
                  ?> <?php  echo $action == 'read' ? 'disabled' : '';?>>
                <div class="radio__box"></div>
                Nữ
              </label>
            </span>
          </div>

          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Địa chỉ
            </div>
            <input type="text" name="address" class="input read-add-edit__input" placeholder="Địa chỉ"
              value="<?php echo $action != 'add' ? $row_user_by_id["address"] : ''; ?>"
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Vai trò <span class="required">*</span>
            </div>
            <div class="dropdown <?php echo $action == "read" ? 'readonly' : '';?>">
              <div class="dropdown__select">
                <span class="dropdown__selected">
                  <?php 
                  if($action != "add"){
                    $role_id = $row_user_by_id['role_id'];
                    
                    $sql_role_by_id = "SELECT * FROM roles WHERE id = $role_id";
                    $query_role_by_id = mysqli_query($conn, $sql_role_by_id);
                    $row_role_by_id = mysqli_fetch_assoc($query_role_by_id);
                  
                    echo $row_role_by_id["name"];
                  }else {
                    echo "Khách hàng";
                  }
                  ?>
                </span>
                <i class='bx bxs-chevron-down dropdown__select-icon'></i>
                <input type="text" class="dropdown__input" value="<?php echo $action != 'add' ? $role_id : "1";?>"
                  name="role_id" hidden>
              </div>

              <ul class="dropdown__list read-add-edit__dropdown-list">
                <?php
                  $sql_role_all = "SELECT * FROM roles";
                  $query_role_all = mysqli_query($conn, $sql_role_all);
                  while($row_role = mysqli_fetch_assoc($query_role_all)){
                ?>
                <li
                  class="dropdown__item <?php echo ($action == 'add' && $row_role['id'] == "1") || ($action != 'add' && $row_role['id'] == $row_user_by_id['role_id']) ? 'active' : ''; ?>">
                  <span class="dropdown__text"
                    data-value="<?php echo $row_role["id"]; ?>"><?php echo $row_role['name'];?></span>
                </li>
                <?php
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>

        <div class="btn-wrapper read-add-edit__line">
          <?php echo $action == 'add' ? '<button type="reset" class="btn reset-form__btn">Làm mới</button>' : '';?>

          <button class="btn btn--primary" name="btnSubmit"><?php
          if($action == 'read'){
            echo "Quay lại";
          }else if($action == 'edit'){
            echo "Lưu lại";
          }else {
            echo "Thêm mới";
          }
          ?></button>
        </div>
      </form>
    </div>
    <!-- end content -->
  </div>

  <!-- js -->
  <script src="../assets/js/_base.js"></script>
  <script>
  <?php
    // hiển thị thông báo
    if(isset($_SESSION['read-add-edit-user__toast'])){
      echo $_SESSION['read-add-edit-user__toast'];
      unset($_SESSION['read-add-edit-user__toast']);
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