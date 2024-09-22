<?php
include "koneksi.php";
session_start();
$message = "";
if ($_SESSION["role"] !== "admin") {
    header("location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name-product"];
    $price = $_POST["price-product"];
    $description = $_POST["description-product"];


    $sql = "INSERT INTO products (product_name, product_price, product_description) VALUES ('$name','$price','$description')";
    $result = $conn->query($sql);
    
    $message = "<div class='alert alert-success mt-3' role='alert'>Produk berhasil Ditambahkan</div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <div class="mt-3 text-center">
                        <h2>Tambah Produk</h2>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name Product</label>
                            <input type="text" class="form-control" name="name-product" id="name" required placeholder="Masukan nama Produk">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Produk</label>
                            <input type="number" class="form-control" name="price-product" id="price" required placeholder="Masukan Harga Produk">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Produk</label>
                            <textarea name="description-product" id="description" class="form-control" required placeholder="Masukan deskripsi"></textarea>
                        </div>
                        
                        <?= $message?>
                        <button class="btn btn-success w-100" type="submit">Submit Produk</button>
                    </form>
                    <a class="btn btn-danger w-100 mt-3" href="./dashboard.php">Kembali Ke dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>