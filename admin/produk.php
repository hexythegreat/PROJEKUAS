<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Product</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <!-- Tombol yang memicu modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalSaya">
                    <i class="fas fa-plus"></i> Tambah
                </button>

                <!-- Contoh Modal -->
                <div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalSayaLabel">Tambah Data</h5>
                            </div>
                            <div class="modal-body">
                                <form method="post">
                                    <div class="form-group row pb-2">
                                        <label for="sku" class="col-4 col-form-label">SKU Product</label>
                                        <div class="col-8">
                                            <input id="sku" name="sku" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="name" class="col-4 col-form-label">Nama Product</label>
                                        <div class="col-8">
                                            <input id="name" name="name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="purchase_price" class="col-4 col-form-label">Harga Beli</label>
                                        <div class="col-8">
                                            <input id="purchase_price" name="purchase_price" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="sell_price" class="col-4 col-form-label">Harga Jual</label>
                                        <div class="col-8">
                                            <input id="sell_price" name="sell_price" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="min_stock" class="col-4 col-form-label">Min Stok</label>
                                        <div class="col-8">
                                            <input id="min_stock" name="min_stock" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="product_type_id" class="col-4 col-form-label">Jenis Produk</label>
                                        <div class="col-8">
                                            <select id="product_type_id" name="product_type_id" type="text" class="form-control" required>
                                                <?php
                                                $sql = "SELECT * FROM `product_type`";
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
                                    <div class="form-group row pb-2">
                                        <label for="restock_id" class="col-4 col-form-label">Restock</label>
                                        <div class="col-8">
                                            <select id="restock_id" name="restock_id" type="text" class="form-control" required>
                                                <?php
                                                $sql = "SELECT * FROM `restock`";
                                                $query = $dbh->prepare($sql);
                                                $query->execute();
                                                $result = $query->fetchAll();
                                                if ($query->rowCount() > 0) {
                                                    foreach ($result as $row) { ?>
                                                        <option value="<?= $row['id'] ?>"><?= $row['restock_number'] ?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button name="tambah" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Nama</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Min Stok</th>
                            <th>Jenis Produk</th>
                            <th>Restok Kode</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>SKU</th>
                            <th>Nama</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Stok</th>
                            <th>Min Stok</th>
                            <th>Jenis Produk</th>
                            <th>Restok Kode</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT `product`.*, `product_type`.name AS product_type, `restock`.restock_number FROM `product` INNER JOIN `product_type` ON `product`.`product_type_id` = `product_type`.`id` INNER JOIN `restock` ON `product`.`restock_id` = `restock`.`id`";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['sku'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td>Rp.<?= number_format($row['purchase_price'], 0, ',', '.'); ?></td>
                                    <td>Rp.<?= number_format($row['sell_price'], 0, ',', '.'); ?></td>
                                    <td><?= $row['stock'] ?></td>
                                    <td><?= $row['min_stock'] ?></td>
                                    <td><?= $row['product_type'] ?></td>
                                    <td><?= $row['restock_number'] ?></td>
                                    <td>
                                        <a href="produk_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "
                            <tr>
                                <td colspan='9'>Tidak ada data</td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<?php
if (isset($_POST['tambah'])) {
    $restock_id = $_POST['restock_id'];
    $sql = "SELECT * FROM `restock` WHERE `id` = :restock_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':restock_id', $restock_id, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);
    $stock = $result->stock;
    $query = $dbh->prepare("INSERT INTO `product` (`sku`, `name`, `purchase_price`, `sell_price`, `stock`, `min_stock`, `product_type_id`, `restock_id`) VALUES (:sku, :name, :purchase_price, :sell_price, :stock, :min_stock, :product_type_id, :restock_id)");
    $query->bindParam(':sku', $_POST['sku'], PDO::PARAM_STR);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam(':purchase_price', $_POST['purchase_price'], PDO::PARAM_STR);
    $query->bindParam(':sell_price', $_POST['sell_price'], PDO::PARAM_STR);
    $query->bindParam(':stock', $stock, PDO::PARAM_STR);
    $query->bindParam(':min_stock', $_POST['min_stock'], PDO::PARAM_STR);
    $query->bindParam(':product_type_id', $_POST['product_type_id'], PDO::PARAM_STR);
    $query->bindParam(':restock_id', $_POST['restock_id'], PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                window.location.href = 'produk.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
                window.location.href = 'produk.php';
            </script>
            ";
    }

} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `product` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil dihapus');
            window.location.href = 'produk.php';
        </script>
        ";
} elseif (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $sql = "UPDATE `product` SET `sku` = :sku, `name` = :name, `purchase_price` = :purchase_price, `sell_price` = :sell_price, `stock` = :stock, `min_stock` = :min_stock, `product_type_id` = :product_type_id, `restock_id` = :restock_id WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sku', $_POST['sku'], PDO::PARAM_STR);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam(':purchase_price', $_POST['purchase_price'], PDO::PARAM_STR);
    $query->bindParam(':sell_price', $_POST['sell_price'], PDO::PARAM_STR);
    $query->bindParam(':stock', $_POST['stock'], PDO::PARAM_STR);
    $query->bindParam(':min_stock', $_POST['min_stock'], PDO::PARAM_STR);
    $query->bindParam(':product_type_id', $_POST['product_type_id'], PDO::PARAM_STR);
    $query->bindParam(':restock_id', $_POST['restock_id'], PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil diubah');
            window.location.href = 'produk.php';
        </script>
        ";
}

?>
<?php require_once 'layouts/footer.php' ?>