<?php
require_once '../php/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM reviews WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    } elseif (isset($_POST['save'])) {
        if (!empty($_POST['id'])) {
            $stmt = $pdo->prepare("UPDATE reviews SET user_id = :user_id, content = :content, rating = :rating WHERE id = :id");
            $stmt->execute(['user_id' => $_POST['user_id'], 'content' => $_POST['content'], 'rating' => $_POST['rating'], 'id' => $_POST['id']]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO reviews (user_id, content, rating) VALUES (:user_id, :content, :rating)");
            $stmt->execute(['user_id' => $_POST['user_id'], 'content' => $_POST['content'], 'rating' => $_POST['rating']]);
        }
    }
}

$reviews = $pdo->query("SELECT * FROM reviews")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Reviews</h2>
<p>Here you can manage reviews.</p>

<button onclick="document.getElementById('reviewForm').reset(); document.getElementById('id').value = '';">Add
    Review</button>

<form id="reviewForm" method="post">
    <input type="hidden" name="id" id="id">
    <label for="user_id">User ID:</label>
    <input type="text" name="user_id" id="user_id" required>
    <label for="content">Content:</label>
    <input type="text" name="content" id="content" required>
    <label for="rating">Rating:</label>
    <input type="number" name="rating" id="rating" required>
    <button type="submit" name="save">Save</button>
</form>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Rating</th>
            <th>Review Text</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reviews as $review): ?>
            <tr onclick="editReview(<?php echo htmlspecialchars(json_encode($review)); ?>)">
                <td><?php echo htmlspecialchars($review['review_id']); ?></td>
                <td><?php echo htmlspecialchars($review['user_id']); ?></td>
                <td><?php echo htmlspecialchars($review['rating']); ?></td>
                <td><?php echo htmlspecialchars($review['review_text']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($review['review_id']); ?>">
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
    }
</script>