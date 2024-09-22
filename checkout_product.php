<?php

include "koneksi.php";
session_start();

$id = $_GET["id"];
$sql = "SELECT * FROM products WHERE id = '$id'";
$products = $conn->query($sql);
$row = $products->fetch_assoc();

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = "<div class='alert alert-success mt-2' role='alert'>Produk Berhasil di Checkout, kamu hanya tinggal tunggu kurir sampai ke rumah</div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Produk</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="mb-3 text-center">
                        <h3>Apakah Anda Yakin Ingin Checkout Produk <b><?= $row["product_name"] ?></b>? </h3>
                    </div>
                    <?= $message ?>
                    <form method="POST">
                        <div class="text-center">
                            <button type="submit" class="btn btn-success w-100 mb-3">Checkout Sekarang</button>
                        </div>
                    </form>
                    <div class="text-center">
                        <a href="dashboard.php" class="btn btn-danger w-100">Jangan Checkout Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>