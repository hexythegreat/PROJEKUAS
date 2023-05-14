<?php
// koneksi database pdo
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dbh = new PDO(
    'mysql:
    host=localhost;
    dbname=db_petsupplies',
    'root',
    '',
    $opt
);
