<?php
// ...existing code...
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - Sam's Hotel</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
    /* Minimal overrides so login matches index.php look */
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
      background: rgba(0,0,0,0.38);
      z-index: 1;
    }

    .login-box {
      position: relative;
      z-index: 2;
      width: 380px;
      background: rgba(255,255,255,0.98);
      padding: 36px 30px;
      border-radius: 12px;
      box-shadow: 0 12px 36px rgba(12,40,80,0.12);
      text-align: left;
    }
    .login-box h2 {
      margin: 0 0 18px;
      font-size: 22px;
      color: #002B5C;
      font-weight: 700;
    }
    .form-row { margin-bottom: 12px; }
    .form-row label {
      display:block;
      font-size: 13px;
      color: #444;
      margin-bottom:6px;
    }
    .form-row input {
      width:100%;
      padding: 12px;
      border-radius:8px;
      border:1px solid #e6e9ef;
      font-size:14px;
    }
    .login-actions {
      margin-top:18px;
      display:flex;
      gap:10px;
      align-items:center;
    }
    .btn-primary {
      background:#002B5C;
      color:#fff;
      border:none;
      padding:12px 18px;
      border-radius:8px;
      cursor:pointer;
      font-weight:600;
    }
    .btn-link {
      background:transparent;
      border:none;
      color:#002B5C;
      text-decoration:underline;
      cursor:pointer;
      font-size:14px;
    }

    /* small notification area */
    .notify {
      text-align:center;
      margin-bottom:10px;
      color:#b71c1c;
      font-size:14px;
    }

    @media (max-width:640px) {
      .login-box { width: 90%; padding: 24px; }
    }
  </style>
</head>
<body>

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
    <div class="login-box" aria-labelledby="loginTitle">
      <h2 id="loginTitle">Sign in to your account</h2>

      <?php if(isset($_GET['error']) && $_GET['error'] !== ''): ?>
        <div class="notify"><?= htmlentities($_GET['error']) ?></div>
      <?php endif; ?>

      <form action="authenticate.php" method="post" autocomplete="on">
        <div class="form-row">
          <label for="email">Email or Username</label>
          <input id="email" name="identifier" type="text" placeholder="you@example.com" required>
        </div>

        <div class="form-row">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="••••••••" required>
        </div>

        <div class="login-actions">
          <button type="submit" class="btn-primary">Login</button>
          <a href="register.php" class="btn-link">Create account</a>
        </div>
      </form>
    </div>
  </main>

  <footer style="text-align:center;padding:18px 0;background:#fafafa;border-top:1px solid #eee;">
    © Sam's Hotel
  </footer>

</body>
</html>
// ...existing code...
```// filepath: