<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="css/donhang.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <header>
        <section id="section-header-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
                <div class="container">
                  <a class="navbar-brand fw-bold" href="/">FASHION</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                  </button>
            
                  <div class="collapse navbar-collapse" id="navbarContent">

                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                          <a class="nav-link active" href="#">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Nam</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Nữ</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Trẻ em</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Mùa</a>
                        </li>
                    </ul>
            
                    <div class="d-flex align-items-center gap-3">
                      <form class="d-flex" role="search">
                        <input class="form-control form-control-sm" type="search" placeholder="Tìm kiếm..." aria-label="Search">
                        <button class="btn btn-outline-dark btn-sm ms-2" type="submit">
                          <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                      </form>

                      <a href="login" class="text-dark" title="Đăng nhập">
                        <i class="fa-solid fa-user fs-5"></i>
                      </a>

                      <a href="cart" class="text-dark position-relative" title="Giỏ hàng">
                        <i class="fa-solid fa-cart-shopping fs-5"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </nav>
        </section>
    </header>
    <main>
        <section id="section-main-1">
            <div class="container">
                <h2 class="text-center">Chi Tiết Đơn Hàng</h2>
                <div class="order-details">
                    <div class="order">
                        <h5>Thông Tin Đơn Hàng</h5>
                        <p><strong>Ngày đặt hàng:</strong> 20/04/2025</p>
                        <p><strong>Trạng thái:</strong> Đã giao</p>
                        <p><strong>Phương thức thanh toán:</strong> Thẻ tín dụng</p>
                        <p><strong>Địa chỉ giao hàng:</strong> 123 Đường ABC, Quận XYZ, TP HCM</p>
                    </div>
                    <h5>Sản phẩm trong đơn hàng</h5>
                    <div class="order-items">
                        <div class="product">
                            <p>Áo phông nam basic (x2)</p>
                            <p>398.000₫</p>
                        </div>
                        <div class="product">
                            <p>Quần jeans slimfit (x1)</p>
                            <p>599.000₫</p>
                        </div>
                    </div>
                    <div class="product total">
                        <p>Tổng cộng</p>
                        <p>997.000₫</p>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </main>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>