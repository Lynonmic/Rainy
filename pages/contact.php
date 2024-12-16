<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/contact.css" />
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
        <?php generateNav('contact'); ?>
      </nav>
    </div>
  </header>
  <main class="main">
    <h1>Contact Us</h1>
    <p>Details about how to contact us...</p>
    <div class="contact-map">
      <h2>Find Us Here</h2>
      <iframe src="https://www.google.com/maps/embed/v1/view?key=YOUR_API_KEY&center=YOUR_LAT,YOUR_LNG&zoom=14"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
  </main>
  <script src="../javascript/main.js"></script>
</body>

</html>