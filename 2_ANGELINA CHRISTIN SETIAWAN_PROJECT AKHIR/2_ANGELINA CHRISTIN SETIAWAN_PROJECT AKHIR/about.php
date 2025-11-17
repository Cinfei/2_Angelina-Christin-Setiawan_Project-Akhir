<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About - Sam's Hotel</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

  <style>
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

    /* Carousel */
    .carousel-container {
      max-width: 900px;
      margin: 28px auto;
      position: relative;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    }
    .carousel-slide { display: none; }
    .carousel-slide img {
      width: 100%;
      height: 420px;
      object-fit: cover;
      display: block;
    }
    .prev, .next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(0,0,0,0.45);
      color: #fff;
      padding: 10px 14px;
      cursor: pointer;
      border-radius: 50%;
      font-size: 18px;
      user-select: none;
    }
    .prev { left: 12px; }
    .next { right: 12px; }

    /* Facilities area: left = vertical cards, right = explanation */
    .facility-wrapper {
      max-width: 1100px;
      margin: 28px auto;
      display: flex;
      gap: 24px;
      align-items: flex-start;
      padding: 0 12px;
    }
    .facility-cards {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }
    .facility-card {
      display: flex;
      gap: 12px;
      background: #fff;
      padding: 12px;
      border-radius: 8px;
      align-items: center;
      box-shadow: 0 3px 10px rgba(0,0,0,0.06);
    }
    .facility-card img {
      width: 140px;
      height: 96px;
      object-fit: cover;
      border-radius: 6px;
    }
    .facility-info h3 { margin: 0 0 6px; font-size: 18px; }
    .facility-info p { margin: 0; color: #555; }

    .facility-desc {
      width: 420px;
      min-width: 260px;
      background: #f7f7f9;
      padding: 18px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.04);
      color: #333;
      line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 880px) {
      .carousel-slide img { height: 260px; }
      .facility-wrapper { flex-direction: column; padding: 0 16px; }
      .facility-desc { width: 100%; }
    }
  </style>
</head>

<body>

  <!-- HEADER (rapikan agar mirip index.php) -->
  <header class="navbar">
    <div class="logo">Sam’s Hotel</div>
    <nav>
      <a href="index.php">Landing Page</a>
      <a href="about.php" class="active">About Us</a>
      <a href="login.php">Login</a>
    </nav>
  </header>

  <section class="about">

    <!-- CAROUSEL (centered) -->
    <div class="carousel-container" aria-label="Image carousel">
      <div class="carousel-slide"><img src="slide1.jpeg" alt="Slide 1"></div>
      <div class="carousel-slide"><img src="slide2.jpeg" alt="Slide 2"></div>
      <div class="carousel-slide"><img src="slide3.jpeg" alt="Slide 3"></div>
      <div class="carousel-slide"><img src="slide4.jpeg" alt="Slide 4"></div>

      <a class="prev" onclick="plusSlides(-1)" aria-label="Previous">&#10094;</a>
      <a class="next" onclick="plusSlides(1)" aria-label="Next">&#10095;</a>
    </div>

    <!-- ABOUT TEXT -->
    <div class="about-text" style="max-width:1100px;margin:18px auto;padding:0 12px;">
      <h2>About Sam's Hotel</h2>
      <p>
        Sam's Hotel adalah hotel premium yang menawarkan pengalaman menginap modern,
        nyaman, dan mewah dengan suasana tropis khas Bali.
      </p>
    </div>

    <!-- FACILITIES: vertical cards left + explanation right -->
    <div class="facility-wrapper">

      <div class="facility-cards">
        <div class="facility-card">
          <img src="facility1.jpeg" alt="Luxury Pool">
          <div class="facility-info">
            <h3>Luxury Pool</h3>
            <p>Kolam renang tropis dengan pemandangan premium.</p>
          </div>
        </div>

        <div class="facility-card">
          <img src="facility2.jpeg" alt="Relaxing Spa">
          <div class="facility-info">
            <h3>Relaxing Spa</h3>
            <p>Spa eksklusif dengan perawatan mewah.</p>
          </div>
        </div>

        <div class="facility-card">
          <img src="facility3.jpeg" alt="Fine Dining">
          <div class="facility-info">
            <h3>Fine Dining</h3>
            <p>Restoran elegan dengan menu internasional.</p>
          </div>
        </div>
      </div>

      <div class="facility-desc">
        <h3>Fasilitas & Layanan</h3>
        <p>
          Di Sam's Hotel kami menyediakan fasilitas lengkap untuk kenyamanan tamu:
          kolam renang, spa, pusat kebugaran, restoran internasional, dan layanan kamar 24 jam.
          Setiap fasilitas dirancang untuk menghadirkan pengalaman menginap tak terlupakan.
        </p>
        <ul>
          <li>Check-in cepat dan layanan concierge</li>
          <li>Paket spa dan relaksasi</li>
          <li>Menu musiman dan layanan catering private</li>
        </ul>
      </div>

    </div>

  </section>

  <footer style="text-align:center;padding:14px 0;">
    ©️ Sam's Hotel - Angelina C @2019
  </footer>

  <script>
    let slideIndex = 0;
    const slides = document.getElementsByClassName("carousel-slide");

    function showSlides() {
      if (!slides || slides.length === 0) return;
      for (let i = 0; i < slides.length; i++) slides[i].style.display = "none";
      slideIndex = (slideIndex + 1) % slides.length;
      slides[slideIndex].style.display = "block";
    }

    // Manual controls
    function plusSlides(n) {
      if (!slides || slides.length === 0) return;
      slides[slideIndex].style.display = "none";
      slideIndex = (slideIndex + n + slides.length) % slides.length;
      slides[slideIndex].style.display = "block";
      resetAuto();
    }

    // Auto slide
    let autoTimer = setInterval(showSlides, 3500);
    function resetAuto() {
      clearInterval(autoTimer);
      autoTimer = setInterval(showSlides, 3500);
    }

    // init
    showSlides();
  </script>

</body>
</html>
