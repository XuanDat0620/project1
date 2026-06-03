<?php
// Lấy cate_id tương ứng với 'Nam'
$gender_name = 'Nam';
$sql_gender = "SELECT gender_id FROM gender WHERE gender_name = '$gender_name'";
$result_gender = mysqli_query($connect, $sql_gender);
$row_gender = mysqli_fetch_assoc($result_gender);
$gender_id = $row_gender['gender_id'];

// Lấy sản phẩm thuộc danh mục này
$sql = "SELECT * FROM product WHERE gender_id = $gender_id AND prd_status = 1";
$query = mysqli_query($connect, $sql);
?>
<header>
    <?php
    include_once ('header.php');
    ?>
</header>
<main>
    <section id="section-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <h1>Quần áo <?php echo $gender_name; ?></h1>
                </div>
                <div class="col-lg-3 col-sm-3">
                    <div class="cate-right-top-item">
                        <select name="" id="">
                            <option value="">Bộ lọc</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3">
                    <div class="cate-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                        </select>
                    </div>
                </div>
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <div class="col-lg-4 mb-3">
                                <div class="card product-card h-100">
                                    <a href="?page_layout=chitietsp&id=<?php echo $row['prd_id'];?>"><img src="images/<?= $row['prd_image'] ?>" class="card-img-top" alt="<?=$row['prd_name']?>"></a>
                                    <div class="card-body">
                                        <a href="?page_layout=chitietsp&id=<?php echo $row['prd_id'];?>"><h6 class="card-title text-center"><?=$row['prd_name']?></h6></a>
                                        <p class="text-danger text-center fw-bold mb-2"><?= number_format($row['prd_price'])?>₫</p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php
    include_once ('footer.php');
    ?>
</footer>