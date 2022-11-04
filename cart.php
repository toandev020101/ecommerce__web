<?php
  require_once('./database/connectdb.php');
  require_once('./helper/function.php');

  session_start();

  $product_list = [];
  if(isset($_SESSION['product_list'])){
    $product_list = $_SESSION['product_list'];
  }

  if(isset($_POST['btnColorSubmit'])){
    $index = $_POST['index'];
    $color_name = $_POST['color_name'];

    $_SESSION['product_list'][$index]['color'] = $color_name; 

    // cập nhật product_list
    $product_list = $_SESSION['product_list'];
  }

  if(isset($_POST['btnQuantitySubmit'])){
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];

    $_SESSION['product_list'][$index]['quantity'] = $quantity;

    // cập nhật product_list
    $product_list = $_SESSION['product_list'];
  }

  if(isset($_POST['btnDel'])){
    $index = $_POST['index'];

    array_splice($_SESSION['product_list'], $index, 1);

    // cập nhật product_list
    $product_list = $_SESSION['product_list'];

    toast('cart__toast', 'success', 'Xóa thành công');
  }

  if(isset($_POST['btnSubmit'])){
    if(isset($_POST['index_list'])){
      $index_list = $_POST['index_list'];
      foreach($index_list as $index){
        $_SESSION['product_list'][$index]['checked'] = true;
      }
      redirect('./payment.php');
    }else {
      toast('cart__toast', 'error', 'Vui lòng chọn sản phẩm');
    }
  }
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
  <link rel="stylesheet" href="./assets/css/cart.css">
  <link rel="stylesheet" href="./assets/css/footer.css">
  <!-- main css -->
</head>

