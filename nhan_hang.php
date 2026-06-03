<?php
//session_start();
//include_once('admin/config/connect.php'); // file kết nối db

if (!isset($_SESSION['cus_id'])) {
    echo "Vui lòng đăng nhập.";
    exit;
}

if (!isset($_GET['ord_id'])) {
    echo "Thiếu mã đơn hàng.";
    exit;
}

$cus_id = $_SESSION['cus_id'];
$ord_id = (int)$_GET['ord_id'];

// Kiểm tra đơn hàng của khách và đang ở trạng thái chờ nhận hàng
$sql = "SELECT * FROM orders WHERE ord_id = $ord_id AND customer_id = $cus_id AND ord_status = 4";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Đơn hàng không hợp lệ hoặc không ở trạng thái chờ nhận hàng.";
    exit;
}

// Cập nhật trạng thái thành đã nhận hàng (5)
$sql_update = "UPDATE orders SET ord_status = 5 WHERE ord_id = $ord_id";
if (mysqli_query($connect, $sql_update)) {
    header("Location: index.php?page_layout=lichsu");
    exit;
} else {
    echo "Cập nhật trạng thái thất bại.";
}
?>

