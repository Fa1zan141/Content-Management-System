<?php
include 'db/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM lessons WHERE lesson_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $lesson = $stmt->fetch();
    
    if (!$lesson) {
        die('Lesson not found.');
    }
} else {
    die('Invalid request.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Update lesson details in the database
    $query = "UPDATE lessons SET title = :title, content = :content WHERE lesson_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['title' => $title, 'content' => $content, 'id' => $id]);

    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lesson</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Edit Lesson</h1>
        <nav>
            <a href="admin.php">Back to Admin Panel</a>
        </nav>
    </header>

    <section>
        <form method="POST">
            <label for="title">Lesson Title</label>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($lesson['title']) ?>" required>

            <label for="content">Lesson Content</label>
            <textarea id="content" name="content" required><?= htmlspecialchars($lesson['content']) ?></textarea>

            <button type="submit">Update Lesson</button>
        </form>
    </section>
</body>
</html>
