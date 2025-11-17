<?php
session_start();
include 'koneksi.php';

// pilih koneksi mysqli
if (isset($conn) && $conn instanceof mysqli) $db = $conn;
elseif (isset($koneksi) && $koneksi instanceof mysqli) $db = $koneksi;
else die('Koneksi database tidak ditemukan.');

// simple handler
$msg = '';
$msgType = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $roomtype  = trim($_POST['roomtype'] ?? '');
  $checkin   = trim($_POST['checkin'] ?? '');
  $checkout  = trim($_POST['checkout'] ?? '');
  $guests    = (int) ($_POST['guests'] ?? 1);

  if ($roomtype === '' || $checkin === '' || $checkout === '') {
    $msg = 'Tipe kamar, check-in, dan check-out harus diisi.';
    $msgType = 'error';
  } else {
    // insert ke tabel rooms
    $stmt = $db->prepare("INSERT INTO rooms (roomtype, checkin, checkout, guests) VALUES (?, ?, ?, ?)");
    if ($stmt) {
      $stmt->bind_param('sssi', $roomtype, $checkin, $checkout, $guests);
      if ($stmt->execute()) {
        $msg = 'Data kamar berhasil ditambahkan.';
        $msgType = 'success';
        // kosongkan form
        $roomtype = $checkin = $checkout = '';
        $guests = 1;
      } else {
        $msg = 'Gagal menyimpan: ' . $stmt->error;
        $msgType = 'error';
      }
      $stmt->close();
    } else {
      $msg = 'Query error: ' . $db->error;
      $msgType = 'error';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Input Data Kamar - Sam's Hotel</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <style>
    .container { padding: 40px 6%; }
    .card { max-width:480px; margin:28px auto; padding:26px; border-radius:12px; background:#fff; box-shadow:0 10px 30px rgba(0,0,0,0.06); }
    label { display:block; margin-bottom:6px; color:#444; font-size:14px; }
    input[type="text"], input[type="date"], input[type="number"], textarea, select { width:100%; padding:12px; border-radius:8px; border:1px solid #e6e9ef; margin-bottom:12px; box-sizing:border-box; }
    .btn-primary { background:#002B5C; color:#fff; padding:10px 16px; border-radius:8px; border:none; cursor:pointer; font-weight:600; }
    .msg { padding:10px 14px; border-radius:8px; margin-bottom:12px; }
    .msg.success { background:#e6f8ee; color:#1b6f3a; }
    .msg.error { background:#fdecea; color:#a72828; }
  </style>
</head>
<body>

  <header class="navbar">
    <div class="logo">Sam's Hotel</div>
    <nav>
      <a href="index.php">Landing Page</a>
      <a href="about.php">About Us</a>
      <a href="inputdata.php" class="active">Input Kamar</a>
      <a href="viewdata.php">View Data</a>
      <?php if(isset($_SESSION["fullname"])) {
        $firstname = explode(" ", $_SESSION["fullname"])[0];
      ?>
        <button class="btn-login"><?= $firstname ?></button>
      <?php } else { ?>
        <a href="login.php" class="btn-login">Login</a>
      <?php } ?>
    </nav>
  </header>

  <main class="container">
    <div class="card" role="main" aria-labelledby="title">
      <h2 id="title" style="color:#002B5C;margin:0 0 12px">Input Data Kamar</h2>

      <?php if($msg): ?>
        <div class="msg <?= $msgType === 'success' ? 'success' : 'error' ?>"><?= htmlspecialchars($msg) ?></div>
      <?php endif; ?>

      <form method="post" action="inputdata.php">
        <label for="roomtype">Tipe Kamar</label>
        <select id="roomtype" name="roomtype" required>
          <option value="">-- Pilih Tipe Kamar --</option>
          <option value="Suite" <?= (isset($roomtype) && $roomtype === 'Suite') ? 'selected' : '' ?>>Suite</option>
          <option value="Family" <?= (isset($roomtype) && $roomtype === 'Family') ? 'selected' : '' ?>>Family</option>
          <option value="Deluxe" <?= (isset($roomtype) && $roomtype === 'Deluxe') ? 'selected' : '' ?>>Deluxe</option>
        </select>

        <label for="checkin">Check-in</label>
        <input id="checkin" name="checkin" type="date" value="<?= htmlspecialchars($checkin ?? '') ?>" required>

        <label for="checkout">Check-out</label>
        <input id="checkout" name="checkout" type="date" value="<?= htmlspecialchars($checkout ?? '') ?>" required>

        <label for="guests">Jumlah Tamu</label>
        <input id="guests" name="guests" type="number" min="1" value="<?= htmlspecialchars($guests ?? 1) ?>">

        <div style="margin-top:12px;">
          <button type="submit" class="btn-primary">Simpan Data</button>
        </div>
      </form>
    </div>
  </main>

  <footer style="text-align:center;padding:18px 0;background:#fafafa;border-top:1px solid #eee;">
    ©️ Sam's Hotel
  </footer>

</body>
</html>