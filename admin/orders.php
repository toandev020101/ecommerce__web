<?php
  require_once('../database/connectdb.php');
  require_once('../helper/function.php');
  session_start();

  if(isset($_SESSION['refresh'])){
    // trang đã làm mới
    $_SESSION['refresh'] = true;
  }

  if(isset($_GET['page'])){
    // lấy page và limit trên url
    $page = $_GET['page'];
    $limit = $_GET['limit'];
  }else {
    // page và limit mặc định
    $page = 1;
    $limit = 2;
  }

  $offset = ($page - 1) * $limit;

  // lấy đơn hàng theo phân trang
  $sql_order_list_pagination = "SELECT * FROM orders limit $offset, $limit";
  $query_order_list_pagination = mysqli_query($conn, $sql_order_list_pagination);
  
  $row_num_order_list_pagination = mysqli_num_rows($query_order_list_pagination);
  if($row_num_order_list_pagination <= 0){
    $page--;
    if($page >= 1){
      // tự động lùi trang nếu bị xóa hết đơn hàng tại trang đó
      $_SESSION['refresh'] = false;
      redirect("orders.php?page=$page&limit=$limit");
      exit();
    }
  }

  // lấy toàn bộ đơn hàng
  $sql_order_all = "SELECT * FROM orders";
  $query_order_all = mysqli_query($conn, $sql_order_all);
  $totalRecord = mysqli_num_rows($query_order_all);
  $totalPage = ceil($totalRecord / $limit);

  if(isset($_POST["btnDel"])){
    $id = $_POST["id"];
    // tắt auto commit
    mysqli_autocommit($conn, false);

    try{
      // xóa sản phẩm theo id
      deleteProductById($conn, $id);
      
      // bật tự động commit sql
      mysqli_autocommit($conn, true);

      toast('products__toast-refresh', 'success', 'Xóa thành công');
      $_SESSION['refresh'] = false;
      refresh();
    }catch(mysqli_sql_exception $exception){
      mysqli_rollback($conn);
      toast('products__toast-refresh', 'error', 'Xóa thất bại');
      throw $exception;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: Đơn hàng</title>
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
      <h2 class="title">Đơn hàng</h2>

      <div class="box">
        <div class="table__head">
          <div class="input-field search">
            <input type="text" class="input-field__input search__input" placeholder=" ">
            <label class="input-field__label">Tìm kiếm theo tên</label>
          </div>
        </div>


        <!-- table -->
        <table>
          <thead>
            <tr>
              <th>Tên khách hàng</th>
              <th>Số điện thoại</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
              <th>Ngày đặt</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php echo $totalRecord <= 0 ? "<tr>
            <td></td>
            <td></td>
            <td>Không có đơn hàng nào</td>
            <td></td>
            <td></td>
            </tr>" : '';
            ?>
            <?php
              while($row_order = mysqli_fetch_assoc($query_order_list_pagination)){
            ?>
            <tr>
              <td>
                <?php echo $row_order['fullname'];?>
              </td>
              <td>
                <?php echo $row_order['phone_num'];?>
              </td>
              <td>
                <?php 
                  $order_id = $row_order['id'];

                  $sql_order_detail_list_by_order_id = "SELECT quantity, price FROM order_details WHERE order_id = $order_id";
                  $query_order_detail_list_by_order_id = mysqli_query($conn, $sql_order_detail_list_by_order_id);

                  $total_quantity = 0;
                  $total_price = 0;
                  while($row_order_detail_list_by_order_id = mysqli_fetch_assoc($query_order_detail_list_by_order_id)){
                    $total_quantity += $row_order_detail_list_by_order_id['quantity'];

                    $total_price += $row_order_detail_list_by_order_id['price'];
                  }

                  echo $total_quantity;
                ?>
              </td>
              <td>
                <div class="price">
                  <?php echo number_format($total_quantity * $total_price); ?>đ
                </div>
              </td>
              <td>
                <?php echo date_format(date_create($row_order['created_at']), 'H:i:s, d/m/Y');?>
              </td>
              <td>
                <?php
                  $status_id = $row_order['status_id'];

                  $sql_status_by_id = "SELECT name, box_name FROM status WHERE id = $status_id";
                  $query_status_by_id = mysqli_query($conn, $sql_status_by_id);
                  $row_status_by_id = mysqli_fetch_assoc($query_status_by_id);

                  $box_name = $row_status_by_id['box_name'];
                  $status_name = $row_status_by_id['name'];
                  echo "<div class='box__status box--$box_name'>$status_name</div>";
                ?>
              </td>
              <td>
                <div class="action">
                  <a href="./edit-order.php?id=<?php echo $row_order['id'];?>" class="link tooltip action__btn"
                    tooltip-title="Chỉnh sửa">
                    <i class='bx bx-edit-alt action__icon'></i>
                  </a>
                  <span class="tooltip action__btn modal__btn-open" tooltip-title="Xóa"
                    data-id="<?php echo $row_order["id"];?>" data-name="<?php echo $row_order["fullname"];?>">
                    <i class='bx bx-trash-alt action__icon'></i>
                  </span>
                </div>
              </td>
            </tr>
            <?php
              }
            ?>
          </tbody>
        </table>
        <!-- end table -->

        <!-- pagination -->
        <ul class="pagination table__pagination <?php echo $totalRecord <= 0 ? 'hidden' : '';?>">
          <li class="pagination__item <?php echo $page == 1 ? 'hidden' : ''; ?>">
            <a href="./orders.php?page=<?php echo $page - 1; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-left"></i>
            </a>
          </li>

          <?php
            for($i = 1; $i <= $totalPage; $i++){
          ?>
          <li class="pagination__item <?php echo $page == $i ? 'active' : ''; ?>">
            <a href="./orders.php?page=<?php echo $i; ?>&limit=<?php echo $limit; ?>"
              class="link pagination__item-link"><?php echo $i; ?></a>
          </li>
          <?php
            }
          ?>

          <li class="pagination__item <?php echo $page == $totalPage ? 'hidden' : ''; ?>">
            <a href="./orders.php?page=<?php echo $page + 1 ?>&limit=<?php echo $limit ?>"
              class="link pagination__item-link">
              <i class="pagination__item-icon bx bx-chevron-right"></i>
            </a>
          </li>
        </ul>
        <!-- end pagination -->
      </div>
    </div>
    <!-- end content -->
  </div>

  <!-- modal delete -->
  <div class="modal">
    <div class="modal__overlay">
    </div>
    <div class="modal__body">
      <div class="delete__modal">
        <div class="delete__modal-text-wrapper">
          <i class='bx bx-error delete__modal-icon'></i>
          <span class="delete__modal-text">Bạn chắc chắn muốn xóa đơn hàng của khách hàng <span
              class="delete__modal-name"></span>
            ?</span>
        </div>
        <form action="" method="post" class="delete__modal-form">
          <input type="text" name="id" class="delete__modal-id" hidden>
          <button class="btn btn--primary" name="btnDel">Đồng ý</button>
          <button type="button" class="btn modal__btn-close">Hủy</button>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal delete -->

  <!-- js -->
  <script src="../assets/js/_base.js"></script>
  <script>
  <?php
    // hiện thông báo
    if(isset($_SESSION['orders__toast'])){
      echo $_SESSION['orders__toast'];
      unset($_SESSION['orders__toast']);
    }

    if(isset($_SESSION['orders__toast-refresh']) && isset($_SESSION['refresh']) && $_SESSION['refresh']){
      echo $_SESSION['orders__toast-refresh'];
      unset($_SESSION['orders__toast-refresh']);
      unset($_SESSION['refresh']);
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