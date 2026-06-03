<?php
// Lấy user_id từ URL
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Lấy dữ liệu người dùng cần sửa
    $sql_get = "SELECT * FROM users WHERE user_id = $user_id";
    $query_get = mysqli_query($connect, $sql_get);
    $user = mysqli_fetch_assoc($query_get);
}

// Xử lý khi submit form sửa
if (isset($_POST['edit_user'])) {
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $user_email = $_POST['user_email'];
    $user_pass = $_POST['user_pass'];
    $user_level = $_POST['user_level'];

    // Kiểm tra trùng tên tài khoản/email với người dùng khác
    $sql_check = "SELECT * FROM users WHERE (username = '$username' OR user_email = '$user_email') AND user_id != $user_id";
    $check = mysqli_num_rows(mysqli_query($connect, $sql_check));

    if ($check == 0) {
        // Cập nhật dữ liệu người dùng
        $sql_update = "UPDATE users SET username = '$username', fullname = '$fullname', user_email = '$user_email', 
                        user_pass = '$user_pass', user_level = '$user_level' WHERE user_id = $user_id";
        mysqli_query($connect, $sql_update);

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
                <li class="active">Sửa người dùng</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php if (isset($error)) echo $error; ?>
            <h1 class="page-header">Sửa người dùng</h1>
        </div>
    </div>
    <div class="row mb-4">
        <form action="" method="post">
            <div class="form-group mb-2">
                <label for="username">Tài khoản</label>
                <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
            </div>
            <div class="form-group mb-2">
                <label for="fullname">Họ tên</label>
                <input type="text" name="fullname" class="form-control" value="<?= $user['fullname'] ?>" required>
            </div>
            <div class="form-group mb-2">
                <label for="user_email">Email</label>
                <input type="email" name="user_email" class="form-control" value="<?= $user['user_email'] ?>" required>
            </div>
            <div class="form-group mb-2">
                <label for="user_pass">Mật khẩu</label>
                <input type="text" name="user_pass" class="form-control" value="<?= $user['user_pass'] ?>" required>
            </div>
            <button type="submit" name="edit_user" class="btn btn-primary mt-2">Cập nhật người dùng</button>
        </form>
    </div>
</div>
