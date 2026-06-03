<?php

session_start();

// Hủy toàn bộ session
session_unset();
session_destroy();

// Chuyển hướng về trang chủ (index.php)
header("Location: index.php");
exit();

?>
