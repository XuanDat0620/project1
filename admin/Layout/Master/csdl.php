<?php
// sd CSDL mã nguồn mở MySQL
$hostName = "localhost";
$userName = "root";
$password = "";
$databaseName = "10_4";
$connect = mysqli_connect($hostName, $userName, $password, $databaseName);

// tạo câu lệnh SQL
$sql = 'SELECT * FROM users';

// ta truy vấn
$query = mysqli_query($connect, $sql);

// lặp mảng để lấy giá trị đag lưu trữ trong biến truy vấn
while ($item = mysqli_fetch_array($query)) {
    echo $item['username'] . '<br>' . $item['user_pass'] . '<br>' ;
    if ($item['user_level'] ==1) {
        echo "Quyền: Admin";
    }else{
        echo "Quyền: Khách hàng";
    }
}
?>