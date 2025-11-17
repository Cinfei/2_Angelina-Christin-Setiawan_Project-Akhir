<?php
session_start();
include 'koneksi.php';

// pilih koneksi mysqli
$db = null;
if (isset($conn) && $conn instanceof mysqli) $db = $conn;
elseif (isset($koneksi) && $koneksi instanceof mysqli) $db = $koneksi;
else {
  $_SESSION['msg'] = ['type'=>'error','text'=>'Koneksi database tidak ditemukan.'];
  header('Location: viewdata.php');
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: viewdata.php');
  exit;
}

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
if ($id <= 0) {
  $_SESSION['msg'] = ['type'=>'error','text'=>'ID tidak valid.'];
  header('Location: viewdata.php');
  exit;
}

$stmt = $db->prepare("DELETE FROM rooms WHERE id = ? LIMIT 1");
if (!$stmt) {
  $_SESSION['msg'] = ['type'=>'error','text'=>'Query error: '.$db->error];
  header('Location: viewdata.php');
  exit;
}
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
  $_SESSION['msg'] = ['type'=>'success','text'=>'Data berhasil dihapus.'];
} else {
  $_SESSION['msg'] = ['type'=>'error','text'=>'Gagal menghapus: '.$stmt->error];
}
$stmt->close();
header('Location: viewdata.php');
exit;
?>