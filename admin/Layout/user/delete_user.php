<?php
// Kết nối CSDL
include_once('connect.php');

// Kiểm tra nếu có tham số user_id
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Câu lệnh xóa người dùng
    $sql = "DELETE FROM users WHERE user_id = $user_id";

    // Thực thi xóa
    if (mysqli_query($connect, $sql)) {
        // Xóa thành công -> chuyển về danh sách người dùng
        header('Location: ?pageLayout=user');
    } else {
        echo '<div class="alert alert-danger" role="alert">Lỗi khi xóa người dùng!</div>';
    }
} else {
    echo '<div class="alert alert-warning" role="alert">Không tìm thấy ID người dùng cần xóa!</div>';
}
?>

