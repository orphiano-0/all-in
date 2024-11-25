<?php
require '../db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("UPDATE items SET title = ?, description = ? WHERE id = ?");
    $stmt->execute([$title, $description, $id]);

    header("Location: ../home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styles.css">
    <title>Update Item</title>
</head>
<body>
    <div class="card">
        <h1>Update Item</h1>
        <form method="POST">
            <input type="text" name="title" value="<?= htmlspecialchars($item['title']) ?>" placeholder="Title" required>
            <textarea name="description" placeholder="Description"><?= htmlspecialchars($item['description']) ?></textarea>
            <button type="submit" class="btn-primary">Update</button>
        </form>
        <a href="../home.php">Back to Home</a>
    </div>
</body>
</html>
