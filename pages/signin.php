<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign-in</title>
  <link rel="stylesheet" href="../css/signin.css" />
</head>

<body>
  <div id="toast-success" class="toast">Sign-up successful!</div>
  <div id="toast-fail" class="toast">User not available, please sign up!</div>
  <button class="btn-return" onclick="window.location.href='../index.php'">
    Return to Home
  </button>
  <main class="main">
    <div class="signin-container">
      <div class="signin-image">
        <img src="../img/sign-in-welcome.jpg" alt="Sign-in Image" />
        <div class="welcome-text">Welcome back</div>
      </div>
      <div class="signin-form">
        <form id="signin-form" action="../php/sign-in-up.php" method="POST">
          <h2>Sign-in</h2>
          <label for="usernamel">Username/Email:</label>
          <input type="text" id="username" name="username" required />
          <label for="passwordl">Password:</label>
          <input type="password" id="password" name="password" required />
          <button type="submit">Submit</button>
          <p>
            If you don't have an account! Please
            <a href="#" onclick="toggleForm()">sign up here</a>.
          </p>
        </form>
        <form id="signup-form" action="../php/sign-in-up.php" method="POST" style="display: none">
          <h2>Sign-up</h2>
          <label for="new-username">Username:</label>
          <input type="text" id="new-username" name="new-username" required />
          <label for="new-password">Password:</label>
          <input type="password" id="new-password" name="new-password" required />
          <label for="new-email">Email:</label>
          <input type="text" id="new-email" name="new-email" required />
          <label for="new-phoneNumber">Phone number:</label>
          <input type="text" id="new-phoneNumber" name="new-phoneNumber" required />
          <button type="submit">Submit</button>
          <p>
            Already have an account? Please
            <a href="#" onclick="toggleForm()">sign in here</a>.
          </p>
        </form>
      </div>
    </div>
  </main>
  <script src="../javascript/main.js"></script>
</body>

</html>