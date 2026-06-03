<?php
if (isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM customer WHERE cus_username='$username' AND cus_pass='$password'";
    $query = mysqli_query($connect, $sql);
    $check = mysqli_num_rows($query);

    if ($check == 1) {
        $cus_data = mysqli_fetch_assoc($query);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['cus_id'] = $cus_data['cus_id'];

        header('location: index.php');
    } else {
        $error = "<div class='alert alert-danger'>Tài khoản không hợp lệ !</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="css/dangnhap.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container login">
        <div class="card auth-card p-4 shadow">
          <h3 class="text-center mb-4" id="form-title">Đăng nhập</h3>
          <form method="POST" action="">
              <div class="mb-3">
                  <label for="username" class="form-label">Họ và tên</label>
                  <input type="text" class="form-control" name="username" placeholder="Nhập tên" required>
              </div>

              <div class="mb-3">
                  <label for="password" class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
              </div>

              <button type="submit" name="sbm" class="btn btn-primary w-100" id="submit-btn">Đăng nhập</button>
          </form>
            <div class="text-center mt-3">
                <a href="#">Quên mật khẩu?</a>
            </div>
    
          <div class="text-center mt-3">
              <span id="toggle-text">Chưa có tài khoản?</span>
              <a href="?page_layout=dangky"><button class="btn btn-link p-0" id="toggle-btn">Đăng ký</button></a>
          </div>
        </div>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
</html>