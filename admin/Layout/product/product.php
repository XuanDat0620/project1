<?php
// tạo SQl để lấy bản ghi trong CSDL
$sql = 'SELECT * FROM product ORDER BY prd_id ASC ';
// thực hiện truy vấn SQL
$query = mysqli_query($connect, $sql);

// Giải thuât phân trag dữ liệu
// Giới hạn số lượng bản ghi trog 1 trag
$row_per_page = 5;
// Lấy ra tổng số bản ghi trog csdl thuộc về bảng product
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product"));
// khai báo phần tử page trên URl
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}else{
    $page = 1;
}
// tinh số lượng page cần có
$total_pages = ceil($total_row / $row_per_page); // hàm ceil để làm tròn lên
// tìm vị trí bản ghi bắt đầu hiển thị
$start_row = ($page - 1) * $row_per_page;
$sql="SELECT * FROM product p JOIN category c ON c.cate_id = p.cate_id ORDER BY prd_id ASC LIMIT $start_row,$row_per_page";
$query = mysqli_query($connect, $sql);
?>

        <!-- Main content -->
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li class="active">/ Quản lý sản phẩm</li>
            </ol>
        </div>
    </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Danh sách sản phẩm</h1>
            </div>
        </div>
    <div class="content">
        <div class="btn-group">
            <a href="?pageLayout=add_product" class="btn btn-success">+ Thêm sản phẩm</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Trạng thái</th>
                    <th>Danh mục</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($product = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td><?= $product['prd_id'] ?></td>
                        <td><?= $product['prd_name'] ?></td>
                        <td><?= number_format($product['prd_price'], 0, ',', '.') ?> VND</td>
                        <td>
                            <img src="../images/<?= $product['prd_image'] ?>" class="product-img" width="80" alt="<?= $product['prd_name'] ?>">
                        </td>
                        <td>
                            <span class="badge <?= $product['prd_status'] == 1 ? 'bg-success' : 'bg-danger' ?>">
                                <?= $product['prd_status'] == 1 ? 'Còn hàng' : 'Hết hàng' ?>
                            </span>
                        </td>
                        <td><?= $product['cate_name'] ?></td>
                        <td>
                            <a href="?pageLayout=edit_product&prd_id=<?= $product['prd_id'] ?>" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                            <a href="?pageLayout=delete_product&prd_id=<?= $product['prd_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm?')">
                                <i class="fa-solid fa-xmark"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <?php
                        for ($i = 1; $i <= $total_pages; $i++) {
                        ?>
                        <li class="page-item"><a class="page-link" href="?pageLayout=product&page=<?= $i?>"><?= $i ?></a></li>
                        <?php
                        }
                        ?>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </nav>
            </div>
    </div>
</div>
</div>

