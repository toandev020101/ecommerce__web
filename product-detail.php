<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Chi tiết sản phẩm</title>
  <?php include_once('./partials/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="./assets/css/_base.css">
  <link rel="stylesheet" href="./assets/css/_app.css">
  <link rel="stylesheet" href="./assets/css/header.css">
  <link rel="stylesheet" href="./assets/css/product-detail.css">
  <link rel="stylesheet" href="./assets/css/footer.css">
  <!-- main css -->
</head>

<body>
  <!-- header -->
  <?php include_once('./partials/header.php') ?>
  <!-- end header -->

  <!-- product detail content -->
  <div class="container">
    <div class="bg-main">
      <!-- breadcumb -->
      <div class="breadcumb">
        <a href="/" class="link">Trang chủ</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="./products.php" class="link">Tất cả sản phẩm</a>
        <span><i class="bx bxs-chevrons-right"></i></span>
        <a href="/" class="link active">JBL Tune 750TNC</a>
      </div>
      <!-- end breadcumb -->

      <div class="product-detail__content">
        <div class="product-detail__info-wrapper">
          <!-- list image -->
          <ul class="product-detail__img-list">
            <li class="product-detail__img-item">
              <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                alt="">
            </li>
            <li class="product-detail__img-item active">
              <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                alt="">
            </li>
            <li class="product-detail__img-item">
              <img src="./assets/images/JBL_E55BT_KEY_BLACK_6175_FS_x1-1605x1605px.png" alt="">
            </li>
            <li class="product-detail__img-item">
              <img src="./assets/images/JBL_Endurance-SPRINT_Product-Image_Red_front-1605x1605px.webp" alt="">
            </li>
            <li class="product-detail__img-item">
              <img src="./assets/images/190402_E1_FW19_EarbudsWCase_S13_0033-1_1605x1605_BACK.png" alt="">
            </li>
            <li class="product-detail__img-item">
              <img src="./assets/images/JBL-Endurance-Sprint_Alt_Red-1605x1605px.webp" alt="">
            </li>
          </ul>
          <!-- list image -->

          <!-- info -->
          <div class="product-detail__info">
            <div class="product-detail__info-line">
              <span class="product-detail__info-box"><i class='bx bx-check'></i>Yêu thích</span>
              <h3 class="product-detail__info-name">
                JBL TUNE 750TNC
              </h3>
            </div>
            <div class="product-detail__info-price">
              <span class="product-detail__info-price-old">1.200.000đ</span>
              <span class="product-detail__info-price-current">
                890.000đ
              </span>
              <span class="product-detail__info-box">20% giảm</span>
            </div>
            <div class="product-detail__info-line">
              <span class="product-detail__info-line-name">
                Màu sắc
              </span>
              <span class="product-detail__info-line-content">
                <ul class="product-detail__info-color-list">
                  <li class="product-detail__info-color-item active">
                    <button>Đen</button>
                    <img
                      src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                      alt="" hidden>
                  </li>
                  <li class="product-detail__info-color-item">
                    <button>Trắng</button>
                    <img src="./assets/images/JBL_E55BT_KEY_BLACK_6175_FS_x1-1605x1605px.png" alt="" hidden>
                  </li>
                  <li class="product-detail__info-color-item">
                    <button>Hồng</button>
                    <img src="./assets/images/JBL_QUANTUM ONE_Product Image_Angle.png" alt="" hidden>
                  </li>
                  <li class="product-detail__info-color-item disabled">
                    <button>Xanh</button>
                    <img src="./assets/images/JBL-Endurance-Sprint_Alt_Red-1605x1605px.webp" alt="" hidden>
                  </li>
                </ul>
              </span>
            </div>
            <div class="product-detail__info-line">
              <span class="product-detail__info-line-name">
                Số lượng
              </span>
              <span class="product-detail__info-line-content">
                <span class="quantity">
                  <span class="quantity__btn quantity__btn-plus">
                    <i class='bx bx-plus'></i>
                  </span>
                  <span class="quantity__number">1</span>
                  <span class="quantity__btn quantity__btn-minus disabled">
                    <i class='bx bx-minus'></i>
                  </span>
                </span>
              </span>

              <span class="product-detail__info-quantity-current-wrapper">
                <span class="product-detail__info-quantity-current">100</span> sản phẩm có sẵn
              </span>
            </div>
            <div class="product-detail__info-line">
              <button class="btn product-detail__info-btn-add-cart">
                <i class='bx bx-cart'></i>
                Thêm vào giỏ hàng
              </button>
              <button class="btn btn--primary">
                Mua ngay
              </button>
            </div>
          </div>
          <!-- end info -->
        </div>

        <div class="product-detail__more">
          <!-- description -->
          <div class="section product-detail__description">
            <h3 class="section__title">Mô tả sản phẩm</h3>
            <p class="product-detail__description-content">
              Pin sạc dự phòng Polymer 5000mAh Không dây Magnetic Type C Anker MagGo A1611 sở hữu ngoại hình đẹp mắt,
              khối lượng gọn nhẹ, tích hợp sạc không dây tiện lợi,...
              • Thiết kế pin sạc đẹp mắt, kiểu dáng sang chảnh, khối lượng gọn nhẹ.

              • Chiếc pin sạc dự phòng Anker này vừa có thể sạc không dây, vừa hỗ trợ sạc có dây qua cổng Type-C vô cùng
              tiện lợi, do vậy, bạn có thể linh hoạt sử dụng để sạc cho nhiều dòng điện thoại.

              • Sử dụng lõi pin Li-on chất lượng giúp giữ năng lượng lâu và an toàn khi dùng, cho thời gian sử dụng lâu
              dài.

              • Đèn báo pin ở mặt dưới giúp theo dõi mức pin còn lại để kịp thời sạc.

              • Giá đỡ tiện lợi, bạn có thể vừa sạc pin vừa dễ dàng xử lý phần việc chưa hoàn thành xong.
              Pin sạc dự phòng Polymer 5000mAh Không dây Magnetic Type C Anker MagGo A1611 sở hữu ngoại hình đẹp mắt,
              khối lượng gọn nhẹ, tích hợp sạc không dây tiện lợi,...
              • Thiết kế pin sạc đẹp mắt, kiểu dáng sang chảnh, khối lượng gọn nhẹ.

              • Chiếc pin sạc dự phòng Anker này vừa có thể sạc không dây, vừa hỗ trợ sạc có dây qua cổng Type-C vô cùng
              tiện lợi, do vậy, bạn có thể linh hoạt sử dụng để sạc cho nhiều dòng điện thoại.

              • Sử dụng lõi pin Li-on chất lượng giúp giữ năng lượng lâu và an toàn khi dùng, cho thời gian sử dụng lâu
              dài.

              • Đèn báo pin ở mặt dưới giúp theo dõi mức pin còn lại để kịp thời sạc.

              • Giá đỡ tiện lợi, bạn có thể vừa sạc pin vừa dễ dàng xử lý phần việc chưa hoàn thành xong.
              Pin sạc dự phòng Polymer 5000mAh Không dây Magnetic Type C Anker MagGo A1611 sở hữu ngoại hình đẹp mắt,
              khối lượng gọn nhẹ, tích hợp sạc không dây tiện lợi,...
              • Thiết kế pin sạc đẹp mắt, kiểu dáng sang chảnh, khối lượng gọn nhẹ.

              • Chiếc pin sạc dự phòng Anker này vừa có thể sạc không dây, vừa hỗ trợ sạc có dây qua cổng Type-C vô cùng
              tiện lợi, do vậy, bạn có thể linh hoạt sử dụng để sạc cho nhiều dòng điện thoại.

              • Sử dụng lõi pin Li-on chất lượng giúp giữ năng lượng lâu và an toàn khi dùng, cho thời gian sử dụng lâu
              dài.

              • Đèn báo pin ở mặt dưới giúp theo dõi mức pin còn lại để kịp thời sạc.

              • Giá đỡ tiện lợi, bạn có thể vừa sạc pin vừa dễ dàng xử lý phần việc chưa hoàn thành xong.
            </p>

            <div class="product-detail__description-btn">
              <button class="btn btn--primary">Xem thêm</button>
            </div>
          </div>
          <!-- end description -->
          <!-- specifications -->
          <div class="section product-detail__specifications">
            <h3 class="section__title">Thông số kỹ thuật</h3>
            <!-- specifications item -->
            <div class="product-detail__specifications-box">
              <span class="product-detail__specifications-name">
                Pin
              </span>
              <span class="product-detail__specifications-content">
                Dùng 5 giờ - Sạc 2 giờ
              </span>
            </div>
            <!-- end specifications item -->

            <!-- specifications item -->
            <div class="product-detail__specifications-box">
              <span class="product-detail__specifications-name">
                Cổng sạc
              </span>
              <span class="product-detail__specifications-content">
                LightningSạc, không dây, Sạc MagSafe
              </span>
            </div>
            <!-- end specifications item -->

            <!-- specifications item -->
            <div class="product-detail__specifications-box">
              <span class="product-detail__specifications-name">
                Tương thích
              </span>
              <span class="product-detail__specifications-content">
                Android, iOS (iPhone), iPadOS (iPad), MacOS (Macbook, iMac)
              </span>
            </div>
            <!-- end specifications item -->

            <!-- specifications item -->
            <div class="product-detail__specifications-box">
              <span class="product-detail__specifications-name">
                Tiện ích
              </span>
              <span class="product-detail__specifications-content">
                Chống nước, IPX4, Chống ồn, Có mic thoại
              </span>
            </div>
            <!-- end specifications item -->
          </div>
          <!-- end specifications -->
        </div>

        <!-- rating -->
        <div class="section product-detail__rating">
          <div class="section__title">
            Đánh giá sản phẩm
          </div>

          <div class="product-detail__rating-detail">
            <!-- table -->
            <div class="product-detail__rating-table">
              <div class="product-detail__rating-head">
                <span class="product-detail__rating-number-total">4.0</span>

                <span class="rating product-detail__rating-list">
                  <i class='bx bxs-star'></i>
                  <i class='bx bxs-star'></i>
                  <i class='bx bxs-star'></i>
                  <i class='bx bxs-star'></i>
                  <i class='bx bx-star'></i>
                </span>

                <span class="product-detail__rating-count">
                  100 đánh giá
                </span>
              </div>

              <div class="product-detail__rating-body">
                <ul>
                  <li class="product-detail__rating-percent-item">
                    <span class="product-detail__rating-star">
                      <span class="product-detail__rating-number">5</span>
                      <i class='bx bxs-star product-detail__rating-star-icon'></i>
                    </span>
                    <span class="product-detail__rating-timeline">
                      <p class="product-detail__rating-timing" style="width:59%;"></p>
                    </span>
                    <span class="product-detail__rating-percent">59%</span>
                  </li>
                  <li class="product-detail__rating-percent-item">
                    <span class="product-detail__rating-star">
                      <span class="product-detail__rating-number">4</span>
                      <i class='bx bxs-star product-detail__rating-star-icon'></i>
                    </span>
                    <span class="product-detail__rating-timeline">
                      <p class="product-detail__rating-timing" style="width:15%;"></p>
                    </span>
                    <span class="product-detail__rating-percent">15%</span>
                  </li>
                  <li class="product-detail__rating-percent-item">
                    <span class="product-detail__rating-star">
                      <span class="product-detail__rating-number">3</span>
                      <i class='bx bxs-star product-detail__rating-star-icon'></i>
                    </span>
                    <span class="product-detail__rating-timeline">
                      <p class="product-detail__rating-timing" style="width:12%;"></p>
                    </span>
                    <span class="product-detail__rating-percent">12%</span>
                  </li>
                  <li class="product-detail__rating-percent-item">
                    <span class="product-detail__rating-star">
                      <span class="product-detail__rating-number">2</span>
                      <i class='bx bxs-star product-detail__rating-star-icon'></i>
                    </span>
                    <span class="product-detail__rating-timeline">
                      <p class="product-detail__rating-timing" style="width:6%;"></p>
                    </span>
                    <span class="product-detail__rating-percent">6%</span>
                  </li>
                  <li class="product-detail__rating-percent-item">
                    <span class="product-detail__rating-star">
                      <span class="product-detail__rating-number">1</span>
                      <i class='bx bxs-star product-detail__rating-star-icon'></i>
                    </span>
                    <span class="product-detail__rating-timeline">
                      <p class="product-detail__rating-timing" style="width:8%;"></p>
                    </span>
                    <span class="product-detail__rating-percent">8%</span>
                  </li>
                </ul>
              </div>
            </div>
            <!-- end table -->

            <!-- image rating -->
            <ul class="product-detail__rating-img-list">
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
              <li class="product-detail__rating-img-item">
                <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                  alt="">
              </li>
            </ul>
            <!-- end image rating -->
          </div>

          <!-- filter -->
          <div class="product-detail__rating-filter">
            <div class="input-field product-detail__rating-search">
              <input type="text" class="input-field__input" placeholder=" ">
              <label class="input-field__label">Tìm kiếm đánh giá theo nội dung</label>
            </div>

            <div class="product-detail__rating-filter-star">
              <span class="product-detail__rating-filter-title">
                Lọc theo:
              </span>
              <button class="product-detail__rating-filter-btn active">
                Tất cả
              </button>
              <button class="product-detail__rating-filter-btn">
                5 sao
              </button>
              <button class="product-detail__rating-filter-btn">
                4 sao
              </button>
              <button class="product-detail__rating-filter-btn">
                3 sao
              </button>
              <button class="product-detail__rating-filter-btn">
                2 sao
              </button>
              <button class="product-detail__rating-filter-btn">
                1 sao
              </button>
            </div>

            <div class="product-detail__rating-filter-sort">
              <div>
                <label for="image" class="checkbox product-detail__rating-filter-checkbox">
                  <input type="checkbox" name="" id="image" class="checkbox__input">
                  <div class="checkbox__box"></div>
                  Có hình ảnh (50)
                </label>
                <label for="book-product" class="checkbox product-detail__rating-filter-checkbox">
                  <input type="checkbox" name="" id="book-product" class="checkbox__input">
                  <div class="checkbox__box"></div>
                  Đã mua hàng
                </label>
              </div>

              <div class="dropdown product-detail__rating-sort">
                <div class="dropdown__select">
                  <span class="dropdown__select-default">
                    Xếp theo:
                  </span>
                  <span class="dropdown__selected">
                    Đánh giá cao
                  </span>
                  <i class='bx bxs-chevron-down dropdown__select-icon'></i>
                </div>

                <ul class="dropdown__list">
                  <li class="dropdown__item">
                    <span class="dropdown__text">Mới nhất</span>
                  </li>
                  <li class="dropdown__item">
                    <span class="dropdown__text">Hữu ích</span>
                  </li>
                  <li class="dropdown__item active">
                    <span class="dropdown__text">Đánh giá cao</span>
                  </li>
                  <li class="dropdown__item">
                    <span class="dropdown__text">Đánh giá thấp</span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="product-detail__rating-search-text-wrapper">
              Kết quả tìm kiếm từ khóa "<span class="product-detail__rating-search-text"></span>"
            </div>
          </div>
          <!-- end filter -->

          <!-- list rating -->
          <ul>
            <!-- item rating -->
            <li class="product-detail__rating-item">
              <div class="product-detail__rating-user">
                <img src="./assets/images/avatar.jpg" alt="" class="product-detail__rating-avatar">
                <div>
                  <div class="product-detail__rating-name">Đức Toàn</div>
                  <div class="product-detail__rating-book">
                    <i class='bx bx-badge-check'></i>
                    Đã mua hàng tại PKShop
                  </div>
                </div>
              </div>

              <span class="rating product-detail__rating-star-list">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bx-star'></i>
              </span>

              <div class="product-detail__rating-content">
                Mình gọi video được có 2h10p tai nghe đã báo còn 20% pin rồi tai nghe mới mua được 1tuần. liệu tai nghe
                có lỗi gì không
              </div>

              <ul class="product-detail__rating-image-list">
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
              </ul>

              <div class="product-detail__rating-action">
                <div class="product-detail__rating-box">
                  <i class='bx bx-like'></i>
                  Hữu ích
                </div>
                <div class="product-detail__rating-box">
                  <i class='bx bx-message-rounded'></i>
                  Thảo luận
                </div>

                <div class="product-detail__rating-date">
                  2022-08-31 09:03
                </div>
              </div>
            </li>
            <!-- end item rating -->
            <!-- item rating -->
            <li class="product-detail__rating-item">
              <div class="product-detail__rating-user">
                <img src="./assets/images/avatar.jpg" alt="" class="product-detail__rating-avatar">
                <div>
                  <div class="product-detail__rating-name">Đức Toàn</div>
                  <div class="product-detail__rating-book">
                    <i class='bx bx-badge-check'></i>
                    Đã mua hàng tại PKShop
                  </div>
                </div>
              </div>

              <span class="rating product-detail__rating-star-list">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bx-star'></i>
              </span>

              <div class="product-detail__rating-content">
                Mình gọi video được có 2h10p tai nghe đã báo còn 20% pin rồi tai nghe mới mua được 1tuần. liệu tai nghe
                có lỗi gì không
              </div>

              <ul class="product-detail__rating-image-list">
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
              </ul>

              <div class="product-detail__rating-action">
                <div class="product-detail__rating-box">
                  <i class='bx bx-like'></i>
                  Hữu ích
                </div>
                <div class="product-detail__rating-box">
                  <i class='bx bx-message-rounded'></i>
                  Thảo luận
                </div>

                <div class="product-detail__rating-date">
                  2022-08-31 09:03
                </div>
              </div>
            </li>
            <!-- end item rating -->
            <!-- item rating -->
            <li class="product-detail__rating-item">
              <div class="product-detail__rating-user">
                <img src="./assets/images/avatar.jpg" alt="" class="product-detail__rating-avatar">
                <div>
                  <div class="product-detail__rating-name">Đức Toàn</div>
                  <div class="product-detail__rating-book">
                    <i class='bx bx-badge-check'></i>
                    Đã mua hàng tại PKShop
                  </div>
                </div>
              </div>

              <span class="rating product-detail__rating-star-list">
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bxs-star'></i>
                <i class='bx bx-star'></i>
              </span>

              <div class="product-detail__rating-content">
                Mình gọi video được có 2h10p tai nghe đã báo còn 20% pin rồi tai nghe mới mua được 1tuần. liệu tai nghe
                có lỗi gì không
              </div>

              <ul class="product-detail__rating-image-list">
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
                <li class="product-detail__rating-image-item">
                  <img src="./assets/images/kisspng-beats-electronics-headphones-apple-beats-studio-red-headphones.png"
                    alt="">
                </li>
              </ul>

              <div class="product-detail__rating-action">
                <div class="product-detail__rating-box">
                  <i class='bx bx-like'></i>
                  Hữu ích
                </div>
                <div class="product-detail__rating-box">
                  <i class='bx bx-message-rounded'></i>
                  Thảo luận
                </div>

                <div class="product-detail__rating-date">
                  2022-08-31 09:03
                </div>
              </div>
            </li>
            <!-- end item rating -->
          </ul>
          <!-- end list rating -->

          <div class="product-detail__rating-footer">
            <button class="btn btn--primary">
              <i class='bx bx-chat product-detail__rating-btn-icon'></i> Viết đánh giá
            </button>

            <!-- pagination -->
            <ul class="pagination product-detail__rating-pagination">
              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">
                  <i class="pagination__item-icon bx bx-chevron-left"></i>
                </a>
              </li>

              <li class="pagination__item active">
                <a href="#" class="link pagination__item-link">1</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">2</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">3</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">4</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">5</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">...</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">15</a>
              </li>

              <li class="pagination__item">
                <a href="#" class="link pagination__item-link">
                  <i class="pagination__item-icon bx bx-chevron-right"></i>
                </a>
              </li>
            </ul>
            <!-- end pagination -->
          </div>
        </div>
        <!-- end rating -->

        <!-- list product -->
        <div class="section">
          <div class="section__title">
            Sản phẩm liên quan
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
                <i class='bx bx-heart product-item__heart'></i>

                <div class="product-item__rating">
                  <i class='bx bxs-star product-item__star--gold'></i>
                  <i class='bx bxs-star product-item__star--gold'></i>
                  <i class='bx bxs-star product-item__star--gold'></i>
                  <i class='bx bxs-star product-item__star--gold'></i>
                  <i class='bx bxs-star'></i>
                </div>

                <span class="product-item__sold">88 đã bán</span>
              </div>

              <div class="product-item__origin-wrapper">
                <span class="product-item__brand">JBL</span>
                <span class="product-item__origin">Nhật bản</span>
              </div>

              <div class="product-item__favourite">
                <i class='bx bx-check'></i>
                <span>Yêu thích</span>
              </div>

              <div class="product-item__sale-off">
                <span class="product-item__percent">10%</span>
                <div class="product-item__text">Giảm</div>
              </div>
            </a>
            <!-- end product item -->
          </div>
        </div>
        <!-- end list product -->
      </div>
    </div>
  </div>
  <!-- end product detail content -->

  <!-- footer -->
  <?php include_once('./partials/footer.php') ?>
  <!-- end footer -->

  <!-- js -->
  <script src="./assets/js/_base.js"></script>
  <script src="./assets/js/_app.js"></script>
  <script src="./assets/js/product-detail.js"></script>
  <!-- end js -->
</body>

</html>