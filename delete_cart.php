<?php
session_start();
$prd_id=$_GET['prd_id'];
// ktra sp có nằm trog session giỏ hàng không
if(isset($_SESSION['cart'][$prd_id])){
    unset($_SESSION['cart'][$prd_id]);
}
// ktra nếu giỏ hàng rỗng thì xóa toàn bộ session giỏ hàng
if(count($_SESSION['cart'])==0){
    unset($_SESSION['cart']);
}
header('location:index.php?page_layout=giohang');
?>