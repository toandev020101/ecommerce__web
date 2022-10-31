<?php
  require_once('../database/connectdb.php');
  require_once('../helper/function.php');
  session_start();

  if(isset($_GET["id"])){
    // lấy id trên url
    $id = $_GET["id"];

    // lấy đơn hàng theo id
    $sql_order_by_id = "SELECT * FROM orders WHERE id = $id";
    $query_order_by_id = mysqli_query($conn, $sql_order_by_id);
    $row_order_by_id = mysqli_fetch_assoc($query_order_by_id);
  }

  if(isset($_POST["btnSubmit"])){
    $status_id = $_POST["status_id"];
    $sql_order_update = "UPDATE orders SET status_id = $status_id WHERE id = $id";
    $query_order_update = mysqli_query($conn, $sql_order_update);

    if($query_order_update){
      toast('orders__toast', 'success', 'Chỉnh sửa thành công');
      redirect("orders.php");
    }else {
      toast('edit-order__toast', 'error', 'Chỉnh sửa thất bại');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Chỉnh sửa đơn hàng</title>
  <?php include_once('../partials/admin/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="../assets/css/_base.css">
  <link rel="stylesheet" href="../assets/css/admin/_app.css">
  <link rel="stylesheet" href="../assets/css/admin/sidebar.css">
  <link rel="stylesheet" href="../assets/css/admin/header.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>

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
      <h2 class="title">Chỉnh sửa đơn hàng</h2>

      <form method="post" class="box">
        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Tên khách hàng <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" placeholder="Họ và tên"
              value="<?php echo $row_order_by_id["fullname"];?>" readonly>
          </div>

          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Số điện thoại <span class="required">*</span>
            </div>
            <input type="tel" class="input read-add-edit__input" placeholder="Số điện thoại"
              value="<?php echo $row_order_by_id["phone_num"];?>" readonly>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Địa chỉ <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" placeholder="Địa chỉ"
              value="<?php echo $row_order_by_id["address"]; ?>" readonly>
          </div>

          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Phương thức thanh toán <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" placeholder="Phương thức thanh toán" value="<?php 
                $payment_method = $row_order_by_id['payment_method'];
                echo $payment_method == 0 ? 'Thanh toán sau khi nhận hàng' : 'Banking';
              ?>" readonly>
          </div>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Ghi chú
          </div>
          <textarea class="textarea read-add-edit__input" placeholder="Ghi chú"
            readonly><?php echo $row_order_by_id['note'];?></textarea>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Danh sách sản phẩm <span class="required">*</span>
          </div>
          <!-- table -->
          <table>
            <thead>
              <tr>
                <th>Ảnh sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Màu sắc</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Số tiền</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $order_id = $row_order_by_id["id"];
                $sql_order_detail_list_by_order_id = "SELECT * FROM order_details WHERE order_id = $order_id";
                $query_order_detail_list_by_order_id = mysqli_query($conn, $sql_order_detail_list_by_order_id);

                $total_price = 0;
                while($row_order_detail_by_order_id = mysqli_fetch_assoc($query_order_detail_list_by_order_id)){
                  $product_id = $row_order_detail_by_order_id['product_id'];

                  $sql_product_by_id = "SELECT * FROM products WHERE id = $product_id";
                  $query_product_by_id = mysqli_query($conn, $sql_product_by_id);
                  $row_product_by_id = mysqli_fetch_assoc($query_product_by_id);

                  $total_price += $row_order_detail_by_order_id['price'] * $row_order_detail_by_order_id['quantity'];
              ?>
              <tr>
                <td>
                  <img src="../uploads/<?php echo $row_product_by_id['thumbnail'];?>"
                    alt="<?php echo $row_product_by_id['thumbnail'];?>" class="img">
                </td>
                <td>
                  <?php echo $row_product_by_id['name'];?>
                </td>
                <td>
                  <?php echo $row_order_detail_by_order_id['color'];?>
                </td>
                <td>
                  <div class="price"><?php echo number_format($row_order_detail_by_order_id['price']);?>đ</div>
                </td>
                <td>
                  <?php echo $row_order_detail_by_order_id['quantity'];?>
                </td>
                <td>
                  <div class="price">
                    <?php echo number_format($row_order_detail_by_order_id['price'] * $row_order_detail_by_order_id['quantity']);?>đ
                  </div>
                </td>
                <td>
                  <div class="action">
                    <a href="../product-detail.php?slug=<?php echo $row_product_by_id['slug'];?>"
                      class="link tooltip action__btn" tooltip-title="Xem chi tiết">
                      <i class='bx bx-detail action__icon'></i>
                    </a>
                  </div>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
          <!-- end table -->
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Tổng tiền <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" placeholder="Tổng tiền"
              value="<?php echo number_format($total_price);?>" readonly>
          </div>

          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Ngày đặt <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" placeholder="Ngày đặt"
              value="<?php echo date_format(date_create($row_order_by_id['created_at']), 'H:i:s, d/m/Y');?>" readonly>
          </div>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Trạng thái <span class="required">*</span>
          </div>
          <div class="dropdown">
            <div class="dropdown__select">
              <span class="dropdown__selected">
                <?php
                  $status_id = $row_order_by_id['status_id'];
                  
                  $sql_status_by_id = "SELECT name FROM status WHERE id = $status_id";
                  $query_status_by_id = mysqli_query($conn, $sql_status_by_id);
                  $row_status_by_id = mysqli_fetch_assoc($query_status_by_id);

                  echo $row_status_by_id['name'];
                ?>
              </span>
              <i class='bx bxs-chevron-down dropdown__select-icon'></i>
              <input type="text" class="dropdown__input" value="<?php echo $row_order_by_id['status_id'];?>"
                name="status_id" hidden>
            </div>

            <ul class="dropdown__list read-add-edit__dropdown-list">
              <?php
                  $sql_status_by_type = "SELECT * FROM status WHERE type = 1";
                  $query_status_by_type = mysqli_query($conn, $sql_status_by_type);
                  while($row_status = mysqli_fetch_assoc($query_status_by_type)){
                ?>
              <li
                class="dropdown__item <?php echo $row_order_by_id['status_id'] == $row_status['id'] ? 'active' : '';?>">
                <span class="dropdown__text"
                  data-value="<?php echo $row_status['id']; ?>"><?php echo $row_status['name']; ?></span>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>

        <div class="btn-wrapper read-add-edit__line">
          <button class="btn btn--primary" name="btnSubmit">Lưu lại</button>
        </div>
      </form>
    </div>
    <!-- end content -->
  </div>

  <!-- js -->
  <script src="../assets/js/_base.js"></script>
  <script>
  <?php
    // hiển thị thông báo
    if(isset($_SESSION['edit-order__toast'])){
      echo $_SESSION['edit-order__toast'];
      unset($_SESSION['edit-order__toast']);
    }
  ?>
  </script>
  <script src="../assets/js/admin/_app.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>