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

  // kiểm tra đăng nhập
  function checkAuth(){
    if(isset($_SESSION['user'])){
      return true;
    }

    return false;
  }

  // kiểm tra quyền truy cập
  function checkPermission($conn){
    if(isset($_SESSION['user'])){
      $role_id = $_SESSION['user']['role_id'];

      $sql_role_by_id = "SELECT name FROM roles WHERE id = $role_id";
      $query_role_by_id = mysqli_query($conn, $sql_role_by_id);
      $row_role_by_id = mysqli_fetch_assoc($query_role_by_id);

      return $row_role_by_id['name'];
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
        $date = new Datetime();
        $file = $_FILES["$name"]["tmp_name"];
        $file_name = $_FILES["$name"]["name"];

        $basename = explode('.', $file_name)[0];
        $file_type = explode('.', $file_name)[1];
        $file_name = $basename . '-' . date_format($date, 'U') . '.' . $file_type;

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
          $date = new Datetime();
          $file = $_FILES["$name"]["tmp_name"][$key];
          $file_name = $_FILES["$name"]["name"][$key];

          $basename = explode('.', $file_name)[0];
          $file_type = explode('.', $file_name)[1];
          $file_name = $basename . '-' . date_format($date, 'U') . '.' . $file_type;
        
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
?>