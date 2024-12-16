<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/news.css" />
</head>

<body>
  <?php include '../php/nav.php'; ?>
  <header class="header">
    <div class="container">
      <div class="logo">
        <span>🌿</span>
        <h1>BORCELLE</h1>
      </div>
      <span class="nav-toggle" onclick="toggleNav()">☰</span>
      <nav class="nav">
        <?php generateNav('shop'); ?>
      </nav>
    </div>
  </header>
  <main class="main">
    <div class="bento-grid">
      <div class="bento-item first">
        <h2>Product 1</h2>
        <img src="../img/gallery_1.jpeg" alt="">
        <p>Details about product 1...</p>
      </div>
      <div class="bento-item">
        <h2>Product 1</h2>
        <img src="../img/gallery_1.jpeg" alt="">
        <p>Details about product 1...</p>
      </div>
      <div class="bento-item">
        <h2>Product 1</h2>
        <img src="../img/gallery_1.jpeg" alt="">
        <p>Details about product 1...</p>
      </div>
      <div class="bento-item">
        <h2>Product 2</h2>
        <img src="../img/gallery_1.jpeg" alt="">
        <p>Details about product 2...</p>
      </div>
      <div class="bento-item">
        <h2>Product 3</h2>
        <img src="../img/gallery_1.jpeg" alt="">
        <p>Details about product 3...</p>
      </div>
    </div>
  </main>
  <script src="../javascript/main.js"></script>
</body>

</html>