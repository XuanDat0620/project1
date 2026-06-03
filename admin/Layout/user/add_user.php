<?php
if (isset($_POST['add_user'])) {
    // Nhận giá trị từ form
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $user_level = $_POST['user_level'];

    // Kiểm tra người dùng đã tồn tại (dựa vào username hoặc email)
    $sql_check = "SELECT * FROM users WHERE username = '$username' OR user_email = '$user_email'";
    $check = mysqli_num_rows(mysqli_query($connect, $sql_check));

    if ($check == 0) {
        // Thêm vào cơ sở dữ liệu
        $sql = "INSERT INTO users (username, fullname,user_pass, user_email, user_level)
            VALUES ('$username', '$fullname','$user_pass', '$user_email', '$user_level')";
        mysqli_query($connect, $sql);
        // Thông báo thành công và chuyển hướng
        $success = '<div class="alert alert-success" role="alert">Thêm người dùng thành công</div>';
        header('Location: ?pageLayout=user');
    } else {
        $error = '<div class="alert alert-danger" role="alert">Tên tài khoản hoặc email đã tồn tại!</div>';
    }
}
?>
<div class="col-lg-10 col-sm-9 main-content">
    <div class="row st1 bg-dark-subtle">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="index.php"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="?pageLayout=user">/ Quản lý thành viên /</a></li>
                <li class="active">Thêm người dùng</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (isset($error)) {
                echo $error;
            }
            ?>
            <h1 class="page-header">Thêm người dùng </h1>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-lg-6">
            <form action="" method="post">
                <div class="form-group mb-2">
                    <label for="username">Tài khoản</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="fullname">Họ tên</label>
                    <input type="text" name="fullname" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="user_email">Email</label>
                    <input type="email" name="user_email" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="password">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group mb-2">
                    <label for="user_level">Cấp bậc</label>
                    <select name="user_level" class="form-control">
                        <option value="1">Quản trị</option>
                        <option value="2">Nhân viên</option>
                        <option value="3">Khách hàng</option>
                    </select>
                </div>
                <button type="submit" name="add_user" class="btn btn-success mt-2">Thêm người dùng</button>
            </form>
        </div>
    </div>
</div>