<?php
$cate_id = $_GET['cate_id'];
$sql = "DELETE FROM category WHERE `cate_id` = $cate_id";
mysqli_query($connect , $sql);
header('location:?pageLayout=category');
?>
<?php
$cate_id = $_GET['cate_id'];
// Kiểm tra xem có sản phẩm nào thuộc danh mục này không
$check = mysqli_query($connect, "SELECT * FROM product WHERE cate_id = $cate_id");
if (mysqli_num_rows($check) > 0) {
    echo "Không thể xóa danh mục vì vẫn còn sản phẩm thuộc danh mục này!";
} else {
    $sql = "DELETE FROM category WHERE cate_id = $cate_id";
    mysqli_query($connect , $sql);
    header('Location: ?pageLayout=category');
}
?>
