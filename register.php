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
          <h4 class="auth__form-title">Đăng ký</h4>

          <form action="">
            <div class="input-field auth__form-input">
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Họ và tên *</label>
            </div>

            <div class="input-field auth__form-input">
              <input type="tel" class="input-field__input" placeholder=" ">
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
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Tên đăng nhập *</label>
            </div>

            <div class="input-field auth__form-input">
              <input type="password" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Mật khẩu *</label>
              <i class='bx bx-hide input-field__icon'></i>
            </div>

            <div class="input-field auth__form-input">
              <input type="password" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Nhập lại mật khẩu *</label>
              <i class='bx bx-hide input-field__icon'></i>
            </div>

            <button class="btn btn--primary auth__form-btn">Đăng ký</button>
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
  <script src="./assets/js/auth.js"></script>
  <!-- end js -->
</body>

</html>