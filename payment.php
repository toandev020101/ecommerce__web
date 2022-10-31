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
  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- payment content -->
  <div class="bg-main">
    <div class="container">
      <!-- breadcumb -->
      <div class="breadcumb">
        <a href="/" class="link">Trang chủ</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="./cart.php" class="link">Giỏ hàng</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="./payment.php" class="link active">Thanh toán</a>
      </div>
      <!-- end breadcumb -->

      <div class="payment">
        <div class="payment-box">
          <div class="payment-address__head">
            <i class='bx bx-map payment-address__head-icon'></i>
            <h3 class="payment-address__head-text">Địa chỉ nhận hàng</h3>
          </div>
          <div class="payment-address__body">
            <div class="payment-address__text">
              <span class="payment-address__text-info">Đậu Đức Toàn (+84) 924212027</span>
              <span class="payment-address__text-address">35 Tạ Hiện, Phường Hòa Cường Bắc, Quận Hải Châu, Đà
                Nẵng</span>
            </div>
            <button class="payment-address__btn modal__btn-open">Thay đổi</button>
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
            <tr>
              <td>
                <div class="payment__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="payment__product-img">
                  <span class="payment__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                Đen
              </td>
              <td>
                <div class="payment__unit-price">
                  <span class="payment__old-price">1.200.000đ</span>
                  <span class="payment__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                1
              </td>
              <td>
                <span class="payment__price">1.000.000đ</span>
              </td>
            </tr>
            <tr>
              <td>
                <div class="payment__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="payment__product-img">
                  <span class="payment__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                Đen
              </td>
              <td>
                <div class="payment__unit-price">
                  <span class="payment__old-price">1.200.000đ</span>
                  <span class="payment__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                1
              </td>
              <td>
                <span class="payment__price">1.000.000đ</span>
              </td>
            </tr>
            <tr>
              <td>
                <div class="payment__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="payment__product-img">
                  <span class="payment__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                Đen
              </td>
              <td>
                <div class="payment__unit-price">
                  <span class="payment__old-price">1.200.000đ</span>
                  <span class="payment__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                1
              </td>
              <td>
                <span class="payment__price">1.000.000đ</span>
              </td>
            </tr>
            <tr>
              <td>
                <div class="payment__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="payment__product-img">
                  <span class="payment__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                Đen
              </td>
              <td>
                <div class="payment__unit-price">
                  <span class="payment__old-price">1.200.000đ</span>
                  <span class="payment__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                1
              </td>
              <td>
                <span class="payment__price">1.000.000đ</span>
              </td>
            </tr>
            <tr>
              <td>
                <div class="payment__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="payment__product-img">
                  <span class="payment__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                Đen
              </td>
              <td>
                <div class="payment__unit-price">
                  <span class="payment__old-price">1.200.000đ</span>
                  <span class="payment__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                1
              </td>
              <td>
                <span class="payment__price">1.000.000đ</span>
              </td>
            </tr>
          </tbody>
        </table>
        <!-- end table -->

        <div class="payment-box payment-method">
          <h3 class="payment-method__title">Phương thức thanh toán</h3>
          <div class="payment-method__list-btn">
            <button class="payment-method__btn">
              Ngân hàng
            </button>
            <button class="payment-method__btn active">
              Thanh toán khi nhận hàng
            </button>
          </div>
          <div class="payment-method__total-price-wrapper">
            <div class="payment-method__total-line">
              <span class="payment-method__total-name">
                Tổng tiền sản phẩm
              </span>
              <span class="payment-method__total-value">
                1.000.000đ
              </span>
            </div>
            <div class="payment-method__total-line">
              <span class="payment-method__total-name">
                Phí vận chuyển
              </span>
              <span class="payment-method__total-value">
                30.000đ
              </span>
            </div>
            <div class="payment-method__total-line">
              <span class="payment-method__total-name">
                Voucher
              </span>
              <span class="payment-method__total-value">
                -10.000đ
              </span>
            </div>
            <div class="payment-method__total-line">
              <span class="payment-method__total-name">
                Tổng thanh toán
              </span>
              <span class="payment-method__total-value payment-method__total-price">
                1.300.000đ
              </span>
            </div>
          </div>
          <div class="payment-method__order-btn">
            <button class="btn btn--primary">Đặt hàng</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end payment content -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- modal address -->
  <div class="modal">
    <div class="modal__overlay">
    </div>
    <div class="modal__body">
      <div class="payment-address__modal">
        <h3 class="payment-address__modal-title">
          Địa chỉ nhận hàng
        </h3>

        <form action="">
          <div class="payment-address__modal-input-wrapper">
            <div class="input-field payment-address__modal-input">
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Họ và tên</label>
            </div>
            <div class="input-field payment-address__modal-input">
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Số điện thoại</label>
            </div>
          </div>

          <div class="payment-address__modal-input-wrapper">
            <div class="dropdown payment-address__modal-input">
              <div class="dropdown__select">
                <span class="dropdown__selected">Tỉnh/Thành phố</span>
                <i class='bx bxs-chevron-down'></i>
              </div>
              <ul class="dropdown__list payment-address__modal-dropdown-list">
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Hồ Chí Minh
                  </span>
                </li>
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Hà Nội
                  </span>
                </li>
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Đà Nẵng
                  </span>
                </li>
              </ul>
            </div>
            <div class="dropdown payment-address__modal-input">
              <div class="dropdown__select">
                <span class="dropdown__selected">Quận/Huyện</span>
                <i class='bx bxs-chevron-down'></i>
              </div>
              <ul class="dropdown__list payment-address__modal-dropdown-list">
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Quận 1
                  </span>
                </li>
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Quận 3
                  </span>
                </li>
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Quận 4
                  </span>
                </li>
              </ul>
            </div>
          </div>

          <div class="payment-address__modal-input-wrapper">
            <div class="dropdown payment-address__modal-input">
              <div class="dropdown__select">
                <span class="dropdown__selected">Phường/Xã</span>
                <i class='bx bxs-chevron-down'></i>
              </div>
              <ul class="dropdown__list payment-address__modal-dropdown-list">
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Xã 1
                  </span>
                </li>
                <li class="dropdown__item">
                  <span class="dropdown__text">
                    Xã 2
                  </span>
                </li>
              </ul>
            </div>

            <div class="input-field payment-address__modal-input">
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Số nhà, tên đường</label>
            </div>
          </div>

          <div class="payment-address__modal-btn-wrapper">
            <button type="button" class="btn modal__btn-close">Trở lại</button>
            <button class="btn btn--primary">Lưu lại</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal address -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script src="./assets/js/_app.js"></script>
  <script src="./assets/js/payment.js"></script>
  <!-- end js -->
</body>

</html>