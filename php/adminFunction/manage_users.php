<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Manage Users</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>
<body>
<?php
require_once '../php/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    } elseif (isset($_POST['save'])) {
        if (!empty($_POST['id'])) {
            $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $stmt->execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'id' => $_POST['id']]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $stmt->execute(['name' => $_POST['name'], 'email' => $_POST['email']]);
        }
    }
}

$users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Users</h2>
<p>Here you can manage users.</p>

<button onclick="toggleForm()">Add User</button>

<form id="userForm" method="post" style="display: none;"></form>
<input type="hidden" name="id" id="id">
<label for="name">Name:</label>
<input type="text" name="name" id="name" required>
<label for="email">Email:</label>
<input type="email" name="email" id="email" required>
<button type="submit" name="save">Save</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr onclick="editUser(<?php echo htmlspecialchars(json_encode($user)); ?>)">
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function editUser(user) {
        document.getElementById('id').value = user.id;
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('userForm').style.display = 'block';
    }

    function toggleForm() {
        var form = document.getElementById('userForm');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
</body>
</html>