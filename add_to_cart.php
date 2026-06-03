<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$prd_id = $_GET['prd_id']; // hoặc $_GET tùy theo cách gửi
//$qtt = $_POST['quantity'] ?? 1;
if (isset($_POST['qtt'])) {
    $qtt = intval($_POST['qtt']);
} else {
    $qtt = 1;
}
if (isset($_SESSION['cart'][$prd_id])) {
    $_SESSION['cart'][$prd_id] += $qtt;
} else {
    $_SESSION['cart'][$prd_id] = $qtt;
}
//$prd_id = $_GET['prd_id'];
//// ktra sản phẩm đa đợc thêm va giỏ hảng chưa
//if(isset($_SESSION['cart'][$prd_id])){
//    $_SESSION['cart'][$prd_id]+=$_SESSION['qtt'];
//}else{
//    $_SESSION['cart'][$prd_id]=$_SESSION['qtt'];
//}
header('location: index.php?page_layout=giohang ');
?>


