<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Trang chủ</title>
  <?php include_once('./partials/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="./assets/css/_base.css">
  <link rel="stylesheet" href="./assets/css/_app.css">
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/index.css">
  <link rel="stylesheet" href="./assets/css/footer.css">
  <!-- main css -->
</head>

<body>
  <div id="toast">
  </div>

  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- hero section -->
  <div class="hero">
    <div class="slider">
      <div class="container">
        <!-- slide item -->
        <div class="slide active">
          <div class="slide__info">
            <div class="slide__info-content">
              <h3 class="top-down slide__info-name">
                JBL TUNE 750TNC
              </h3>
              <h2 class="top-down trans-delay-0-2 slide__info-short-description">
                Next-gen design
              </h2>
              <p class="top-down trans-delay-0-4">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis atque, repellendus amet praesentium
                maxime quos quia magnam fugit libero similique sapiente repudiandae odio aliquam illum modi fugiat nobis
                ullam unde. Fugit.
              </p>
              <div class="top-down trans-delay-0-6 slide__info-btn">
                <a href="#" class="link btn btn--primary">
                  Mua ngay
                </a>
              </div>
            </div>
          </div>

          <div class="slide__img top-down">
            <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
              alt="">
          </div>
        </div>
        <!-- end slide item -->

        <!-- slide item -->
        <div class="slide row-revere">
          <div class="slide__info">
            <div class="slide__info-content">
              <h3 class="top-down slide__info-name">
                JBL Quantum ONE
              </h3>
              <h2 class="top-down trans-delay-0-2 slide__info-short-description">
                Ipsum dolor
              </h2>
              <p class="top-down trans-delay-0-4">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis atque, repellendus amet praesentium
                maxime quos quia magnam fugit libero similique sapiente repudiandae odio aliquam illum modi fugiat
                nobis.
              </p>
              <div class="top-down trans-delay-0-6 slide__info-btn">
                <a href="#" class="link btn btn--primary">Mua ngay</a>
              </div>
            </div>
          </div>

          <div class="slide__img right-left">
            <img src="./assets/images/JBL_E55BT_KEY_BLACK_6175_FS_x1-1605x1605px.png" alt="">
          </div>
        </div>
        <!-- end slide item -->

        <!-- slide item -->
        <div class="slide">
          <div class="slide__info">
            <div class="slide__info-content">
              <h3 class="top-down slide__info-name">
                JBL JR 310BT
              </h3>
              <h2 class="top-down trans-delay-0-2 slide__info-short-description">
                consectetur, adipisicing elit
              </h2>
              <p class="top-down trans-delay-0-4">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis atque, repellendus amet praesentium
                maxime quos quia magnam fugit libero similique sapiente repudiandae odio aliquam.
              </p>
              <div class="top-down trans-delay-0-6 slide__info-btn">
                <a href="#" class="link btn btn--primary">Mua ngay</a>
              </div>
            </div>
          </div>

          <div class="slide__img left-right">
            <img src="./assets/images/JBL_JR 310BT_Product Image_Hero_Skyblue.png" alt="">
          </div>
        </div>
        <!-- end slide item -->
      </div>

      <!-- slide controll -->
      <button class="slide-controll slide-prev">
        <i class='bx bxs-chevron-left'></i>
      </button>
      <button class="slide-controll slide-next">
        <i class='bx bxs-chevron-right'></i>
      </button>
      <!-- end slide controll -->
    </div>
  </div>
  <!-- end hero section -->

  <!-- promotion section -->
  <div class="promotion container">
    <!-- promotion item -->
    <a href="#" class="link promotion__box">
      <div class="promotion__text">
        <h3 class="promotion__title">
          Headphone & Earbuds
        </h3>
        <p class="promotion__description">
          Lorem, ipsum dolor sit amet consectetur?
        </p>
      </div>
      <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png" alt=""
        class="promotion__img">
    </a>
    <!-- end promotion item -->
    <!-- promotion item -->
    <a href="#" class="link promotion__box">
      <div class="promotion__text">
        <h3 class="promotion__title">
          Headphone & Earbuds
        </h3>
        <p class="promotion__description">
          Lorem, ipsum dolor sit amet consectetur?
        </p>
      </div>
      <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png" alt=""
        class="promotion__img">
    </a>
    <!-- end promotion item -->
    <!-- promotion item -->
    <a href="#" class="link promotion__box">
      <div class="promotion__text">
        <h3 class="promotion__title">
          Headphone & Earbuds
        </h3>
        <p class="promotion__description">
          Lorem, ipsum dolor sit amet consectetur?
        </p>
      </div>
      <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png" alt=""
        class="promotion__img">
    </a>
    <!-- end promotion item -->
  </div>
  <!-- end promotion section -->

  <!-- product list -->
  <div class="section">
    <div class="container">
      <div class="section__header">
        <h2 class="section__header-title">Sản phẩm mới nhất</h2>
      </div>
      <div class="section__body product-list">
        <!-- product item -->
        <a href="#" class="link product-item">
          <div class="product-item__img"
            style="background-image: url(./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png);">
          </div>

          <h4 class="product-item__name">
            kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones
          </h4>

          <div class="product-item__price">
            <span class="product-item__price-old">1.200.000đ</span>
            <span class="product-item__price-current">990.000đ</span>
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

          <div class="product-item__best-selling">
            <i class='bx bx-check'></i>
            <span>Bán chạy</span>
          </div>

          <div class="product-item__sale-off">
            <span class="product-item__percent">10%</span>
            <div class="product-item__text">Giảm</div>
          </div>
        </a>
        <!-- end product item -->
      </div>
      <div class="section__footer">
        <a href="./products.php" class="link btn btn--primary">Xem tất cả</a>
      </div>
    </div>
  </div>
  <!-- end product list -->

  <!-- special product -->
  <div class="bg-second">
    <div class="special container">
      <div class="special__img">
        <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png" alt="">
      </div>

      <div class="special__info">
        <h3 class="special__name">
          JBL TUNE 750TNC
        </h3>
        <p class="special__description">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ipsam aliquid officia quo totam odit, id, porro
          perspiciatis veniam accusantium fugit vero, modi voluptatem deserunt dolore quod. Sapiente cupiditate
          itaque quaerat.
        </p>
        <a href="#" class="link btn btn--primary">Mua ngay</a>
      </div>
    </div>
  </div>
  <!-- end special product -->

  <!-- product list -->
  <div class="section">
    <div class="container">
      <div class="section__header">
        <h2 class="section__header-title">Sản phẩm bán chạy nhất</h2>
      </div>
      <div class="section__body product-list lastest-list">
        <!-- product item -->
        <a href="#" class="link product-item">
          <div class="product-item__img"
            style="background-image: url(./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png);">
          </div>

          <h4 class="product-item__name">
            kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones
          </h4>

          <div class="product-item__price">
            <span class="product-item__price-old">1.200.000đ</span>
            <span class="product-item__price-current">990.000đ</span>
          </div>

          <div class="product-item__action">
            <div class="rating product-item__rating">
              <i class='bx bxs-star product-item__star--gold'></i>
              <i class='bx bxs-star product-item__star--gold'></i>
              <i class='bx bxs-star product-item__star--gold'></i>
              <i class='bx bxs-star product-item__star--gold'></i>
              <i class='bx bxs-star'></i>
            </div>

            <span class="product-item__sold">88 đã bán</span>
          </div>

          <div class="product-item__best-selling">
            <i class='bx bx-check'></i>
            <span>Bán chạy</span>
          </div>

          <div class="product-item__sale-off">
            <span class="product-item__percent">10%</span>
            <div class="product-item__text">Giảm</div>
          </div>
        </a>
        <!-- end product item -->
      </div>
      <div class="section__footer">
        <a href="./products.php" class="link btn btn--primary">Xem tất cả</a>
      </div>
    </div>
  </div>
  <!-- end product list -->

  <!-- blogs -->
  <div class="section">
    <div class="container">
      <div class="section__header">
        <h2 class="section__header-title">Tin tức mới nhất</h2>
      </div>

      <div class="blog">
        <div class="blog__img">
          <img src="./assets/images/JBL_Quantum400_Lifestyle1.png" alt="">
        </div>
        <div class="blog__info">
          <div class="blog__title">
            Lorem ipsum dolor sit amet
          </div>
          <div class="blog__preview">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente quibusdam cupiditate id et nulla ipsum hic
            reprehenderit enim maxime officiis illum, eos voluptatum dolorem, voluptatem error sit quos, sint illo!
          </div>
          <a href="#" class="link btn btn--primary">Xem thêm</a>
        </div>
      </div>

      <div class="blog row-revere">
        <div class="blog__img">
          <img src="./assets/images/JBL_TUNE220TWS_Lifestyle_black.png" alt="">
        </div>
        <div class="blog__info">
          <div class="blog__title">
            Lorem ipsum dolor sit amet
          </div>
          <div class="blog__preview">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente quibusdam cupiditate id et nulla ipsum hic
            reprehenderit enim maxime officiis illum, eos voluptatum dolorem, voluptatem error sit quos, sint illo!
          </div>
          <a href="#" class="link btn btn--primary">Xem thêm</a>
        </div>
      </div>

      <div class="section__footer">
        <a href="./news.php" class="link btn btn--primary">Xem tất cả</a>
      </div>
    </div>
  </div>
  <!-- end blogs -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script>
  <?php
    // hiển thị thông báo
    if(isset($_SESSION['index__toast'])){
      echo $_SESSION['index__toast'];
      unset($_SESSION['index__toast']);
    }
  ?>
  </script>
  <script src="./assets/js/_app.js"></script>
  <script src="./assets/js/index.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>