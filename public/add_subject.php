<?php
include '../database/db_connect.php';

$student_id = $_POST["student_id"];
$subject_name = $_POST["subject_name"];
$has_rgz = isset($_POST["has_rgz"]) ? 1 : 0;
$has_control = isset($_POST["has_control"]) ? 1 : 0;
$has_credit = isset($_POST["has_credit"]) ? 1 : 0;
$has_exam = isset($_POST["has_exam"]) ? 1 : 0;

$sql = "INSERT INTO subjects (student_id, subject_name, has_rgz, has_control, has_credit, has_exam, rgz_status, control_status, credit_status, exam_status, exam_grade) 
        VALUES ($student_id, '$subject_name', $has_rgz, $has_control, $has_credit, $has_exam, 'не сдал', 'не сдал', 'не сдал', 'не сдал', NULL)";

if ($conn->query($sql) === TRUE) {
    header("Location: student.php?id=$student_id");
} else {
    echo "Ошибка: " . $conn->error;
}
?>
