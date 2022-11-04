<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');

  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Giỏ hàng</title>
  <?php include_once('./partials/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="./assets/css/_base.css">
  <link rel="stylesheet" href="./assets/css/_app.css">
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/order-success.css ">
  <link rel="stylesheet" href="./assets/css/footer.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>
  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- content -->
  <div class="order-success">
    <span class='order-success__icon'></span>
    <span class="order-success__toast">Đặt hàng thành công</span>
    <span class="order-success__description">
      Chúng tôi sẽ liên hệ với bạn ngay sau khi nhận được đơn hàng này
    </span>
    <span class="order-success__tel">Mọi thắc mắc xin liên hệ hotline: 0924 xxx xxx</span>

    <div>
      <a href="./index.php" class="link btn order-success__btn">Trở về trang chủ</a>
      <a href="./user/order.php" class="link btn btn--primary order-success__btn">Theo dõi đơn hàng</a>
    </div>
  </div>
  <!-- content -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script src="./assets/js/_app.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>