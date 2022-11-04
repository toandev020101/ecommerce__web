<?php
  $url = $_SERVER['REQUEST_URI'];
  $path = substr($url, 15);

  $product_list = [];
  if(isset($_SESSION['product_list'])){
    $product_list = $_SESSION['product_list'];
  }

  if(isset($_POST['btnDel'])){
    $index = $_POST['btnDel'];
    array_splice($_SESSION['product_list'], $index, 1);

    $pos = strpos($path, '.php');
    if(!is_bool($pos)){
      $file_name = substr($path, 1, $pos - 1);
      toast($file_name . '__toast', 'success', 'Xóa thành công');
    }

    $product_list = $_SESSION['product_list'];
  }

  if(isset($_POST['btnLogout'])){
    unset($_SESSION['user']);
    
    $pos = strpos($path, '.php');
    if(!is_bool($pos)){
      $file_name = substr($path, 1, $pos - 1);
      toast($file_name . '__toast', 'success', 'Đăng xuất thành công');
    }
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
              <span class="badge__count badge__count--primary">
                <?php echo count($product_list);?>
              </span>
            </a>

            <!-- cart menu -->
            <div class="cart__list <?php echo count($product_list) == 0 ? 'cart__list--no-cart' : ''; ?>">
              <?php
                if(count($product_list) == 0){
              ?>
              <!-- no cart -->
              <div class="cart__item--no-cart cart__item--arrow">
                <img src="./assets/images/no_cart.png" alt="no-cart" class="cart__item--no-cart-img">
                <span class="cart__item--no-cart-text">Chưa có sản phẩm</span>
              </div>
              <!-- end no cart -->

              <?php
                }else{
              ?>

              <h4 class="cart__item-title cart__item--arrow">
                Sản phẩm đã thêm
              </h4>
              <ul class="cart__list-item">
                <?php
                  foreach ($product_list as  $index => $product){
                    $product_id = $product['id'];

                    $sql_product_by_id = "SELECT * FROM products WHERE id = $product_id";
                    $query_product_by_id = mysqli_query($conn, $sql_product_by_id);
                    $row_product_by_id = mysqli_fetch_assoc($query_product_by_id);
                ?>
                <!-- cart item -->
                <li class="cart__item">
                  <img src="./uploads/<?php echo $row_product_by_id['thumbnail'];?>"
                    alt="<?php echo $row_product_by_id['thumbnail'];?>" class="cart__item-img">
                  <div class="cart__item-info">
                    <div class="cart__item-head">
                      <h5 class="cart__item-name">
                        <?php echo $row_product_by_id['name'];?>
                      </h5>
                      <div class="cart__item-price-wrapper">
                        <span class="cart__item-price"><?php echo number_format($product['price']);?>đ</span>
                        <span class="cart__item-multiply">x</span>
                        <span class="cart__item-quantity"><?php echo $product['quantity'];?></span>
                      </div>
                    </div>

                    <div class="cart__item-body">
                      <div class="cart__item-description">
                        <span>Màu sắc: <?php echo $product['color'];?></span>
                      </div>
                      <form action="" method="post">
                        <span class="cart__item-remove">Xóa</span>
                        <input type="submit" name="btnDel" value="<?php echo $index;?>" hidden>
                      </form>
                    </div>
                  </div>
                </li>
                <!-- end cart item -->
                <?php
                  }
                ?>
              </ul>

              <a href="./cart.php" class="link btn btn--primary cart__view">
                Xem giỏ hàng
              </a>

              <?php
                }
              ?>
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
                $src = $avatar == 'no_avatar.jpg' ? "./assets/images/$avatar" : "./uploads/$avatar";

                echo "<a href='#' class='link auth__info'>
                <img src='$src' alt='$avatar' class='auth__info-avatar'>
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
        <?php
          $sql_category_all = "SELECT * FROM categories";
          $query_category_all = mysqli_query($conn, $sql_category_all);

          while($row_category = mysqli_fetch_assoc($query_category_all)){
            if($row_category['parent_id'] == 0){
        ?>

        <?php
          $category_id = $row_category['id'];
          
          $sql_category_list_by_parent_id = "SELECT * FROM categories WHERE parent_id = $category_id";
          $query_category_list_by_parent_id = mysqli_query($conn, $sql_category_list_by_parent_id);
          $num_category_list_by_parent_id = mysqli_num_rows($query_category_list_by_parent_id);
        ?>
        <li class="main-menu__item <?php echo $num_category_list_by_parent_id > 0 ? "mega-dropdown" : '' ?> <?php 
          $category_slug = $row_category['slug'];
          if($category_slug == 'index'){
            echo $path == '/' || strpos($path, 'index.php') != false ? 'active' : '';
          }else{
            echo strpos($path, "$category_slug.php") != false ? 'active' : '';
          }
        ?>">
          <a href="./<?php echo $row_category['slug']; ?>.php"
            class="link main-menu__item-link"><?php echo $row_category['name'];?>
            <?php echo $num_category_list_by_parent_id > 0 ? "<i class='bx bx-chevron-down main-menu__item-icon'></i>" : '' ?>
          </a>
          <?php
            if($num_category_list_by_parent_id > 0){
          ?>
          <div class="mega-content">
            <?php
              while($row_category_by_parent_id = mysqli_fetch_assoc($query_category_list_by_parent_id)){
            ?>
            <!-- mega content item -->
            <div class="mega-content__item">
              <h3 class="mega-content__title">
                <?php echo $row_category_by_parent_id['name']; ?>
              </h3>
              <ul class="mega-content__menu-list">
                <?php
                  $category_2_id = $row_category_by_parent_id['id'];
          
                  $sql_category_list_2_by_parent_id = "SELECT * FROM categories WHERE parent_id = $category_2_id";
                  $query_category_list_2_by_parent_id = mysqli_query($conn, $sql_category_list_2_by_parent_id);
                  
                  while ($row_category_2_by_parent_id = mysqli_fetch_assoc($query_category_list_2_by_parent_id)) {
                ?>
                <li class="mega-content__menu-item">
                  <a href="./products.php?category_slug=<?php echo $row_category_2_by_parent_id['slug'];?>"
                    class="link mega-content__menu-item-link">
                    <?php echo $row_category_2_by_parent_id['name'];?>
                  </a>
                </li>
                <?php
                  }
                ?>
              </ul>
            </div>
            <!-- end mega content item -->
            <?php
              }
            ?>
          </div>
          <?php
            }
          ?>
        </li>
        <?php
            }
          }
        ?>
      </ul>
    </nav>
  </div>
  <!-- end bottom header -->
</header>