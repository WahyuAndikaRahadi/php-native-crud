<?php
include "koneksi.php";
session_start();
if ($_SESSION["role"] !== "admin") {
    header("location: index.php");
    exit();
}

$id = $_GET["id"];
$sql = "SELECT * FROM products WHERE id = '$id'";
$products = $conn->query($sql);
$row = $products->fetch_assoc();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Produk</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="mb-3 text-center">
                        <h3>Apakah Anda Yakin Ingin Menghapus <b><?= $row["product_name"] ?></b>? </h3>
                    </div>
                    <div class="text-center">
                        <a href="delete.php?id=<?= $row["id"] ?>" class="btn btn-danger w-50 mb-3">Hapus Produk</a>
                        <a href="dashboard.php" class="btn btn-success w-50">Jangan Hapus Produk</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>