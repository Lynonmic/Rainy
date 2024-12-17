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

<h2>Payments</h2>
<p>Here you can manage payments.</p>

<button onclick="document.getElementById('paymentForm').reset(); document.getElementById('id').value = '';">Add
    Payment</button>

<form id="paymentForm" method="post">
    <input type="hidden" name="id" id="id">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" id="user_id" required>
    <label for="amount">Amount:</label>
    <input type="text" name="amount" id="amount" required>
    <label for="date">Date:</label>
    <input type="date" name="date" id="date" required>
    <button type="submit" name="save">Save</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Booking ID</th>
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
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function editPayment(payment) {
        document.getElementById('id').value = payment.id;
        document.getElementById('user_id').value = payment.user_id;
        document.getElementById('amount').value = payment.amount;
        document.getElementById('date').value = payment.date;
    }
</script>