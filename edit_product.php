<?php
include "koneksi.php";
session_start();
$message = "";
if ($_SESSION["role"] !== "admin") {
    header("location: index.php");
    exit();
}

$id = $_GET["id"];
$sql = "SELECT * FROM products WHERE id = '$id'";
$products = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name_product"];
    $price = $_POST["price_product"];
    $description = $_POST["description_product"];

    $sql = "UPDATE products SET product_name = '$name', product_price = '$price', product_description = '$description' WHERE id = '$id'";

    $conn->query($sql);

    $message = "<div class='alert alert-warning mt-3' role='alert'>Produk berhasil Di edit</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <div class="mt-3 text-center">
                        <h2>Update Product</h2>
                    </div>
                    <form method="POST">
                        <?php while ($row = $products->fetch_assoc()): ?>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control" name="name_product" id="name" required placeholder="Masukan Nama Produk" value='<?= $row["product_name"] ?>'>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">harga Produk</label>
                                <input type="number" class="form-control" name="price_product" id="price" required placeholder="Masukan harga Produk" value='<?= $row["product_price"] ?>'>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi Produk</label>
                                <input class="form-control p-4" name="description_product" id="description" required placeholder="Masukan Deskripsi Produk" value='<?= $row["product_description"] ?>'>
                            </div>
                        <?php endwhile; ?>
                        <?= $message?>
                        <button class="btn btn-warning text-white w-100" type="submit"> Update produk</button>
                    </form>
                    <a class="btn btn-danger w-100 mt-3" href="./dashboard.php">Kembali Ke dashboard</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>