<?php 
include "koneksi.php";
session_start();
$message = "";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["username"] = $user["name"];
            header("location: dashboard.php");
        } else {
            $message = "<div class='alert alert-danger mt-3' role='alert'>Password Salah</div>";
        }
    } else  {
        $message =  "<div class='alert alert-danger mt-3' role='alert'>Akun Tidak Ditemukan</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <div class="mb-3 text-center">
                        <h2>LOGIN</h2>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" required placeholder="Masukan Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required placeholder="Masukan Password">
                        </div>
                        <?=$message ?>
                        <button class="btn btn-success w-100" type="submit">Submit Login</button>
                    </form>
                    <a href="./register.php" class="btn btn-primary w-100 mt-3">Beralih Ke Register</a>
                    <a href="./index.php" class="btn btn-danger w-100 mt-3">Kembali Ke Beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>