<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Customer</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Customer</li>
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
                                        <label for="name" class="col-4 col-form-label">Nama Customer</label>
                                        <div class="col-8">
                                            <input id="name" name="name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="gender" class="col-4 col-form-label">Jenis Kelamin</label>
                                        <div class="col-8">
                                            <input type="radio" name="gender" value="L" id="L">
                                            <label for="L"> Laki - laki </label>
                                            <input type="radio" name="gender" value="P" id="P">
                                            <label for="P"> Perempuan </label>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="phone" class="col-4 col-form-label">No Telp</label>
                                        <div class="col-8">
                                            <input id="phone" name="phone" type="number" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="email" class="col-4 col-form-label">Email</label>
                                        <div class="col-8">
                                            <input id="email" name="email" type="email" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="address" class="col-4 col-form-label">Address</label>
                                        <div class="col-8">
                                            <input id="address" name="address" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="card_id" class="col-4 col-form-label">Kartu</label>
                                        <div class="col-8">
                                            <select id="card_id" name="card_id" type="text" class="form-control" required>
                                                <?php
                                                $sql = "SELECT * FROM `card`";
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
                            <th>Nama Customer</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Kartu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nama Customer</th>
                            <th>Jenis Kelamin</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Kartu</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT `customer`.*, `card`.name AS card FROM `customer` INNER JOIN `card` ON `customer`.`card_id` = `card`.`id`";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['gender'] ?></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><?= $row['address'] ?></td>
                                    <td><?= $row['card'] ?></td>
                                    <td>
                                        <a href="customer_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                        <?php }
                        } else {
                            echo "
                            <tr>
                                <td colspan='7'>Tidak ada data</td>
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
    $sql = "INSERT INTO `customer` (`name`, `gender`, `phone`, `email`, `address`, `card_id`) VALUES (:name, :gender, :phone, :email, :address, :card_id)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam(':gender', $_POST['gender'], PDO::PARAM_STR);
    $query->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
    $query->bindParam(':card_id', $_POST['card_id'], PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            window.location.href = 'customer.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal ditambahkan');
            window.location.href = 'customer.php';
        </script>
        ";
    }
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `customer` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil dihapus');
            window.location.href = 'customer.php';
        </script>
        ";
} elseif (isset($_POST['edit'])) {
    $sql = "UPDATE `customer` SET `name` = :name, `gender` = :gender, `phone` = :phone, `email` = :email, `address` = :address, `card_id` = :card_id WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $_POST['id'], PDO::PARAM_STR);
    $query->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
    $query->bindParam(':gender', $_POST['gender'], PDO::PARAM_STR);
    $query->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR);
    $query->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $query->bindParam(':address', $_POST['address'], PDO::PARAM_STR);
    $query->bindParam(':card_id', $_POST['card_id'], PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    echo "
        <script>
            alert('Data berhasil diubah');
            window.location.href = 'customer.php';
        </script>
        ";
}

?>
<?php require_once 'layouts/footer.php' ?>