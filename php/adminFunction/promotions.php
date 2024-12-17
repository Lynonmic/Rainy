<?php
require_once '../php/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("DELETE FROM promotions WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    } elseif (isset($_POST['save'])) {
        if (!empty($_POST['id']) && !empty($_POST['title']) && !empty($_POST['description'])) {
            $stmt = $pdo->prepare("UPDATE promotions SET title = :title, description = :description WHERE id = :id");
            $stmt->execute(['title' => $_POST['title'], 'description' => $_POST['description'], 'id' => $_POST['id']]);
        } elseif (!empty($_POST['title']) && !empty($_POST['description'])) {
            $stmt = $pdo->prepare("INSERT INTO promotions (title, description) VALUES (:title, :description)");
            $stmt->execute(['title' => $_POST['title'], 'description' => $_POST['description']]);
        }
    }
}

$stmt = $pdo->query("SELECT * FROM promotions");
$promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Promotions</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/table.css" />
</head>

<body>
    <h2>Manage Promotions</h2>
    <p>Here you can manage promotions.</p>

    <button onclick="toggleForm()">Add Promotion</button>

    <form id="promotionForm" method="post" style="display: none;">
        <input type="hidden" name="id" id="id">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <button type="submit" name="save">Save</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($promotions as $promotion): ?>
                <tr onclick="editPromotion(<?php echo htmlspecialchars(json_encode($promotion)); ?>)">
                    <td><?php if (!empty($promotion['id']))
                        echo htmlspecialchars($promotion['id']); ?></td>
                    <td><?php if (!empty($promotion['title']))
                        echo htmlspecialchars($promotion['title']); ?></td>
                    <td><?php if (!empty($promotion['description']))
                        echo htmlspecialchars($promotion['description']); ?>
                    </td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($promotion['id']); ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editPromotion(promotion) {
            document.getElementById('id').value = promotion.id;
            document.getElementById('title').value = promotion.title;
            document.getElementById('description').value = promotion.description;
            document.getElementById('promotionForm').style.display = 'block';
            setActiveRow(promotion.id);
        }

        function toggleForm() {
            var form = document.getElementById('promotionForm');
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