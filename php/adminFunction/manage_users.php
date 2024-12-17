<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Users</title>
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
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
        } elseif (isset($_POST['save'])) {
            if (strlen($_POST['phoneNumber']) > 10) {
                echo "Phone number must be smaller than 10 characters long.";
            } else {
                if (!empty($_POST['id']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['user_type']) && isset($_POST['phoneNumber'])) {
                    $stmt = $pdo->prepare("UPDATE users SET username = :username, email = :email, user_type = :user_type, phone_number = :phone_number WHERE id = :id");
                    $stmt->execute(['username' => $_POST['username'], 'email' => $_POST['email'], 'user_type' => $_POST['user_type'], 'phone_number' => $_POST['phoneNumber'], 'id' => $_POST['id']]);
                } elseif (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['user_type']) && isset($_POST['phoneNumber'])) {
                    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, email, user_type, phone_number) VALUES (:username, :password, :email, :user_type, :phone_number)");
                    $stmt->execute(['username' => $_POST['username'], 'password' => $_POST['password'], 'email' => $_POST['email'], 'user_type' => $_POST['user_type'], 'phone_number' => $_POST['phoneNumber']]);
                }
            }
        }
    }

    $users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="header">
            <h2>Manage Users</h2>
            <p>Here you can manage users.</p>

            <button onclick="toggleForm()" class="btn-save">Add User</button>
        </div>


        <div class="form-container">
            <form id="userForm" method="POST" style="display: none; width:70%;">
                <h2>User input</h2>
                <input type="hidden" id="id" name="id" />
                <label for="new-username">Username:</label>
                <input type="text" id="new-username" name="username" required />
                <label for="new-password">Password:</label>
                <input type="password" id="new-password" name="password" required />
                <label for="new-email">Email:</label>
                <input type="text" id="email" name="email" />
                <label for="new-phoneNumber">Phone number:</label>
                <input type="text" id="new-phoneNumber" name="phoneNumber" />
                <select name="user_type" id="user_type" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="btn"><button type="submit" name="save" class="btn-save">Save</button></div>
            </form>
        </div>
        <div class="form-container">
            <form id="editUserForm" method="POST" style="display: none; width:70%;">
                <h2>Edit User</h2>
                <input type="hidden" id="edit-id" name="id" />
                <label for="edit-username">Username:</label>
                <input type="text" id="edit-username" name="username" required />
                <label for="edit-email">Email:</label>
                <input type="text" id="edit-email" name="email" />
                <label for="edit-phoneNumber">Phone number:</label>
                <input type="text" id="edit-phoneNumber" name="phoneNumber" />
                <select name="user_type" id="edit-user_type" required>
                    <option value="customer">Customer</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="btn"><button type="submit" name="save" class="btn-save">Save</button></div>
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
            <tbody class="table">
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
                                <button type="submit" name="delete" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        function editUser(user) {
            document.getElementById('edit-id').value = user.id;
            document.getElementById('edit-username').value = user.username;
            document.getElementById('edit-email').value = user.email;
            document.getElementById('edit-phoneNumber').value = user.phone_number;
            document.getElementById('edit-user_type').value = user.user_type;
            document.getElementById('editUserForm').style.display = 'grid';
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