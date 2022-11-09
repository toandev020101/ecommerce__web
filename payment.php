<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');

  session_start();

  if(!isset($_SESSION['info'])){
    $_SESSION['info'] = [
      'fullname' => '',
      'phone_num' => '',
      'address' => 'Chưa có địa chỉ',
    ];
  }
  
  if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $_SESSION['info']['fullname'] = $user['fullname'];
    $_SESSION['info']['phone_num'] = $user['phone_num'];
    $_SESSION['info']['address'] = $user['address'];
  }

  $product_list = [];
  if(isset($_GET['action'])){
    array_push($product_list, $_SESSION['product_order']);
  }else {
    foreach ($_SESSION['product_list'] as $product){
      if($product['checked']){
        array_push($product_list, $product);
      }
    }
  }
  
  if(count($product_list) == 0){
    toast('cart__toast', 'error', 'Vui lòng chọn sản phẩm');
    redirect('./cart.php');
  }

  if(isset($_POST['btnAddress'])){
    $_SESSION['info']['fullname'] = $_POST['fullname'];
    $_SESSION['info']['phone_num'] = $_POST['phone_num'];
    $_SESSION['info']['address'] = $_POST['address'];
  }

  $info = $_SESSION['info'];

  if(isset($_POST['btnSubmit'])){
    $fullname = $_SESSION['info']['fullname'];
    $phone_num = $_SESSION['info']['phone_num'];
    $address = $_SESSION['info']['address'];
    
    $note = $_POST['note'];
    $payment_method = $_POST['payment_method'];
    
    $sql_status_by_name = "SELECT id FROM status WHERE name = 'Chờ xác nhận' and type = 1";
    $query_status_by_name = mysqli_query($conn, $sql_status_by_name);
    $row_status_by_name = mysqli_fetch_assoc($query_status_by_name);
    $status_id = $row_status_by_name['id'];

    if(empty($fullname) || empty($phone_num) || $address == 'Chưa có địa chỉ'){
      toast('payment__toast', 'error', 'Vui lòng nhập địa chỉ');
    }else {
      // thêm đơn hàng
      $sql_order_add = "INSERT INTO orders(fullname, phone_num, address, note, payment_method, status_id) VALUES ('$fullname', '$phone_num', '$address', '$note', $payment_method, $status_id)";
      $query_order_add = mysqli_query($conn, $sql_order_add);

      if($query_order_add){
        // thêm chi tiết đơn hàng
        $order_id = mysqli_insert_id($conn);
        foreach ($product_list as $product){
          $product_id = $product['id'];
          $color = $product['color'];
          $price = $product['price'];
          $quantity = $product['quantity'];

          $sql_order_detail_add = "INSERT INTO order_details(order_id, product_id, color, price, quantity) VALUES ($order_id, $product_id, '$color', $price, $quantity)";
          $query_order_detail_add = mysqli_query($conn, $sql_order_detail_add);

          if(!$query_order_detail_add){
            toast('payment__toast', 'error', 'Đặt hàng thất bại');
            break;
          }
        }

        if(!isset($_SESSION['payment__toast'])){
          unset($_SESSION['info']);

          if(isset($_GET['action'])) {
            unset($_SESSION['product_order']);
          }else {
            // xóa sản phẩm trong giỏ hàng
            foreach ($_SESSION['product_list'] as $index => $product){
              if($product['checked']){
                array_splice($_SESSION['product_list'], $index, 1);
              }
            }
          }

          toast('payment__toast', 'error', 'Đặt hàng thành công');
          redirect('./order-success.php');
        }
      }else {
        toast('payment__toast', 'error', 'Đặt hàng thất bại');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Thanh toán</title>
  <?php include_once('./partials/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="./assets/css/_base.css">
  <link rel="stylesheet" href="./assets/css/_app.css">
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/payment.css">
  <link rel="stylesheet" href="./assets/css/footer.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>
  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- payment content -->
  <div class="bg-main">
    <div class="container">
      <!-- breadcumb -->
      <div class="breadcumb">
        <a href="./index.php" class="link">Trang chủ</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <?php echo isset($_GET['action']) ? '<a href="./products.php" class="link">Tất cả sản phẩm</a>' : '<a href="./cart.php" class="link">Giỏ hàng</a>';?>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="./payment.php" class="link active">Thanh toán</a>
      </div>
      <!-- end breadcumb -->

      <form action="" method="post" class="payment">
        <div class="payment-box">
          <div class="payment-address__head">
            <i class='bx bx-map payment-address__head-icon'></i>
            <h3 class="payment-address__head-text">Địa chỉ nhận hàng</h3>
          </div>
          <div class="payment-address__body">
            <div class="payment-address__text">
              <span class="payment-address__text-info">
                <?php
                  echo $info['fullname'] . ' ' . $info['phone_num'];
                ?>
              </span>
              <span class="payment-address__text-address">
                <?php
                  echo $info['address'];
                ?>
              </span>
            </div>
            <button type="button" class="payment-address__btn modal__btn-open">Thay đổi</button>
          </div>
        </div>

        <!-- table -->
        <table>
          <thead>
            <tr>
              <th>Sản phẩm</th>
              <th>Màu sắc</th>
              <th>Đơn giá</th>
              <th>Số lượng</th>
              <th>Số tiền</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($product_list as $product){
                $product_id = $product['id'];

                $sql_product_by_id = "SELECT * FROM products WHERE id = $product_id";
                $query_product_by_id = mysqli_query($conn, $sql_product_by_id);
                $row_product_by_id = mysqli_fetch_assoc($query_product_by_id);
            ?>
            <tr>
              <td>
                <div class="payment__product">
                  <img src="./uploads/<?php echo $row_product_by_id['thumbnail'];?>"
                    alt="<?php echo $row_product_by_id['thumbnail'];?>" class="payment__product-img">
                  <span class="payment__product-name"><?php echo $row_product_by_id['name'];?></span>
                </div>
              </td>
              <td>
                <?php echo $product['color'];?>
              </td>
              <td>
                <span class="payment__current-price">
                  <?php echo number_format($product['price']);?>đ</span>
              </td>
              <td>
                <?php echo $product['quantity'];?>
              </td>
              <td>
                <span
                  class="payment__price"><?php echo number_format($product['price'] * $product['quantity']);?>đ</span>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        <!-- end table -->

        <div class="payment-box payment__total">
          <textarea name="note" class="payment__textarea payment__note" placeholder="Ghi chú"></textarea>

          <div class="payment__total-price-wrapper">
            <div class="payment__total-line">
              <span class="payment__total-name">
                Tổng tiền sản phẩm
              </span>
              <span class="payment__total-value">
                <?php
                  $total_price = 0;
                  foreach ($product_list as $product){
                    $total_price += $product['price'] * $product['quantity'];
                  }
                  echo number_format($total_price);
                ?>đ
              </span>
            </div>

            <div class="payment__total-line">
              <span class="payment__total-name">
                Tổng thanh toán
              </span>
              <span class="payment__total-value payment__total-price">
                <?php
                  $total_price = 0;
                  foreach ($product_list as $product){
                    $total_price += $product['price'] * $product['quantity'];
                  }
                  echo number_format($total_price);
                ?>đ
              </span>
            </div>
          </div>
        </div>

        <div class="payment-box payment-method">
          <h3 class="payment-method__title">Phương thức thanh toán</h3>
          <div class="payment-method__list-btn">
            <span class="payment-method__item-btn">
              <input type="radio" name="payment_method" value="0" class="payment-method__radio" checked>
              <button type="button" class="payment-method__btn">
                Thanh toán khi nhận hàng
              </button>
            </span>

            <span class="payment-method__item-btn">
              <input type="radio" name="payment_method" value="1" class="payment-method__radio">
              <button type="button" class="payment-method__btn">
                Ngân hàng
              </button>
            </span>
          </div>

          <div class="payment-method__order-btn">
            <button class="btn btn--primary" name="btnSubmit">Đặt hàng</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- end payment content -->

  <!-- modal address -->
  <div class="modal">
    <div class="modal__overlay">
    </div>
    <div class="modal__body">
      <div class="payment-address__modal">
        <h3 class="payment-address__modal-title">
          Địa chỉ nhận hàng
        </h3>

        <form action="" method="post">
          <div class="payment-address__modal-input-wrapper">
            <div class="input-field payment-address__modal-input">
              <input type="text" name="fullname" value="<?php echo $info['fullname'];?>" class="input-field__input"
                placeholder=" " required>
              <label class="input-field__label">Họ và tên</label>
            </div>
            <div class="input-field payment-address__modal-input">
              <input type="text" name="phone_num" value="<?php echo $info['phone_num'];?>" class="input-field__input"
                placeholder=" " required>
              <label class="input-field__label">Số điện thoại</label>
            </div>
          </div>

          <div class="payment-address__modal-input-wrapper">
            <textarea name="address" class="payment__textarea payment-address__modal-textarea" placeholder='Địa chỉ'
              required><?php echo $info['address'] != "Chưa có địa chỉ" ? $info['address'] : '';?></textarea>
          </div>

          <div class="payment-address__modal-btn-wrapper">
            <button type="button" class="btn modal__btn-close">Trở lại</button>
            <button class="btn btn--primary" name="btnAddress">Lưu lại</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal address -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script>
  <?php
    if(isset($_SESSION['payment__toast'])){
      echo $_SESSION['payment__toast'];
      unset($_SESSION['payment__toast']);
    }
  ?>
  </script>
  <script src="./assets/js/_app.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>