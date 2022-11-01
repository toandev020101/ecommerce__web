<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');
  
  session_start();

  if(checkAuth()){
    $role = checkPermission($conn);
    redirect($role == 'admin' ? './admin/index.php' : './index.php');
  }

  if(isset($_POST['btnSubmit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql_user_by_username = "SELECT * FROM users WHERE username = '$username'";
    $query_user_by_username = mysqli_query($conn, $sql_user_by_username);

    if(mysqli_num_rows($query_user_by_username) > 0){
      $row_user_by_username = mysqli_fetch_assoc($query_user_by_username);
      if($username == $row_user_by_username['username'] && password_verify($password, $row_user_by_username['password'])){
        $_SESSION['user'] = $row_user_by_username;

        $fullname = $row_user_by_username['fullname'];
        $role = checkPermission($conn);
        
        toast($role == 'admin' ? 'admin-index__toast' : 'index__toast', 'success', "Xin chào, $fullname");
        redirect($role == 'admin' ? './admin/index.php' : './index.php');
      }else {
        toast('login__toast', 'error', 'Tài khoản hoặc mật khẩu không chính xác');
      }
    }else {
      toast('login__toast', 'error', 'Tài khoản không tồn tại');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Đăng nhập</title>
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
          <h4 class="auth__form-title">Đăng nhập</h4>

          <form action="" method="post">
            <div class="input-field auth__form-input">
              <input type="text" class="input-field__input" placeholder=" " name="username" required>
              <label class="input-field__label">Tên đăng nhập *</label>
              <span class="input-field__message"></span>
            </div>

            <div class="input-field auth__form-input">
              <input type="password" class="input-field__input" placeholder=" " name="password" required>
              <label class="input-field__label">Mật khẩu *</label>
              <i class='bx bx-hide input-field__icon'></i>
            </div>

            <button class="btn btn--primary auth__form-btn" name="btnSubmit">Đăng nhập</button>
          </form>

          <a href="#" class="auth__form-forgot-password">
            Quên mật khẩu
          </a>

          <span class="auth__form-link-wrapper">
            Bạn mới biết tới PKShop?
            <a href="./register.php" class="link auth__form-link">Đăng ký</a>
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
    if(isset($_SESSION['login__toast'])){
      echo $_SESSION['login__toast'];
      unset($_SESSION['login__toast']);
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