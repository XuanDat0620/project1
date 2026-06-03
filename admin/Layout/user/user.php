<?php
// tạo SQl để lấy bản ghi trong CSDL
$sql = 'SELECT * FROM users ORDER BY user_id ASC ';
// thực hiện truy vấn SQL
$query = mysqli_query($connect, $sql);

// Giải thuât phân trag dữ liệu
// Giới hạn số lượng bản ghi trog 1 trag
$row_per_page = 5;
// Lấy ra tổng số bản ghi trog csdl thuộc về bảng product
$total_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM users"));
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
$sql = "SELECT * FROM users ORDER BY user_id ASC LIMIT $start_row, $row_per_page";
$query = mysqli_query($connect, $sql);
?>
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li class="active">/ Quản lý thành viên</li>
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
            <h1 class="page-header">Quản lý người dùng </h1>
        </div>
    </div>
    <div class="content">
        <div class="btn-group">
            <a href="?pageLayout=add_user" class="btn btn-success">+ Thêm người dùng</a>
        </div>
        <table class="table table-bordered table-striped text-center align-middle">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tài khoản</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Cấp bậc</th>
                <th>Hành động</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $stt=1;
            while ($item = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?= $item['user_id'] ?></td>
                    <td><?= $item['username'] ?></td>
                    <td><?= $item['fullname'] ?></td>
                    <td><?= $item['user_email'] ?></td>
                    <td>
                        <?php
                        switch ($item['user_level']) {
                            case 1: echo "Quản trị"; break;
                            case 2: echo "Nhân viên"; break;
                        }
                        ?>
                    </td>
                    <td>
                        <a href="?pageLayout=edit_user&user_id=<?= $item['user_id'] ?>" class="btn btn-primary"><i class="fa-solid fa-pencil"></i></a>
                        <a onclick="return confirm('Bạn có muốn xóa không?')" href="?pageLayout=delete_user&user_id=<?= $item['user_id'] ?>" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></a>
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
                        <li class="page-item"><a class="page-link" href="?pageLayout=user&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php
                    }
                    ?>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>
