<?php
$ord_id = $_GET['ord_id'];
$sql = "SELECT * FROM order_detail od
        JOIN orders o ON o.ord_id = od.ord_id
        JOIN product p ON p.prd_id = od.prd_id
        JOIN customer c ON c.cus_id = o.customer_id
        WHERE od.ord_id = $ord_id";
$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_array($query);
// Lấy ID đơn hàng từ URL
if (isset($_GET['ord_id'])) {
    $ord_id = $_GET['ord_id'];

    // Lấy thông tin đơn hàng
    $sql_order = "SELECT o.*, c.cus_username, c.cus_phone, c.cus_address FROM orders o JOIN customer c ON o.customer_id = c.cus_id WHERE o.ord_id = $ord_id";
    $result_order = mysqli_query($connect, $sql_order);
    $order = mysqli_fetch_assoc($result_order);

    // Lấy chi tiết sản phẩm trong đơn hàng
    $sql_detail = "SELECT * FROM order_detail od JOIN product p ON od.prd_id = p.prd_id WHERE od.ord_id = $ord_id ";
    $result_detail = mysqli_query($connect, $sql_detail);
} else {
    echo "<div class='alert alert-danger'>Không có đơn hàng được chọn.</div>";
    exit;
}
?>
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li ><a href="?pageLayout=order">/ Quản lý đơn hàng /</a></li>
                <li class="active"><a href="#">Chi tiết đơn hàng</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Chi tiết đơn hàng</h1>
        </div>
        <div class="col-lg-12">
            <p>Người nhận: <?= $order['cus_username'] ?></p>
            <p>Số điện thoại: <?= $order['cus_phone'] ?></p>
            <p>Địa chỉ: <?= $order['cus_address'] ?></p>
            <p>Ngày mua:<?= date('d/m/Y H:i:s', strtotime($order['ord_buy_date'])) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="content">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($item = mysqli_fetch_assoc($result_detail)) { ?>
                    <tr>
                        <td><?= $item['prd_name'] ?></td>
                        <td><img src="../images/<?= $item['prd_image']  ?>" alt="" width="100px"></td>
                        <td><?= $item['ord_detail_amount'] ?></td>
                        <td><?= number_format($item['ord_detail_price']) ?> VNĐ</td>
                        <td><?= number_format($item['ord_detail_amount'] * $item['ord_detail_price']) ?> VNĐ</td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4"><h3 class="text-danger"><b>Tổng tiền:</b></h3></td>
                    <td><h3 class="text-danger"><b><?= number_format($order['ord_total_price']) ?>đ</b></h3></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <p><strong>Tổng tiền:</strong> <?= number_format($order['ord_total_price']) ?> VNĐ</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
                <?php
                if($row['ord_status']==1){
                ?>
                <a href="Layout/order/xu_ly_order.php?ord_id=<?= $row['ord_id'] ?>&status=2" class="btn btn-warning">Xác nhận đơn hàng</a>
                <a href="Layout/order/xu_ly_order.php?ord_id=<?= $row['ord_id'] ?>&status=6" class="btn btn-danger">Hủy đơn hàng</a>
                <?php
                }elseif ($row['ord_status']==2){
                ?>
                <a href="Layout/order/xu_ly_order.php?ord_id=<?= $row['ord_id'] ?>&status=3" class="btn btn-danger">Đang giao hàng</a>
                <?php
                }elseif ($row['ord_status']==3){
                ?>
                <a href="Layout/order/xu_ly_order.php?ord_id=<?= $row['ord_id'] ?>&status=4" class="btn btn-danger">Đã giao hàng</a>
                <?php
                }elseif ($row['ord_status']==4){
                ?>
                <a href="#" class="btn btn-outline-info">Chờ nhận hàng</a>
                <?php
                }elseif ($row['ord_status']==5){
                ?>
                <a href="#" class="btn btn-outline-secondary">Đã nhận hàng</a>
                <?php
                }else{
                ?>
                <a href="#" class="btn btn-danger">Đã hủy</a>
                <?php
                }
                ?>
        </div>
    </div>
</div>
