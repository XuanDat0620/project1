<?php
// Nhận vào một điều kiện $where (ví dụ: DATE(ord_buy_date) = CURDATE())
//Truy vấn bảng orders để:
//COUNT(*) → đếm số đơn hàng (tổng số dòng)
//SUM(ord_total_price) → tính tổng doanh thu của các đơn đó
//Trả về một mảng: ['total_orders' => ..., 'total_revenue' => ...]
function getStats($connect, $where) {
    $sql = "SELECT COUNT(*) AS total_orders, SUM(ord_total_price) AS total_revenue 
            FROM orders WHERE $where AND ord_status != 'Đã hủy'";
    $result = mysqli_query($connect, $sql);
    return mysqli_fetch_assoc($result);
}

// Lấy thống kê
//DATE(ord_buy_date) lấy ngày (bỏ giờ)
//CURDATE() là ngày hiện tại
//→ Đếm & tính tổng đơn hàng mua hôm nay
$today = getStats($connect, "DATE(ord_buy_date) = CURDATE()");
// YEARWEEK(date, 1) trả về năm + số tuần (ISO-8601, tuần bắt đầu từ thứ 2)
//So sánh ord_buy_date với CURDATE() để xem có thuộc cùng một tuần không
//→ Thống kê đơn hàng trong tuần này
$week = getStats($connect, "YEARWEEK(ord_buy_date, 1) = YEARWEEK(CURDATE(), 1)");
$month = getStats($connect, "MONTH(ord_buy_date) = MONTH(CURDATE()) AND YEAR(ord_buy_date) = YEAR(CURDATE())");
$year = getStats($connect, "YEAR(ord_buy_date) = YEAR(CURDATE())");
$monthly_revenue = [];
for ($i = 1; $i <= 12; $i++) {
    $sql = "SELECT SUM(ord_total_price) AS revenue FROM orders 
            WHERE MONTH(ord_buy_date) = $i AND YEAR(ord_buy_date) = YEAR(CURDATE()) AND ord_status != 'Đã hủy'";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_assoc($result);
    $monthly_revenue[$i] = $row['revenue'] ?? 0;
}
?>

<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa-solid fa-house"></i></a></li>
                <li class="active">/ Trang chủ quản trị</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Trang chủ quản trị</h1>
        </div>
    </div>
    <div class="row st2">
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="stat-item d-flex">
                <div class="info-box bg-primary-subtle p-3">
                    <h5 class="card-title">Hôm nay</h5>
                    <p>Đơn hàng: <?= $today['total_orders'] ?></p>
                    <p>Doanh thu: <?= number_format($today['total_revenue'], 0, ',', '.') ?> đ</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="stat-item d-flex">
                <div class="info-box bg-danger-subtle p-3">
                    <h5 class="card-title">Tuần này</h5>
                    <p>Đơn hàng: <?= $week['total_orders'] ?></p>
                    <p>Doanh thu: <?= number_format($week['total_revenue'], 0, ',', '.') ?> đ</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="stat-item d-flex">
                <div class="info-box bg-warning-subtle p-3">
                    <h5 class="card-title">Tháng này</h5>
                    <p>Đơn hàng: <?= $month['total_orders'] ?></p>
                    <p>Doanh thu: <?= number_format($month['total_revenue'], 0, ',', '.') ?> đ</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="stat-item d-flex">
                <div class="info-box bg-secondary-subtle p-3">
                    <h5 class="card-title">Năm nay</h5>
                    <p>Đơn hàng: <?= $year['total_orders'] ?></p>
                    <p>Doanh thu: <?= number_format($year['total_revenue'], 0, ',', '.') ?> đ</p>
                </div>
            </div>
        </div>
    </div>
</div>
