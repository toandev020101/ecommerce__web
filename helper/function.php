<?php
  // chuyển hướng trang $url
  function redirect($url){
    if(!empty($url)){
      header("Location: $url");
    }
  }

  // refresh trang sau $seconds giây
  function refresh($seconds = 0){
    if($seconds >= 0){
      header("Refresh: $seconds");
    }
  }

  // thông báo
  function toast($name, $type, $message, $duration = 3000){
    $_SESSION["$name"] = "toast({
      type: '$type',
      message: '$message',
      duration: $duration
    })";
  }

  // upload 1 file
  function uploadFileSingle($uploads_dir, $name, $toast_name, $required = false){
    $file_name = '';
    if ($_FILES["$name"]["error"] == UPLOAD_ERR_OK) {
        $file = $_FILES["$name"]["tmp_name"];
        $file_name = $_FILES["$name"]["name"];
        $path = $uploads_dir . '/' . $file_name;
        $upload_file = move_uploaded_file($file, $path);

        if(!$upload_file){
          toast($toast_name, 'error', 'Tải ảnh lên thất bại');
        }
    }else {
      if($required){
        toast($toast_name, 'error', 'Vui lòng tải ảnh lên');
      }
    }

    return $file_name;
  }

  // upload nhiều file
  function uploadFileMultiple($uploads_dir, $name, $toast_name, $required = false){
    $file_name_list = [];
    foreach ($_FILES["$name"]["error"] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
          $file = $_FILES["$name"]["tmp_name"][$key];
          $file_name = $_FILES["$name"]["name"][$key];
          $path = $uploads_dir . '/' . $file_name;
          $upload_file = move_uploaded_file($file, $path);

          if($upload_file){
            array_push($file_name_list, $file_name);
          }else {
            toast($toast_name, 'error', 'Tải ảnh lên thất bại');
            break;
          }
      }else {
        array_push($file_name_list, '');
        if($required){
          toast($toast_name, 'error', 'Vui lòng tải ảnh lên');
          break;
        }
      }
    }
    return $file_name_list;
  }

  // delete product by id
  function deleteProductById($conn, $id){
    // lấy ảnh sản phẩm
    $sql_image_list = "SELECT thumbnail FROM images WHERE product_id = $id";
    $query_image_list = mysqli_query($conn, $sql_image_list);

    // xóa ảnh của sản phẩm đã xóa
    while($row_image = mysqli_fetch_assoc($query_image_list)){
      unlink('../uploads/' . $row_image["thumbnail"]);
    }

    // xóa ảnh sản phẩm
    $sql_image_list_delete = "DELETE FROM images WHERE product_id = $id";
    mysqli_query($conn, $sql_image_list_delete);

    // xóa trạng thái sản phẩm
    $sql_product_status_list_delete = "DELETE FROM product_status WHERE product_id = $id";
    mysqli_query($conn, $sql_product_status_list_delete);

    // xóa màu sản phẩm
    $sql_product_color_list_delete = "DELETE FROM product_colors WHERE product_id = $id";
    mysqli_query($conn, $sql_product_color_list_delete);

    // lấy ảnh sản phẩm
    $sql_product = "SELECT thumbnail FROM products WHERE id = $id";
    $query_product = mysqli_query($conn, $sql_product);
    $row_product = mysqli_fetch_assoc($query_product);

    // xóa ảnh của sản phẩm đã xóa
    unlink('../uploads/' . $row_product["thumbnail"]);

    // xóa sản phẩm
    $sql_product_delete = "DELETE FROM products WHERE id = $id";
    mysqli_query($conn, $sql_product_delete);
  }
?>