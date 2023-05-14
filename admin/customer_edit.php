<?php
require_once 'layouts/header.php';
require_once 'layouts/navbar.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `customer` WHERE `id` = :id";
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
                <li class="breadcrumb-item"><a href="customer.php">Customer</a></li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <a href="customer.php" class="btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="card-body">
                    <form method="post" action="customer.php">
                        <div class="form-group row pb-2">
                            <label for="name" class="col-4 col-form-label">Nama Customer</label>
                            <div class="col-8">
                                <input id="name" name="name" value="<?= $row['name'] ?>" type="text" class="form-control" required>
                                <input  name="id" value="<?= $row['id'] ?>" type="hidden" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="gender" class="col-4 col-form-label">Jenis Kelamin</label>
                            <div class="col-8">
                                <input type="radio" name="gender" value="L" id="L" <?php if ($row['gender'] == 'L') { echo "checked";} ?>>
                                <label for="L"> Laki - laki </label>
                                <input type="radio" name="gender" value="P" id="P" <?php if ($row['gender'] == 'P') {echo "checked";} ?>>
                                <label for="P"> Perempuan </label>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="phone" class="col-4 col-form-label">No Telp</label>
                            <div class="col-8">
                                <input id="phone" name="phone" value="<?= $row['phone'] ?>" type="number" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="email" class="col-4 col-form-label">Email</label>
                            <div class="col-8">
                                <input id="email" name="email" value="<?= $row['email'] ?>" type="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="address" class="col-4 col-form-label">Address</label>
                            <div class="col-8">
                                <input id="address" name="address" value="<?= $row['address'] ?>" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row pb-2">
                            <label for="card_id" class="col-4 col-form-label">Kartu</label>
                            <div class="col-8">
                                <select id="card_id" name="card_id" type="text" class="form-control" required>
                                    <?php
                                    $sql = "SELECT * FROM `card` WHERE `id` = :id";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':id', $row['card_id'], PDO::PARAM_STR);
                                    $query->execute();
                                    $result = $query->fetch();
                                    ?>
                                    <option value="<?= $result['id'] ?>"><?= $result['name'] ?></option>
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