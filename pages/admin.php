<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/admin.css" />
</head>

<body>
  <div class="header">
    <button class="sidebar-toggle" onclick="toggleSidebar()">☰</button>
  </div>
  <div class="admin-container">
    <aside class="sidebar">
      <nav class="nav">
        <ul>
          <li class="nav-item">
            <a href="#" onclick="loadContent('manage-users')"><span class="icon">👥</span> Manage Users</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('manage-services')"><span class="icon">🛠️</span> Manage Services</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('manage-bookings')"><span class="icon">📅</span> Manage Bookings</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('payments')"><span class="icon">💳</span> Payments</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('manage-staff')"><span class="icon">👨‍💼</span> Manage Staff</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('manage-reviews')"><span class="icon">⭐</span> Manage Reviews</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('promotions')"><span class="icon">🎁</span> Promotions</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('contact-queries')"><span class="icon">📧</span> Contact Queries</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('settings')"><span class="icon">⚙️</span> Settings</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('reports')"><span class="icon">📊</span> Reports</a>
          </li>
          <li class="nav-item">
            <a href="#" onclick="loadContent('notifications')"><span class="icon">🔔</span> System Notifications</a>
          </li>
          <li class="nav-item">
            <a href="../index.php"><span class="icon">🚪</span> Logout</a>
          </li>
        </ul>
      </nav>
    </aside>
    <main class="main">
      <iframe id="content-frame" src="../php/load_content.php" frameborder="0" class="frame"></iframe>
    </main>
  </div>
  <script src="../javascript/main.js"></script>
  <script>
    function toggleSidebar() {
      document.querySelector('.sidebar').classList.toggle('collapsed');
      document.querySelector('.main').classList.toggle('collapsed');
    }
  </script>
</body>

</html>