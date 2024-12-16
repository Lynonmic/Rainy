<?php
require_once '../php/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM promotions WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    } elseif (isset($_POST['save'])) {
        if (!empty($_POST['id'])) {
            $stmt = $pdo->prepare("UPDATE promotions SET title = :title, description = :description WHERE id = :id");
            $stmt->execute(['title' => $_POST['title'], 'description' => $_POST['description'], 'id' => $_POST['id']]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO promotions (title, description) VALUES (:title, :description)");
            $stmt->execute(['title' => $_POST['title'], 'description' => $_POST['description']]);
        }
    }
}

$stmt = $pdo->query("SELECT * FROM promotions");
$promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Promotions</title>
</head>

<body>
    <h1>Manage Promotions</h1>
    <form method="post">
        <input type="hidden" name="id" value="">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" required></textarea>
        <button type="submit" name="save">Save</button>
    </form>
    <h2>Existing Promotions</h2>
    <ul>
        <?php foreach ($promotions as $promotion): ?>
            <li>
                <strong><?php echo htmlspecialchars($promotion['promo_code']); ?></strong><br>
                <?php echo htmlspecialchars($promotion['valid_from']); ?><br>
                <form method="post" style="display:inline;">
                    <button type="submit" name="delete">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>