<?php
include_once ('admin/config/connect.php');
$sql_menu="SELECT * FROM category ORDER BY cate_id ASC LIMIT 4";
$query_menu=mysqli_query($connect,$sql_menu);
?>
<section id="section-header-1">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">FASHION</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="<?php if (!isset($_GET['page_layout'])){echo 'active';} ?>">
                        <a class="nav-link active" href="index.php">Trang chủ</a>
                    </li>
                    <li class="<?php if (isset($_GET['page_layout'])){if ($_GET['page_layout']== 'gender') {echo 'active';}} ?>">
                        <a class="nav-link" href="?page_layout=nam">Nam</a>
                    </li>
                    <li class="<?php if (isset($_GET['page_layout'])){if ($_GET['page_layout']== 'gender') {echo 'active';}} ?>">
                        <a class="nav-link" href="?page_layout=nu">Nữ</a>
                    </li>
                    <li class="<?php if (isset($_GET['page_layout'])){if ($_GET['page_layout']== 'gender') {echo 'active';}} ?>">
                        <a class="nav-link" href="?page_layout=tre_em">Trẻ em</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center gap-3">
                    <!-- Tìm kiếm -->
                    <form class="d-flex" method="get" action="index.php" role="search">
                        <input class="form-control form-control-sm" type="search" name="keyword" placeholder="Tìm kiếm..." aria-label="Search">
                        <input type="hidden" name="page_layout" value="timkiem">
                        <button class="btn btn-outline-secondary btn-sm ms-2" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                        <?php
                        if (isset($_SESSION['username'])){
                        ?>
                        <div>
                        <a class="btn btn-sm btn-outline-dark ms-2" href="?page_layout=taikhoan">Tài khoản</a>
                            <a class="btn btn-sm btn-outline-dark ms-2" href="?page_layout=lichsu">Lịch sử</a>
                        <a class="btn btn-sm btn-outline-dark ms-2" href="logout.php">Đăng xuất</a>
                        </div>
                        <?php
                        }else{
                        ?>
                        <div>
                            <!-- Nếu chưa đăng nhập -->
                            <a href="?page_layout=dangnhap" class="btn btn-sm btn-outline-dark ms-2">Đăng nhập</a>
                            <a href="?page_layout=dangky" class="btn btn-sm btn-outline-dark ms-2">Đăng ký</a>
                        </div>
                        <?php
                            }
                        ?>
                    <a href="?page_layout=giohang"  class="<?php if (isset($_GET['page_layout'])){if ($_GET['page_layout']== 'product') {echo 'active';}} ?>" title="Giỏ hàng">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                    </a>
                </div>

            </div>
        </div>
    </nav>
</section>

