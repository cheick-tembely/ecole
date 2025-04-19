<?php
// Inclure le fichier de connexion
include '../includes/connection.php';
include '../includes/sidebar_secre.php';

// Traitement du formulaire d'upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $file = $_FILES['file'];

    // Validation
    if ($file['error'] != UPLOAD_ERR_OK) {
        die("Error uploading file");
    }

    $fileType = '';
    if (strpos($file['type'], 'pdf') !== false) {
        $fileType = 'pdf';
    } elseif (strpos($file['type'], 'word') !== false) {
        $fileType = 'word';
    } elseif (strpos($file['type'], 'image') !== false) {
        $fileType = 'image';
    } else {
        die("Invalid file type");
    }

    $filePath = '/uploads/' . basename($file['name']);
    if (!move_uploaded_file($file['tmp_name'], __DIR__ . '/uploads/' . basename($file['name']))) {
        die("Error saving file");
    }

    $stmt = $db->prepare("INSERT INTO books (title, author, description, file_path, file_type) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $author, $description, $filePath, $fileType);
    $stmt->execute();
    $stmt->close();

    echo "Book uploaded successfully!";
}

// Traitement de la recherche
$searchTerm = $_GET['search'] ?? '';
$searchResults = [];

if ($searchTerm) {
    $stmt = $db->prepare("SELECT * FROM books WHERE title LIKE ? OR author LIKE ?");
    $searchTerm = "%$searchTerm%";
    $stmt->bind_param("ss", $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Traitement du téléchargement
if (isset($_GET['download_id'])) {
    $id = $_GET['download_id'];
    $stmt = $db->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

    if ($book) {
        $filePath = __DIR__ . '/uploads/' . basename($book['file_path']);
        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Book not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Library</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            height: 100px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Upload a Book</h1>
    <form action="bibliotheque.php" method="post" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required><br><br>
        <label for="author">Author:</label>
        <input type="text" name="author" id="author"><br><br>
        <label for="description">Description:</label><br>
        <textarea name="description" id="description"></textarea><br><br>
        <label for="file">Upload file:</label>
        <input type="file" name="file" id="file" required><br><br>
        <input type="submit" value="Upload">
    </form>

    <h2>Search Books</h2>
    <form action="bibliotheque.php" method="get">
        <label for="search">Search:</label>
        <input type="text" name="search" id="search" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <input type="submit" value="Search">
    </form>

    <?php if ($searchTerm && $searchResults): ?>
        <h2>Search Results</h2>
        <ul>
            <?php foreach ($searchResults as $book): ?>
                <li>
                    <strong>Title:</strong> <?php echo htmlspecialchars($book['title']); ?><br>
                    <strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?><br>
                    <a href="bibliotheque.php?download_id=<?php echo $book['id']; ?>">Download</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($searchTerm): ?>
        <p>No books found.</p>
    <?php endif; ?>
</body>
</html>
