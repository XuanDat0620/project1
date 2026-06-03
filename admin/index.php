<?php
// khởi taạo session
session_start();
// khởi tạo  đối tượng
ob_start();
// tạo kết nối CSDL cho toàn bộ trang quản trị
include_once ('config/connect.php');
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    // gọi trag chủ vào  đầu tiên
    include_once ('Layout/Master/admin.php');
}else{
    include_once ('Layout/Master/login.php');
}

?>