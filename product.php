<?php
include_once 'layouts/header.php';
include_once 'layouts/menu.php';
$img = ['product-1.jpg', 'product-2.jpg', 'product-3.jpg', 'product-4.jpg', 'product-5.jpg', 'product-6.jpg', 'product-7.jpg', 'product-8.jpg', 'product-9.jpg'];
$cat = ['cat-1.jpg', 'cat-2.jpg', 'cat-3.jpg', 'cat-4.jpg', 'cat-5.jpg'];
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
                        $result = $smt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $key => $value) {
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
                        <span>Products</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->


<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>All Product</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php
                        $sql = "SELECT * FROM product_type";
                        $smt = $dbh->prepare($sql);
                        $smt->execute();
                        $result = $smt->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($result as $key => $value) {
                            echo '<li data-filter=".categories' . $value['id'] . '">' . $value['name'] . '</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
            $i = 1;
            shuffle($img);
            $sql = "SELECT * FROM product";
            $smt = $dbh->prepare($sql);
            $smt->execute();
            $result = $smt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $key => $value) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix categories<?= $value['product_type_id'] ?>">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="img/product/<?= $img[$i % count($img)] ?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="detail.php?sku=<?= $value['sku'] ?>"><i class="fa fa-heart"></i></a></li>
                                <li><a href="detail.php?sku=<?= $value['sku'] ?>"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="detail.php?sku=<?= $value['sku'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="detail.php?sku=<?= $value['sku'] ?>"><?= $value['name'] ?></a></h6>
                            <h5>Rp.<?= number_format($value['sell_price'], 0, ',', '.'); ?></h5>
                        </div>
                    </div>
                </div>
            <?php $i++;
            } ?>
        </div>
    </div>
</section>
<!-- Featured Section End -->
<!-- Blog Section End -->
<?php include_once 'layouts/footer.php' ?>