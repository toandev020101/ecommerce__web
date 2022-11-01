<?php
  require_once('../database/connectdb.php');
  require_once('../helper/function.php');

  session_start();

  if(checkAuth()){
    $role = checkPermission($conn);
    if($role != 'admin'){
      toast('index__toast', 'error', 'Bạn không có quyền truy cập');
      redirect('../index.php');
    }
  }else {
    toast('login__toast', 'error', 'Bạn chưa đăng nhập');
    redirect('../login.php');
  }

  $action = 'add';

  if(isset($_GET["action"])){
    // lấy action và id trên url
    $action = $_GET["action"];
    $id = $_GET["id"];

    // lấy danh mục theo id
    $sql_category_by_id = "SELECT * FROM categories WHERE id = $id";
    $query_category_by_id = mysqli_query($conn, $sql_category_by_id);
    $row_category_by_id = mysqli_fetch_assoc($query_category_by_id);
  }

  if(isset($_POST["btnSubmit"])){
    // upload file
    $file_name = uploadFileSingle('../uploads', 'thumbnail', 'add-edit-category__toast');

    // xử lý file
    if($action == "edit" && $_POST['thumbnail_edit_empty'] == "0" && empty($file_name)){
      // giữ nguyên nếu không chỉnh sửa ảnh
      $thumbnail = $row_category_by_id["thumbnail"];
    }else {
      // thêm hoặc sửa ảnh
      $thumbnail = $file_name;

      if($action == "edit"){
        // xóa ảnh cũ nếu chỉnh sửa
        unlink('../uploads/' . $row_category_by_id["thumbnail"]);
      }
    }

    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $parent_id = $_POST["parent_id"];

    if(!isset($_SESSION['add-edit-category__toast'])){
      if($action == "add"){
        // thêm danh mục mới
        $sql_submit = "INSERT INTO categories(thumbnail, name, slug, parent_id) VALUES ('$thumbnail', '$name', '$slug', $parent_id)";
      }else{
        // Sửa danh mục
        $sql_submit = "UPDATE categories SET thumbnail = '$thumbnail', name = '$name', slug = '$slug', parent_id = $parent_id WHERE id = $id";
      }
  
      $query_submit = mysqli_query($conn, $sql_submit);
  
      if ($query_submit) {
        // thông báo
        toast('categories__toast', 'success', $action == 'add' ? 'Thêm mới thành công' : 'Chỉnh sửa thành công');

        // chuyển trang
        redirect("categories.php");
      } else {
        toast('add-edit-category__toast', 'error', $action == 'add' ? 'Thêm mới thất bại' : 'Chỉnh sửa thất bại');
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: <?php echo $action == 'edit' ? 'Chỉnh sửa' : 'Thêm'; ?> danh mục</title>
  <?php include_once('../partials/admin/head.php') ?>

  <!-- main css -->
  <link rel="stylesheet" href="../assets/css/_base.css">
  <link rel="stylesheet" href="../assets/css/admin/_app.css">
  <link rel="stylesheet" href="../assets/css/admin/sidebar.css">
  <link rel="stylesheet" href="../assets/css/admin/header.css">
  <!-- main css -->
</head>

<body>
  <div id="toast">
  </div>

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
      <h2 class="title"><?php echo $action == 'edit' ? 'Chỉnh sửa' : 'Thêm'; ?> danh mục</h2>

      <form method="post" enctype="multipart/form-data" class="box">
        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Ảnh danh mục
          </div>
          <div class="upload">
            <img
              src="<?php echo $action == "edit" && $row_category_by_id["thumbnail"] ? '../uploads/' . $row_category_by_id["thumbnail"] : 'no-image'; ?>"
              alt="<?php echo $action == "edit" && $row_category_by_id["thumbnail"] ? $row_category_by_id["thumbnail"] : ''; ?>"
              class="upload__img">
            <div class="upload__content">
              <i class='bx bx-cloud-upload upload__icon'></i>
              <span class='upload__text'>Tải ảnh lên</span>
            </div>
            <input type="file" class="upload__input" name="thumbnail">
            <?php echo $action == "edit" ? '<input type="text" class="upload__edit-empty" name="thumbnail_edit_empty" value="0" hidden>' : '' ?>
            <i class='bx bx-x upload__close'></i>
            <div class=" upload__name">
              <?php echo $action == "edit" && $row_category_by_id["thumbnail"] ? $row_category_by_id["thumbnail"] : ''; ?>
            </div>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Tên danh mục <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" name="name" placeholder="Tên danh mục"
              value="<?php echo $action == "edit" ? $row_category_by_id["name"] : ''; ?>" required>
          </div>
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Slug đường dẫn <span class="required">*</span>
            </div>
            <input type="text" class="input read-add-edit__input" name="slug" placeholder="Slug đường dẫn"
              value="<?php echo $action == "edit" ? $row_category_by_id["slug"] : ''; ?>" required>
          </div>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Danh mục cha
          </div>
          <div class="dropdown">
            <div class="dropdown__select">
              <span class="dropdown__selected">
                <?php 
                  if($action == "edit"){
                    $parent_id = $row_category_by_id['parent_id'];
                    if($parent_id == "0"){
                      echo "-- Chọn danh mục --";
                    }else {
                      $sql_category_by_parent_id = "SELECT * FROM categories WHERE id = $parent_id";
                      $query_category_by_parent_id = mysqli_query($conn, $sql_category_by_parent_id);
                      $row_category_by_parent_id = mysqli_fetch_assoc($query_category_by_parent_id);
                    
                      echo $row_category_by_parent_id["name"];
                    }
                  }else {
                    echo "-- Chọn danh mục --";
                  }
                ?>
              </span>
              <i class='bx bxs-chevron-down dropdown__select-icon'></i>
              <input type="text" class="dropdown__input" value="<?php echo $action == 'edit' ? $parent_id : "0";?>"
                name="parent_id" hidden>
            </div>

            <ul class="dropdown__list read-add-edit__dropdown-list">
              <li
                class="dropdown__item <?php echo ($action == 'edit' && $parent_id == "0") || $action == 'add' ? 'active' : ''; ?>">
                <span class="dropdown__text" data-value="0">-- Chọn danh mục --</span>
              </li>
              <?php
                $sql_category_all = "SELECT * FROM categories";
                $query_category_all = mysqli_query($conn, $sql_category_all);
                while($row_category = mysqli_fetch_assoc($query_category_all)){
              ?>
              <li
                class="dropdown__item <?php echo $action == 'edit' && $row_category_by_id["parent_id"] == $row_category["id"] ? 'active' : ''; ?>">
                <span class="dropdown__text"
                  data-value="<?php echo $row_category["id"]; ?>"><?php echo $row_category["name"]; ?></span>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>

        <div class="btn-wrapper read-add-edit__line">
          <?php echo $action != 'edit' ? '<button type="reset" class="btn reset__btn">Làm mới</button>' : '';?>
          <button class="btn btn--primary" name="btnSubmit"
            value="submit"><?php echo $action == 'edit' ? 'Lưu lại' : 'Thêm mới';?></button>
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
    if(isset($_SESSION['add-edit-category__toast'])){
      echo $_SESSION['add-edit-category__toast'];
      unset($_SESSION['add-edit-category__toast']);
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