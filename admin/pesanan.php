<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
?>
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pesanan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Pesanan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No Pesanan</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $sql = "SELECT `order`.*, `product`.name AS product, `customer`.name AS customer FROM `order` INNER JOIN `product` ON `order`.`product_id` = `product`.`id` INNER JOIN `customer` ON `order`.`customer_id` = `customer`.`id`";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $result = $query->fetchAll();
                        if ($query->rowCount() > 0) {
                            foreach ($result as $row) { ?>
                                <tr>
                                    <td><?= $row['order_number'] ?></td>
                                    <td><?= $row['date'] ?></td>
                                    <td><?= $row['customer'] ?></td>
                                    <td><?= $row['product'] ?></td>
                                    <td><?= $row['qty'] ?></td>
                                    <td>Rp.<?= number_format($row['total_price'], 0, ',', '.'); ?></td>
                                    <td>
                                        <a href="" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM `order` WHERE `id` = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    echo "
        <script>
            alert('Data berhasil dihapus');
            window.location.href = 'pesenan.php';
        </script>
        ";
} 
?>
<?php require_once 'layouts/footer.php' ?>