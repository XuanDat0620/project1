<?php
//include_once ('../../config/connect.php');
//$ord_id = $_GET['ord_id'];
//$ord_status = $_GET['status'];
//$sql="UPDATE orders SET `ord_status`=$ord_status WHERE `ord_id`='$ord_id'";
//mysqli_query($connect,$sql);
//header('location:../../index.php?pageLayout=order_detail&ord_id='.$ord_id);
//?>
<?php
//include_once('../../config/connect.php');
//
//$ord_id = $_GET['ord_id'];
//$ord_status = $_GET['status'];
//
//// Kiểm tra trạng thái hiện tại
//$sql_check = "SELECT ord_status FROM orders WHERE ord_id = '$ord_id'";
//$result = mysqli_query($connect, $sql_check);
//$row = mysqli_fetch_assoc($result);
//
//// Chỉ cho phép cập nhật nếu đơn chưa bị huỷ
//if ($row['ord_status'] != 6) {
//    $sql = "UPDATE orders SET ord_status = $ord_status WHERE ord_id = '$ord_id'";
//    mysqli_query($connect, $sql);
//} else {
//    // Tùy chọn: hiện thông báo lỗi hoặc không làm gì
//    echo "<script>alert('Không thể xác nhận đơn hàng vì đã bị khách hủy.');</script>";
//}
//
//header('Location: ../index.php?pageLayout=order_detail&ord_id=' . $ord_id);
//?>
<?php
include_once "../../config/connect.php";
$ord_id = $_GET["ord_id"];
$ord_status = $_GET["status"];

$sql_check = "SELECT ord_status FROM orders WHERE ord_id = '$ord_id'";
$result_check = mysqli_query($connect, $sql_check);
$row_check = mysqli_fetch_array($result_check);

if ($row_check['ord_status'] == 6) {
    header('location:../../index.php?pageLayout=order_detail&ord_id=' . $ord_id . '&ord_status=' . $ord_status);
}else {
    if ($ord_status == 6) {
        $sql_get_products = "SELECT prd_id, ord_detail_amount FROM order_detail WHERE ord_id = $ord_id";
        $result_products = mysqli_query($connect, $sql_get_products);

        while ($row = mysqli_fetch_assoc($result_products)) {
            $prd_id = $row['prd_id'];
            $amount = $row['ord_detail_amount'];

            // Cập nhật lại số lượng tồn kho
            $sql_update_stock = "UPDATE product SET prd_quantity = prd_quantity + $amount WHERE prd_id = $prd_id";
            mysqli_query($connect, $sql_update_stock);
        }
    }
    $sql = "UPDATE orders SET ord_status = $ord_status WHERE ord_id = $ord_id";
    mysqli_query($connect, $sql);
    header('location:../../index.php?pageLayout=order_detail&ord_id=' . $ord_id . '&ord_status=' . $ord_status);
}

?>
