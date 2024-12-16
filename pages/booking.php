<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Booking</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/booking.css" />
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
                <?php generateNav('booking'); ?>
            </nav>
        </div>
    </header>
    <main class="main">
        <h1>Booking</h1>
        <form action="../php/submit_booking.php" method="POST" class="booking-form">
            <div class="form-group">
                <label for="customer-name">Customer Name:</label>
                <input type="text" id="customer-name" name="customer-name" required />
            </div>
            <div class="form-group">
                <label for="phone-number">Phone Number:</label>
                <input type="text" id="phone-number" name="phone-number" required />
            </div>
            <div class="form-group services-time-note">
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required />
                </div>
                <div class="form-group">
                    <label for="datetime">Preferred Date and Time:</label>
                    <input type="datetime-local" id="datetime" name="datetime" required />
                </div>
            </div>
            <div class="form-group service-discount-payment">
                <div class="form-group">
                    <label for="service">Service:</label>
                    <select id="service" name="service" required>
                        <option value="service1">Service 1</option>
                        <option value="service2">Service 2</option>
                        <option value="service3">Service 3</option>
                        <option value="service4">Service 4</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="discount">Discount:</label>
                    <select id="discount" name="discount">
                        <option value="none">None</option>
                        <option value="discount1">Discount 1</option>
                        <option value="discount2">Discount 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="payment">Payment:</label>
                    <select id="payment" name="payment" required>
                        <option value="credit-card">Credit Card</option>
                        <option value="paypal">PayPal</option>
                        <option value="cash">Cash</option>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <label for="note">Note:</label>
                <textarea id="note" name="note" rows="4"></textarea>
            </div>

            <button type="submit" class="btn">Submit Booking</button>
        </form>
    </main>
    <script src="../javascript/main.js"></script>
    <script>
        document.getElementById('datetime').addEventListener('input', function () {
            const inputDate = new Date(this.value);
            const now = new Date();
            if (inputDate < now) {
                alert('The selected date and time cannot be in the past.');
                this.value = '';
            }
        });
    </script>
</body>

</html>