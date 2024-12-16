<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Profile</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/user.css" />
</head>

<body>
    <?php
    session_start();
    include '../php/nav.php';
    require '../php/connect.php';

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$_SESSION['username']]);
    $user = $stmt->fetch();

    $stmtBookings = $pdo->prepare('SELECT * FROM bookings WHERE user_id = ( SELECT id FROM users WHERE username = ? )');
    $stmtBookings->execute([$_SESSION['username']]);
    $bookings = $stmtBookings->fetchAll();



    ?>


    <header class="header">
        <div class="container">
            <button class="btn-return" onclick="window.location.href='../index.php'">Return to Home</button>
            <div class="user-info">
                <img src="../img/user.png" alt="User Image" class="user-img" />
                <span class="username"><?php echo htmlspecialchars($user['username']); ?></span>
            </div>
        </div>
    </header>
    <div class="user-container">
        <aside class="sidebar">
            <nav class="nav">
                <ul>
                    <li class="nav-item">
                        <a href="#user-info">User Information</a>
                    </li>
                    <li class="nav-item">
                        <a href="#booking-detail">Booking Detail</a>
                    </li>
                    <li class="nav-item">
                        <a href="#booking-list">List of Bookings</a>
                    </li>
                </ul>
            </nav>
        </aside>
        <main class="main">
            <section id="user-info">
                <h2>User Information</h2>
                <p>Name: <?php echo htmlspecialchars($user['username']); ?></p>
                <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                <p>Phone Number: <?php echo htmlspecialchars($user['phone_number']); ?></p>
            </section>
            <section id="booking-detail">
                <h2>Booking Detail</h2>
                <?php if (!empty($booking)) { ?>
                    <p>Booking date: <?php echo htmlspecialchars($bookings[0]['booking_date']); ?></p>
                    <p>Cleaning time: <?php echo htmlspecialchars($bookings[0]['time_slot']); ?></p>
                    <p>Status: <?php echo htmlspecialchars($bookings['status']); ?></p>
                <?php } else { ?>
                    <p>No booking available</p>
                <?php } ?>
            </section>
            <section id="booking-list">
                <h2>List of Bookings</h2>
                <ul>
                    <?php
                    if (!empty($bookings))
                        foreach ($bookings as $booking): ?>
                            <li>
                                <p>Service: <?php echo htmlspecialchars($booking['booking_id']); ?></p>
                                <p>Booking date: <?php echo htmlspecialchars($booking['booking_date']); ?></p>
                            </li>
                        <?php endforeach; else { ?>
                        <p>No booking available</p>
                    <?php } ?>
                </ul>
            </section>
        </main>
    </div>
    <script src="../javascript/main.js"></script>
</body>

</html>