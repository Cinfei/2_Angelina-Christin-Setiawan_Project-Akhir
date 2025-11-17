<?php
include 'koneksi.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Sam's Hotel</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
    /* Navbar tweaks to match index.php */
    nav a { font-size:16px; margin:0 14px; text-decoration:none; color:#444; padding-bottom:6px; }
    nav a.active { color:#000; border-bottom:3px solid #000; }

    /* Hero / form */
    .landing {
      min-height: calc(100vh - 80px);
      display: flex;
      align-items: center;
      justify-content: center;
      background: url('suite.jpeg') no-repeat center center/cover;
      position: relative;
    }
    .landing::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0,0,0,0.36);
      z-index: 1;
    }

    .card {
      position: relative;
      z-index: 2;
      width: 420px;
      background: rgba(255,255,255,0.98);
      padding: 36px;
      border-radius: 12px;
      box-shadow: 0 12px 36px rgba(12,40,80,0.12);
    }
    .card h2 { margin:0 0 12px; color:#002B5C; font-size:22px; }
    .card p { margin:0 0 18px; color:#555; }

    .field { margin-bottom:12px; }
    .field input {
      width:100%; padding:12px; border-radius:8px; border:1px solid #e6e9ef; font-size:14px;
    }
    .actions { display:flex; gap:10px; align-items:center; margin-top:12px; }
    .btn-primary {
      background:#002B5C; color:#fff; border:none; padding:12px 18px; border-radius:8px; cursor:pointer; font-weight:600;
    }
    .btn-ghost {
      background:transparent; border:1px solid #ccc; padding:10px 14px; border-radius:8px; cursor:pointer;
    }

    .small-link { display:block; margin-top:14px; text-align:center; color:#555; }
    .small-link a { color:#002B5C; text-decoration:none; font-weight:600; }

    /* notification popup */
    .notify-popup {
      position: fixed; top: -80px; left: 50%; transform: translateX(-50%);
      background: #4CAF50; color: white; padding: 12px 20px; border-radius: 8px;
      font-size: 15px; font-weight: 500; transition: 0.45s; z-index: 9999; opacity: 0;
    }
    .notify-popup.error { background: #D9534F; }
    .notify-popup.show { top: 22px; opacity: 1; }

    @media (max-width: 640px) {
      .card { width: 92%; padding: 22px; }
    }
  </style>
</head>
<body>

  <div id="notifyPopup" class="notify-popup" role="status" aria-live="polite"></div>

  <header class="navbar">
    <div class="logo">Sam’s Hotel</div>
    <nav>
      <a href="index.php">Landing Page</a>
      <a href="about.php">About Us</a>

      <?php if(isset($_SESSION["fullname"])) {
        $firstname = explode(" ", $_SESSION["fullname"])[0];
      ?>
        <button class="btn-login"><?= $firstname ?></button>
      <?php } else { ?>
        <a href="login.php" class="btn-login">Login</a>
      <?php } ?>
    </nav>
  </header>

  <main class="landing" role="main">
    <div class="card" aria-labelledby="regTitle">
      <h2 id="regTitle">Create an account</h2>
      <p>Daftar untuk mendapatkan akses ke pemesanan dan penawaran khusus Sam's Hotel.</p>

      <form action="proses_register.php" method="POST" autocomplete="on">
        <div class="field">
          <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
        </div>

        <div class="field">
          <input type="number" name="umur" placeholder="Umur" min="1" required>
        </div>

        <div class="field">
          <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="field">
          <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="field">
          <input type="text" name="alamat" placeholder="Alamat" required>
        </div>

        <div class="actions">
          <button type="submit" class="btn-primary">Register</button>
          <a href="login.php" class="btn-ghost" role="button">Already have an account?</a>
        </div>
      </form>

      <div class="small-link">
        Dengan mendaftar Anda menyetujui <a href="#">Syarat & Ketentuan</a>
      </div>
    </div>
  </main>

  <footer style="text-align:center;padding:18px 0;background:#fafafa;border-top:1px solid #eee;">
    ©️ Sam's Hotel - Angelina C @2019
  </footer>

  <script>
    // show transient notify if session set
    <?php if (isset($_SESSION["notify"])) { ?>
      (function(){
        const np = document.getElementById("notifyPopup");
        np.textContent = "<?= addslashes($_SESSION["notify"]["msg"]) ?>";
        if ("<?= $_SESSION["notify"]["type"] ?>" === "error") np.classList.add("error");
        np.classList.add("show");
        setTimeout(()=> np.classList.remove("show"), 3200);
      })();
    <?php unset($_SESSION["notify"]); } ?>
  </script>

</body>
</html>
// ...existing code...