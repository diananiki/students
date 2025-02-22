<?php
include '../database/db_connect.php';

$subject_id = $_GET["id"];
$student_id = $_GET["student_id"];

$sql = "DELETE FROM subjects WHERE id = $subject_id";

if ($conn->query($sql) === TRUE) {
    header("Location: student.php?id=$student_id");
} else {
    echo "Ошибка: " . $conn->error;
}
?>
