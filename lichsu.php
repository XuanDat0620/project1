<?php
// Kiểm tra khách hàng đã đăng nhập chưa
if (!isset($_SESSION['cus_id'])) {
    echo "<p>Vui lòng đăng nhập để xem lịch sử đơn hàng.</p>";
    exit;
}
$cus_id = $_SESSION['cus_id'];
// Lấy danh sách đơn hàng
$sql_orders = "SELECT * FROM orders WHERE customer_id = $cus_id ORDER BY ord_buy_date DESC";
$result_orders = mysqli_query($connect, $sql_orders);
?>

<header>
    <?php include_once('header.php'); ?>
</header>
<main>
    <section id="section-main-1">
        <div class="container">
            <h1 class="text-center mb-4">Lịch Sử Mua Hàng</h1>
            <hr class="my-5">
            <?php if (mysqli_num_rows($result_orders) > 0){ ?>
                <table class="history table-bordered table-hover">
                    <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Ngày đặt</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $stt = 1;
                    while ($order = mysqli_fetch_assoc($result_orders)){
                        ?>
                        <tr>
                            <td><?= $stt++ ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($order['ord_buy_date'])) ?></td>
                            <td>
                                    <?php
                                    $ord_id = $order['ord_id'];
                                    $sql_details = "SELECT p.prd_name, od.ord_detail_price, od.ord_detail_amount
                                        FROM order_detail od JOIN product p ON od.prd_id = p.prd_id WHERE od.ord_id = $ord_id";
                                    $result_details = mysqli_query($connect, $sql_details);
                                    while ($detail = mysqli_fetch_assoc($result_details)) {
                                        $tien = number_format($detail['ord_detail_price'] * $detail['ord_detail_amount'], 0, ',', '.');
                                        echo "<div>{$detail['prd_name']} (x{$detail['ord_detail_amount']}) - {$tien}₫</div>";
                                    }
                                    ?>
                            </td>
                            <td><?= number_format($order['ord_total_price'], 0, ',', '.') ?>₫</td>
                            <td>
                                <?php
                                switch ($order['ord_status']) {
                                    case 1:
                                        echo "<span class='text-warning'>Đang xử lý</span> | <a href='huydon.php?ord_id={$order['ord_id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Bạn chắc chắn muốn hủy đơn này?');\">Hủy đơn</a>";
                                        break;
                                    case 2:
                                        echo "<span class='text-success'>Đang giao hàng</span>";break;
                                    case 3:
                                        echo "<span class='text-success'>Đã giao hàng</span>";break;
                                    case 4:
                                        echo "<span class='text-success'>Chờ nhận hàng</span> | <a href='nhan_hang.php?ord_id={$order['ord_id']}' class='btn btn-sm btn-primary' onclick=\"return confirm('Bạn đã nhận hàng chưa?');\">Nhận hàng</a>";break;
                                    case 5:
                                        echo "<span class='text-success'>Đã nhận hàng</span>";break;
                                    case 6:
                                        echo "<span class='text-success'>Đã hủy</span>";break;
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php }else { ?>
                <p class="text-center">Bạn chưa có đơn hàng nào.</p>
            <?php  } ?>
        </div>
    </section>
</main>
<footer>
    <?php
    include_once ('footer.php');
    ?>
</footer>