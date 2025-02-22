<?php
include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM students WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?success=student_deleted");
        exit;
    } else {
        header("Location: index.php?error=student_not_deleted");
        exit();
    }
}

$conn->close();
?>
