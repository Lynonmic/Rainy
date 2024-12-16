<?php
require_once '../php/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $stmt = $pdo->prepare("DELETE FROM staff WHERE id = :id");
        $stmt->execute(['id' => $_POST['id']]);
    } elseif (isset($_POST['save'])) {
        if (!empty($_POST['id'])) {
            $stmt = $pdo->prepare("UPDATE staff SET name = :name, position = :position WHERE id = :id");
            $stmt->execute(['name' => $_POST['name'], 'position' => $_POST['position'], 'id' => $_POST['id']]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO staff (name, position) VALUES (:name, :position)");
            $stmt->execute(['name' => $_POST['name'], 'position' => $_POST['position']]);
        }
    }
}

$staff = $pdo->query("SELECT * FROM staff")->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Staff</h2>
<p>Here you can manage staff.</p>

<button onclick="document.getElementById('staffForm').reset(); document.getElementById('id').value = '';">Add
    Staff</button>

<form id="staffForm" method="post">
    <input type="hidden" name="id" id="id">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <label for="position">Position:</label>
    <input type="text" name="position" id="position" required>
    <button type="submit" name="save">Save</button>
</form>

<table>
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
                <td><?php echo htmlspecialchars($member['staff_id']); ?></td>
                <td><?php echo htmlspecialchars($member['name']); ?></td>
                <td><?php echo htmlspecialchars($member['email']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($member['staff_id']); ?>">
                        <button type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    function editStaff(member) {
        document.getElementById('id').value = member.id;
        document.getElementById('name').value = member.name;
        document.getElementById('position').value = member.position;
    }
</script>