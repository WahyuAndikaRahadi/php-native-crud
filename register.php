<?php
include 'koneksi.php';
session_start();
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = "user";

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name','$email','$password', '$role')";
    $email_check = "SELECT * FROM users WHERE email = '$email'";
    $result_email = $conn->query($email_check);
    if($result_email->num_rows > 0) {
        $message = "<div class='alert alert-danger mt-3' role='alert'>Akun Email Sudah Terdaftar</div>";
    } else {
        $result = $conn->query($sql);
        $message =  "<div class='alert alert-success mt-3' role='alert'>Pendaftaran Berhasil</div>";
    };
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body  class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="mb-3 text-center">
                        <h2>REGISTER</h2>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" required placeholder="Masukan Nama">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required placeholder="Masukan Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required placeholder="Masukan Password">
                        </div>
                        <?=$message ?>
                        <button class="btn btn-success w-100" type="submit">Submit Register</button>
                    </form>
                    <a href="./login.php" class="btn btn-primary w-100 mt-3">Beralih Ke Login</a>
                    <a href="./index.php" class="btn btn-danger w-100 mt-3">Kembali Ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>