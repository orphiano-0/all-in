<?php
require '../db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
$stmt->execute([$id]);

header("Location: ../home.php");
?>
