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
  <div class="auth">
    <div class="auth__wrapper">
      <div class="auth__info">
        <a href="/" class="link auth__info-logo">
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

          <form action="">
            <div class="input-field auth__form-input">
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Tên đăng nhập</label>
              <span class="input-field__message"></span>
            </div>

            <div class="input-field auth__form-input">
              <input type="password" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Mật khẩu</label>
              <i class='bx bx-hide input-field__icon'></i>
            </div>

            <button class="btn btn--primary auth__form-btn">Đăng nhập</button>
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
  <script src="./assets/js/auth.js"></script>
  <!-- end js -->
</body>

</html>