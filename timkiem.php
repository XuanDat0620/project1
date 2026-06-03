<?php
$keyword = mysqli_real_escape_string($connect, $_GET['keyword'] ?? '');

$sql = "SELECT * FROM product WHERE prd_name LIKE '%$keyword%'";
$query = mysqli_query($connect, $sql);
?>
<header>
    <?php
    include_once ('header.php');
    ?>
</header>
<main>
    <div class="container mt-4">
        <h3>Kết quả tìm kiếm : <strong><?= htmlspecialchars($keyword) ?></strong></h3>
        <div class="row" id="st2-product">
            <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                <div class="col-lg-3">
                    <div class="bg-gray">
                        <a href="?page_layout=chitietsp&id=<?php echo $row['prd_id'];?>"><img src="images/<?php echo $row['prd_image']?>" alt=""></a>
                    </div>
                    <h3 class="text-center"><a href="?page_layout=chitietsp&id=<?php echo $row['prd_id']; ?>"><?php echo $row['prd_name']?></a></h3>
                    <p class="price text-danger"> <?php echo number_format($row['prd_price'])?>đ</p>
                </div>
            <?php } ?>
        </div>
    </div>
</main>
