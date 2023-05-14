<?php
include_once('layouts/header.php');
include_once('layouts/menu.php');
$img = ['product-1.jpg', 'product-2.jpg', 'product-3.jpg', 'product-4.jpg', 'product-5.jpg', 'product-6.jpg', 'product-7.jpg', 'product-8.jpg', 'product-9.jpg'];
?>

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    <ul>
                        <?php
                        $sql = "SELECT * FROM product_type";
                        $smt = $dbh->prepare($sql);
                        $smt->execute();
                        $row = $smt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($row as $key => $value) {
                            echo '<li><a href="product.php">' . $value['name'] . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>+65 11.188.888</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>PetSupplies</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Home</a>
                        <a href="./product.php">Product</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<?php

$sku = $_GET['sku'];
$sql = "SELECT product.*, product_type.name AS product_type FROM `product` INNER JOIN product_type ON product_type.id = product.product_type_id WHERE `sku` = :sku";
$query = $dbh->prepare($sql);
$query->bindParam(':sku', $sku, PDO::PARAM_STR);
$query->execute();
$row = $query->fetch();
?>
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="img/product/details/product-details-1.jpg" alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="img/product/details/product-details-2.jpg" src="img/product/details/thumb-1.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-3.jpg" src="img/product/details/thumb-2.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-5.jpg" src="img/product/details/thumb-3.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-4.jpg" src="img/product/details/thumb-4.jpg" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?= $row['name'] ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                    </div>
                    <div class="product__details__price">Rp. <?= number_format($row['sell_price'], 0, ',', '.'); ?></div>
                    <p>From nutritious food to essential vitamins, from stylish collars and leashes to comfortable bedding, from spacious cages to fun toys, and from aquatic essentials to grooming necessities, we've got all the pet supplies you need to provide your furry friend with the best care possible. Plus, with our wide range of clothing and training products, you can keep your pet looking their best and feeling their happiest!</p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="primary-btn" data-toggle="modal" data-target="#modalSaya">
                        ADD TO CARD
                    </button>
                    <a class="heart-icon"><span class="icon_heart_alt"></span></a>
                    <ul>
                        <li><b>Availability</b> <span>In Stock</span></li>
                        <li><b>Stock</b> <span><?= $row['stock'] ?></span></li>
                        <li><b>Categories</b> <span><?= $row['product_type'] ?></span></li>
                        <li><b>Share on</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSayaLabel">Form Order</h5>
            </div>
            <div class="modal-body">
                <form method="post">
                    <?php
                    // cek order_number seblumnya
                    $sql2 = "SELECT * FROM `order` ORDER BY id DESC LIMIT 1";
                    $query2 = $dbh->prepare($sql2);
                    $query2->execute();
                    $result2 = $query2->fetch();
                    $order_number = $result2['order_number'];
                    $order_number = substr($order_number, 3);
                    $order_number = (int) $order_number;
                    $order_number++;
                    $order_number = "PO" . str_pad($order_number, 3, "0", STR_PAD_LEFT);
                    ?>
                    <div class="form-group row pb-2">
                        <label for="order_number" class="col-4 col-form-label">Order Number</label>
                        <div class="col-8">
                            <input id="order_number" name="order_number" value="<?= $order_number ?>" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <label for="customer_id" class="col-4 col-form-label">Nama Customer</label>
                        <div class="col-8">
                            <select id="customer_id" name="customer_id" type="text" class="form-control" required>
                                <?php
                                $sql3 = "SELECT * FROM `customer`";
                                $query3 = $dbh->prepare($sql3);
                                $query3->execute();
                                $result3 = $query3->fetchAll();
                                if ($query3->rowCount() > 0) {
                                    foreach ($result3 as $row3) { ?>
                                        <option value="<?= $row3['id'] ?>"><?= $row3['name'] ?></option>
                                <?php }
                                } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <label for="product_name" class="col-4 col-form-label">Nama Product</label>
                        <div class="col-8">
                            <input id="product_name" name="product_name" value="<?= $row['name'] ?>" type="text" class="form-control" readonly>
                            <input id="product_id" name="product_id" value="<?= $row['id'] ?>" type="hidden" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <label for="sell_price" class="col-4 col-form-label">Harga</label>
                        <div class="col-8">
                            <input id="sell_price" name="sell_price" value="<?= $row['sell_price'] ?>" type="text" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <label for="qty" class="col-4 col-form-label">Qty</label>
                        <div class="col-8">
                            <input id="qty" name="qty" type="number" class="form-control" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>

        </div>
    </div>
</div>
<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $i = 1;
            shuffle($img);
            $sql2 = "SELECT * FROM product WHERE product_type_id = '$row[product_type_id]' limit 4";
            $smt = $dbh->prepare($sql2);
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="img/product/<?= $img[$i % count($img)] ?>">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="detail.php?sku=<?= $value['sku'] ?>"><?= $value['name'] ?></a></h6>
                            <h5>Rp. <?= number_format($value['sell_price'], 0, ',', '.'); ?></h5>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
    </div>
</section>
<!-- Related Product Section End -->
<?php
if (isset($_POST['submit'])) {
    $order_number = $_POST['order_number'];
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $sell_price = $_POST['sell_price'];
    $qty = $_POST['qty'];
    $total_price = $sell_price * $qty;
    $sql = "INSERT INTO `order`(`order_number`,`date`, `qty`, `total_price`, `customer_id`, `product_id`) VALUES ('$order_number',NOW(), '$qty', '$total_price', '$customer_id', '$product_id')";
    echo $sql;
    $query = $dbh->prepare($sql);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "<script>alert('Order berhasil!');</script>";
        echo "<script>window.location.href ='order.php?order_number=$order_number'</script>";
    } else {
        echo "<script>alert('Order gagal!');</script>";
    }
}

?>
<?php include_once('layouts/footer.php') ?>