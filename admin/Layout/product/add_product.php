<?php
// truy vấn để lấy danh mục trog SQL
$sql_cate="SELECT * FROM category ORDER BY cate_id ASC ";
$query_cate = mysqli_query($connect, $sql_cate);
$sql_size = "SELECT * FROM size ORDER BY size_id ASC";
$query_size = mysqli_query($connect, $sql_size);
$sql_color = "SELECT * FROM color ORDER BY color_id ASC";
$query_color = mysqli_query($connect, $sql_color);
// thực hiện thêm mới bản ghi
if (isset($_POST['sbm'])) {
    $prd_name = $_POST['prd_name'];
    $prd_price = $_POST['prd_price'];
    $prd_quantity = $_POST['prd_quantity'];
    $color_id = $_POST['color_id'];
    $cate_id = $_POST['cate_id'];
    $size_id = $_POST['size_id'];
    $prd_detail = $_POST['prd_detail'];
    // lấy tên ảnh để thêm vào SQL
    $prd_image= $_FILES['prd_image']['name'];
    // đẩy file lên 1 vị trí tạm thời trong PHP
    $tmp_name = $_FILES['prd_image']['tmp_name'];
//    $sql="INSERT INTO product(`prd_name`,`prd_price`,`prd_quantity`,`cate_id`,`prd_detail`,`prd_image`, `gender_id`)
//          VALUES('$prd_name', $prd_price, $prd_quantity, $cate_id, '$prd_detail', '$prd_image', 1)";

    $sql="INSERT INTO product(`prd_name`,`prd_price`,`prd_quantity`,`color_id`,`cate_id`,`size_id`,`prd_detail`,`prd_image`)
          VALUES(
                '$prd_name',$prd_price,$prd_quantity,'$color_id',$cate_id,'$size_id','$prd_detail','$prd_image')";
    mysqli_query($connect, $sql);
//    $prd_id = mysqli_insert_id($connect);

// thêm vào bảng product_variant
//    $sql_variant_insert = "INSERT INTO product_variant (prd_id, size_id, color_id, stock)
//                       VALUES ($prd_id, $size_id, $color_id, $prd_quantity)";
//    mysqli_query($connect, $sql_variant_insert);
//    // lấy ảnh từ thư mục tam của PHP về thư mục của dự án
//    move_uploaded_file($tmp_name, 'images/'.$prd_image);
    header('location:?pageLayout=product');
}
?>
<div class="col-lg-10 col-sm-9">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ul class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="?pageLayout=product">/ Quản lý sản phẩm / </a></li>
                <li class="active"> Thêm sản phẩm</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
        </div>
    </div>
    <div class="content">
        <div class="form-container">
            <form class="add" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input name="prd_name" type="text" class="form-control">
                </div>

                <div class="form-group">
                    <label>Giá sản phẩm</label>
                    <input name="prd_price" type="number" class="form-control">
                </div>

                <div class="form-group">
                    <label>Số lượng</label>
                    <input name="prd_quantity" type="number" class="form-control">
                </div>

                <div class="form-group">
                    <label>Màu sắc</label>
                    <select name="color_id" class="form-select">
                        <?php while($color = mysqli_fetch_array($query_color)) { ?>
                            <option value="<?= $color['color_id'] ?>"><?= $color['color_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ảnh sản phẩm</label>
                    <input name="prd_image" type="file" class="form-control">
                </div>

                <div class="form-group">
                    <label>Danh mục</label>
                    <select name="cate_id" class="form-select">
                        <?php
                        while($item = mysqli_fetch_array($query_cate)){
                        ?>
                        <option value="<?php echo $item['cate_id']?>"><?php echo $item['cate_name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Kích thước</label>
                    <select name="size_id" class="form-select">
                        <?php while($size = mysqli_fetch_array($query_size)) { ?>
                            <option value="<?= $size['size_id'] ?>"><?= $size['size_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mô tả sản phẩm</label>
                    <textarea name="prd_detail" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                <button type="reset" class="btn btn-secondary">Làm mới</button>
            </form>
        </div>
    </div>
</div>


