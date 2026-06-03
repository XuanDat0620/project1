<?php
// Lấy cate_id tương ứng với 'Mùa'
$category_name = 'Mùa';
$sql_cate = "SELECT cate_id FROM category WHERE cate_name = '$category_name'";
$result_cate = mysqli_query($connect, $sql_cate);
$row_cate = mysqli_fetch_assoc($result_cate);
$cate_id = $row_cate['cate_id'];

// Lấy sản phẩm thuộc danh mục này
$sql = "SELECT * FROM product WHERE cate_id = $cate_id AND prd_status = 1";
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
                <div class="col-lg-3">
                    <div class="sidebar">
                        <h5 class="filter-title">Category</h5>
                        <div class="filter-option">
                            <label><input type="checkbox"> T-shirts <span>(182)</span></label>
                            <label><input type="checkbox"> Jeans <span>(63)</span></label>
                            <label><input type="checkbox"> Coats <span>(139)</span></label>
                        </div>
                        <a href="#" class="show-more">Show more</a>

                        <h5 class="filter-title">Size</h5>
                        <div class="filter-option">
                            <label><input type="checkbox"> S <span>(102)</span></label>
                            <label><input type="checkbox"> M <span>(163)</span></label>
                            <label><input type="checkbox"> L <span>(179)</span></label>
                            <label><input type="checkbox"> XL <span>(143)</span></label>
                            <label><input type="checkbox"> XXL <span>(131)</span></label>
                            <label><input type="checkbox"> XXXL <span>(138)</span></label>
                        </div>
                        <a href="#" class="show-more">Show more</a>

                        <h5 class="filter-title mt-4">Colour</h5>
                        <div class="filter-option">
                            <label><input type="checkbox"> <span class="color-box black"></span> Black <span>(112)</span></label>
                            <label><input type="checkbox"> <span class="color-box grey"></span> Grey <span>(87)</span></label>
                            <label><input type="checkbox"> <span class="color-box blue"></span> Blue <span>(59)</span></label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-8">
                    <h1>Sản phẩm <?php echo $category_name; ?></h1>
                    <div class="row">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                            ?>
                            <div class="col-lg-4 mb-3">
                                <div class="card product-card h-100">
                                    <a href="?page_layout=chitietsp&id=<?= $row['prd_id'];?>"><img src="images/<?= $row['prd_image'] ?>" class="card-img-top" alt="<?=$row['prd_name']?>"></a>
                                    <div class="card-body">
                                        <a href="?page_layout=chitietsp&id=<?= $row['prd_id'];?>"><h6 class="card-title text-center"><?=$row['prd_name']?></h6></a>
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