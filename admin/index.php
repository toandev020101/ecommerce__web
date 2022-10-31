<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Thống kê</title>
  <?php include_once('../partials/admin/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="../assets/css/_base.css">
  <link rel="stylesheet" href="../assets/css/admin/_app.css">
  <link rel="stylesheet" href="../assets/css/admin/sidebar.css">
  <link rel="stylesheet" href="../assets/css/admin/header.css">
  <link rel="stylesheet" href="../assets/css/admin/index.css">
  <!-- main css -->
</head>

<body>
  <div class="bg-main">
    <!-- sidebar -->
    <?php include_once('../partials/admin/sidebar.php') ?>
    <!-- end sidebar -->
  </div>

  <div class="bg-second container">
    <!-- header -->
    <?php include_once('../partials/admin/header.php') ?>
    <!-- end header -->

    <!-- content -->
    <div class="content">
      <h2 class="title">Thống kê</h2>

      <div class="statistical">
        <div class="box statistical__box">
          <i class='bx bx-package statistical__box-icon'></i>
          <div>
            <h3 class="statistical__box-number">1,000</h3>
            <span class="statistical__box-name">Tổng doanh số</span>
          </div>
        </div>
        <div class="box statistical__box">
          <i class='bx bx-receipt statistical__box-icon'></i>
          <div>
            <h3 class="statistical__box-number">800</h3>
            <span class="statistical__box-name">Tổng đơn hàng</span>
          </div>
        </div>
        <div class="box statistical__box">
          <i class='bx bx-dollar-circle statistical__box-icon'></i>
          <div>
            <h3 class="statistical__box-number">10,000,000</h3>
            <span class="statistical__box-name">Tổng thu nhập</span>
          </div>
        </div>
        <div class="box statistical__box">
          <i class='bx bx-repost statistical__box-icon'></i>
          <div>
            <h3 class="statistical__box-number">100</h3>
            <span class="statistical__box-name">Tổng trả hàng</span>
          </div>
        </div>
      </div>
    </div>
    <!-- end content -->
  </div>

  <!-- js -->
  <script src="../assets/js/_base.js"></script>
  <script src="../assets/js/admin/_app.js"></script>
  <!-- end js -->
</body>

</html>