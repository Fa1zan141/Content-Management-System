<?php
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
    <title>Content Management System</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Content Management System</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Admin Panel</a>
        </nav>
    </header>
    
    <section>
        <h2>Available Lessons</h2>
        <div class="lesson-list">
            <?php foreach ($lessons as $lesson): ?>
                <div class="lesson">
                    <h3><?= htmlspecialchars($lesson['title']) ?></h3>
                    <p><?= nl2br(htmlspecialchars($lesson['content'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>
