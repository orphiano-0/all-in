<?php
session_start();
require 'db.php';

if (isset($_POST['uploadFile'])) {
    $file = $_FILES['fileUpload'];

    // Ensure the uploads directory exists
    $uploadsDir = 'uploads/';
    if (!is_dir($uploadsDir)) {
        mkdir($uploadsDir, 0777, true);
    }

    $filePath = $uploadsDir . basename($file['name']);

    // Move the uploaded file
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
        // Save file details to the database
        $stmt = $pdo->prepare("INSERT INTO uploaded_files (file_name, file_path) VALUES (?, ?)");
        $stmt->execute([$file['name'], $filePath]);

        $_SESSION['message'] = "File uploaded successfully.";
    } else {
        $_SESSION['error'] = "Failed to upload file.";
    }
}

header("Location: home.php");
exit;
?>
