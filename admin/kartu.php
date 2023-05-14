<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Kartu</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Kartu</li>
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
                                        <label for="code" class="col-4 col-form-label">Kode Kartu</label>
                                        <div class="col-8">
                                            <input id="code" name="code" type="text" class="form-control" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="name" class="col-4 col-form-label">Nama Kartu</label>
                                        <div class="col-8">
                                            <input id="name" name="name" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="discount" class="col-4 col-form-label">Diskon Kartu</label>
                                        <div class="col-8">
                                            <input id="discount" name="discount" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row pb-2">
                                        <label for="member_fee" class="col-4 col-form-label">Member fee</label>
                                        <div class="col-8">
                                            <input id="member_fee" name="member_fee" type="number" class="form-control" required>
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
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diskon</th>
                            <th>Member Fee</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Diskon</th>
                            <th>Member Fee</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `card`";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['code'] ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['discount'] ?></td>
                                    <td>Rp.<?= number_format($row['member_fee'], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="kartu_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
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
    $code = $_POST['code'];
    $name = $_POST['name'];
    $discount = $_POST['discount'];
    $member_fee = $_POST['member_fee'];
    $sql = "INSERT INTO `card` (`code`, `name`, `discount`, `member_fee`) VALUES (:code, :name, :discount, :member_fee)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':discount', $discount, PDO::PARAM_STR);
    $query->bindParam(':member_fee', $member_fee, PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if ($lastInsertId) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
            window.location.href = 'kartu.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data gagal ditambahkan');
            window.location.href = 'kartu.php';
        </script>
        ";
    }
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `card` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil dihapus');
            window.location.href = 'kartu.php';
        </script>
        ";
} elseif (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $code = $_POST['code'];
    $name = $_POST['name'];
    $discount = $_POST['discount'];
    $member_fee = $_POST['member_fee'];
    $sql = "UPDATE `card` SET `code` = :code, `name` = :name, `discount` = :discount, `member_fee` = :member_fee WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->bindParam(':code', $code, PDO::PARAM_STR);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':discount', $discount, PDO::PARAM_STR);
    $query->bindParam(':member_fee', $member_fee, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil diubah');
            window.location.href = 'kartu.php';
        </script>
        ";
}

?>
<?php require_once 'layouts/footer.php' ?>