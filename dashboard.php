<?php
include "koneksi.php";
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    exit();
}
$is_admin = $_SESSION["role"] == "admin";
$is_user = $_SESSION["role"] == "user";

$sql = "SELECT * FROM products";
$products = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container mt-3">
        <div class="mb-3">
            <h2>Halo,<b> <?= ($_SESSION["username"]) ?></b> Selamat Datang di Dashboard <?php if($is_admin):?> Admin <?php endif;?><?php if($is_user):?> User <?php endif;?></h2>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>

                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Deskripsi Produk</th>
                    <?php if ($is_admin): ?>
                        <th>Aksi Produk</th>
                    <?php endif; ?>
                    <?php if ($is_user): ?>
                        <th>Checkout</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["product_name"] ?></td>
                        <td>Rp. <?= $row["product_price"] ?></td>
                        <td><?= $row["product_description"] ?></td>
                        <?php if ($is_admin): ?>
                            <td>
                                <a href="edit_product.php?id=<?= $row["id"] ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                <a href="delete_product.php?id=<?= $row["id"] ?>" class="btn btn-danger btn-sm">hapus</a>
                            </td>
                    </tr>
                <?php endif; ?>
                <?php if ($is_user): ?>
                    <td>
                        <a href="checkout_product.php?id=<?= $row["id"] ?>" class="btn btn-secondary btn-sm">Beli Produk</a>
                    </td>
                <?php endif; ?>
            <?php endwhile; ?>
            </tbody>
        </table>
        <div class="mt-5">
            <?php if ($is_admin): ?>
                <a href="add_product.php" class="btn btn-primary mb-3 w-50">Tambah Produk</a>
                <?php endif; ?>
                <a href="logout.php" class="btn btn-danger w-50">Logout</a>
            </div>
    </div>
</body>
</html>