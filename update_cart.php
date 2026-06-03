<?php
if (isset($_POST['update_cart']) && isset($_POST['qtt'])) {
    foreach ($_POST['qtt'] as $prd_id => $quantity) {
        $prd_id = intval($prd_id);
        $quantity = intval($quantity);
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$prd_id]);
        } else {
            $_SESSION['cart'][$prd_id] = $quantity;
        }
    }
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
    header("Location: index.php?page_layout=giohang");
    exit;
}
?>