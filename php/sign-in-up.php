<?php
session_start();
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && $password == $user['password_hash']) {
            $_SESSION['username'] = $user['username'];
            if ($user['username'] == 'admin') {
                header('Location: ../pages/admin.php');
            } else {
                header('Location: ../index.php');
            }
            exit();
        } else {
            echo '<script>
                    localStorage.setItem("signinFail", "true");
                    window.location.href = "../pages/signin.php";
                  </script>';
            exit();
        }
    } elseif (isset($_POST['new-username']) && isset($_POST['new-password']) && isset($_POST['new-email']) && isset($_POST['new-phoneNumber']) && isset($_POST['new-address'])) {
        // Sign-up logic
        $newUsername = $_POST['new-username'];
        $newPassword = $_POST['new-password'];
        $newEmail = $_POST['new-email'];
        $newPhoneNumber = $_POST['new-phoneNumber'];
        $status = "customer";

        $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, email, phone_number, user_type) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$newUsername, $newPassword, $newEmail, $newPhoneNumber, $status]);

        echo '<script>
                localStorage.setItem("signupSuccess", "true");
                window.location.href = "../pages/signin.php";
              </script>';
        exit();
    }
}
?>