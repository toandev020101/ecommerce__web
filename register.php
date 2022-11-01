<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');
  
  session_start();

  if(checkAuth()){
    $role = checkPermission($conn);
    redirect($role == 'admin' ? './admin/index.php' : './index.php');
  }

  if(isset($_POST['btnSubmit'])){
    $fullname = $_POST['fullname'];
    $phone_num = $_POST['phone_num'];
    $gender = $_POST['gender'];
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role_id = 1;

    if($password != $confirm_password){
      toast('register__toast', 'error', 'Mật khẩu không khớp');
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    if(!isset($_SESSION['register__toast'])){
      $sql_user_by_username = "SELECT * FROM users WHERE username = '$username'";
      $query_user_by_username = mysqli_query($conn, $sql_user_by_username);

      if(mysqli_num_rows($query_user_by_username) == 0){
        $sql_user_add = "INSERT INTO users(fullname, username, password, phone_num, gender, role_id) VALUES ('$fullname','$username', '$password', '$phone_num', $gender, $role_id)";
        $query_user_add = mysqli_query($conn, $sql_user_add);
        $user_add_id = mysqli_insert_id($conn);

        if($query_user_add){
          $sql_user_by_id = "SELECT * FROM users WHERE id = $user_add_id";
          $query_user_by_id = mysqli_query($conn, $sql_user_by_id);
          $row_user_by_id = mysqli_fetch_assoc($query_user_by_id);

          $_SESSION['user'] = $row_user_by_id;
          $role = checkPermission($conn);
          
          toast('index__toast', 'success', "Xin chào, $fullname");
          redirect('./index.php');
        }else {
          toast('register__toast', 'error', 'Đăng ký thất bại');
        }
      }else {
        toast('register__toast', 'error', 'Tài khoản đã tồn tại');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Đăng ký</title>
  <?php include_once('./partials/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="./assets/css/_base.css">
  <link rel="stylesheet" href="./assets/css/auth.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>
  <div class="auth">
    <div class="auth__wrapper">
      <div class="auth__info">
        <a href="./index.php" class="link auth__info-logo">
          <i class='bx bx-shopping-bag auth__info-icon'></i>
          <span class="auth__info-name">PKShop</span>
        </a>

        <p class="auth__info-description">
          Nền tảng thương mại điện tử được yêu thích ở Đông Nam á
        </p>
      </div>

      <div class="auth__form-wrapper">
        <div class="auth__form">
          <h4 class="auth__form-title">Đăng ký</h4>

          <form action="" method="post">
            <div class="input-field auth__form-input">
              <input type="text" class="input-field__input" placeholder=" " name="fullname">
              <label class="input-field__label">Họ và tên *</label>
            </div>

            <div class="input-field auth__form-input">
              <input type="tel" class="input-field__input" placeholder=" " name="phone_num">
              <label class="input-field__label">Số điện thoại *</label>
            </div>

            <div class="auth__form-input">
              <span class="auth__form-name">
                Giới tính <span class="required">*</span>
              </span>
              <span class="auth__form-radio-group">
                <label for="male" class="auth__form-radio radio">
                  <input type="radio" id="male" name="gender" class="radio__input" value="0" checked>
                  <div class="radio__box"></div>
                  Nam
                </label>
                <label for="female" class="auth__form-radio radio">
                  <input type="radio" id="female" name="gender" class="radio__input" value="1">
                  <div class="radio__box"></div>
                  Nữ
                </label>
              </span>
            </div>

            <div class="input-field auth__form-input">
              <input type="text" class="input-field__input" placeholder=" " name="username">
              <label class="input-field__label">Tên đăng nhập *</label>
            </div>

            <div class="input-field auth__form-input">
              <input type="password" class="input-field__input" placeholder=" " name="password">
              <label class="input-field__label">Mật khẩu *</label>
              <i class='bx bx-hide input-field__icon'></i>
            </div>

            <div class="input-field auth__form-input">
              <input type="password" class="input-field__input" placeholder=" " name="confirm_password">
              <label class="input-field__label">Nhập lại mật khẩu *</label>
              <i class='bx bx-hide input-field__icon'></i>
            </div>

            <button class="btn btn--primary auth__form-btn" name="btnSubmit">Đăng ký</button>
          </form>

          <span class="auth__form-link-wrapper">
            Bạn đã biết tới PKShop?
            <a href="./login.php" class="link auth__form-link">Đăng nhập</a>
          </span>
        </div>
      </div>
    </div>
  </div>

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script>
  <?php
    // hiển thị thông báo
    if(isset($_SESSION['register__toast'])){
      echo $_SESSION['register__toast'];
      unset($_SESSION['register__toast']);
    }
  ?>
  </script>
  <script src="./assets/js/auth.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>