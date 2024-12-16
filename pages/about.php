<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/about.css" />
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
        <?php generateNav('about'); ?>
      </nav>
    </div>
  </header>
  <main class="about">
    <div class="container about-content">
      <div class="about-image">
        <img src="../images/ceo-image.jpg" alt="CEO Olivia Wilson" />
      </div>
      <div class="about-text">
        <h2>CEO</h2>
        <h3>Olivia Wilson</h3>
        <p>
          <strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna
            aliqua.</strong>
        </p>
        <p>
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
          nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur.
        </p>
        <p>
          Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
          officia deserunt mollit anim id est laborum.
        </p>
        <button class="btn">READ MORE</button>
      </div>
    </div>
  </main>
  <script src="../javascript/main.js"></script>
</body>

</html>