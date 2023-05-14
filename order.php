<?php
include_once('layouts/header.php');
include_once('layouts/menu.php');
if (!isset($_GET['order_number'])) {
    header('Location: index.php');
}
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
                        <span>Order</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <h4>Order Details</h4>
            <form action="#">
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-striped">
                            <tr class="table-success">
                                <th>Order Number</th>
                                <th>Tanggal Pesan</th>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total Harga</th>
                            </tr>
                            <?php
                            $sql = "SELECT `order`.*, `product`.name AS product, product.sell_price, `customer`.name AS customer FROM `order` INNER JOIN `product` ON `order`.`product_id` = `product`.`id` INNER JOIN `customer` ON `order`.`customer_id` = `customer`.`id` WHERE order_number = '$_GET[order_number]'";
                            $smt = $dbh->prepare($sql);
                            $smt->execute();
                            $row = $smt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($row as $key => $value) {
                                echo '<tr>';
                                echo '<td>' . $value['order_number'] . '</td>';
                                echo '<td>' . $value['date'] . '</td>';
                                echo '<td>' . $value['customer'] . '</td>';
                                echo '<td>' . $value['product'] . '</td>';
                                echo '<td>' . $value['sell_price'] . '</td>';
                                echo '<td>' . $value['qty'] . '</td>';
                                echo '<td>' . $value['total_price'] . '</td>';
                                echo '</tr>';
                            } ?>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php include_once('layouts/footer.php') ?>