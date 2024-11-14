<?php
include 'db/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Insert lesson into the database
    $query = "INSERT INTO lessons (title, content) VALUES (:title, :content)";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['title' => $title, 'content' => $content]);

    header('Location: admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Lesson</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Add New Lesson</h1>
        <nav>
            <a href="admin.php">Back to Admin Panel</a>
        </nav>
    </header>

    <section>
        <form method="POST">
            <label for="title">Lesson Title</label>
            <input type="text" id="title" name="title" required>

            <label for="content">Lesson Content</label>
            <textarea id="content" name="content" required></textarea>

            <button type="submit">Add Lesson</button>
        </form>
    </section>
</body>
</html>
