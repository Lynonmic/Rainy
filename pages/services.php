<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link rel="stylesheet" href="../css/services.css" />
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
        <?php generateNav('services'); ?>
      </nav>
    </div>
  </header>
  <main class="main">
    <h1>Our Services</h1>
    <div class="bento-grid">
      <div class="bento-item">
        <h2>General House Cleaning</h2>
        <ul>
          <li>Wipe all surfaces: floors, tables, chairs, cabinets, windows, mirrors...</li>
          <li>Vacuum, mop floors, carpets</li>
          <li>Clean the kitchen: wipe stove, hood, refrigerator, microwave</li>
          <li>Clean the bathroom: wipe toilet, sink, mirror, shower</li>
          <li>Organize items neatly</li>
          <li>Replace sanitary items (if requested)</li>
        </ul>
        <a href="booking.php"><button type="button" class="btn-signin">Booking now!</button></a>
      </div>
      <div class="bento-item">
        <h2>Post-Construction Cleaning</h2>
        <ul>
          <li>Collect and dispose of construction waste</li>
          <li>Wipe surfaces covered with dust, paint</li>
          <li>Clean construction site toilets</li>
          <li>Clean window and door glass</li>
          <li>Reorganize items and tools</li>
        </ul>
        <a href="booking.php"><button type="button" class="btn-signin">Booking now!</button></a>

      </div>
      <div class="bento-item">
        <h2>Office Cleaning</h2>
        <ul>
          <li>Wipe desks, chairs, file cabinets</li>
          <li>Vacuum floors, carpets</li>
          <li>Clean office kitchen</li>
          <li>Wipe window and door glass</li>
          <li>Clean the bathroom</li>
          <li>Take out trash, replace trash bags</li>
        </ul>
        <a href="booking.php"><button type="button" class="btn-signin">Booking now!</button></a>

      </div>
      <div class="bento-item">
        <h2>Custom Cleaning</h2>
        <ul>
          <li>Flexibly meet all customer needs</li>
          <li>Can focus on specific areas as requested (e.g., clean kitchen cabinets, wipe glass, wash curtains...)</li>
          <li>Use specialized, safe cleaning products</li>
        </ul>
        <a href="booking.php"><button type="button" class="btn-signin">Booking now!</button></a>

      </div>
    </div>
  </main>
  <script src="../javascript/main.js"></script>
</body>

</html>