<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `restock` WHERE `id` = :id";
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
                <li class="breadcrumb-item"><a href="stok.php">Produk</a></li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="stok.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form method="post" action="stok.php">
                        <div class="form-group row pb-2">
                            <label for="restock_number" class="col-4 col-form-label">Kode Restok</label>
                            <div class="col-8">
                                <input id="restock_number" name="restock_number" value="<?= $row['restock_number'] ?>" type="text" class="form-control" required>
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="date" class="col-4 col-form-label">Tanggal</label>
                            <div class="col-8">
                                <input id="date" name="date" value="<?= $row['date'] ?>" type="datetime-local" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="qty" class="col-4 col-form-label">qty</label>
                            <div class="col-8">
                                <input id="qty" name="qty" value="<?= $row['qty'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="price" class="col-4 col-form-label">Harga</label>
                            <div class="col-8">
                                <input id="price" name="price" value="<?= $row['price'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="supplier_id" class="col-4 col-form-label">Supplier</label>
                            <div class="col-8">
                                <select id="supplier_id" name="supplier_id" type="text" class="form-control" required>
                                    <?php
                                    $sql = "SELECT * FROM `supplier` WHERE `id` = :id";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':id', $row['supplier_id'], PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetch();
                                    ?>
                                    <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>
                                    <?php
                                    $sql = "SELECT * FROM `supplier`";
                                    $query = $dbh->prepare($sql);
                                    $query->execute();
                                    $result = $query->fetchAll();
                                    if ($query->rowCount() > 0) {
                                        foreach ($result as $row) { ?>
                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
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