<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db_name = "pkshop";

  $conn = mysqli_connect($host, $user, $pass, $db_name);

  if($conn) {
    mysqli_set_charset($conn, 'utf8');
  }else {
    die("Kết nối không thành công: " . mysqli_connect_error());
  }
?>