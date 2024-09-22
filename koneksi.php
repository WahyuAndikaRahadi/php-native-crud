<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "seleksi-wahyu";

$conn = new mysqli($hostname, $username, $password, $database);
if($conn->connect_error) {
    die("Disconnect:" . $conn->connect_error);
}