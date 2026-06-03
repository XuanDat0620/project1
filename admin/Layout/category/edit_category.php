<?php
ob_start();
$cate_id = $_GET['cate_id'];
$sql_select="SELECT * FROM category WHERE `cate_id` = $cate_id";
$item=mysqli_fetch_array(mysqli_query($connect,$sql_select));
if (isset($_POST['sbm'])) {
    // Nhận giá trị từ name của input
    $cate_name = $_POST['cate_name'];
    // tìm kiếm bản ghi trog CSDL
    $sql_check = "SELECT * FROM category WHERE `cate_name` = '$cate_name'";
    // đếm số lượng bản ghi sau khi tìm (mysqli_num_rows)
    $check=mysqli_num_rows(mysqli_query($connect,$sql_check));
    // vt câu lệnh SQL thêm mới
    if ($check==0) {
        // vt câu lệnh SQL thêm mới
        $sql = "UPDATE category SET cate_name = '$cate_name' WHERE `cate_id` = $cate_id";
        mysqli_query($connect, $sql);
        $success = '<div class="alert alert-success" role="alert">Sửa danh mục thành công</div>';
        header('location: ?pageLayout=category');
    }else {
        $error= '<div class="alert alert-danger" role="alert">Danh mục đã tồn tại!</div>';
    }
}
ob_end_flush();
?>
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="?pageLayout=category"> / Quản lý danh mục / </a></li>
                <li class="active"> Sửa danh mục</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh mục:<?php echo $item['cate_name']?></h1>
        </div>
    </div>
    <?php
    if (isset($error)) {
        echo $error;
    }
    ?>
        <form class="edit" method="post">
            <div class="form-group">
                <label for="categoryName">Tên danh mục:</label>
                <input type="text" name="cate_name" value="<?php echo $item['cate_name']?>" class="form-control" id="categoryName" placeholder="Danh mục 1">
            </div>
            <button type="submit" name="sbm" class="btn btn-success">Cập nhật</button>
            <button type="reset" class="btn btn-default">Làm mới</button>
        </form>
</div>