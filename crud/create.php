<?php
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO items (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);

    header("Location: ../home.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../styles.css">
    <title>Add Item</title>
</head>
<body>
    <div class="card">
        <h1>Add Item</h1>
        <form method="POST">
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="description" placeholder="Description"></textarea>
            <button type="submit" class="btn-primary">Add</button>
        </form>
        <a href="../home.php">Back to Home</a>
    </div>
</body>
</html>
