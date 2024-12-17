<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Staff</title>
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
            $stmt = $pdo->prepare("DELETE FROM staff WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
        } elseif (isset($_POST['save'])) {
            if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['position'])) {
                $stmt = $pdo->prepare("UPDATE staff SET name = :name, position = :position WHERE id = :id");
                $stmt->execute(['name' => $_POST['name'], 'position' => $_POST['position'], 'id' => $_POST['id']]);
            } elseif (!empty($_POST['name']) && !empty($_POST['position'])) {
                $stmt = $pdo->prepare("INSERT INTO staff (name, position) VALUES (:name, :position)");
                $stmt->execute(['name' => $_POST['name'], 'position' => $_POST['position']]);
            }
        }
    }

    $staff = $pdo->query("SELECT * FROM staff")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <div class="container">
        <div class="header">
            <h2>Manage Staff</h2>
            <p>Here you can manage staff.</p>

            <button onclick="toggleForm()" class="btn-save">Add Staff</button>
        </div>

        <div class="form-container">
            <form id="staffForm" method="post" style="display: none;">
                <input type="hidden" name="id" id="id">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required>
                <label for="position">Position:</label>
                <input type="text" name="position" id="position" required>
                <div class="btn"><button type="submit" name="save" class="btn-save">Save</button></div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff as $member): ?>
                    <tr onclick="editStaff(<?php echo htmlspecialchars(json_encode($member)); ?>)">
                        <td><?php if (!empty($member['id']))
                            echo htmlspecialchars($member['id']); ?></td>
                        <td><?php if (!empty($member['name']))
                            echo htmlspecialchars($member['name']); ?></td>
                        <td><?php if (!empty($member['position']))
                            echo htmlspecialchars($member['position']); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($member['id']); ?>">
                                <button type="submit" name="delete" class="btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editStaff(member) {
            document.getElementById('id').value = member.id;
            document.getElementById('name').value = member.name;
            document.getElementById('position').value = member.position;
            document.getElementById('staffForm').style.display = 'block';
            setActiveRow(member.id);
        }

        function toggleForm() {
            var form = document.getElementById('staffForm');
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