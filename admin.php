<?php

session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

include 'db/db_connection.php';

// Fetch all lessons from the database
$query = "SELECT * FROM lessons ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute();
$lessons = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Lessons</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="add_lesson.php">Add New Lesson</a>
            <a href="logout.php">Logout</a> 
    </header>

    <section>
        <h2>All Lessons</h2>
        <div class="lesson-list">
            <?php foreach ($lessons as $lesson): ?>
                <div class="lesson">
                    <h3><?= htmlspecialchars($lesson['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($lesson['content'])) ?></p>
                    <a href="edit_lesson.php?id=<?= $lesson['lesson_id'] ?>">Edit</a>
                    <a href="delete_lesson.php?id=<?= $lesson['lesson_id'] ?>" onclick="return confirm('Are you sure you want to delete this lesson?')">Delete</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
