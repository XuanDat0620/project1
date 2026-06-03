<?php
if (!isset($_SESSION['cus_id'])) {
    echo "<div class='alert alert-danger'>Bạn cần đăng nhập để xem thông tin tài khoản.</div>";
    exit();
}

$cus_id = $_SESSION['cus_id'];

// Lấy thông tin khách hàng
$sql = "SELECT * FROM customer WHERE cus_id = $cus_id";
$result = mysqli_query($connect, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "<div class='alert alert-danger'>Không tìm thấy thông tin khách hàng</div>";
    exit();
}

$customer = mysqli_fetch_assoc($result);
    // 2. Xử lý form cập nhật thông tin
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fullname'])) {
    $fullname = mysqli_real_escape_string($connect, $_POST['fullname']);
    $cus_email = mysqli_real_escape_string($connect, $_POST['cus_email']);
    $cus_phone = mysqli_real_escape_string($connect, $_POST['cus_phone']);
    $cus_address = mysqli_real_escape_string($connect, $_POST['cus_address']);

    $update_sql = "UPDATE customer 
                   SET fullname='$fullname', cus_email='$cus_email', cus_phone='$cus_phone', cus_address='$cus_address' 
                   WHERE cus_id=$cus_id";

    if (mysqli_query($connect, $update_sql)) {
        // Cập nhật lại dữ liệu mới nhất
        $result = mysqli_query($connect, $sql);
        $customer = mysqli_fetch_assoc($result);
        echo "<div class='alert alert-success'>Cập nhật thông tin thành công!</div>";
    } else {
        echo "<div class='alert alert-danger'>Có lỗi xảy ra khi cập nhật.</div>";
    }
}
?>
<header>
    <?php
    include_once ('header.php');
    ?>
</header>
<main>
        <section id="section-main-1">
            <div class="container">
                <h1 class="text-center">Thông tin tài khoản</h1>
                <hr class="my-5">
                <form action="" method="post">
                    <div class="mb-3 custom">
                        <label for="fullname" class="form-label ">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $customer['fullname'] ?>" placeholder="Nhập tên">
                    </div>
                    <div class="mb-3 custom">
                        <label for="email" class="form-label ">Email</label>
                        <input type="email" class="form-control" id="email" name="cus_email" value="<?= $customer['cus_email'] ?>" placeholder="Nhập email">
                    </div>
                    <div class="mb-3 custom">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" name="cus_phone" value="<?= $customer['cus_phone'] ?>" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="mb-3 custom">
                        <label for="address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="address" name="cus_address" value="<?= $customer['cus_address'] ?>" placeholder="Nhập địa chỉ">
                    </div>
                    <button type="submit" class="btn btn-outline-dark">Cập nhật thông tin</button>
                </form>
        </section>
    </main>
<footer>
    <?php
    include_once ('footer.php');
    ?>
</footer>