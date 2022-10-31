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

      <div class="cart">
        <!-- no cart -->
        <img src="./assets/images/no-cart.png" alt="" class="cart__no-img">
        <span class="cart__no-text">Giỏ hàng của bạn còn trống</span>
        <a href="./products.php" class="link btn btn--primary cart__no-btn">Mua ngay</a>
        <!-- end no cart -->

        <!-- table -->
        <table>
          <thead>
            <tr>
              <th>
                <label class="checkbox checkbox__select-all">
                  <input type="checkbox" name="" class="checkbox__input cart__checkbox-input">
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
            <tr>
              <td>
                <label class="checkbox">
                  <input type="checkbox" name="" class="checkbox__input">
                  <div class="checkbox__box"></div>
                </label>
              </td>
              <td>
                <div class="cart__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="cart__product-img">
                  <span class="cart__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <div class="dropdown__select cart__color">
                    <span class="dropdown__selected">
                      Đen
                    </span>
                    <i class='bx bx-chevron-down'></i>
                  </div>

                  <ul class="dropdown__list">
                    <li class="dropdown__item active">
                      <span class="dropdown__text">Đen</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Đỏ</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Trắng</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Xanh</span>
                    </li>
                  </ul>
                </div>
              </td>
              <td>
                <div class="cart__unit-price">
                  <span class="cart__old-price">1.200.000đ</span>
                  <span class="cart__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                <span class="quantity">
                  <span class="quantity__btn quantity__btn-plus">
                    <i class='bx bx-plus'></i>
                  </span>
                  <span class="quantity__number">1</span>
                  <span class="quantity__btn quantity__btn-minus disabled">
                    <i class='bx bx-minus'></i>
                  </span>
                </span>
              </td>
              <td>
                <span class="cart__price">1.000.000đ</span>
              </td>
              <td>
                <div class="tooltip" tooltip-title="Xem chi tiết">
                  <a href="#" class="link">
                    <i class='bx bx-detail cart__icon'></i>
                  </a>
                </div>
                <div class="tooltip" tooltip-title="Xóa">
                  <i class='bx bx-trash-alt cart__icon'></i>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <label class="checkbox">
                  <input type="checkbox" name="" class="checkbox__input">
                  <div class="checkbox__box"></div>
                </label>
              </td>
              <td>
                <div class="cart__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="cart__product-img">
                  <span class="cart__product-name">Lorem ipsum dolor, sit amet consectetur adipisicing elit</span>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <div class="dropdown__select cart__color">
                    <span class="dropdown__selected">
                      Đen
                    </span>
                    <i class='bx bx-chevron-down'></i>
                  </div>

                  <ul class="dropdown__list">
                    <li class="dropdown__item active">
                      <span class="dropdown__text">Đen</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Đỏ</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Trắng</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Xanh</span>
                    </li>
                  </ul>
                </div>
              </td>
              <td>
                <div class="cart__unit-price">
                  <span class="cart__old-price">1.200.000đ</span>
                  <span class="cart__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                <span class="quantity">
                  <span class="quantity__btn quantity__btn-plus">
                    <i class='bx bx-plus'></i>
                  </span>
                  <span class="quantity__number">1</span>
                  <span class="quantity__btn quantity__btn-minus disabled">
                    <i class='bx bx-minus'></i>
                  </span>
                </span>
              </td>
              <td>
                <span class="cart__price">1.000.000đ</span>
              </td>
              <td>
                <div class="tooltip" tooltip-title="Xem chi tiết">
                  <a href="#" class="link">
                    <i class='bx bx-detail cart__icon'></i>
                  </a>
                </div>
                <div class="tooltip" tooltip-title="Xóa">
                  <i class='bx bx-trash-alt cart__icon'></i>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <label class="checkbox">
                  <input type="checkbox" name="" class="checkbox__input">
                  <div class="checkbox__box"></div>
                </label>
              </td>
              <td>
                <div class="cart__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="cart__product-img">
                  <span class="cart__product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe
                    asperiores quidem quae odio voluptates incidunt eos, voluptate quos, assumenda necessitatibus beatae
                    iste cum, facilis facere veniam enim hic doloribus ipsum.</span>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <div class="dropdown__select cart__color">
                    <span class="dropdown__selected">
                      Đen
                    </span>
                    <i class='bx bx-chevron-down'></i>
                  </div>

                  <ul class="dropdown__list">
                    <li class="dropdown__item active">
                      <span class="dropdown__text">Đen</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Đỏ</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Trắng</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Xanh</span>
                    </li>
                  </ul>
                </div>
              </td>
              <td>
                <div class="cart__unit-price">
                  <span class="cart__old-price">1.200.000đ</span>
                  <span class="cart__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                <span class="quantity">
                  <span class="quantity__btn quantity__btn-plus">
                    <i class='bx bx-plus'></i>
                  </span>
                  <span class="quantity__number">1</span>
                  <span class="quantity__btn quantity__btn-minus disabled">
                    <i class='bx bx-minus'></i>
                  </span>
                </span>
              </td>
              <td>
                <span class="cart__price">1.000.000đ</span>
              </td>
              <td>
                <div class="tooltip" tooltip-title="Xem chi tiết">
                  <a href="#" class="link">
                    <i class='bx bx-detail cart__icon'></i>
                  </a>
                </div>
                <div class="tooltip" tooltip-title="Xóa">
                  <i class='bx bx-trash-alt cart__icon'></i>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <label class="checkbox">
                  <input type="checkbox" name="" class="checkbox__input">
                  <div class="checkbox__box"></div>
                </label>
              </td>
              <td>
                <div class="cart__product">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="" class="cart__product-img">
                  <span class="cart__product-name">Lorem ipsum dolor, sit amet consectetur adipisicing elit</span>
                </div>
              </td>
              <td>
                <div class="dropdown">
                  <div class="dropdown__select cart__color">
                    <span class="dropdown__selected">
                      Đen
                    </span>
                    <i class='bx bx-chevron-down'></i>
                  </div>

                  <ul class="dropdown__list">
                    <li class="dropdown__item active">
                      <span class="dropdown__text">Đen</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Đỏ</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Trắng</span>
                    </li>
                    <li class="dropdown__item">
                      <span class="dropdown__text">Xanh</span>
                    </li>
                  </ul>
                </div>
              </td>
              <td>
                <div class="cart__unit-price">
                  <span class="cart__old-price">1.200.000đ</span>
                  <span class="cart__current-price">1.200.000đ</span>
                </div>
              </td>
              <td>
                <span class="quantity">
                  <span class="quantity__btn quantity__btn-plus">
                    <i class='bx bx-plus'></i>
                  </span>
                  <span class="quantity__number">1</span>
                  <span class="quantity__btn quantity__btn-minus disabled">
                    <i class='bx bx-minus'></i>
                  </span>
                </span>
              </td>
              <td>
                <span class="cart__price">1.000.000đ</span>
              </td>
              <td>
                <div class="tooltip" tooltip-title="Xem chi tiết">
                  <a href="#" class="link">
                    <i class='bx bx-detail cart__icon'></i>
                  </a>
                </div>
                <div class="tooltip" tooltip-title="Xóa">
                  <i class='bx bx-trash-alt cart__icon'></i>
                </div>
              </td>
            </tr>
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
            <button class="btn btn--primary cart__voucher-btn">Áp dụng</button>
          </div>

          <div class="cart__action">
            <span class="cart__action-table">
              <span>Chọn sản phẩm (<span class="cart__action-product-number">0</span>)</span>
              <span class="tooltip cart__action-table-remove" tooltip-title="Xóa">
                <i class='bx bx-trash-alt'></i>
              </span>
            </span>

            <span class="cart__action-order">
              <span class="cart__action-price-wrapper">
                <span class="cart__action-voucher-price">-12.000đ</span>
                <span>
                  Tổng thanh toán (<span class="cart__action-product-number">0</span> sản phẩm): <span
                    class="cart__action-total-price">1.000.000đ</span>
                </span>
              </span>
              <a href="./payment.php" class="link btn btn--primary cart__action-order-btn">
                Mua hàng
              </a>
            </span>
          </div>
        </div>
        <!-- end total -->
      </div>
    </div>
  </div>
  <!-- end cart content -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script src="./assets/js/_app.js"></script>
  <script src="./assets/js/cart.js"></script>
  <!-- end js -->
</body>

</html>