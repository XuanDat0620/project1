<?php
if (isset($_POST['sbm'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    if ($password==$re_password) {
        $sql="INSERT INTO customer (`fullname`,`cus_email`,`cus_phone`,`cus_address`,`cus_username`,`cus_pass`) 
              VALUES ('$fullname','$email','$phone','$address','$username','$password')";
        mysqli_query($connect, $sql);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="css/dangki.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="register-container">
        <form class="register-form" method="POST">
            <h2>Đăng ký tài khoản</h2>
    
            <label for="fullname">Họ và tên</label>
            <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên" required>
            <label for="fullname">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Nhập email" required>

            <label for="phone">Số điện thoại</label>
            <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại" required>

            <label for="address">Địa chỉ</label>
            <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ" required>
                
            <label for="username">Tài khoản</label>
            <input type="text" name="username" class="form-control" placeholder="Nhập tên" required>

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu" required>

            <label for="re_password">Xác nhận mật khẩu</label>
            <input type="text" name="re_password" class="form-control" placeholder="Nhập lại mật khẩu" required>

            <button name="sbm" type="submit" class="btn btn-primary">Đăng ký</button>

            <p class="login-link">Đã có tài khoản? <a href="?page_layout=dangnhap">Đăng nhập</a></p>
        </form>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>