<?php
//$sql_prd="SELECT * FROM product ORDER BY prd_id DESC LIMIT 8";
//$query_prd=mysqli_query($connect,$sql_prd);
// 8 sản phẩm mới nhất cho section-main-1
$sql_prd_new = "SELECT * FROM product ORDER BY prd_id DESC LIMIT 8";
$query_prd_new = mysqli_query($connect, $sql_prd_new);

// 8 sản phẩm bán chạy nhất cho section-main-3 (giả sử bạn có trường prd_sold lưu số lượng bán ra)
$sql_prd_best = "SELECT * FROM product ORDER BY prd_quantity DESC LIMIT 8";
$query_prd_best = mysqli_query($connect, $sql_prd_best);
?>
<header>
    <?php
    include_once ('header.php');
    include_once ('banner.php');
    ?>
</header>
<main>
    <section id="section-main-1">
        <div class="container text-center">
            <h2 class="page-header">THỜI TRANG MỚI NHẤT</h2>
            <div class="row" id="st2-product">
                <?php
                while ($item=mysqli_fetch_array($query_prd_new)) {
                    ?>
                    <div class="col-lg-3">
                        <div class="bg-gray">
                            <a href="?page_layout=chitietsp&id=<?php echo $item['prd_id'];?>"><img src="images/<?php echo $item['prd_image']?>" alt=""></a>
                        </div>
                        <h3><a href="?page_layout=chitietsp&id=<?php echo $item['prd_id']; ?>"><?php echo $item['prd_name']?></a></h3>
                        <p class="price text-danger"> <?php echo number_format($item['prd_price'])?>đ</p>
                    </div>
                    <?php
                }
                ?>
            </div>
    </section>
<!--    <section id="section-main-2">-->
<!--        <div class="container text-center">-->
<!--            <h3>SEASON SALE</h3>-->
<!--            <h2>UP TO 70% OFF</h2>-->
<!--        </div>-->
<!--    </section>-->
    <section id="section-main-3">
        <div class="container text-center">
            <h2>THỜI TRANG BÁN CHẠY NHẤT</h2>
            <div class="row" id="st3-product">
                <?php
                while ($item=mysqli_fetch_array($query_prd_best)) {
                    ?>
                    <div class="col-lg-3">
                        <div class="bg-gray">
                            <a href="?page_layout=chitietsp&id=<?php echo $item['prd_id'];?>"><img src="images/<?php echo $item['prd_image']?>" alt=""></a>
                        </div>
                        <h3><a href="?page_layout=chitietsp&id=<?php echo $item['prd_id']; ?>"><?php echo $item['prd_name']?></a></h3>
                        <p class="price text-danger"> <?php echo number_format($item['prd_price'])?>đ</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
</main>
<footer>
    <?php
    include_once ('footer.php');
    ?>
</footer>