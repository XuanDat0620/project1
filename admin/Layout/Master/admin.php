<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/category.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/editcate.css">
    <link rel="stylesheet" href="css/themsp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <section id="section-header-1">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                          <a class="navbar-brand" href="#">BKACAD STORE</a>
                          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                              <span class="navbar-toggler-icon"></span>
                          </button>
                          <div class="dropdown">
                              <a class="btn btn-sm btn-outline-dark ms-2" href="Layout/Master/logout.php">Đăng xuất</a>
                          </div>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </header>
    <main>
        <section id="section-main-1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-sm-3 sidebar">
                        <ul class="menu">
                            <form role="search">
                                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                            </form>
                            <li class="<?php if (!isset($_GET['pageLayout'])){echo 'active';} ?>"><a href="index.php">Dashboard</a></li>
                            <li class="<?php if (isset($_GET['pageLayout'])){if ($_GET['pageLayout']== 'user') {echo 'active';}} ?>"><a href="?pageLayout=user"><i class="fa-solid fa-user"></i>Quản lý thành viên</a></li>
                            <li class="<?php if (isset($_GET['pageLayout'])){if ($_GET['pageLayout']== 'category'|| $_GET['pageLayout']== 'add_category'){echo 'active';}} ?>"><a href="?pageLayout=category"><i class="fa-solid fa-folder"></i>Quản lý danh mục</a></li>
                            <li class="<?php if (isset($_GET['pageLayout'])){if ($_GET['pageLayout']== 'product'){echo 'active';}} ?>"><a href="?pageLayout=product"><i class="fa-solid fa-bag-shopping"></i>Quản lý sản phẩm</a></li>
                            <li class="<?php if (isset($_GET['pageLayout'])){if ($_GET['pageLayout']== 'order'){echo 'active';}} ?>"><a href="?pageLayout=order"><i class="fa-solid fa-comment"></i>Quản lý đơn hàng</a></li>
                        </ul>
                    </div>

                    <!-- Master page layout-->
                    <?php
                    if (isset($_GET['pageLayout'])) {
                        switch ($_GET['pageLayout']) {
                            case 'category': include_once('Layout/category/category.php'); break;
                            case 'add_category': include_once('Layout/category/add_category.php'); break;
                            case 'edit_category': include_once('Layout/category/edit_category.php'); break;
                            case 'delete_category': include_once('Layout/category/delete_category.php'); break;
                            case 'product': include_once('Layout/product/product.php'); break;
                            case 'add_product': include_once('Layout/product/add_product.php'); break;
                            case 'edit_product': include_once('Layout/product/edit_product.php'); break;
                            case 'delete_product': include_once('Layout/product/delete_product.php'); break;
                            case 'order': include_once('Layout/order/order.php'); break;
                            case 'order_detail': include_once('Layout/order/order_detail.php'); break;
                            case 'user': include_once('Layout/user/user.php'); break;
                            case 'add_user': include_once('Layout/user/add_user.php'); break;
                            case 'edit_user': include_once('Layout/user/edit_user.php'); break;
                            case 'delete_user': include_once('Layout/user/delete_user.php'); break;
                        }
                    }else {
                        include_once('dashboard.php');
                    }
                    ?>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>