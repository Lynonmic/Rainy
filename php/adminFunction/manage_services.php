<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Services</title>
    <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
    <?php
    require_once '../php/connect.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['delete'])) {
            $stmt = $pdo->prepare("DELETE FROM services WHERE id = :id");
            $stmt->execute(['id' => $_POST['id']]);
        } elseif (isset($_POST['save'])) {
            if (!empty($_POST['id'])) {
                $stmt = $pdo->prepare("UPDATE services SET name = :name, description = :description WHERE id = :id");
                $stmt->execute(['name' => $_POST['name'], 'description' => $_POST['description'], 'id' => $_POST['id']]);
            } else {
                $stmt = $pdo->prepare("INSERT INTO services (name, description) VALUES (:name, :description)");
                $stmt->execute(['name' => $_POST['name'], 'description' => $_POST['description']]);
            }
        }
    }

    $services = $pdo->query("SELECT * FROM services")->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Manage Services</h2>
    <p>Here you can manage services.</p>

    <button onclick="toggleForm()">Add Service</button>

    <form id="serviceForm" method="post" style="display: none;">
        <input type="hidden" name="id" id="id">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <label for="description">Description:</label>
        <input type="text" name="description" id="description" required>
        <button type="submit" name="save">Save</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($services as $service): ?>
                <tr onclick="editService(<?php echo htmlspecialchars(json_encode($service)); ?>)">
                    <td><?php echo htmlspecialchars($service['id']); ?></td>
                    <td><?php echo htmlspecialchars($service['name']); ?></td>
                    <td><?php echo htmlspecialchars($service['description']); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($service['id']); ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editService(service) {
            document.getElementById('id').value = service.id;
            document.getElementById('name').value = service.name;
            document.getElementById('description').value = service.description;
            document.getElementById('serviceForm').style.display = 'block';
        }

        function toggleForm() {
            var form = document.getElementById('serviceForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>

</html>