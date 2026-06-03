<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    $id = 0;
}
//$id = intval($_GET['id']); // ép kiểu an toàn tránh injection

$sql = "SELECT * FROM product WHERE prd_id = $id";
$query = mysqli_query($connect, $sql);
$val = mysqli_fetch_assoc($query);
// Lấy danh sách các size liên quan đến sản phẩm
$sql_size = "SELECT  s.size_id, s.size_name
             FROM size s JOIN product p ON p.size_id = s.size_id
             WHERE p.prd_id = $id ";
$query_size = mysqli_query($connect, $sql_size);

// Lấy danh sách color theo bảng product_variant
$sql_color = "SELECT  c.color_id, c.color_name
              FROM color c JOIN product p ON p.color_id = c.color_id
              WHERE p.prd_id = $id";
$query_color = mysqli_query($connect, $sql_color);
$sql_prd="SELECT * FROM product ORDER BY prd_id DESC LIMIT 4";
$query_prd=mysqli_query($connect,$sql_prd);
?>
<header>
    <?php
    include_once ('header.php');
    ?>
</header>
<main>
       <section id="section-main-1" >
          <div class="container">
            <div class="row align-items-start">
              <div class="col-lg-6 d-flex">
                  <div class="d-flex flex-column me-3 product-left-small">
                      <img src="images/<?= $val['prd_image'] ?>" class="img-thumbnail mb-2 thumb-img" data-src="images/<?= $val['prd_image'] ?>" alt="Thumb 1">
                      <img src="images/<?= $val['prd_image'] ?>" class="img-thumbnail mb-2 thumb-img" data-src="images/<?= $val['prd_image'] ?>" alt="Thumb 2">
                      <img src="images/<?= $val['prd_image'] ?>" class="img-thumbnail mb-2 thumb-img" data-src="images/<?= $val['prd_image'] ?>" alt="Thumb 3">
                  </div>
                <div class="product-left-big">
                  <a href="#"><img src="images/<?= $val['prd_image'] ?>" alt="" class="main-product-img"></a>
                </div>
              </div>
              <div class="col-lg-6">
                <h2 class="page-product"><?php echo $val['prd_name']?></h2>
                <p class="price"><?php echo number_format($val['prd_price'])?>đ</p>
                  <?php
                      if (isset($_POST['add_to_cart'])) {
                          if (isset($_POST['qtt'])) {
                              $qtt = intval($_POST['qtt']); // Ép kiểu về số nguyên để tránh lỗi và injection
                          } else {
                              $qtt = 1; // Mặc định là 1 nếu không có số lượng được gửi
                          }
                          if (isset($_POST['size'])) {
                              $size = intval($_POST['size']); // Ép kiểu size về số nguyên
                          } else {
                              $size = 0; // Mặc định là 0 nếu không chọn size
                          }
                          if (isset($_POST['color'])) {
                              $color = intval($_POST['color']); // Ép kiểu color về số nguyên
                          } else {
                              $color = 0; // Mặc định là 0 nếu không chọn màu
                          }

                          if ($size > 0 && $color > 0) {
                              header("Location: add_to_cart.php?prd_id={$val['prd_id']}&qtt=$qtt&size_id=$size&color_id=$color");
                              exit;
                          }
                  }
                  ?>
                  <form action="" method="POST">
                      <div class="mb-2 d-flex">
                          <label class="me-2">Size:</label>
                          <select required class="form-select w-50" name="size">
                              <?php while ($size = mysqli_fetch_assoc($query_size)) { ?>
                                  <option value="<?= $size['size_id'] ?>"><?= $size['size_name'] ?></option>
                              <?php } ?>
                          </select>
                      </div>

                      <div class="mb-2 d-flex">
                          <label class="me-2">Color:</label>
                          <?php
                          // Reset lại truy vấn vì đã fetch ở trên
                          mysqli_data_seek($query_color, 0);
                          while ($color = mysqli_fetch_assoc($query_color)) { ?>
                              <label class="me-2">
                                  <input type="radio" required name="color" value="<?= $color['color_id'] ?>"> <?= $color['color_name'] ?>
                              </label>
                          <?php } ?>
                      </div>

                      <div class="d-flex align-items-center mb-2">
                          <label for="qtt" class="form-label me-2 mb-0">Số lượng:</label>
                          <input type="number" id="qtt" name="qtt" class="form-control" value="1" min="1" max="<?= $val['prd_quantity']; ?>" style="width: 70px;" />
                      </div>

                      <div class="d-flex gap-2">
                          <button type="submit" name="add_to_cart" class="btn btn-danger">Thêm vào giỏ hàng</button>
                      </div>
                  </form>

                <div class="name mt-4">
                    <h4>DETAIL</h4>
                    <div><?php echo $val['prd_detail'] ?></div>
                </div>
              </div>
            </div>
          </div>
       </section>
       <section id="main-2">
            <div class="container">
                  <h4 class="text-center text-dark"><b>SẢN PHẨM KHÁC</b></h4>
                  <div class="row mt-3 pro-other">
                      <?php
                      while ($item=mysqli_fetch_array($query_prd)) {
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