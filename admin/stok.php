<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Restock</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Restock</li>
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
                                        <label for="restock_number" class="col-4 col-form-label">Kode Restok</label>
                                        <div class="col-8">
                                            <input id="restock_number" name="restock_number" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="date" class="col-4 col-form-label">Tanggal</label>
                                        <div class="col-8">
                                            <input id="date" name="date" type="datetime-local" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="qty" class="col-4 col-form-label">qty</label>
                                        <div class="col-8">
                                            <input id="qty" name="qty" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="price" class="col-4 col-form-label">Harga</label>
                                        <div class="col-8">
                                            <input id="price" name="price" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="supplier_id" class="col-4 col-form-label">Supplier</label>
                                        <div class="col-8">
                                            <select id="supplier_id" name="supplier_id" type="text" class="form-control" required>
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
                            <th>Kode Restock</th>
                            <th>Tanggal</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode Restock</th>
                            <th>Tanggal</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Supplier</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT `restock`.*, `supplier`.name AS supplier FROM `restock` INNER JOIN `supplier` ON `restock`.`supplier_id` = `supplier`.`id`";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['restock_number'] ?></td>
                                    <td><?= $row['date'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td><?= $row['price'] ?></td>
                                    <td><?= $row['supplier'] ?></td>
                                    <td>
                                        <a href="stok_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "
                            <tr>
                                <td colspan='5'>Tidak ada data</td>
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

    $restock_number = $_POST['restock_number'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $supplier_id = $_POST['supplier_id'];
    $query = $dbh->prepare("INSERT INTO `restock` (`restock_number`, `date`, `qty`, `price`, `supplier_id`) VALUES (:restock_number, :date, :qty, :price, :supplier_id)");
    $query->bindParam(':restock_number', $restock_number, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':qty', $qty, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':supplier_id', $supplier_id, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "
            <script>
                alert('Data berhasil ditambahkan');
                window.location.href = 'stok.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal ditambahkan');
                window.location.href = 'stok.php';
            </script>
            ";
    }
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `restock` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil dihapus');
            window.location.href = 'stok.php';
        </script>
        ";
} elseif (isset($_POST['edit'])) {
    // update data
    $id = $_POST['id'];
    $restock_number = $_POST['restock_number'];
    $date = $_POST['date'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    $supplier_id = $_POST['supplier_id'];
    $query = $dbh->prepare("UPDATE `restock` SET `restock_number` = :restock_number, `date` = :date, `qty` = :qty, `price` = :price, `supplier_id` = :supplier_id WHERE `id` = :id");
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':restock_number', $restock_number, PDO::PARAM_STR);
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':qty', $qty, PDO::PARAM_STR);
    $query->bindParam(':price', $price, PDO::PARAM_STR);
    $query->bindParam(':supplier_id', $supplier_id, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "
            <script>
                alert('Data berhasil diubah');
                window.location.href = 'stok.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data gagal diubah');
                window.location.href = 'stok.php';
            </script>
            ";
    }
}

?>
<?php require_once 'layouts/footer.php' ?>