<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
    <?php
    require_once '../php/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
        } elseif (isset($_POST['save'])) {
            if (!empty($_POST['id'])) {
                $stmt = $pdo->prepare("UPDATE bookings SET user_id = :user_id, service_id = :service_id, date = :date WHERE id = :id");
                $stmt->execute(['user_id' => $_POST['user_id'], 'service_id' => $_POST['service_id'], 'date' => $_POST['date'], 'id' => $_POST['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO bookings (user_id, service_id, date) VALUES (:user_id, :service_id, :date)");
                $stmt->execute(['user_id' => $_POST['user_id'], 'service_id' => $_POST['service_id'], 'date' => $_POST['date']]);
            }
        }
    }

    $bookings = $pdo->query("SELECT * FROM bookings")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Manage Bookings</h2>
    <p>Here you can manage bookings.</p>

    <button onclick="toggleForm()">Add Booking</button>

    <form id="bookingForm" method="post" style="display: none;">
        <input type="hidden" name="id" id="id">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id" required>
        <label for="service_id">Service ID:</label>
        <input type="text" name="service_id" id="service_id" required>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" required>
        <button type="submit" name="save">Save</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Service ID</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr onclick="editBooking(<?php echo htmlspecialchars(json_encode($booking)); ?>)">
                    <td><?php echo htmlspecialchars($booking['booking_id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['user_id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['service_id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['booking_date']); ?></td>
                    <td>
                        <form method="post" style="display:inline;"></form>
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($booking['booking_id']); ?>">
                        <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editBooking(booking) {
            document.getElementById('id').value = booking.id;
            document.getElementById('user_id').value = booking.user_id;
            document.getElementById('service_id').value = booking.service_id;
            document.getElementById('date').value = booking.date;
            document.getElementById('bookingForm').style.display = 'block';
        }

        function toggleForm() {
            var form = document.getElementById('bookingForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>

</html>