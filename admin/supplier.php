<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Supplier</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Supplier</li>
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
                                        <label for="name" class="col-4 col-form-label">Nama Supplier</label>
                                        <div class="col-8">
                                            <input id="name" name="name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="phone" class="col-4 col-form-label">No Telp</label>
                                        <div class="col-8">
                                            <input id="phone" name="phone" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="address" class="col-4 col-form-label">Address</label>
                                        <div class="col-8">
                                            <input id="address" name="address" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="contact_name" class="col-4 col-form-label">Nama Kontak</label>
                                        <div class="col-8">
                                            <input id="contact_name" name="contact_name" type="text" class="form-control" required>
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
                            <th>Nama Supplier</th>
                            <th>No Telp</th>
                            <th>Address</th>
                            <th>Nama Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Supplier</th>
                            <th>No Telp</th>
                            <th>Address</th>
                            <th>Nama Kontak</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `supplier`";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['contact_name'] ?></td>
                                    <td>
                                        <a href="supplier_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
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
    $sql = "INSERT INTO `supplier` (`name`, `phone`, `address`, `contact_name`) VALUES (:name, :phone,:address, :contact_name)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $query->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
    $query->bindParam(':contact_name', $_POST['contact_name'], PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            window.location.href = 'supplier.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal ditambahkan');
            window.location.href = 'supplier.php';
        </script>
        ";
    }
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `supplier` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil dihapus');
            window.location.href = 'supplier.php';
        </script>
        ";
} elseif (isset($_POST['edit'])) {
    $sql = "UPDATE `supplier` SET `name` = :name, `phone` = :phone, `address` = :address, `contact_name` = :contact_name WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $query->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
    $query->bindParam(':contact_name', $_POST['contact_name'], PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    echo "
        <script>
            alert('Data berhasil diubah');
            window.location.href = 'supplier.php';
        </script>
        ";
}

?>
<?php require_once 'layouts/footer.php' ?>