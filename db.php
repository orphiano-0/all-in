<?php
$host = 'localhost'; // Database host
$db = 'my_app'; // Database name
$user = 'your_user'; // Database username
$pass = 'your_password'; // Database password

try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // If connection fails, show an error message
    echo "Connection failed: " . $e->getMessage();
}
?>
