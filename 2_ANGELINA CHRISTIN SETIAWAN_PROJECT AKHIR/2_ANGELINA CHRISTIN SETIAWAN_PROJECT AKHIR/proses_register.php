<?php
session_start();
include 'koneksi.php';

// pilih koneksi mysqli dari koneksi.php (cari $conn atau $koneksi)
if (isset($conn) && $conn instanceof mysqli) {
    $db = $conn;
} elseif (isset($koneksi) && $koneksi instanceof mysqli) {
    $db = $koneksi;
} else {
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Koneksi database tidak ditemukan.'];
    header('Location: register.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}

// ambil input
$nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
$umur = (int) ($_POST['umur'] ?? 0);
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$alamat = trim($_POST['alamat'] ?? '');

// validasi sederhana
if ($nama_lengkap === '' || $umur <= 0 || $email === '' || $password === '' || $alamat === '') {
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Semua field harus diisi.'];
    header('Location: register.php');
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Format email tidak valid.'];
    header('Location: register.php');
    exit;
}

// cek duplikat email
$stmt = $db->prepare("SELECT 1 FROM users WHERE email = ? LIMIT 1");
if (!$stmt) {
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Query error: '.$db->error];
    header('Location: register.php');
    exit;
}
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->close();
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Email sudah terdaftar.'];
    header('Location: register.php');
    exit;
}
$stmt->close();

// masukkan data (hash password)
$hash = password_hash($password, PASSWORD_DEFAULT);
$ins = $db->prepare("INSERT INTO users (namalengkap, umur, email, password, alamat) VALUES (?, ?, ?, ?, ?)");
if (!$ins) {
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Gagal menyiapkan query: '.$db->error];
    header('Location: register.php');
    exit;
}
$ins->bind_param('sisss', $nama_lengkap, $umur, $email, $hash, $alamat);
if ($ins->execute()) {
    $ins->close();
    $_SESSION['notify'] = ['type'=>'success','msg'=>'Pendaftaran berhasil. Silakan login.'];
    header('Location: login.php');
    exit;
} else {
    $err = $ins->error;
    $ins->close();
    $_SESSION['notify'] = ['type'=>'error','msg'=>'Pendaftaran gagal: '.$err];
    header('Location: success.php');
    exit;
}
?>
// ...existing code...