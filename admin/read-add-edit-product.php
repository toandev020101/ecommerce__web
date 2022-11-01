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

    // lấy sản phẩm theo id
    $sql_product_by_id = "SELECT * FROM products WHERE id = $id";
    $query_product_by_id = mysqli_query($conn, $sql_product_by_id);
    $row_product_by_id = mysqli_fetch_assoc($query_product_by_id);
  }

  if(isset($_POST["btnSubmit"])){
    if($action == 'read'){
      // chuyển trang
      redirect('products.php');
    }else {
      // upload file
      $file_name = uploadFileSingle('../uploads', 'thumbnail', 'read-add-edit-product__toast', $action == 'add' ? true : false);

      // xử lý file
      if($action == "edit" && $_POST['thumbnail_edit_empty'] == "0" && empty($file_name)){
        // giữ nguyên nếu không chỉnh sửa ảnh
        $thumbnail = $row_product_by_id["thumbnail"];
      }else {
        // thêm hoặc sửa ảnh
        $thumbnail = $file_name;

        if($action == "edit"){
          // xóa ảnh cũ nếu chỉnh sửa
          unlink('../uploads/' . $row_product_by_id["thumbnail"]);
        }
      }

      // upload files
      $file_name_list = uploadFileMultiple('../uploads', 'image_list', 'read-add-edit-product__toast', $action == 'add' ? true : false);

      // xử lý file
      if($action == "edit"){
        // lấy image theo product id
        $sql_image_list_by_product_id = "SELECT thumbnail FROM images WHERE product_id = $id";
        $query_image_list_by_product_id = mysqli_query($conn, $sql_image_list_by_product_id);
        $row_image_list_by_product_id = mysqli_fetch_all($query_image_list_by_product_id);

        // lấy image chỉnh sửa
        $image_edit_empty_list = $_POST["image_edit_empty_list"];
        foreach($image_edit_empty_list as $index => $image_edit_empty){
          if($image_edit_empty == "0" && empty($file_name_list[$index])){
            // giữ nguyên nếu không chỉnh sửa ảnh
            $file_name_list[$index] = $row_image_list_by_product_id[$index][0];
          }else {
            // xóa ảnh cũ nếu chỉnh sửa
            unlink('../uploads/' . $row_image_list_by_product_id[$index][0]);
          }
        }
      }
      
      // thêm hoặc sửa ảnh
      $image_list = $file_name_list;
  
      $name = $_POST["name"];
      $slug = $_POST["slug"];
      $quantity = $_POST["quantity"];
      $price = $_POST["price"];
      
      $discount = !empty($_POST["discount"]) ? $_POST["discount"] : 0;
      $category_id = $_POST["category_id"];
      if($category_id == "0"){
        if(!isset($_SESSION['read-add-edit-product__toast'])){
          toast('read-add-edit-product__toast', 'error', 'Vui lòng chọn danh mục');
        }
      }
  
      if(isset($_POST["status_list"])){
        $status_list = $_POST["status_list"];
      }
  
      if(isset($_POST["color_list"])){
        $color_list = $_POST["color_list"];
      }else {
        if(!isset($_SESSION['read-add-edit-product__toast'])){
          toast('read-add-edit-product__toast', 'error', 'Vui lòng chọn màu sắc');
        }
      }
  
      $description = $_POST["description"];
  
      if(!isset($_SESSION['read-add-edit-product__toast'])){
        // tắt tự động commit sql
        mysqli_autocommit($conn, false);
        
        try{
          if($action == 'add'){
            // thêm sản phẩm mới
            $sql_product_add = "INSERT INTO products(thumbnail, name, slug, quantity, price, discount, description, category_id) VALUES ('$thumbnail', '$name', '$slug', $quantity, $price, $discount, '$description', $category_id)";
  
            mysqli_query($conn, $sql_product_add);
            $product_add_id = mysqli_insert_id($conn);
    
            // thêm ảnh mới
            $values = '';
            foreach($image_list as $index => $image){
              $values .= "('$image', $product_add_id)";
              if($index != count($image_list) - 1){
                $values .= ',';
              }
            }
    
            $sql_image_list_add = "INSERT INTO images(thumbnail, product_id) VALUES $values";
            mysqli_query($conn, $sql_image_list_add);
      
            if(isset($status_list)){
              // thêm trạng thái mới
              $values = '';
              foreach($status_list as $index => $status_id){
                $values .= "($product_add_id, $status_id)";
                if($index != count($status_list) - 1){
                  $values .= ',';
                }
              }
              $sql_product_status_list_add = "INSERT INTO product_status(product_id, status_id) VALUES $values";
              mysqli_query($conn, $sql_product_status_list_add);
            }
      
            // thêm màu mới
            $values = '';
            foreach($color_list as $index => $color_id){
              $values .= "($product_add_id, $color_id)";
              if($index != count($color_list) - 1){
                $values .= ',';
              }
            }
            $sql_product_color_list_add = "INSERT INTO product_colors(product_id, color_id) VALUES $values";
            mysqli_query($conn, $sql_product_color_list_add);
          }else {
            // chỉnh sửa sản phẩm
            $sql_product_update = "UPDATE products SET thumbnail = '$thumbnail', name = '$name', slug = '$slug', quantity = $quantity, price = $price, discount = $discount, description = '$description', category_id = $category_id WHERE id = $id";
  
            mysqli_query($conn, $sql_product_update);

            // xóa ảnh cũ
            $sql_image_list_delete = "DELETE FROM images WHERE product_id = $id";
            mysqli_query($conn, $sql_image_list_delete);

            // thêm ảnh mới
            $values = '';
            foreach($image_list as $index => $image){
              $values .= "('$image', $id)";
              if($index != count($image_list) - 1){
                $values .= ',';
              }
            }
    
            $sql_image_list_add = "INSERT INTO images(thumbnail, product_id) VALUES $values";
            mysqli_query($conn, $sql_image_list_add);
      
            // xóa trạng thái cũ
            $sql_product_status_list_delete = "DELETE FROM product_status WHERE product_id = $id";
            mysqli_query($conn, $sql_product_status_list_delete);

            if(isset($status_list)){
              // thêm trạng thái mới
              $values = '';
              foreach($status_list as $index => $status_id){
                $values .= "($id, $status_id)";
                if($index != count($status_list) - 1){
                  $values .= ',';
                }
              }
              $sql_status_list_add = "INSERT INTO product_status(product_id, status_id) VALUES $values";
              mysqli_query($conn, $sql_status_list_add);
            }

            // xóa màu cũ
            $sql_product_color_list_delete = "DELETE FROM product_colors WHERE product_id = $id";
            mysqli_query($conn, $sql_product_color_list_delete);
      
            // thêm màu mới
            $values = '';
            foreach($color_list as $index => $color_id){
              $values .= "($id, $color_id)";
              if($index != count($color_list) - 1){
                $values .= ',';
              }
            }
            $sql_color_list_add = "INSERT INTO product_colors(product_id, color_id) VALUES $values";
            mysqli_query($conn, $sql_color_list_add);
          }

          // bật tự động commit sql
          mysqli_autocommit($conn, true);

          toast('products__toast', 'success', $action == 'add' ? 'Thêm mới thành công' : 'Chỉnh sửa thành công');
          redirect("products.php");
        }catch(mysqli_sql_exception $exception) {
          mysqli_rollback($conn);
          toast('read-add-edit-product__toast', 'error', $action == 'add' ? 'Thêm mới thất bại' : 'Chỉnh sửa thất bại');
          throw $exception;
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PKShop: <?php echo $action == 'read' ? 'Chi tiết' : ($action == 'edit' ? 'Chỉnh sửa' : 'Thêm'); ?> sản phẩm
  </title>
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
      <h2 class="title"><?php echo $action == 'read' ? 'Chi tiết' : ($action == 'edit' ? 'Chỉnh sửa' : 'Thêm'); ?> sản
        phẩm</h2>

      <form method="post" enctype="multipart/form-data" class="box">
        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Ảnh sản phẩm <span class="required">*</span>
          </div>
          <div class="upload">
            <img src="<?php echo $action != "add" ? '../uploads/' . $row_product_by_id["thumbnail"] : 'no-image'; ?>"
              alt="<?php echo $action != "add" ? $row_product_by_id["thumbnail"] : ''; ?>" class="upload__img">
            <div class="upload__content">
              <i class='bx bx-cloud-upload upload__icon'></i>
              <span class='upload__text'>Tải ảnh lên</span>
            </div>
            <input type="file" name="thumbnail" class="upload__input">
            <?php echo $action == "edit" ? '<input type="text" class="upload__edit-empty" name="thumbnail_edit_empty" value="0" hidden>' : '' ?>
            <i class='bx bx-x upload__close <?php echo $action == "read" ? 'hidden' : '';?>'></i>
            <div class="upload__name">
              <?php echo $action != "add" ? $row_product_by_id["thumbnail"] : ''; ?>
            </div>
          </div>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Thư viện ảnh <span class="required">*</span>
          </div>
          <div class="read-add-edit__row">
            <?php
              $row_num_image = 4;

              if($action != 'add'){
                $sql_image_list_by_product_id = "SELECT * FROM images WHERE product_id = $id";
                $query_image_list_by_product_id = mysqli_query($conn, $sql_image_list_by_product_id);
              }

              while($action == 'add' ? $row_num_image > 0 : $row_image_by_product_id = mysqli_fetch_assoc($query_image_list_by_product_id)){
            ?>
            <div class="read-add-edit__col">
              <div class="upload small">
                <img
                  src="<?php echo $action != "add" ? '../uploads/' .$row_image_by_product_id["thumbnail"] : 'no-image'; ?>"
                  alt="<?php echo $action != "add" ? $row_image_by_product_id["thumbnail"] : ''; ?>"
                  class="upload__img">
                <div class="upload__content">
                  <i class='bx bx-cloud-upload upload__icon'></i>
                  <span class='upload__text'>Tải ảnh lên</span>
                </div>
                <input type="file" name="image_list[]" class="upload__input">
                <?php echo $action == "edit" ? '<input type="text" class="upload__edit-empty" name="image_edit_empty_list[]" value="0" hidden>' : '' ?>
                <i class='bx bx-x upload__close <?php echo $action == "read" ? 'hidden' : '';?>'></i>
                <div class="upload__name">
                  <?php echo $action != "add" ? $row_image_by_product_id["thumbnail"] : ''; ?>
                </div>
              </div>
            </div>
            <?php
                $action == 'add' ? $row_num_image-- : '';
              }
            ?>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Tên sản phẩm <span class="required">*</span>
            </div>
            <input type="text" name="name" class="input read-add-edit__input" placeholder="Tên sản phẩm"
              value="<?php echo $action != 'add' ? $row_product_by_id["name"] : ''; ?>" required
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Slug đường dẫn <span class="required">*</span>
            </div>
            <input type="text" name="slug" class="input read-add-edit__input" placeholder="Slug đường dẫn"
              value="<?php echo $action != 'add' ? $row_product_by_id["slug"] : ''; ?>" required
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Số lượng <span class="required">*</span>
            </div>
            <input type="number" name="quantity" class="input read-add-edit__input" placeholder="Số lượng"
              value="<?php echo $action != 'add' ? $row_product_by_id["quantity"] : ''; ?>" required
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Giá <span class="required">*</span>
            </div>
            <input type="text" name="price" class="input read-add-edit__input" placeholder="Giá"
              value="<?php echo $action != 'add' ? $row_product_by_id["price"] : ''; ?>" required
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
        </div>

        <div class="read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Giảm giá
            </div>
            <input type="text" name="discount" class="input read-add-edit__input" placeholder="Giảm giá"
              value="<?php echo $action != 'add' ? $row_product_by_id["discount"] : ''; ?>"
              <?php echo $action == "read" ? 'readonly' : '';?>>
          </div>
          <div class=" read-add-edit__col">
            <div class="read-add-edit__name">
              Danh mục <span class="required">*</span>
            </div>
            <div class="dropdown <?php echo $action == "read" ? 'readonly' : '';?>">
              <div class="dropdown__select">
                <span class="dropdown__selected">
                  <?php 
                  if($action != "add"){
                    $category_id = $row_product_by_id['category_id'];
                    
                    $sql_category_list_by_id = "SELECT * FROM categories WHERE id = $category_id";
                    $query_category_list_by_id = mysqli_query($conn, $sql_category_list_by_id);
                    $row_category_by_id = mysqli_fetch_assoc($query_category_list_by_id);
                  
                    echo $row_category_by_id["name"];
                  }else {
                    echo "-- Chọn danh mục --";
                  }
                ?>
                </span>
                <i class='bx bxs-chevron-down dropdown__select-icon'></i>
                <input type="text" class="dropdown__input" value="<?php echo $action != 'add' ? $category_id : "0";?>"
                  name="category_id" hidden>
              </div>

              <ul class="dropdown__list read-add-edit__dropdown-list">
                <li class="dropdown__item <?php echo $action == 'add' ? 'active' : ''; ?>">
                  <span class="dropdown__text">-- Chọn danh mục --</span>
                </li>
                <?php
                  $sql_category_all = "SELECT * FROM categories";
                  $query_category_all = mysqli_query($conn, $sql_category_all);
                  while($row_category = mysqli_fetch_assoc($query_category_all)){
                ?>
                <li
                  class="dropdown__item <?php echo $action != 'add' && $row_product_by_id["category_id"] == $row_category["id"] ? 'active' : ''; ?>">
                  <span class="dropdown__text"
                    data-value="<?php echo $row_category["id"]; ?>"><?php echo $row_category["name"]; ?></span>
                </li>
                <?php
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>

        <div class=" read-add-edit__row">
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Trạng thái
            </div>
            <ul class="checkbox__list">
              <?php 
                $sql_status_by_type = "SELECT * FROM status WHERE type = 0";
                $query_status_by_type = mysqli_query($conn, $sql_status_by_type);

                while ($row_status_by_type = mysqli_fetch_assoc($query_status_by_type)){
              ?>
              <li class="checkbox__item">
                <label for="status<?php echo $row_status_by_type['id']?>" class="checkbox">
                  <input type="checkbox" name="status_list[]" value="<?php echo $row_status_by_type['id']?>"
                    id="status<?php echo $row_status_by_type['id']?>" class="checkbox__input" <?php
                    if($action != 'add'){
                      $status_id = $row_status_by_type['id'];
                      $sql_product_status_by_product_status_id = "SELECT * FROM product_status WHERE product_id = $id and status_id = $status_id";

                      $query_product_status_by_product_status_id = mysqli_query($conn, $sql_product_status_by_product_status_id);
                      $row_num_product_status_by_product_status_id = mysqli_num_rows($query_product_status_by_product_status_id);

                      if($row_num_product_status_by_product_status_id > 0){
                        echo 'checked';
                      }
                    }
                  ?> <?php echo $action == "read" ? 'disabled' : '';?>>
                  <div class="checkbox__box"></div>
                  <?php echo $row_status_by_type["name"];?>
                </label>
              </li>
              <?php 
                }
              ?>
            </ul>
          </div>
          <div class="read-add-edit__col">
            <div class="read-add-edit__name">
              Màu sắc <span class="required">*</span>
            </div>
            <ul class="checkbox__list">
              <?php
                $sql_color_all = "SELECT * FROM colors";
                $query_color_all = mysqli_query($conn, $sql_color_all);

                while ($row_color = mysqli_fetch_assoc($query_color_all)){
              ?>
              <li class="checkbox__item">
                <label for="color<?php echo $row_color["id"]?>" class="checkbox">
                  <input type="checkbox" name="color_list[]" value="<?php echo $row_color["id"]?>"
                    id="color<?php echo $row_color["id"]?>" class="checkbox__input" <?php
                    if($action != 'add'){
                      $color_id = $row_color['id'];
                      $sql_product_color_by_product_color_id = "SELECT * FROM product_colors WHERE product_id = $id and color_id = $color_id";

                      $query_product_color_by_product_color_id = mysqli_query($conn, $sql_product_color_by_product_color_id);
                      $row_num_product_color_by_product_color_id = mysqli_num_rows($query_product_color_by_product_color_id);

                      if($row_num_product_color_by_product_color_id > 0){
                        echo 'checked';
                      }
                    }
                  ?> <?php echo $action == "read" ? 'disabled' : '';?>>
                  <div class="checkbox__box"></div>
                  <?php echo $row_color["name"];?>
                </label>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>

        <div class="read-add-edit__line">
          <div class="read-add-edit__name">
            Mô tả
          </div>
          <!-- text editor -->
          <div class="text-editor">
            <!-- text editor header -->
            <div class="text-editor__header <?php echo $action == "read" ? 'readonly' : '';?>">
              <!-- text editor format -->
              <button type="button" class="text-editor__btn format" id="bold">
                <i class='bx bx-bold'></i>
              </button>
              <button type="button" class="text-editor__btn format" id="italic">
                <i class='bx bx-italic'></i>
              </button>
              <button type="button" class="text-editor__btn format" id="underline">
                <i class='bx bx-underline'></i>
              </button>
              <!-- end text editor format -->

              <!-- text editor list -->
              <button type="button" class="text-editor__btn" id="insertUnorderedList">
                <i class='bx bx-list-ul'></i>
              </button>
              <button type="button" class="text-editor__btn" id="insertOrderedList">
                <i class='bx bx-list-ol'></i>
              </button>
              <!-- end text editor list -->

              <!-- text editor undo/redo -->
              <button type="button" class="text-editor__btn" id="undo">
                <i class='bx bx-undo'></i>
              </button>
              <button type="button" class="text-editor__btn" id="redo">
                <i class='bx bx-redo'></i>
              </button>
              <!-- end text editor undo/redo -->

              <!-- text editor link -->
              <button type="button" class="adv-text-editor__btn" id="createLink">
                <i class='bx bx-link'></i>
              </button>
              <button type="button" class="text-editor__btn" id="unlink">
                <i class='bx bx-unlink'></i>
              </button>
              <button type="button" class="adv-text-editor__btn" id="insertImage">
                <i class='bx bx-image'></i>
              </button>
              <!-- end text editor link -->

              <!-- text editor alignment -->
              <button type="button" class="text-editor__btn align" id="justifyLeft">
                <i class='bx bx-align-left'></i>
              </button>
              <button type="button" class="text-editor__btn align" id="justifyCenter">
                <i class='bx bx-align-middle'></i>
              </button>
              <button type="button" class="text-editor__btn align" id="justifyRight">
                <i class='bx bx-align-right'></i>
              </button>
              <button type="button" class="text-editor__btn align" id="justifyFull">
                <i class='bx bx-align-justify'></i>
              </button>
              <button type="button" class="text-editor__btn spacing" id="indent">
                <i class='bx bx-right-indent'></i>
              </button>
              <button type="button" class="text-editor__btn spacing" id="outdent">
                <i class='bx bx-left-indent'></i>
              </button>
              <!-- end text editor alignment -->

              <!-- text editor headings -->
              <select class="adv-text-editor__btn" id="formatBlock">
                <option value="h1">H1</option>
                <option value="h2">H2</option>
                <option value="h3">H3</option>
                <option value="h4">H4</option>
                <option value="h5">H5</option>
                <option value="h6">H6</option>
              </select>
              <!-- end text editor headings -->

              <!-- text editor font -->
              <select class="adv-text-editor__btn" id="fontName">
              </select>
              <!-- end text editor font -->

              <!-- text editor fontsize -->
              <select class="adv-text-editor__btn" id="fontSize">
              </select>
              <!-- end text editor fontsize -->

              <!-- text editor color -->
              <div class="text-editor__input-wrapper">
                <input type="color" class="adv-text-editor__btn" id="foreColor">
                <label for="foreColor">Font Color</label>
              </div>

              <div class="text-editor__input-wrapper">
                <input type="color" class="adv-text-editor__btn" id="backColor">
                <label for="backColor">Highlight Color</label>
              </div>
              <!-- end text editor color -->
            </div>
            <!-- end text editor header -->

            <!-- text editor content -->
            <div class="text-editor__content" <?php echo $action != "read" ? 'contenteditable' : '';?>>
              <?php echo $action != 'add' ? $row_product_by_id["description"] : '' ;?>
            </div>
            <input type="text" name="description" class="text-editor__content-input"
              value="<?php echo $action != 'add' ? $row_product_by_id["description"] : '' ;?>" hidden>
            <!-- end text editor content -->
          </div>
          <!-- end text editor -->
        </div>

        <div class="btn-wrapper read-add-edit__line">
          <?php echo $action == 'add' ? '<button type="reset" class="btn reset__btn">Làm mới</button>' : '';?>

          <button class="btn btn--primary" name="btnSubmit"><?php
          if($action == 'read'){
            echo "Quay lại";
          }else if($action == 'edit'){
            echo "Lưu lại";
          }else {
            echo "Thêm mới";
          }
          ?></button>
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
    if(isset($_SESSION['read-add-edit-product__toast'])){
      echo $_SESSION['read-add-edit-product__toast'];
      unset($_SESSION['read-add-edit-product__toast']);
    }
  ?>
  </script>
  <script src="../assets/js/admin/_app.js"></script>
  <script src="../assets/js/admin/text-editor.js"></script>
  <!-- end js -->
</body>

</html>

<?php
  // Ngắt kết nối
  mysqli_close($conn);
?>