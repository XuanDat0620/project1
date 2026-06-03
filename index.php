<?php
session_start();
ob_start();
include_once ('admin/config/connect.php') ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop quần áo</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/14_4.css">
    <link rel="stylesheet" href="css/sanpham.css">
    <link rel="stylesheet" href="css/giohang.css">
    <link rel="stylesheet" href="css/chitietsp.css">
    <link rel="stylesheet" href="css/taikhoan.css">
    <link rel="stylesheet" href="css/thanhtoan.css">
    <link rel="stylesheet" href="css/success.css">
    <link rel="stylesheet" href="css/lichsu.css">
</head>
<body>
    <!-- Master page -->
    <?php
    if(isset($_GET['page_layout'])){
        switch ($_GET['page_layout']) {
            case 'dangnhap': include_once('dangnhap.php'); break;
            case 'dangky' : include_once('dangky.php'); break;
            case 'nam': include_once('nam.php'); break;
            case 'nu': include_once('nu.php'); break;
            case 'tre_em': include_once('tre_em.php'); break;
            case 'giohang': include_once('giohang.php'); break;
            case 'taikhoan': include_once('taikhoan.php'); break;
            case 'chitietsp': include_once('chitietsp.php'); break;
            case 'thanhtoan': include_once('thanhtoan.php'); break;
            case 'success' : include_once('success.php'); break;
            case 'timkiem' : include_once('timkiem.php'); break;
            case 'lichsu' : include_once('lichsu.php'); break;
            case 'nhan_hang' : include_once('nhan_hang.php'); break;
        }
    }else{
        include_once ('dashboard.php');
    }
    ?>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>

