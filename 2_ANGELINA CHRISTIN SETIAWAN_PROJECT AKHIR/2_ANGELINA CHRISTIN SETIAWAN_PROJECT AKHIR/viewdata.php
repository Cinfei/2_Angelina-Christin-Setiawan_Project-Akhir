<?php
session_start();
include 'koneksi.php';

// pilih koneksi mysqli dari koneksi.php
$db = null;
if (isset($conn) && $conn instanceof mysqli) $db = $conn;
elseif (isset($koneksi) && $koneksi instanceof mysqli) $db = $koneksi;
else die('Koneksi database tidak ditemukan.');

// ambil data kamar sesuai struktur tabel rooms
$result = $db->query("SELECT id, roomtype, checkin, checkout, guests FROM rooms ORDER BY id DESC");
$rows = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Data Kamar - Sam's Hotel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .wrap { padding:36px 6%; }
    .box { max-width:1100px; margin:20px auto; background:#fff; padding:18px; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,0.06); }
    table { width:100%; border-collapse:collapse; font-size:14px; }
    th, td { padding:10px; border-bottom:1px solid #eee; text-align:left; }
    th { background:#f6f9fc; color:#002B5C; font-weight:600; }
    .actions { display:flex; gap:6px; }
    .btn-update { background:#f0ad4e; color:#fff; padding:6px 10px; border-radius:6px; border:none; text-decoration:none; cursor:pointer; font-size:12px; }
    .btn-delete { background:#d9534f; color:#fff; padding:6px 10px; border-radius:6px; border:none; cursor:pointer; font-size:12px; }
    .empty { color:#666; padding:18px; text-align:center; }
    @media (max-width:800px) { table, thead, tbody, th, td, tr { display:block; } thead { display:none; } tr { margin-bottom:12px; border:1px solid #eee; padding:10px; border-radius:8px; } td:before { content:attr(data-label) ": "; font-weight:600; } }
  </style>
</head>
<body>

  <header class="navbar">
    <div class="logo">Sam's Hotel</div>
    <nav>
      <a href="index.php">Landing Page</a>
      <a href="about.php">About Us</a>
      <a href="inputdata.php">Input Kamar</a>
      <a href="viewdata.php" class="active">View Data</a>
      <?php if(isset($_SESSION["fullname"])) {
        $firstname = explode(" ", $_SESSION["fullname"])[0];
      ?>
        <button class="btn-login"><?= $firstname ?></button>
      <?php } else { ?>
        <a href="login.php" class="btn-login">Login</a>
      <?php } ?>
    </nav>
  </header>

  <main class="wrap">
    <div class="box">
      <h2 style="color:#002B5C;margin:0 0 12px">Daftar Kamar</h2>

      <?php if (empty($rows)): ?>
        <div class="empty">Belum ada data kamar.</div>
      <?php else: ?>
        <div style="overflow:auto">
          <table aria-label="Daftar kamar">
            <thead>
              <tr>
                <th style="width:50px">No</th>
                <th>Tipe Kamar</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th style="width:80px">Tamu</th>
                <th style="width:160px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($rows as $i => $r): ?>
                <tr>
                  <td data-label="No"><?= $i+1 ?></td>
                  <td data-label="Tipe Kamar"><?= htmlspecialchars($r['roomtype']) ?></td>
                  <td data-label="Check-in"><?= htmlspecialchars($r['checkin']) ?></td>
                  <td data-label="Check-out"><?= htmlspecialchars($r['checkout']) ?></td>
                  <td data-label="Tamu"><?= htmlspecialchars($r['guests']) ?></td>
                  <td data-label="Aksi">
                    <div class="actions">
                      <a href="update.php?id=<?= urlencode($r['id']) ?>" class="btn-update">Update</a>
                      <form method="post" action="delete.php" style="display:inline;" onsubmit="return confirm('Yakin hapus data ini?');">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($r['id']) ?>">
                        <button type="submit" class="btn-delete">Delete</button>
                      </form>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <footer style="text-align:center;padding:18px 0;background:#fafafa;border-top:1px solid #eee;">
    ©️ Sam's Hotel
  </footer>

</body>
</html>