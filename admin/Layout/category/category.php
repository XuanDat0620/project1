<?php
// tạo SQl để lấy bản ghi trong CSDL
$sql = 'SELECT * FROM category ORDER BY cate_id ASC ';
// thực hiện truy vấn SQL
$query = mysqli_query($connect, $sql);

// Giải thuât phân trag dữ liệu
// Giới hạn số lượng bản ghi trog 1 trag
$row_per_page = 5;
// Lấy ra tổng số bản ghi trog csdl thuộc về bảng product
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM category"));
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
$sql="SELECT * FROM  category ORDER BY cate_id ASC LIMIT $start_row,$row_per_page";
?>
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li class="active"><a href="#">/ Quản lý danh mục</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (isset($success)) {
                echo $success;
            }
            ?>
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <div class="content">
        <div class="btn-group">
            <a href="?pageLayout=add_category" class="btn btn-success">+ Thêm danh mục</a>
        </div>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $stt=1;
            while ($item = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $stt ?></td>
                    <td><?php echo $item['cate_name']?></td>
                    <td>
                        <a href="?pageLayout=edit_category&cate_id=<?php echo $item['cate_id']?>" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                        <a onclick="return confirm('Bạn có muốn xóa không?')" href="?pageLayout=delete_category&cate_id=<?php echo $item['cate_id']?>" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
                    </td>
                </tr>
                <?php
                $stt++;
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
                    <li class="page-item"><a class="page-link" href="?pageLayout=category&page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>