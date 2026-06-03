<?php
if (isset($_GET['prd_id'])) {
    $prd_id = $_GET['prd_id'];

    // Xóa ảnh trong thư mục (nếu cần)
    $sql_img = "SELECT prd_image FROM product WHERE prd_id = $prd_id";
    $result_img = mysqli_query($connect, $sql_img);
    $row = mysqli_fetch_assoc($result_img);
    if ($row && file_exists('images/' . $row['prd_image'])) {
        unlink('images/' . $row['prd_image']);
    }
    mysqli_query($connect, "DELETE FROM product WHERE prd_id = $prd_id");

    // Xóa sản phẩm
    $sql = "DELETE FROM product WHERE prd_id = $prd_id";
    mysqli_query($connect, $sql);

    header('Location: index.php?pageLayout=product');
}
?>

