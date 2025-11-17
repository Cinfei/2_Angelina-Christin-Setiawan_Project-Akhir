<?php
session_start();
include 'koneksi.php';

$fullname = $_POST['fullname'];
$birth_date = $_POST['birth_date'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];

$check = mysqli_query($koneksi, "SELECT * FROM customers WHERE email='$email'");
if (mysqli_num_rows($check) > 0) {
    $_SESSION["notify"] = ["type"=>"error", "msg"=>"Email sudah terdaftar!"];
    header("Location: index.php");
    exit;
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$insert = mysqli_query($koneksi, "
    INSERT INTO customers (fullname, birth_date, phone, email, password_hash)
    VALUES ('$fullname', '$birth_date', '$phone', '$email', '$hash')
");

if ($insert) {
    $_SESSION["notify"] = ["type"=>"success", "msg"=>"Registrasi berhasil! Silakan login."];
    header("Location: index.php");
} else {
    $_SESSION["notify"] = ["type"=>"error", "msg"=>"Registrasi gagal!"];
    header("Location: index.php");
}
exit;
?>


