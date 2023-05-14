<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `product_type` WHERE `id` = :id";
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
                <li class="breadcrumb-item"><a href="jenis_produk.php">Jenis produk</a></li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="jenis_produk.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form method="post" action="jenis_produk.php">
                        <div class="form-group row pb-2">
                            <label for="name" class="col-4 col-form-label">Jenis produk</label>
                            <div class="col-8">
                                <input id="name" name="name" value="<?= $row['name'] ?>" type="text" class="form-control">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
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