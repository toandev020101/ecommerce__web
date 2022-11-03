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

  // config query string
  function queryString($query_string, $key, $value_item, $type = 'item' | 'list'){
    // tách key=value
    $query_array = explode('&',$query_string);

    $query_array_new = [];
    $checkKey = false;
    foreach($query_array as $query_item){
      // tách key,value
      $query_item_array = explode('=', $query_item);
      if($query_item_array[0] != 'page' && $query_item_array[0] != 'limit'){
        if($type == 'item'){
          if($query_item_array[0] == $key){
            $checkKey = true;
            $query_item = "$key=$value_item";
          }
        }else {
          // có key hay không ?
          if($query_item_array[0] == $key){
            $checkKey = true;

            // get list
            $value_list_string = $_GET["$key"];
            
            // tách value
            $value_array = explode('%', $value_list_string);

            // tìm kiếm value trùng
            $pos = array_search($value_item, $value_array);
            if(!is_bool($pos)){
              // trùng value xóa trong mảng
              array_splice($value_array, $pos, 1);
            }else {
              // không trùng value thêm vào mảng
              array_push($value_array, $value_item);
            }

            if(count($value_array) == 0){
              continue;
            }else {
              $query_item = $key . '=';
              foreach($value_array as $index => $value){
                $query_item .= $value;
                if($index != count($value_array) - 1){
                  $query_item .= '%';
                }
              }
            }
          }
        }

        // thêm key=value vào mảng
        array_push($query_array_new, $query_item);
      }
    }

    if(!$checkKey){
      array_push($query_array_new, "$key=$value_item");
    }

    $query_string = '';
    foreach($query_array_new as $index => $query_item){
      // gộp key=value
      $query_string .= $query_item;
      if($index != count($query_array_new) - 1){
        $query_string .= '&';
      }
    }

    return $query_string;
  }

  // lấy list id bằng query string
  function queryListId($key){
    if(isset($_GET["$key"])){
      $list_id_string = $_GET["$key"];
      $list_id = explode('%', $list_id_string);
    }else {
      $list_id = [];
    }

    return $list_id;
  }
?>