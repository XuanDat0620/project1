
<header>
    <?php
    include_once ('header.php');
    ?>
</header>
<main>
    <section id="section-main-1">
        <div class="container" id="cart">
            <h1 class="text-center">Giỏ hàng của bạn</h1>
            <hr class="my-5">
            <?php
            if(isset($_SESSION['cart'])){
                // lấy id sản phẩm từ session giỏ hàng
                $cart_item=array();
                foreach ($_SESSION['cart'] as $key => $value) {
                    // Đảm bảo key là số nguyên hợp lệ
                    if (is_numeric($key) && intval($key) > 0) {
                        $cart_item[] = intval($key);
                    }
                }
                // chuyển đổi từ mảng sang chuỗi ký tự
                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                } else {
                    $cart = []; // Nếu không có thì gán là mảng rỗng
                }

                // Lấy danh sách các key (ID sản phẩm) từ giỏ hàng
                $cart_item = array_keys($cart);
                $valid_ids = array_filter($cart_item, function($id) {
                    return is_numeric($id) && intval($id) > 0;
                });

                if (!empty($valid_ids)) {
                    $str_item = implode(',', $valid_ids);
                    $s_cart = "SELECT p.*, s.size_name, c.color_name FROM product p 
                               JOIN size s ON p.size_id = s.size_id 
                               JOIN color c ON p.color_id = c.color_id 
                               WHERE p.prd_id IN ($str_item)";
                    $q_cart = mysqli_query($connect, $s_cart);

                    if ($q_cart && mysqli_num_rows($q_cart) > 0) {
                        foreach ($q_cart as $item) {
                            // xử lý sản phẩm trong giỏ hàng
                        }
                    } else {
                        echo "<p class='text-danger'>Không có sản phẩm nào trong giỏ hàng.</p>";
                    }
                } else {
                    echo "<p class='text-danger'>Giỏ hàng đang trống.</p>";
                }
                // Nếu người dùng nhấn nút cập nhật giỏ hàng
                if (isset($_POST['update_cart']) && isset($_POST['qtt'])) {
                    foreach ($_POST['qtt'] as $prd_id => $quantity) {
                        $prd_id = intval($prd_id);
                        $quantity = intval($quantity);
                        if ($quantity <= 0) {
                            unset($_SESSION['cart'][$prd_id]); // xóa sản phẩm nếu số lượng <= 0
                        } else {
                            $_SESSION['cart'][$prd_id] = $quantity;
                        }
                    }
                    // Nếu giỏ hàng trống sau khi cập nhật, xóa session giỏ hàng
                    if (empty($_SESSION['cart'])) {
                        unset($_SESSION['cart']);
                    }
                    // Reload lại trang để tránh gửi lại form
                    header('Location: index.php?page_layout=giohang');
                    exit;
                }
                ?>
            <form action="" method="post">
                <table class="table table-bordered text-center align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $total_price=0;
                    foreach ($q_cart as $key => $value) {
                        $prd_id = $value['prd_id'];
                        $quantity = $_SESSION['cart'][$prd_id]; // Số lượng sản phẩm trong giỏ
                        $item_price = $quantity * $value['prd_price']; // Tổng tiền của sản phẩm này
                        $total_price += $item_price; // Cộng dồn vào tổng
                    ?>
                    <tr>
                        <td class="image">
                            <img src="images/<?= $value['prd_image'] ?>" class="product-img" alt="Sản phẩm">
                        </td>
                        <td class="text-start">
                            <strong><?= $value['prd_name'] ?></strong><br>
                            <small>Size: <?= $value['size_name'] ?>, Màu: <?= $value['color_name'] ?></small>
                        </td>
                        <td><?= number_format($value['prd_price']) ?>đ</td>
                        <td class="quantity-prd">
                            <input type="number" name="qtt[<?= $value['prd_id'] ?>]" class="qtt form-control" value="<?= $quantity ?>" min="1">
                        </td>
                        <td><?= number_format($item_price) ?>đ</td>
                        <td>
                            <a href="delete_cart.php?prd_id=<?= $value['prd_id'] ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="d-flex justify-content-between">
                    <!-- Cập nhật giỏ hàng -->
                    <button type="submit" name="update_cart" class="btn btn-warning">Cập nhật giỏ hàng</button>
                </div>
            </form>
            <div class="total-cart mt-3">
                <h5>Tổng cộng: <span class="text-danger"><?= number_format($total_price) ?>đ</span></h5>
                <a href="?page_layout=thanhtoan" class="btn btn-primary">Thanh toán</a>
            </div>
            <?php
                }else {
                echo '<div class="alert alert-danger">Bạn không có sản phẩm nào trong giỏ hàng</div>';
            }
                // Nếu chưa đăng nhập thì hiển thị nút đăng nhập / đăng ký
                if (!isset($_SESSION['username'])) {
                    echo '
                <div class="alert alert-danger">Bạn cần đăng nhập để mua hàng</div>
                <div class="text-center">
                    <a href="?page_layout=dangnhap" class="btn btn-danger">Đăng nhập</a>
                    <a href="?page_layout=dangky" class="btn btn-outline-secondary">Đăng ký</a>
                </div>';
//                }
                }
            ?>
        </div>
    </section>
</main>
<footer>
    <?php
    include_once ('footer.php');
    ?>
</footer>