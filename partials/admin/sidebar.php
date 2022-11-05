<?php
  $url = $_SERVER['REQUEST_URI'];
  $path = substr($url, 21);

  if(isset($_POST['btnLogout'])){
    unset($_SESSION['user']);
    toast('login__toast', 'success', 'Đăng xuất thành công');
    redirect('../login.php');
  }
?>

<!-- sidebar -->
<nav class="sidebar">
  <div class="sidebar__head">
    <a href="./index.php" class="link sidebar__logo-wrapper">
      <i class='bx bx-shopping-bag sidebar__logo-icon'></i>
      <span>PKShop</span>
    </a>
  </div>

  <ul class="sidebar__menu-list">
    <li class="sidebar__menu-item <?php echo $path == '/' || strpos($path, 'index.php') != false ? 'active' : ''; ?>">
      <a href="./index.php" class="link sidebar__menu-link" tooltip-title="Thống kê">
        <i class='bx bx-bar-chart-alt sidebar__menu-icon'></i>
        <span class="sidebar__menu-text">Thống kê</span>
      </a>
    </li>
    <li class="sidebar__menu-item <?php echo strpos($path, 'categories.php') != false ? 'active' : ''; ?>">
      <a href="./categories.php" class="link sidebar__menu-link" tooltip-title="Danh mục">
        <i class='bx bx-category-alt sidebar__menu-icon'></i>
        <span class="sidebar__menu-text">Danh mục</span>
      </a>
    </li>
    <li class="sidebar__menu-item <?php echo strpos($path, 'products.php') != false ? 'active' : ''; ?>">
      <a href="./products.php" class="link sidebar__menu-link" tooltip-title="Sản phẩm">
        <i class='bx bx-package sidebar__menu-icon'></i>
        <span class="sidebar__menu-text">Sản phẩm</span>
      </a>
    </li>
    <li class="sidebar__menu-item <?php echo strpos($path, 'orders.php') != false ? 'active' : ''; ?>">
      <a href="./orders.php" class="link sidebar__menu-link" tooltip-title="Đơn hàng">
        <i class='bx bx-clipboard sidebar__menu-icon'></i>
        <span class="sidebar__menu-text">Đơn hàng</span>
      </a>
    </li>
    <li class="sidebar__menu-item <?php echo strpos($path, 'users.php') != false ? 'active' : ''; ?>">
      <a href="./users.php" class="link sidebar__menu-link" tooltip-title="Hiển thị">
        <i class='bx bx-user sidebar__menu-icon'></i>
        <span class="sidebar__menu-text">Tài khoản</span>
      </a>
    </li>
  </ul>

  <form action="" method="post">
    <button class="reset__btn" name="btnLogout">
      <div class="sidebar__logout sidebar__menu-item">
        <span class="sidebar__menu-link" tooltip-title="Đăng xuất">
          <i class='bx bx-log-out sidebar__menu-icon'></i>
          <span class="sidebar__menu-text">Đăng xuất</span>
        </span>
      </div>
    </button>
  </form>
</nav>
<!-- end sidebar -->