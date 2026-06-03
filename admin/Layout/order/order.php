<?php
$sql="SELECT * FROM orders o JOIN customer c ON o.customer_id = c.cus_id
        ORDER BY `ord_status` ASC";
$query=mysqli_query($connect,$sql);
// Giải thuât phân trag dữ liệu
// Giới hạn số lượng bản ghi trog 1 trag
$row_per_page = 5;
// Lấy ra tổng số bản ghi trog csdl thuộc về bảng product
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM orders "));
// khai báo phần tử page trên URl
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page = 1;
}
// tinh số lượng page cần có
$total_pages = ceil($total_row / $row_per_page); // hàm ceil để làm tròn lên
// tìm vị trí bản ghi bắt đầu hiển thị
$start_row = ($page - 1) * $row_per_page;
$sql="SELECT * FROM orders o JOIN customer c ON o.customer_id = c.cus_id ORDER BY ord_buy_date ASC LIMIT $start_row, $row_per_page";
$query = mysqli_query($connect, $sql);
?>
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li class="active">/ Quản lý đơn hàng</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách đơn hàng</h1>
        </div>
    </div>
    <div class="content">

        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
            <tr>
                <th>Mã đơn </th>
                <th>Ngày mua</th>
                <th>Họ và tên</th>
                <th>Sô điện thoại</th>
                <th>Địa chỉ</th>
                <th>Tổng tiền</th>
                <th>Trạng thái </th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($query as $k => $v){
            ?>
                <tr>
                    <td><?= $k + 1 ?></td>
                    <td><?= date('d/m/Y H:i:s', strtotime($v['ord_buy_date'])) ?></td>
                    <td><?= $v['fullname'] ?></td>
                    <td><?= $v['cus_phone']?></td>
                    <td><?= $v['cus_address']?></td>
                    <td><?= number_format($v['ord_total_price']) ?></td>
                         <?php
                        switch ($v['ord_status']) {
                            case 1: echo '<td class="text-secondary">Chưa duyệt</td>';break;
                            case 2: echo '<td class="text-secondary">Đã duyệt</td>';break;
                            case 3: echo '<td class="text-secondary">Đang giao hàng</td>';break;
                            case 4: echo '<td class="text-secondary">Đã giao hàng</td>';break;
                            case 5: echo '<td class="text-secondary">Đã nhận hàng</td>';break;
                            case 6: echo '<td class="text-secondary">Đã hủy</td>';break;
                        }
                        ?>
                    <td><a href="?pageLayout=order_detail&ord_id=<?= $v['ord_id'] ?>" class="btn btn-primary">Xem chi tiết</a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div>
            <nav aria-label="page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <?php
                    for ($i = 1; $i <= $total_pages; $i++) {
                        ?>
                        <li class="page-item"><a class="page-link" href="?pageLayout=order&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
