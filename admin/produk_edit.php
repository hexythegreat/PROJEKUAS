<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `product` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    $row = $query->fetch();
?>
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Form</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="product.php">Produk</a></li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="product.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form method="post" action="produk.php">

                        <div class="form-group row pb-2">
                            <label for="sku" class="col-4 col-form-label">SKU Product</label>
                            <div class="col-8">
                                <input id="sku" name="sku" value="<?= $row['sku'] ?>" type="text" class="form-control" required>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="name" class="col-4 col-form-label">Nama Product</label>
                            <div class="col-8">
                                <input id="name" name="name" value="<?= $row['name'] ?>" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="purchase_price" class="col-4 col-form-label">Harga Beli</label>
                            <div class="col-8">
                                <input id="purchase_price" name="purchase_price" value="<?= $row['purchase_price'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="sell_price" class="col-4 col-form-label">Harga Jual</label>
                            <div class="col-8">
                                <input id="sell_price" name="sell_price" value="<?= $row['sell_price'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="stock" class="col-4 col-form-label">Stok</label>
                            <div class="col-8">
                                <input id="stock" name="stock" value="<?= $row['stock'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="min_stock" class="col-4 col-form-label">Min Stok</label>
                            <div class="col-8">
                                <input id="min_stock" name="min_stock" value="<?= $row['min_stock'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="product_type_id" class="col-4 col-form-label">Jenis Produk</label>
                            <div class="col-8">
                                <select id="product_type_id" name="product_type_id" type="text" class="form-control" required>
                                    <?php
                                    $sql2 = "SELECT * FROM `product_type` WHERE `id` = :id";
                                    $query2 = $dbh->prepare($sql2);
                                    $query2->bindParam(':id', $row['product_type_id'], PDO::PARAM_STR);
                                    $query2->execute();
                                    $row2 = $query2->fetch();
                                    ?>
                                    <option value="<?= $row2['id'] ?>"><?= $row2['name'] ?></option>
                                    <?php
                                    $sql3 = "SELECT * FROM `product_type`";
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
                            <label for="restock_id" class="col-4 col-form-label">Restock</label>
                            <div class="col-8">
                                <select id="restock_id" name="restock_id" type="text" class="form-control" required>
                                    <?php
                                    $sql5 = "SELECT * FROM `restock` WHERE `id` = :id";
                                    $query5 = $dbh->prepare($sql5);
                                    $query5->bindParam(':id', $row['restock_id'], PDO::PARAM_STR);
                                    $query5->execute();
                                    $row5 = $query5->fetch();
                                    ?>
                                    <option value="<?= $row5['id'] ?>"><?= $row5['restock_number'] ?></option>
                                    <?php
                                    $sql4 = "SELECT * FROM `restock`";
                                    $query4 = $dbh->prepare($sql4);
                                    $query4->execute();
                                    $result4 = $query4->fetchAll();
                                    if ($query4->rowCount() > 0) {
                                        foreach ($result4 as $row4) { ?>
                                            <option value="<?= $row4['id'] ?>"><?= $row4['restock_number'] ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-4 col-8">
                                <input type="reset" value="Reset" class="btn btn-secondary">
                                <button name="edit" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php }
require_once 'layouts/footer.php' ?>