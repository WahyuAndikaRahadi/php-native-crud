<?php 
include "koneksi.php";
session_start();
if($_SESSION["role"] !== "admin") {
    header("location: index.php");
    exit();
}

$id = $_GET["id"];

$sql = "DELETE FROM products WHERE id = '$id'";
$conn->query($sql);

header("location: dashboard.php");

?>