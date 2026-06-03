<?php
if (isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username' AND user_pass='$password'";
    $query = mysqli_query($connect, $sql);
    $check = mysqli_num_rows($query);
    if ($check == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: index.php');
    }else{
        $error = "<div class='alert alert-danger'>Tài khoản không hợp lệ !</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Đăng Nhập</h2>
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Tên Đăng Nhập</label>
                <input type="text" class="form-control" name="username" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu</label>
                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="remember" value="remember me">Nhớ tài khoản
            </div>
            <button type="submit" name="sbm" class="btn btn-primary">Đăng Nhập</button>
        </form>
        <div class="text-center mt-3">
            <a href="#">Quên mật khẩu?</a>
        </div>
    </div>
</body>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.js"></script>
</html>