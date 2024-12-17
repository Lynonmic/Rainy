<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Payments</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/table.css" />
    <style>
        .btn-save {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-save:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }
    </style>
</head>

<body>
    <?php
    require_once '../php/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete']) && !empty($_POST['id'])) {
            $stmt = $pdo->prepare("DELETE FROM payments WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
        } elseif (isset($_POST['save'])) {
            if (!empty($_POST['id']) && !empty($_POST['user_id']) && !empty($_POST['amount']) && !empty($_POST['date'])) {
                $stmt = $pdo->prepare("UPDATE payments SET user_id = :user_id, amount = :amount, date = :date WHERE id = :id");
                $stmt->execute(['user_id' => $_POST['user_id'], 'amount' => $_POST['amount'], 'date' => $_POST['date'], 'id' => $_POST['id']]);
            } elseif (!empty($_POST['user_id']) && !empty($_POST['amount']) && !empty($_POST['date'])) {
                $stmt = $pdo->prepare("INSERT INTO payments (user_id, amount, date) VALUES (:user_id, :amount, :date)");
                $stmt->execute(['user_id' => $_POST['user_id'], 'amount' => $_POST['amount'], 'date' => $_POST['date']]);
            }
        }
    }

    $payments = $pdo->query("SELECT * FROM payments")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="header">
            <h2>Manage Payments</h2>
            <p>Here you can manage payments.</p>

            <button onclick="toggleForm()" class="btn-save">Add Payment</button>
        </div>

        <div class="form-container">
            <form id="paymentForm" method="post" style="display: none;">
                <input type="hidden" name="id" id="id">
                <label for="user_id">User ID:</label>
                <input type="text" name="user_id" id="user_id" required>
                <label for="amount">Amount:</label>
                <input type="text" name="amount" id="amount" required>
                <label for="date">Date:</label>
                <input type="date" name="date" id="date" required>
                <div class="btn"><button type="submit" name="save" class="btn-save">Save</button></div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $payment): ?>
                    <tr onclick="editPayment(<?php echo htmlspecialchars(json_encode($payment)); ?>)">
                        <td><?php if (!empty($payment['id']))
                            echo htmlspecialchars($payment['id']); ?></td>
                        <td><?php if (!empty($payment['user_id']))
                            echo htmlspecialchars($payment['user_id']); ?></td>
                        <td><?php if (!empty($payment['amount']))
                            echo htmlspecialchars($payment['amount']); ?></td>
                        <td><?php if (!empty($payment['date']))
                            echo htmlspecialchars($payment['date']); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($payment['id']); ?>">
                                <button type="submit" name="delete" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editPayment(payment) {
            document.getElementById('id').value = payment.id;
            document.getElementById('user_id').value = payment.user_id;
            document.getElementById('amount').value = payment.amount;
            document.getElementById('date').value = payment.date;
            document.getElementById('paymentForm').style.display = 'block';
            setActiveRow(payment.id);
        }

        function toggleForm() {
            var form = document.getElementById('paymentForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }

        function setActiveRow(id) {
            var rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.classList.remove('active');
                if (row.querySelector('input[name="id"]').value == id) {
                    row.classList.add('active');
                }
            });
        }
    </script>
</body>

</html>