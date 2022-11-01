<?php
  $url = $_SERVER['REQUEST_URI'];
  $path = substr($url, 14, 14);

  if(isset($_POST['btnLogout'])){
    unset($_SESSION['user']);
    if($path == '/' || strpos($path, '/index.php') != false){
      toast('index__toast-refresh', 'success', 'Đăng xuất thành công');
      $_SESSION['refresh'] = false;
    }else {
      toast('index__toast', 'success', 'Đăng xuất thành công');
    }
    redirect('./index.php');
  }
?>

<header>
  <!-- top header -->
  <div class="bg-main">
    <div class="container top-header">
      <!-- logo -->
      <a href="./index.php" class="link logo">
        <i class='bx bx-shopping-bag logo__icon'></i>
        <span class="logo__text">PKShop</span>
      </a>
      <!-- end logo -->

      <!-- search -->
      <div class="search">
        <div class="input-field search__input-wrapper">
          <input type="text" class="input-field__input search__input" placeholder=" ">
          <label class="input-field__label">Tìm kiếm</label>

          <!-- history search -->
          <div class="history">
            <h3 class="history__title">
              Lịch sử tìm kiếm
            </h3>
            <ul class="history__list">
              <li class="history__item">
                <a href="#" class="link">Tai nghe</a>
              </li>
              <li class="history__item">
                <a href="#" class="link">Bàn phím</a>
              </li>
              <li class="history__item">
                <a href="#" class="link">Cáp sạc</a>
              </li>
            </ul>
          </div>
          <!-- end history search -->
        </div>
        <i class='bx bx-search-alt search__icon'></i>
      </div>
      <!-- end search -->

      <!-- action -->
      <ul class="action">
        <li class="action__item">
          <div class="link action__cart">
            <a href="./cart.php" class="link badge">
              <i class='bx bx-cart action__icon'></i>
              <span class="badge__count badge__count--primary">3</span>
            </a>

            <!-- cart menu -->
            <div class="cart__list">
              <!-- no cart: ul class cart__list--no-cart -->
              <div class="cart__item--no-cart cart__item--arrow">
                <img src="./assets/images/no-cart.png" alt="no-cart" class="cart__item--no-cart-img">
                <span class="cart__item--no-cart-text">Chưa có sản phẩm</span>
              </div>
              <!-- end no cart -->

              <h4 class="cart__item-title cart__item--arrow">
                Sản phẩm đã thêm
              </h4>
              <ul class="cart__list-item">
                <!-- cart item -->
                <li class="cart__item">
                  <img src="./assets/images/avatar.jpg" alt="cart__item-img" class="cart__item-img">
                  <div class="cart__item-info">
                    <div class="cart__item-head">
                      <h5 class="cart__item-name">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, labore modi reprehenderit
                      </h5>
                      <div class="cart__item-price-wrapper">
                        <span class="cart__item-price">2.000.000đ</span>
                        <span class="cart__item-multiply">x</span>
                        <span class="cart__item-quantity">2</span>
                      </div>
                    </div>

                    <div class="cart__item-body">
                      <div class="cart__item-description">
                        <span>Nhãn hiệu: JBL</span>
                        <span>Màu sắc: Đỏ</span>
                      </div>
                      <span class="cart__item-remove">Xóa</span>
                    </div>
                  </div>
                </li>
                <!-- end cart item -->

                <!-- cart item -->
                <li class="cart__item">
                  <img src="./assets/images/avatar.jpg" alt="cart__item-img" class="cart__item-img">
                  <div class="cart__item-info">
                    <div class="cart__item-head">
                      <h5 class="cart__item-name">
                        JBL_E55BT_KEY_BLACK
                      </h5>
                      <div class="cart__item-price-wrapper">
                        <span class="cart__item-price">2.000.000đ</span>
                        <span class="cart__item-multiply">x</span>
                        <span class="cart__item-quantity">2</span>
                      </div>
                    </div>

                    <div class="cart__item-body">
                      <div class="cart__item-description">
                        <span>Nhãn hiệu: JBL</span>
                        <span>Màu sắc: Đỏ</span>
                      </div>
                      <span class="cart__item-remove">Xóa</span>
                    </div>
                  </div>
                </li>
                <!-- end cart item -->

                <!-- cart item -->
                <li class="cart__item">
                  <img src="./assets/images/avatar.jpg" alt="cart__item-img" class="cart__item-img">
                  <div class="cart__item-info">
                    <div class="cart__item-head">
                      <h5 class="cart__item-name">
                        JBL_E55BT_KEY_BLACK
                      </h5>
                      <div class="cart__item-price-wrapper">
                        <span class="cart__item-price">2.000.000đ</span>
                        <span class="cart__item-multiply">x</span>
                        <span class="cart__item-quantity">2</span>
                      </div>
                    </div>

                    <div class="cart__item-body">
                      <div class="cart__item-description">
                        <span>Nhãn hiệu: JBL</span>
                        <span>Màu sắc: Đỏ</span>
                      </div>
                      <span class="cart__item-remove">Xóa</span>
                    </div>
                  </div>
                </li>
                <!-- end cart item -->
              </ul>

              <a href="./cart.php" class="link btn btn--primary cart__view">
                Xem giỏ hàng
              </a>
            </div>
            <!-- end cart menu -->
          </div>
        </li>
        <li class="action__item">
          <div class="badge">
            <i class='bx bx-bell action__icon'></i>
            <span class="badge__count badge__count--primary">3</span>
          </div>
        </li>
        <li class="action__item">
          <div class="auth">
            <?php
              if(!checkAuth()){
                echo '<a href="./login.php" class="link auth__login">Đăng nhập</a>
                <span class="auth_slash">/</span>
                <a href="./register.php" class="link auth__register">Đăng ký</a>';
              }else {
                $avatar = $_SESSION['user']['avatar'];
                $fullname = $_SESSION['user']['fullname'];

                echo "<a href='#' class='link auth__info'>
                <img src='./uploads/$avatar' alt='$avatar' class='auth__info-avatar'>
                <span class='auth__info-fullname'>$fullname</span>
              </a>
  
              <!-- user menu -->
              <ul class='dropdown__list auth__dropdown-list'>
                <!-- dropdown item -->
                <li class='dropdown__item'>
                  <a href='#' class='link auth__link'>
                    <i class='bx bx-cog dropdown__icon'></i>
                    <span class='dropdown__text'>Thông tin tài khoản</span>
                  </a>
                </li>
                <!-- end dropdown item -->
  
                <!-- dropdown item -->
                <li class='dropdown__item'>
                  <a href='#' class='link auth__link'>
                    <i class='bx bx-detail dropdown__icon'></i>
                    <span class='dropdown__text'>Theo dõi đơn hàng</span>
                  </a>
                </li>
                <!-- end dropdown item -->
  
                <!-- dropdown item -->
                <li class='dropdown__item'>
                  <form action='' method='post'>
                    <button class='auth__link reset__btn' name='btnLogout'>
                      <i class='bx bx-log-out dropdown__icon'></i>
                      <span class='dropdown__text'>Đăng xuất</span>
                    </button>
                  </form>
                </li>
                <!-- end dropdown item -->
              </ul>
              <!-- end user menu -->";
              }
            ?>
          </div>
        </li>
      </ul>
      <!-- end action -->
    </div>
  </div>
  <!-- end top header -->
  <!-- bottom header -->
  <div class="bg-second">
    <nav class="container bottom-header">
      <ul class="main-menu__list">
        <li
          class="main-menu__item <?php echo  $path == '/' || strpos($path, '/index.php') != false ? 'active' : ''; ?>">
          <a href="./index.php" class="link main-menu__item-link">Trang chủ</a>
        </li>
        <li
          class="main-menu__item mega-dropdown <?php echo strpos($path, '/products.php') != false ? 'active' : ''; ?>">
          <a href="./products.php" class="link main-menu__item-link">
            Sản phẩm
            <i class='bx bx-chevron-down main-menu__item-icon'></i>
          </a>
          <div class="mega-content">
            <!-- mega content item -->
            <div class="mega-content__item">
              <h3 class="mega-content__title">
                Phụ kiện di động
              </h3>
              <ul class="mega-content__menu-list">
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=sac-du-phong" class="link mega-content__menu-item-link">
                    Sạc dự phòng
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=sac-cap" class="link mega-content__menu-item-link">
                    Sạc,cáp
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=op-lung-dien-thoai" class="link mega-content__menu-item-link">
                    Ốp lưng điện thoại
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=mieng-dan-dien-thoai" class="link mega-content__menu-item-link">
                    Miếng dán điện thoại
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=gay-chup-anh" class="link mega-content__menu-item-link">
                    Gậy chụp ảnh
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=de-moc-dien-thoai" class="link mega-content__menu-item-link">
                    Đế, móc điện thoại
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=gia-do-dien-thoai" class="link mega-content__menu-item-link">
                    Giá đỡ điện thoại
                  </a>
                </li>
              </ul>
            </div>
            <!-- end mega content item -->

            <!-- mega content item -->
            <div class="mega-content__item">
              <h3 class="mega-content__title">
                Phụ kiện laptop
              </h3>
              <ul class="mega-content__menu-list">
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=chuot-ban-phim" class="link mega-content__menu-item-link">
                    Chuột, bàn phím
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=balo-tui-chong-soc" class="link mega-content__menu-item-link">
                    Balo, túi chống sốc
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=gia-do-laptop" class="link mega-content__menu-item-link">
                    Giá đỡ laptop
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=phan-mem" class="link mega-content__menu-item-link">
                    Phần mềm
                  </a>
                </li>
              </ul>
            </div>
            <!-- end mega content item -->

            <!-- mega content item -->
            <div class="mega-content__item">
              <h3 class="mega-content__title">
                Thiết bị âm thanh
              </h3>
              <ul class="mega-content__menu-list">
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=tai-nghe" class="link mega-content__menu-item-link">
                    Tai nghe
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=loa" class="link mega-content__menu-item-link">
                    Loa
                  </a>
                </li>
              </ul>
            </div>
            <!-- end mega content item -->

            <!-- mega content item -->
            <div class="mega-content__item">
              <h3 class="mega-content__title">
                Thiết bị lưu trữ
              </h3>
              <ul class="mega-content__menu-list">
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=o-cung-di-dong" class="link mega-content__menu-item-link">
                    Ổ cứng di động
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=the-nho" class="link mega-content__menu-item-link">
                    Thẻ nhớ
                  </a>
                </li>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category=usb" class="link mega-content__menu-item-link">
                    USB
                  </a>
                </li>
              </ul>
            </div>
            <!-- end mega content item -->
          </div>
        </li>
        <li class="main-menu__item <?php echo strpos($path, '/news.php') != false ? 'active' : ''; ?>">
          <a href="./news.php" class="link main-menu__item-link">Tin tức</a>
        </li>
        <li class="main-menu__item <?php echo strpos($path, '/about.php') != false ? 'active' : ''; ?>">
          <a href="./about.php" class="link main-menu__item-link">Giới thiệu</a>
        </li>
        <li class="main-menu__item <?php echo strpos($path, '/contact.php') != false ? 'active' : ''; ?>">
          <a href="./contact.php" class="link main-menu__item-link">Liên hệ</a>
        </li>
      </ul>
    </nav>
  </div>
  <!-- end bottom header -->
</header>