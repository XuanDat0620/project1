<?php
ob_start();
$prd_id = $_GET['prd_id'];
$sql_select = "SELECT * FROM product WHERE prd_id = $prd_id";
$item = mysqli_fetch_array(mysqli_query($connect, $sql_select));

if (isset($_POST['sbm'])) {
    $prd_name = $_POST['name'];
    $prd_price = $_POST['price'];
    $prd_status = $_POST['status'];
    $prd_category = $_POST['cate_id'];

    // Xử lý ảnh mới nếu có
    if ($_FILES['image']['name'] != "") {
        $prd_image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "../images/$prd_image");
        $image_query = ", prd_image = '$prd_image'";
    } else {
        $image_query = "";
    }

    // Kiểm tra trùng tên sản phẩm (trừ bản ghi hiện tại)
    $sql_check = "SELECT * FROM product WHERE prd_name = '$prd_name' AND prd_id != $prd_id";
    $check = mysqli_num_rows(mysqli_query($connect, $sql_check));

    if ($check == 0) {
        $sql = "UPDATE product SET prd_name = '$prd_name', prd_price = '$prd_price', prd_status = '$prd_status',cate_id = '$prd_category' $image_query WHERE prd_id = $prd_id";
        mysqli_query($connect, $sql);
        header('Location: index.php?pageLayout=product');
        exit;
    } else {
        $error = '<div class="alert alert-danger" role="alert">Tên sản phẩm đã tồn tại!</div>';
    }
}
ob_end_flush();
?>

<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="?pageLayout=product"> / Quản lý sản phẩm / </a></li>
                <li class="active"> Sửa sản phẩm</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm: <?= $item['prd_name'] ?></h1>
        </div>
    </div>

    <?php if (isset($error)) echo $error; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="prd_id" value="<?= $item['prd_id'] ?>">

        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $item['prd_name'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $item['prd_price'] ?>" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Ảnh sản phẩm</label><br>
            <img src="../images/<?= $item['prd_image'] ?>" width="120"><br><br>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" id="status" name="status">
                <option value="1" <?= $item['prd_status'] == 1 ? 'selected' : '' ?>>Còn hàng</option>
                <option value="0" <?= $item['prd_status'] == 0 ? 'selected' : '' ?>>Hết hàng</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Danh mục</label>
            <select class="form-select" id="category" name="cate_id">
                <?php
                $cate_query = mysqli_query($connect, "SELECT * FROM category");
                while ($cate = mysqli_fetch_assoc($cate_query)) {
                    $selected = $cate['cate_id'] == $item['cate_id'] ? 'selected' : '';
                    echo "<option value='{$cate['cate_id']}' $selected>{$cate['cate_name']}</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
        <a href="index.php?pageLayout=product" class="btn btn-secondary">Hủy</a>
    </form>
</div>
