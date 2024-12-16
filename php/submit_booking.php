<?php
require 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerName = $_POST['customer-name'];
    $phoneNumber = $_POST['phone-number'];
    $address = $_POST['address'];
    $service = $_POST['service'];
    $discount = $_POST['discount'];
    $payment = $_POST['payment'];
    $datetime = $_POST['datetime'];
    $note = $_POST['note'];

    $stmt = $pdo->prepare('INSERT INTO bookings (customer_name, phone_number, address, service, discount, payment, datetime, note) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$customerName, $phoneNumber, $address, $service, $discount, $payment, $datetime, $note]);

    echo '<script>
            alert("Booking submitted successfully!");
            window.location.href = "../pages/booking.php";
          </script>';
}
?>