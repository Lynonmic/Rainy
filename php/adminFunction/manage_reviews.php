<?php
require_once '../php/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete']) && !empty($_POST['id'])) {
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    } elseif (isset($_POST['save'])) {
        if (!empty($_POST['id']) && !empty($_POST['user_id']) && !empty($_POST['content']) && !empty($_POST['rating'])) {
            $stmt = $pdo->prepare("UPDATE reviews SET user_id = :user_id, content = :content, rating = :rating WHERE id = :id");
            $stmt->execute(['user_id' => $_POST['user_id'], 'content' => $_POST['content'], 'rating' => $_POST['rating'], 'id' => $_POST['id']]);
        } elseif (!empty($_POST['user_id']) && !empty($_POST['content']) && !empty($_POST['rating'])) {
            $stmt = $pdo->prepare("INSERT INTO reviews (user_id, content, rating) VALUES (:user_id, :content, :rating)");
            $stmt->execute(['user_id' => $_POST['user_id'], 'content' => $_POST['content'], 'rating' => $_POST['rating']]);
        }
    }
}

$reviews = $pdo->query("SELECT * FROM reviews")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Reviews</title>
    <link rel="stylesheet" href="../css/styles.css" />
    <link rel="stylesheet" href="../css/table.css" />
</head>

<body>
    <h2>Manage Reviews</h2>
    <p>Here you can manage reviews.</p>

    <button onclick="toggleForm()">Add Review</button>

    <form id="reviewForm" method="post" style="display: none;">
        <input type="hidden" name="id" id="id">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id" required>
        <label for="content">Content:</label>
        <input type="text" name="content" id="content" required>
        <label for="rating">Rating:</label>
        <input type="number" name="rating" id="rating" required>
        <button type="submit" name="save">Save</button>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Content</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reviews as $review): ?>
                <tr onclick="editReview(<?php echo htmlspecialchars(json_encode($review)); ?>)">
                    <td><?php if (!empty($review['id']))
                        echo htmlspecialchars($review['id']); ?></td>
                    <td><?php if (!empty($review['user_id']))
                        echo htmlspecialchars($review['user_id']); ?></td>
                    <td><?php if (!empty($review['content']))
                        echo htmlspecialchars($review['content']); ?></td>
                    <td><?php if (!empty($review['rating']))
                        echo htmlspecialchars($review['rating']); ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($review['id']); ?>">
                            <button type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function editReview(review) {
            document.getElementById('id').value = review.id;
            document.getElementById('user_id').value = review.user_id;
            document.getElementById('content').value = review.content;
            document.getElementById('rating').value = review.rating;
            document.getElementById('reviewForm').style.display = 'block';
            setActiveRow(review.id);
        }

        function toggleForm() {
            var form = document.getElementById('reviewForm');
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