<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Users</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/table.css" />
</head>

<body>
    <?php
    require_once '../php/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete']) && !empty($_POST['id'])) {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
        } elseif (isset($_POST['save'])) {
            if (!empty($_POST['id']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['user_type'])) {
                $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, user_type = :user_type WHERE id = :id");
                $stmt->execute(['username' => $_POST['username'], 'email' => $_POST['email'], 'user_type' => $_POST['user_type'], 'id' => $_POST['id']]);
            } elseif (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['user_type'])) {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, user_type, phone_number) VALUES (:username, :email, :user_type, :phone_number)");
                $stmt->execute(['username' => $_POST['username'], 'email' => $_POST['email'], 'user_type' => $_POST['user_type'], 'phone_number' => $_POST['phone_number']]);
            }
        }
    }

    $users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Manage Users</h2>
    <p>Here you can manage users.</p>

    <button onclick="toggleForm()">Add User</button>

    <div class="form-container">
        <form id="userForm" method="POST" style="display: none; width:70%;">
            <h2>User input</h2>
            <label for="new-username">Username:</label>
            <input type="text" id="new-username" name="new-username" required />
            <label for="new-password">Password:</label>
            <input type="password" id="new-password" name="new-password" required />
            <label for="new-email">Email:</label>
            <input type="text" id="new-email" name="new-email" required />
            <label for="new-phoneNumber">Phone number:</label>
            <input type="text" id="new-phoneNumber" name="new-phoneNumber" required />
            <select name="user_type" id="user_type" required>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <div class="btn"><button type="submit" name="save">Save</button></div>

        </form>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone number</th>
                <th>User type</th>
                <th>Created at</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr onclick="editUser(<?php echo htmlspecialchars(json_encode($user)); ?>)">
                    <td><?php if (!empty($user['id']))
                        echo htmlspecialchars($user['id']);
                    else
                        echo ""; ?></td>
                    <td><?php if (!empty($user['username']))
                        echo htmlspecialchars($user['username']);
                    else
                        echo ""; ?></td>
                    <td><?php if (!empty($user['email']))
                        echo htmlspecialchars($user['email']);
                    else
                        echo ""; ?></td>
                    <td><?php if (!empty($user['phone_number']))
                        echo htmlspecialchars($user['phone_number']);
                    else
                        echo ""; ?></td>
                    <td><?php if (!empty($user['user_type']))
                        echo htmlspecialchars($user['user_type']);
                    else
                        echo ""; ?></td>
                    <td><?php if (!empty($user['created_at']))
                        echo htmlspecialchars($user['created_at']);
                    else
                        echo ""; ?></td>

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
            document.getElementById('username').value = user.username;
            document.getElementById('email').value = user.email;
            document.getElementById('phone_number').value = user.phone_number;
            document.getElementById('user_type').value = user.user_type;
            document.getElementById('userForm').style.display = 'block';
            setActiveRow(user.id);
        }

        function toggleForm() {
            var form = document.getElementById('userForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'grid';
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