<?php
session_start();
include_once('admin/config/connect.php'); // kết nối DB

if (!isset($_SESSION['cus_id'])) {
    echo "Bạn cần đăng nhập!";
    exit;
}

$cus_id = $_SESSION['cus_id'];
if (isset($_GET['ord_id'])) {
    $ord_id = $_GET['ord_id'];

    // Kiểm tra xem đơn này thuộc về khách hàng và đang ở trạng thái chờ xử lý
    $sql_check = "SELECT * FROM orders WHERE ord_id = $ord_id AND customer_id = $cus_id AND ord_status = 1";
    $result = mysqli_query($connect, $sql_check);

    if (mysqli_num_rows($result) > 0) {
        // Cập nhật trạng thái đơn hàng thành -1 (đã hủy)
        $sql_cancel = "UPDATE orders SET ord_status = 6 WHERE ord_id = $ord_id";
        if (mysqli_query($connect, $sql_cancel)) {
            header('Location: index.php?page_layout=lichsu'); // quay lại trang lịch sử
            exit;
        } else {
            echo "Lỗi khi hủy đơn.";
        }
    } else {
        echo "Không tìm thấy đơn hàng hợp lệ để hủy.";
    }
} else {
    echo "Thiếu ID đơn hàng.";
}
?>