<body>
  <div id="toast"></div>
  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- cart content -->
  <div class="bg-main">
    <div class="container">
      <!-- breadcumb -->
      <div class="breadcumb">
        <a href="/" class="link">Trang chủ</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="./cart.php" class="link active">Giỏ hàng</a>
      </div>
      <!-- end breadcumb -->

      <div class="cart <?php echo count($product_list) == 0 ? 'no__cart' : '';?>">
        <?php 
          if( count($product_list) == 0){
        ?>
        <!-- no cart -->
        <img src="./assets/images/no_cart.png" alt="no_cart.png" class="no__cart-img">
        <span class="no__cart-text">Giỏ hàng của bạn còn trống</span>
        <a href="./products.php" class="link btn btn--primary">Mua ngay</a>
        <!-- end no cart -->
        <?php
          }else{
        ?>

        <form action="" method="post">
          <!-- table -->
          <table>
            <thead>
              <tr>
                <th>
                  <label class="checkbox checkbox__select-all">
                    <input type="checkbox" class="checkbox__input cart__checkbox-input">
                    <div class="checkbox__box cart__checkbox"></div>
                  </label>
                </th>
                <th>Sản phẩm</th>
                <th>Màu sắc</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Số tiền</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach ($product_list as $index => $product) {
                  $product_id = $product['id'];
                  
                  $sql_product_by_id = "SELECT * FROM products WHERE id = $product_id";
                  $query_product_by_id = mysqli_query($conn, $sql_product_by_id);
                  $row_product_by_id = mysqli_fetch_assoc($query_product_by_id);
              ?>
              <tr>
                <td>
                  <label class="checkbox">
                    <input type="checkbox" name="index_list[]" value="<?php echo $index;?>" class="checkbox__input">
                    <div class="checkbox__box"></div>
                  </label>
                </td>
                <td>
                  <div class="cart__product">
                    <img src="./uploads/<?php echo $row_product_by_id['thumbnail'];?>"
                      alt="<?php echo $row_product_by_id['thumbnail'];?>" class="cart__product-img">
                    <span class="cart__product-name">
                      <?php echo $row_product_by_id['name'];?>
                    </span>
                  </div>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="number" name="index" value="<?php echo $index; ?>" hidden>
                    <div class="dropdown">
                      <div class="dropdown__select cart__color">
                        <span class="dropdown__selected">
                          <?php echo $product['color'];?>
                        </span>
                        <i class='bx bx-chevron-down'></i>
                        <input type="text" name="color_name" class="dropdown__input"
                          value="<?php echo $product['color'];?>" hidden>
                      </div>

                      <ul class="dropdown__list">
                        <?php
                        // lấy color id
                        $sql_product_color_list_by_product_id = "SELECT color_id FROM product_colors WHERE product_id = $product_id";
                        $query_product_color_list_by_product_id = mysqli_query($conn, $sql_product_color_list_by_product_id);

                        while($row_product_color_list_by_product_id = mysqli_fetch_assoc($query_product_color_list_by_product_id)){
                          $color_id = $row_product_color_list_by_product_id['color_id'];

                          // lấy color
                          $sql_color_by_id = "SELECT * FROM colors WHERE id = $color_id";
                          $query_color_by_id = mysqli_query($conn, $sql_color_by_id);
                          $row_color_by_id = mysqli_fetch_assoc($query_color_by_id);
                      ?>
                        <li
                          class="dropdown__item <?php echo $product['color'] == $row_color_by_id['name'] ? 'active' : '';?>">
                          <span class=" dropdown__text" data-value="<?php echo $row_color_by_id['name']; ?>">
                            <?php echo $row_color_by_id['name'];?>
                          </span>
                        </li>
                        <?php
                          }
                        ?>
                      </ul>
                    </div>
                    <input type="submit" name="btnColorSubmit" class="cart__row-submit" hidden>
                  </form>
                </td>
                <td>
                  <span class="cart__current-price"><?php echo number_format($product['price']);?>đ</span>
                </td>
                <td>
                  <form action="" method="post">
                    <input type="number" name="index" value="<?php echo $index; ?>" hidden>
                    <span class="quantity">
                      <span class="quantity__btn quantity__btn-plus">
                        <i class='bx bx-plus'></i>
                      </span>
                      <span class="quantity__number"><?php echo $product['quantity'];?></span>
                      <span
                        class="quantity__btn quantity__btn-minus <?php echo $product['quantity'] == 1 ? 'disabled' : ''?>">
                        <i class='bx bx-minus'></i>
                      </span>
                      <input type="number" name="quantity" class="quantity__input"
                        value="<?php echo $product['quantity']; ?>" hidden>
                    </span>
                    <input type="submit" name="btnQuantitySubmit" class="cart__row-submit" hidden>
                  </form>
                </td>
                <td>
                  <span
                    class="cart__total-price"><?php echo number_format($product['price'] * $product['quantity']);?>đ</span>
                </td>
                <td>
                  <div class="tooltip" tooltip-title="Xem chi tiết">
                    <a href="./product-detail.php?slug=<?php echo  $row_product_by_id['slug'];?>" class="link">
                      <i class='bx bx-detail cart__icon'></i>
                    </a>
                  </div>
                  <div class="tooltip modal__btn-open" tooltip-title="Xóa" data-id="<?php echo $index;?>"
                    data-name="<?php echo $row_product_by_id["name"];?>">
                    <i class='bx bx-trash-alt cart__icon'></i>
                  </div>
                </td>
              </tr>
              <?php
              }
            ?>
            </tbody>
          </table>
          <!-- end table -->

          <!-- total -->
          <div class="cart__total">
            <div class="cart__voucher">
              <div class="input-field cart__voucher-input">
                <input type="text" class="input-field__input" placeholder=" ">
                <label class="input-field__label">Nhập mã Voucher (nếu có)</label>
              </div>
              <button type="button" class="btn btn--primary cart__voucher-btn">Áp dụng</button>
            </div>

            <div class="cart__action">
              <span>Chọn sản phẩm (<span class="cart__action-product-number">0</span>)</span>

              <span class="cart__action-order">
                <span class="cart__action-price-wrapper">
                  <span class="cart__action-voucher-price">-12.000đ</span>
                  <span>
                    Tổng thanh toán (<span class="cart__action-total-product">0
                    </span> sản phẩm): <span class="cart__action-total-price">0đ</span>
                  </span>
                </span>
                <button class="btn btn--primary cart__action-order-btn" name="btnSubmit">
                  Mua hàng
                </button>
              </span>
            </div>
          </div>
          <!-- end total -->
          <?php
          }
        ?>
        </form>
      </div>
    </div>
  </div>
  <!-- end cart content -->

  <!-- modal delete -->
  <div class="modal">
    <div class="modal__overlay">
    </div>
    <div class="modal__body">
      <div class="delete__modal">
        <div class="delete__modal-text-wrapper">
          <i class='bx bx-error delete__modal-icon'></i>
          <span class="delete__modal-text">Bạn chắc chắn muốn xóa sản phẩm <span class="delete__modal-name"></span>
            ?</span>
        </div>
        <form action="" method="post" class="delete__modal-form">
          <input type="text" name="index" class="delete__modal-id" hidden>
          <button class="btn btn--primary delete__btn" name="btnDel">Đồng ý</button>
          <button type="button" class="btn modal__btn-close delete__btn">Hủy</button>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal delete -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script>
  <?php
    if(isset($_SESSION['cart__toast'])){
      echo $_SESSION['cart__toast'];
      unset($_SESSION['cart__toast']);
    }
  ?>
  </script>
  <script src="./assets/js/_app.js"></script>
  <script src="./assets/js/cart.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>