<?php
include 'db/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete lesson from the database
    $query = "DELETE FROM lessons WHERE lesson_id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);

    header('Location: admin.php');
} else {
    die('Invalid request.');
}
?>


