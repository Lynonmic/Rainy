<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/styles.css" />
</head>

<body>
  <?php session_start(); ?>
  <?php include './php/nav.php'; ?>
  <header class="header">
    <div class="container">
      <div class="logo">
        <span>🌿</span>
        <h1>RAINY</h1>
      </div>
      <span class="nav-toggle" onclick="toggleNav()">☰</span>
      <nav class="nav">
        <?php generateNav('home'); ?>
      </nav>
    </div>
  </header>
  <main class="main">
    <div class="hero">
      <div class="carousel">
        <div class="carousel-images">
          <div class="carousel-slide">
            <img src="./img/image1.png" alt="Soap Display 1" />
            <div class="hero-content">
              <h2>Clean.<br />Moisture.<br />Care.</h2>
            </div>
          </div>
          <div class="carousel-slide">
            <img src="./img/image2.png" alt="Soap Display 2" />
            <div class="hero-content hero-content-blue">
              <h2>Natural.<br />Fresh.<br />Pure.</h2>
            </div>
          </div>
          <div class="carousel-slide">
            <img src="./img/sile_3.png" alt="Soap Display 3" />
            <div class="hero-content hero-content-green">
              <h2>Organic.<br />Healthy.<br />Glow.</h2>
            </div>
          </div>
        </div>
        <div class="carousel-buttons">
          <button class="carousel-button" onclick="prevSlide()">❮</button>
          <button class="carousel-button" onclick="nextSlide()">❯</button>
        </div>
      </div>
    </div>

    <div class="gallery">
      <div class="gallery-item">
        <div class="gallery-content">
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </p>
          <button class="btn">SHOP NOW</button>
        </div>
      </div>
      <div class="gallery-item">
        <img src="./img/gallery_1.jpeg" alt="Soap 1" />
      </div>
      <div class="gallery-item">
        <img src="./img/gallery_2.jpg" alt="Soap 2" />
      </div>
      <div class="gallery-item">
        <img src="./img/gallery_3.webp" alt="Soap 3" />
      </div>
    </div>
  </main>
  <script src="javascript/main.js"></script>
</body>

</html>