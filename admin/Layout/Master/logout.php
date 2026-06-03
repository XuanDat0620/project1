<?php
session_start();
session_destroy(); // Xoá toàn bộ session
header('location: login.php'); // Chuyển hướng về trang đăng nhập
exit();
?>