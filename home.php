<?php
session_start();
require 'db.php';

// Fetch items for CRUD
$itemsStmt = $pdo->query("SELECT * FROM items");
$items = $itemsStmt->fetchAll();

// Fetch uploaded files for the file upload feature
$filesStmt = $pdo->query("SELECT * FROM uploaded_files");
$files = $filesStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Updated .card styling */
        .card {
            width: 100%;
            max-width: 900px;
            max-height: 80vh; /* Limit card height to 80% of the viewport */
            overflow-y: auto; /* Enable vertical scrolling */
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 20px;
        }

        /* Optional: Customize scrollbar */
        .card::-webkit-scrollbar {
            width: 8px;
        }

        .card::-webkit-scrollbar-thumb {
            background-color: #007bff;
            border-radius: 5px;
        }

        .card::-webkit-scrollbar-thumb:hover {
            background-color: #0056b3;
        }

        /* Body style for centering */
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            color: #333;
        }

        /* Button Styles */
        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 6px;
            font-size: 14px;
            margin: 5px 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #003f8c);
            box-shadow: 0 6px 10px rgba(0, 123, 255, 0.4);
        }

        .logout-btn {
            width: 100%;
            background-color: #dc3545;
            font-size: 16px;
            padding: 12px 0;
            margin-top: 20px;
        }

        /* Section Styles */
        h2 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #444;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            background: #ffffff;
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: box-shadow 0.3s ease;
        }

        li:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        li strong {
            font-size: 16px;
            color: #222;
        }

        li p {
            font-size: 14px;
            color: #555;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="file"] {
            padding: 8px;
            border: 2px dashed #007bff;
            border-radius: 8px;
            background: #e9f5ff;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        input[type="file"]:hover {
            border-color: #0056b3;
        }

        button {
            padding: 10px 15px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #0056b3;
        }

        @media (max-width: 768px) {
            .card {
                padding: 15px;
                max-height: unset; /* Allow card height to expand on smaller screens */
            }

            .card ul li {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .btn-primary {
                font-size: 0.8em;
            }

            .header h1 {
                font-size: 1.8em;
            }
        }

        @media (max-width: 480px) {
            .header h1 {
                font-size: 1.5em;
            }

            .btn-primary {
                padding: 8px 10px;
                font-size: 0.8em;
            }

            .card ul li {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <div class="card">
            <div class="header">
                <h1>Welcome to Home</h1>
            </div>

            <!-- CRUD Section -->
            <div class="crud-section">
                <h2>Manage Items</h2>
                <a href="crud/create.php" class="btn-primary">Add New Item</a>
                <ul>
                    <?php foreach ($items as $item): ?>
                        <li>
                            <div>
                                <strong><?= htmlspecialchars($item['title']) ?></strong>
                                <p><?= htmlspecialchars($item['description']) ?></p>
                            </div>
                            <div>
                                <a href="crud/update.php?id=<?= $item['id'] ?>" class="btn-primary">Edit</a>
                                <a href="crud/delete.php?id=<?= $item['id'] ?>" class="btn-primary" onclick="return confirm('Are you sure?')">Delete</a>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- File Upload Section -->
            <div class="upload-section">
                <h2>Upload Image or File</h2>
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <label for="fileUpload">Choose Image or File:</label>
                    <input type="file" name="fileUpload" id="fileUpload" accept=".jpg, .jpeg, .png, .pdf, .docx, .csv" required>
                    <button type="submit" name="uploadFile">Upload</button>
                </form>
            </div>

            <!-- Display Uploaded Files -->
            <div class="uploaded-files">
                <h2>Uploaded Files</h2>
                <ul>
                    <?php foreach ($files as $file): ?>
                        <li>
                            <strong><?= htmlspecialchars($file['file_name']) ?></strong>
                            <a href="<?= htmlspecialchars($file['file_path']) ?>" target="_blank" class="btn-primary">View</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <a href="./auth/logout.php" class="btn-primary logout-btn">Logout</a>
        </div>
    </div>
</body>
</html>
