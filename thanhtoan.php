<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_SESSION['cart']) && isset($_SESSION['username'])) {

// 1. Lấy thông tin khách hàng
$cus_username = $_SESSION['username'];
$s_find_cus = "SELECT * FROM customer WHERE cus_username = '$cus_username'";
$q_find_cus = mysqli_query($connect, $s_find_cus);
foreach ($q_find_cus as $value) {
    $customer_id = $value['cus_id'];
    $customer = $value;
}

// 2. Chuẩn bị dữ liệu đơn hàng
$cart_item = array_keys($_SESSION['cart']);

// Chỉ lọc các ID là số nguyên dương hợp lệ
$valid_ids = array_filter($cart_item, function($id) {
    return is_numeric($id) && intval($id) > 0;
});

if (!empty($valid_ids)) {
    $str_item = implode(',', $valid_ids);
    $s_cart = "SELECT * FROM product WHERE prd_id IN ($str_item)";
    $q_cart = mysqli_query($connect, $s_cart);
    $cart_products = [];
    foreach ($q_cart as $item) {
        $cart_products[] = $item;
    }
} else {
    die("Giỏ hàng trống hoặc có lỗi dữ liệu.");
}
$price=0;
$total_price=0;
foreach ($q_cart as $key => $value) {
    $subtotal = $_SESSION['cart'][$value['prd_id']] * $value['prd_price'];
    $total_price += $subtotal;
    $_SESSION['total_price'] = $total_price;
}
$ord_total_price=$_SESSION['total_price'];
if (isset($_POST['submit_order'])) {
    // (Tuỳ chọn) Lưu thông tin khách hàng nếu muốn cập nhật lại
    $fullname = $_POST['fullname'];
    $phone = $_POST['cus_phone'];
    $address = $_POST['cus_address'];
    $note = $_POST['note'];
    $payment = $_POST['payment'];

    // Có thể cập nhật lại địa chỉ hoặc số điện thoại cho khách hàng nếu muốn
    $update_customer = "UPDATE customer SET fullname='$fullname', cus_phone='$phone', cus_address='$address' WHERE cus_id = $customer_id";
    mysqli_query($connect, $update_customer);
    // Tạo đơn hàng
    $staff_id = 1;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $ord_buy_date = date('Y-m-d H:i:s');
    $ord_status = 1;
    $s_add_order = "INSERT INTO orders (customer_id, staff_id, ord_buy_date, ord_total_price, ord_status)
                        VALUES ($customer_id, $staff_id, '$ord_buy_date', $total_price, $ord_status)";
    mysqli_query($connect, $s_add_order);
    $ord_id = mysqli_insert_id($connect);
    foreach ($q_cart as $value) {
        $prd_id = $value['prd_id'];
        $prd_price = $value['prd_price'];
        $prd_quantity = $value['prd_quantity'];
        $ord_detail_amount = $_SESSION['cart'][$prd_id];

        // Trừ số lượng kho
        $prd_qtt = $prd_quantity - $ord_detail_amount;
        $s_update_prd = "UPDATE product SET prd_quantity = $prd_qtt WHERE prd_id = $prd_id";
        mysqli_query($connect, $s_update_prd);

        // Thêm vào order_detail
        $s_add_od = "INSERT INTO order_detail (prd_id, ord_id, ord_detail_price, ord_detail_amount)
                     VALUES ($prd_id, $ord_id, $prd_price, $ord_detail_amount)";
        mysqli_query($connect, $s_add_od);
    }
    // Sau khi thanh toán xong, xoá giỏ hàng
    unset($_SESSION['cart']);
    unset($_SESSION['total_price']);

    // Chuyển hướng đến trang thành công
    header("location: index.php?page_layout=success");
    exit;
}
?>

<header>
    <?php include_once('header.php'); ?>
</header>
<main>
    <section id="section-main-1">
        <div class="container">
            <div class="row">
                <?php if (isset($_SESSION['username'])) { ?>
                    <form method="post" action="">
                        <div class="col-lg-7 float-start">
                            <h1>Thông tin giao hàng</h1>
                            <div class="information">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="fullname" value="<?= $customer['fullname'] ?>">
                            </div>
                            <div class="information">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" id="phone" name="cus_phone" value="<?= $customer['cus_phone'] ?>">
                            </div>
                            <div class="information">
                                <label for="address" class="form-label">Địa chỉ giao hàng</label>
                                <input type="text" class="form-control" id="address" name="cus_address" value="<?= $customer['cus_address'] ?>">
                            </div>
                            <div class="information">
                                <label for="note" class="form-label">Ghi chú</label>
                                <input type="text" class="form-control" id="note" name="note">
                            </div>

                            <h4>Phương thức thanh toán</h4>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="payment" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">Thanh toán khi nhận hàng</label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="payment" id="bank" value="bank">
                                <label class="form-check-label" for="bank">Chuyển khoản ngân hàng</label>
                            </div>
                        </div>

                        <div class="col-lg-5 float-end">
                            <div class="order">
                                <h4>Đơn hàng của bạn</h4>
                                <?php foreach ($cart_products as $product): ?>
                                    <div class="order-item">
                                        <p><?= $product['prd_name']; ?> (x<?= $_SESSION['cart'][$product['prd_id']]; ?>)</p>
                                        <p><?= number_format($product['prd_price'] * $_SESSION['cart'][$product['prd_id']]); ?>đ</p>
                                    </div>
                                <?php endforeach; ?>
                                <hr>
                                <div class="order-item total">
                                    <p>Tổng cộng</p>
                                    <p><?= number_format($total_price); ?>đ</p>
                                </div>
                                <button type="submit" name="submit_order" class="btn btn-dark w-100 mt-4">Thanh toán</button>
                            </div>
                        </div>
                    </form>
                <?php } } ?>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php
    include_once ('footer.php');
    ?>
</footer>