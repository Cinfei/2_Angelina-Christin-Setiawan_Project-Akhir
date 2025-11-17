<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sam’s Hotel</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
    /* ========= NAVBAR ACTIVE LINK (GARIS BAWAH) ========== */
    nav a {
      font-size: 16px;
      font-weight: 500;
      color: #444;
      text-decoration: none;
      margin: 0 18px;
      padding-bottom: 6px;
      border-bottom: 3px solid transparent;
      transition: 0.3s;
    }

    nav a.active {
      color: black;
      border-bottom: 3px solid black;
    }

    /* SUCCESS & ERROR POPUP */
    .notify-popup {
      position: fixed;
      top: -80px;
      left: 50%;
      transform: translateX(-50%);
      background: #4CAF50;
      color: white;
      padding: 15px 25px;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 500;
      transition: 0.5s;
      z-index: 9999;
      opacity: 0;
    }

    .notify-popup.error {
      background: #D9534F;
    }

    .notify-popup.show {
      top: 20px;
      opacity: 1;
    }

    /* Extra button style */
    .outline-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      border: 2px solid #444;
      border-radius: 6px;
      background: transparent;
      color: #444;
      cursor: pointer;
      transition: 0.3s;
      text-decoration: none;
      font-weight: 500;
    }

    .outline-btn:hover {
      background: #444;
      color: #fff;
    }

    .primary-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      border-radius: 6px;
      background: #444;
      color: #fff;
      cursor: pointer;
      transition: 0.3s;
      text-decoration: none;
      font-weight: 500;
    }

    .primary-btn:hover {
      background: #222;
    }
  </style>
</head>

<body>

  <!-- NOTIFICATION POPUP -->
  <div id="notifyPopup" class="notify-popup"></div>

  <!-- NAVBAR -->
  <header class="navbar">
    <div class="logo">Sam’s Hotel</div>
    <nav>
      <a href="#landing" class="active">Landing Page</a>
      <a href="about.php">About Us</a>
      <a href="login.php">Login</a>
    </nav>
  </header>

  <!-- LANDING PAGE -->
  <section class="landing" id="landing">
    <div class="text">
      <h1>Welcome</h1>
      <p>Discover Sam’s Hotel — a serene destination where modern comfort meets tropical luxury.</p>
      <a href="book.php" class="primary-btn">Book Now</a>
      <a href="about.php" class="outline-btn">Learn More</a>
      <a href="login.php" class="outline-btn">Login</a>
    </div>
    <img src="suite.jpeg" alt="Hotel Image" style="width:45%; border-radius:10px;">
  </section>

  <!-- ROOM LIST SECTION -->
  <section class="rooms" id="rooms">
    <h2 class="section-title">Our Rooms</h2>
    <p class="section-subtitle">Choose the perfect room for your stay</p>

    <div class="room-container">
      <div class="room-card">
        <img src="deluxe.jpeg" alt="Deluxe Room">
        <h3>Deluxe Room</h3>
        <p>Spacious room with balcony view and king-size bed.</p>
         <p> Rp 1.500.000/night</p>
        <a href="book.php?room=Deluxe" class="book-btn">Book Now</a>
      </div>

      <div class="room-card">
        <img src="suite.jpeg" alt="Suite Room">
        <h3>Suite Room</h3>
        
        <p>Luxury suite with living room and premium amenities.</p>
        <p>  Rp 2.500.000/night</p>

        <a href="book.php?room=Suite" class="book-btn">Book Now</a>
      </div>

      <div class="room-card">
        <img src="family.jpeg" alt="Family Room">
        <h3>Family Room</h3>
        <p>Perfect for families, includes 2 queen beds.</p>
        <p>  Rp 4.000.000/night </p>
        

        <a href="book.php?room=Family" class="book-btn">Book Now</a>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    ©️ Sam's Hotel - Angelina C @2019
  </footer>

  <!-- SCRIPT -->
  <script>
    /* ====== NAVBAR ACTIVE ON SCROLL ====== */
    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll("nav a");

    function activateMenu() {
      let current = "";
      sections.forEach(sec => {
        const top = window.scrollY;
        const offset = sec.offsetTop - 150;
        const height = sec.offsetHeight;
        if (top >= offset && top < offset + height) {
          current = sec.getAttribute("id");
        }
      });
      navLinks.forEach(a => {
        a.classList.remove("active");
        if (a.getAttribute("href") === "#" + current) {
          a.classList.add("active");
        }
      });
    }

    window.addEventListener("scroll", activateMenu);

    /* Smooth scroll on click */
    navLinks.forEach(link => {
      link.addEventListener("click", function (e) {
        if (this.getAttribute("href").startsWith("#")) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute("href"));
          window.scrollTo({
            top: target.offsetTop - 80,
            behavior: "smooth"
          });
          navLinks.forEach(a => a.classList.remove("active"));
          this.classList.add("active");
        }
      });
    });

    /* PHP FLASH POPUP */
    <?php if (isset($_SESSION["notify"])) { ?>
      const np = document.getElementById("notifyPopup");
      np.innerText = "<?= $_SESSION["notify"]["msg"] ?>";
      if ("<?= $_SESSION["notify"]["type"] ?>" === "error") {
        np.classList.add("error");
      }
      np.classList.add("show");
      setTimeout(() => np.classList.remove("show"), 3000);
    <?php unset($_SESSION["notify"]); } ?>
  </script>

</body>
</html>
