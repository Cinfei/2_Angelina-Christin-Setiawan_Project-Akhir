<?php
session_start();
include 'koneksi.php';

// hanya terima POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: inputdata.php');
  exit;
}

$identifier = trim($_POST['identifier'] ?? '');
$password   = $_POST['password'] ?? '';

if ($identifier === '' || $password === '') {
  header('Location: login.php?error=' . urlencode('Email dan password harus diisi.'));
  exit;
}

// pilih koneksi mysqli dari koneksi.php
if (isset($conn) && $conn instanceof mysqli) {
  $db = $conn;
} elseif (isset($koneksi) && $koneksi instanceof mysqli) {
  $db = $koneksi;
} else {
  header('Location: login.php?error=' . urlencode('Koneksi database tidak ditemukan.'));
  exit;
}

// ambil user berdasarkan email atau (opsional) nama lengkap agar kompatibel dengan form "Email or Username"
$stmt = $db->prepare("SELECT namalengkap, password FROM users WHERE email = ? OR namalengkap = ? LIMIT 1");
if (!$stmt) {
  header('Location: login.php?error=' . urlencode('Terjadi kesalahan database.'));
  exit;
}
$stmt->bind_param('ss', $identifier, $identifier);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
  $stmt->close();
  header('Location: login.php?error=' . urlencode('Akun tidak ditemukan.'));
  exit;
}

$stmt->bind_result($fullname, $hash);
$stmt->fetch();
$stmt->close();

// verifikasi password (mendukung hash dari password_hash)
if (password_verify($password, $hash)) {
  // login sukses
  $_SESSION['fullname'] = $fullname;
  header('Location: inputdata.php');
  exit;
} else {
  header('Location: login.php?error=' . urlencode('Email/Password salah.'));
  exit;
}
?>
// ...existing code...