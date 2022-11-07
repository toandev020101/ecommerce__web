<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');

  session_start();

  $sql_by_category_id = '';
  if(isset($_GET['category_slug'])){
    $category_slug = $_GET['category_slug'];

    // lấy danh mục theo slug
    $sql_category_by_slug = "SELECT id FROM categories WHERE slug = '$category_slug'";
    $query_category_by_slug = mysqli_query($conn, $sql_category_by_slug);
    $row_category_by_slug = mysqli_fetch_array($query_category_by_slug);

    $category_id = $row_category_by_slug['id'];

    $sql_by_category_id = "and category_id = $category_id";
  }

  $sql_by_price_from_to = '';
  if(isset($_GET['price_from'])){
    // điều kiện
    $price_from = $_GET['price_from'];
    $price_to = $_GET['price_to'];
    $sql_by_price_from_to = "and (price - discount) BETWEEN $price_from and $price_to";
  }

  $status_list_id = queryListId('status_list_id');
  $sql_left_join_product_status = '';
  $sql_by_status_id = '';
  // kiểm tra status của product
  if(count($status_list_id) > 0){
    // nối bảng
    $sql_left_join_product_status = 'LEFT JOIN product_status ON products.id = product_status.product_id';
    
    // điều kiện
    $sql_by_status_id = "and status_id in (";
    foreach($status_list_id as $index => $status_id){
      $sql_by_status_id .= "$status_id";
      if($index != count($status_list_id) - 1){
        $sql_by_status_id .= ',';
      }
    }

    $sql_by_status_id .= ')';
  }

  $color_list_id = queryListId('color_list_id');
  $sql_left_join_product_colors = '';
  $sql_by_color_id = '';
  // kiểm tra colors của product
  if(count($color_list_id) > 0){
    // nối bảng
    $sql_left_join_product_colors = 'LEFT JOIN product_colors ON products.id = product_colors.product_id';
    
    // điều kiện
    $sql_by_color_id = "and color_id in (";
    foreach($color_list_id as $index => $color_id){
      $sql_by_color_id .= "$color_id";
      if($index != count($color_list_id) - 1){
        $sql_by_color_id .= ',';
      }
    }

    $sql_by_color_id .= ')';
  }

  // sort
  $sql_order_by = 'created_at DESC';
  if(isset($_GET['order_by'])){
    $sql_order_by = $_GET['order_by'];
  }

  if(isset($_GET['page'])){
    // lấy page và limit trên url
    $page = $_GET['page'];
    $limit = $_GET['limit'];
  }else {
    // page và limit mặc định
    $page = 1;
    $limit = 8;
  }

  $offset = ($page - 1) * $limit;

  // lấy sản phẩm theo phân trang
  $sql_product_list_pagination = "SELECT DISTINCT products.* FROM products $sql_left_join_product_status $sql_left_join_product_colors WHERE deleted = 0 $sql_by_category_id $sql_by_price_from_to $sql_by_status_id $sql_by_color_id ORDER BY $sql_order_by limit $offset, $limit";
  $query_product_list_pagination = mysqli_query($conn, $sql_product_list_pagination);

  // lấy toàn bộ sản phẩm
  $sql_product_all = "SELECT DISTINCT products.* FROM products $sql_left_join_product_status $sql_left_join_product_colors WHERE deleted = 0 $sql_by_category_id $sql_by_price_from_to $sql_by_status_id $sql_by_color_id";
  $query_product_all = mysqli_query($conn, $sql_product_all);
  $totalRecord = mysqli_num_rows($query_product_all);
  $totalPage = ceil($totalRecord / $limit);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Sản phẩm</title>
  <?php include_once('./partials/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="./assets/css/_base.css">
  <link rel="stylesheet" href="./assets/css/_app.css">
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/products.css">
  <link rel="stylesheet" href="./assets/css/footer.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>
  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- products content -->
  <div class="bg-main">
    <div class="container">
      <!-- breadcumb -->
      <div class="breadcumb">
        <a href="/" class="link">Trang chủ</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="./products.php" class="link active">Tất cả sản phẩm</a>
      </div>
      <!-- end breadcumb -->

      <!-- category -->
      <ul class="products-category__list">
        <?php
          // lấy danh mục 
          $sql_category_by_slug = "SELECT id FROM categories WHERE slug = 'products'";
          $query_category_by_slug = mysqli_query($conn, $sql_category_by_slug);
          $row_category_by_slug = mysqli_fetch_assoc($query_category_by_slug);
          $category_id = $row_category_by_slug['id'];

          // lấy danh sách danh mục
          $sql_category_list_by_parent_id = "SELECT * FROM categories WHERE parent_id = $category_id";
          $query_category_list_by_parent_id = mysqli_query($conn, $sql_category_list_by_parent_id);
          while($row_category_by_parent_id = mysqli_fetch_assoc($query_category_list_by_parent_id)){
        ?>
        <li class="products-category__item">
          <img src="./uploads/<?php echo $row_category_by_parent_id['thumbnail'];?>"
            alt="<?php echo $row_category_by_parent_id['thumbnail'];?>" class="products-category__img">
          <span class="products-category__name">
            <?php echo $row_category_by_parent_id['name'];?>
          </span>

          <ul class="products-category__sub-list">
            <?php
              $category_2_id = $row_category_by_parent_id['id'];

              // lấy danh sách danh mục
              $sql_category_list_2_by_parent_id = "SELECT * FROM categories WHERE parent_id = $category_2_id";
              $query_category_list_2_by_parent_id = mysqli_query($conn, $sql_category_list_2_by_parent_id);
              while($row_category_2_by_parent_id = mysqli_fetch_assoc($query_category_list_2_by_parent_id)){
            ?>
            <li class="products-category__sub-item">
              <a href="./products.php?category_slug=<?php echo $row_category_2_by_parent_id['slug'];?>" class="link">
                <img src="./uploads/<?php echo $row_category_2_by_parent_id['thumbnail'];?>"
                  alt="<?php echo $row_category_2_by_parent_id['thumbnail'];?>" class="products-category__sub-img">
                <div class="products-category__sub-name">
                  <?php echo $row_category_2_by_parent_id['name'];?>
                </div>
              </a>
            </li>
            <?php
              }
            ?>
          </ul>
        </li>
        <?php
          }
        ?>
      </ul>
      <!-- end category -->

      <div class="products-content">
        <!-- filter -->
        <div class="products-filter">
          <!-- filter item -->
          <div class="products-filter__box">
            <span class="products-filter__title">
              Khoảng giá
            </span>

            <div class="products-filter__input-wrapper">
              <div class="input-field">
                <input type="number" class="input-field__input products-filter__input" placeholder=" ">
                <label class="input-field__label">Từ</label>
              </div>

              <span class="products-filter__hyphen">-</span>

              <div class="input-field">
                <input type="number" class="input-field__input products-filter__input" placeholder=" ">
                <label class="input-field__label">Đến</label>
              </div>
            </div>

            <span class='products-filter__error'>Vui lòng nhập đủ khoảng giá (từ - đến)</span>

            <a href="./products.php?<?php
              // lấy query string
              $query_string = $_SERVER['QUERY_STRING'];
              if(!empty($query_string)){
                // tách key=value
                $query_array = explode('&',$query_string);

                $query_array_new = [];
                foreach($query_array as $query_item){
                  // tách key,value
                  $query_item_array = explode('=', $query_item);
                  if($query_item_array[0] != 'page' && $query_item_array[0] != 'limit' && $query_item_array[0] != 'price_from' && $query_item_array[0] != 'price_to'){
                    // thêm key=value vào mảng
                    array_push($query_array_new, $query_item);
                  }
                }

                $query_string = '';
                foreach($query_array_new as $index => $query_item){
                  // gộp key=value
                  $query_string .= $query_item;
                  if($index != count($query_array_new) - 1){
                    $query_string .= '&';
                  }
                }

                echo "$query_string&";
              }
            ?>" class="link btn btn--primary products-filter__btn products-filter__btn-price">Áp dụng</a>
          </div>
          <!-- end filter item -->

          <!-- filter item -->
          <div class="products-filter__box">
            <span class="products-filter__title">
              Trạng thái
            </span>

            <ul class="products-filter__list">
              <?php
                // lấy status
                $sql_status_by_type = "SELECT * FROM status WHERE type = 0";
                $query_status_by_type = mysqli_query($conn, $sql_status_by_type);

                // lấy list status id
                $status_list_id = queryListId('status_list_id');
                
                while($row_status_by_type = mysqli_fetch_assoc($query_status_by_type)){
              ?>
              <li class="products-filter__item">
                <a href="./products.php?<?php
                  $status_id = $row_status_by_type['id'];

                  // lấy query string
                  $query_string = $_SERVER['QUERY_STRING']; 
                  if(!empty($query_string)){
                    $query_string = queryString($query_string, 'status_list_id', $status_id, 'list');
                    echo $query_string;
                  }else {
                    echo "status_list_id=$status_id";
                  }
                ?>" class="link products-filter__checkbox">
                  <label for="status<?php echo $row_status_by_type['id'];?>" class="checkbox">
                    <input type="checkbox" id="status<?php echo $row_status_by_type['id'];?>" class="checkbox__input" <?php
                      echo !is_bool(array_search($row_status_by_type['id'], $status_list_id)) ? 'checked' : '';
                    ?>>
                    <div class="checkbox__box"></div>
                    <?php echo $row_status_by_type['name'];?>
                  </label>
                </a>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
          <!-- end filter item -->

          <!-- filter item -->
          <div class="products-filter__box">
            <span class="products-filter__title">
              Màu sắc
            </span>

            <ul class="products-filter__list">
              <?php
                // lấy colors
                $sql_color_all = "SELECT * FROM colors";
                $query_color_all = mysqli_query($conn, $sql_color_all);

                // lấy list color id
                $color_list_id = queryListId('color_list_id');
                
                while($row_color = mysqli_fetch_assoc($query_color_all)){
              ?>
              <li class="products-filter__item">
                <a href="./products.php?<?php
                  $color_id = $row_color['id'];

                  // lấy query string
                  $query_string = $_SERVER['QUERY_STRING']; 
                  if(!empty($query_string)){
                    $query_string = queryString($query_string, 'color_list_id', $color_id, 'list');
                    echo $query_string;
                  }else {
                    echo "color_list_id=$color_id";
                  }
                ?>" class="link products-filter__checkbox">
                  <label for="color<?php echo $row_color['id'];?>" class="checkbox">
                    <input type="checkbox" name="" id="color<?php echo $row_color['id'];?>" class="checkbox__input" <?php
                      echo !is_bool(array_search($row_color['id'], $color_list_id)) ? 'checked' : '';
                    ?>>
                    <div class="checkbox__box"></div>
                    <?php echo $row_color['name'];?>
                  </label>
                </a>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
          <!-- end filter item -->

          <!-- filter item -->
          <div class="products-filter__box">
            <span class="products-filter__title">
              Đánh giá
            </span>

            <ul class="products-filter__list">
              <li class="products-filter__item">
                <a href="#" class="link products-filter__checkbox">
                  <label for="rating1" class="checkbox">
                    <input type="checkbox" name="" id="rating1" class="checkbox__input">
                    <div class="checkbox__box"></div>
                    <span class="rating products-filter__rating">
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                    </span>
                  </label>
                </a>
              </li>
              <li class="products-filter__item">
                <a href="#" class="link products-filter__checkbox">
                  <label for="rating2" class="checkbox">
                    <input type="checkbox" name="" id="rating2" class="checkbox__input">
                    <div class="checkbox__box"></div>
                    <span class="rating products-filter__rating">
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bx-star'></i>
                    </span>
                  </label>
                </a>
              </li>
              <li class="products-filter__item">
                <a href="#" class="link products-filter__checkbox">
                  <label for="rating3" class="checkbox">
                    <input type="checkbox" name="" id="rating3" class="checkbox__input">
                    <div class="checkbox__box"></div>
                    <span class="rating products-filter__rating">
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bx-star'></i>
                      <i class='bx bx-star'></i>
                    </span>
                  </label>
                </a>
              </li>
              <li class="products-filter__item">
                <a href="#" class="link products-filter__checkbox">
                  <label for="rating4" class="checkbox">
                    <input type="checkbox" name="" id="rating4" class="checkbox__input">
                    <div class="checkbox__box"></div>
                    <span class="rating products-filter__rating">
                      <i class='bx bxs-star'></i>
                      <i class='bx bxs-star'></i>
                      <i class='bx bx-star'></i>
                      <i class='bx bx-star'></i>
                      <i class='bx bx-star'></i>
                    </span>
                  </label>
                </a>
              </li>
              <li class="products-filter__item">
                <a href="#" class="link products-filter__checkbox">
                  <label for="rating5" class="checkbox">
                    <input type="checkbox" name="" id="rating5" class="checkbox__input">
                    <div class="checkbox__box"></div>
                    <span class="rating products-filter__rating">
                      <i class='bx bxs-star'></i>
                      <i class='bx bx-star'></i>
                      <i class='bx bx-star'></i>
                      <i class='bx bx-star'></i>
                      <i class='bx bx-star'></i>
                    </span>
                  </label>
                </a>
              </li>
            </ul>
          </div>
          <!-- end filter item -->

          <!-- filter item -->
          <div class="products-filter__box">
            <a href="./products.php" class="link btn btn--primary products-filter__btn">Xóa tất cả</a>
          </div>
          <!-- end filter item -->
        </div>
        <!-- end filter -->

        <!-- product list -->
        <div class="products-list">
          <!-- sort -->
          <div class="products-sort">
            <span class="products-sort__title">Sắp xếp theo:</span>
            <a href="./products.php?<?php
              // lấy query string
              $query_string = $_SERVER['QUERY_STRING']; 
              if(!empty($query_string)){
                $query_string = queryString($query_string, 'order_by', 'created_at+DESC', 'item');
                echo $query_string;
              }else {
                echo "order_by=created_at+DESC";
              }
            ?>"
              class="link btn products-sort__btn <?php echo $sql_order_by == 'created_at DESC' ? 'btn--primary' : '';?>">Mới
              nhất</a>

            <div class="dropdown products-sort__price">
              <div class="dropdown__select">
                <span class="dropdown__selected">
                  <?php
                    if($sql_order_by == '(price - discount) ASC'){
                      echo 'Giá: từ thấp đến cao';
                    }else if($sql_order_by == '(price - discount) DESC'){
                      echo 'Giá: từ cao đến thấp';
                    }else {
                      echo 'Giá';
                    }
                  ?>
                </span>
                <i class='bx bxs-chevron-down'></i>
              </div>
              <ul class="dropdown__list products-sort__price-list">
                <li class="dropdown__item <?php echo $sql_order_by == '(price - discount) ASC' ? 'active' : '';?>">
                  <a href="./products.php?<?php
                    // lấy query string
                    $query_string = $_SERVER['QUERY_STRING']; 
                    if(!empty($query_string)){
                      $query_string = queryString($query_string, 'order_by', '(price+-+discount)+ASC', 'item');
                      echo $query_string;
                    }else {
                      echo "order_by=(price+-+discount)+ASC";
                    }
                  ?>" class="link">
                    <span class="dropdown__text">
                      Giá: từ thấp đến cao
                    </span>
                  </a>
                </li>

                <li class="dropdown__item <?php echo $sql_order_by == '(price - discount) DESC' ? 'active' : '';?>">
                  <a href="./products.php?<?php
                    // lấy query string
                    $query_string = $_SERVER['QUERY_STRING']; 
                    if(!empty($query_string)){
                      $query_string = queryString($query_string, 'order_by', '(price+-+discount)+DESC', 'item');
                      echo $query_string;
                    }else {
                      echo "order_by=(price+-+discount)+DESC";
                    }
                  ?>" class="link">
                    <span class="dropdown__text">
                      Giá: từ cao đến thấp
                    </span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <!-- end sort -->

          <div class="product-list">
            <?php
              while($row_product = mysqli_fetch_assoc($query_product_list_pagination)){
            ?>
            <!-- product item -->
            <a href="./product-detail.php?slug=<?php echo $row_product['slug'];?>" class="link product-item">
              <div class="product-item__img"
                style="background-image: url(./uploads/<?php echo $row_product['thumbnail'];?>);">
              </div>

              <h4 class="product-item__name">
                <?php echo $row_product['name'];?>
              </h4>

              <div class="product-item__price">
                <?php
                  if($row_product['discount'] > 0){
                    $price = number_format($row_product['price']);
                    echo "<span class='product-item__price-old'>".$price."đ</span>";
                  }
                ?>

                <span class="product-item__price-current">
                  <?php echo number_format($row_product['price'] - $row_product['discount']);?>đ
                </span>
              </div>

              <div class="product-item__action">
                <span class="rating product-item__rating">
                  <i class='bx bxs-star'></i>
                  <i class='bx bxs-star'></i>
                  <i class='bx bxs-star'></i>
                  <i class='bx bxs-star'></i>
                  <i class='bx bx-star'></i>
                </span>

                <span class="product-item__sold">88 đã bán</span>
              </div>

              <?php
                $product_id = $row_product['id'];

                // lấy status id
                $sql_product_status_by_product_id = "SELECT status_id FROM product_status WHERE product_id = $product_id";
                $query_product_status_by_product_id = mysqli_query($conn, $sql_product_status_by_product_id);
                
                while($row_product_status_by_product_id = mysqli_fetch_assoc($query_product_status_by_product_id)){
                  $status_id = $row_product_status_by_product_id['status_id'];

                  // lấy status name
                  $sql_status_by_id = "SELECT name FROM status WHERE id = $status_id";
                  $query_status_by_id = mysqli_query($conn, $sql_status_by_id);
                  $row_status_by_id = mysqli_fetch_assoc($query_status_by_id);

                  $status_name = $row_status_by_id['name'];

                  if($status_name == 'Bán chạy'){
                    echo "<div class='product-item__best-selling'>
                      <i class='bx bx-check'></i>
                      <span>Bán chạy</span>
                    </div>";
                    break;
                  }
                }
              ?>

              <?php
                $discount = $row_product['discount'];

                if($discount > 0){
                  $price = $row_product['price'];
                  $percent = (int)($discount / $price * 100);

                  echo "<div class='product-item__sale-off'>
                    <span class='product-item__percent'>$percent%</span>
                    <div class='product-item__text'>Giảm</div>
                  </div>";
                }
              ?>
            </a>
            <!-- end product item -->
            <?php
              }
            ?>
          </div>

          <!-- pagination -->
          <?php
            if($totalPage > 1){
          ?>
          <ul class="pagination table__pagination <?php echo $totalRecord <= 0 ? 'hidden' : '';?>">
            <li class="pagination__item <?php echo $page == 1 ? 'hidden' : ''; ?>">
              <a href="./products.php?<?php
                $query_string = $_SERVER['QUERY_STRING'];
                if(!empty($query_string)) {
                  $pos = strpos($query_string, '&page');
                  if(!is_bool($pos)){
                    $query_string = substr($query_string, 0, $pos);
                  }
                  echo "$query_string&";
                }

                $page_prev = $page - 1;
                echo "page=$page_prev&limit=$limit";
              ?>" class="link pagination__item-link">
                <i class="pagination__item-icon bx bx-chevron-left"></i>
              </a>
            </li>

            <?php
              for($i = 1; $i <= $totalPage; $i++){
            ?>
            <li class="pagination__item <?php echo $page == $i ? 'active' : ''; ?>">
              <a href="./products.php?<?php
                $query_string = $_SERVER['QUERY_STRING'];
                if(!empty($query_string)) {
                  $pos = strpos($query_string, '&page');
                  if(!is_bool($pos)){
                    $query_string = substr($query_string, 0, $pos);
                  }
                  echo "$query_string&";
                }

                echo "page=$i&limit=$limit";
              ?>" class="link pagination__item-link"><?php echo $i; ?></a>
            </li>
            <?php
              }
            ?>

            <li class="pagination__item <?php echo $page == $totalPage ? 'hidden' : ''; ?>">
              <a href="./products.php?<?php
                $query_string = $_SERVER['QUERY_STRING'];
                if(!empty($query_string)) {
                  $pos = strpos($query_string, '&page');
                  if(!is_bool($pos)){
                    $query_string = substr($query_string, 0, $pos);
                  }
                  echo "$query_string&";
                }

                $page_next = $page + 1;
                echo "page=$page_next&limit=$limit";
              ?>" class="link pagination__item-link">
                <i class="pagination__item-icon bx bx-chevron-right"></i>
              </a>
            </li>
          </ul>
          <?php
            }
          ?>
          <!-- end pagination -->
        </div>
        <!-- end product list -->
      </div>
    </div>
  </div>
  <!-- end products content -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script>
  <?php
    if(isset($_SESSION['products__toast'])){
      echo $_SESSION['products__toast'];
      unset($_SESSION['products__toast']);
    }
  ?>
  </script>
  <script src="./assets/js/_app.js"></script>
  <script src="./assets/js/products.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>