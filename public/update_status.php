<?php
include '../database/db_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$student_id = $_POST["student_id"];
$subject_id = $_POST["subject_id"];

$rgz_status = isset($_POST["rgz_status"]) ? $_POST["rgz_status"] : "не сдал";
$control_status = isset($_POST["control_status"]) ? $_POST["control_status"] : "не сдал";
$credit_status = isset($_POST["credit_status"]) ? $_POST["credit_status"] : "не сдал";
$exam_status = isset($_POST["exam_status"]) ? $_POST["exam_status"] : "не сдал";

$has_rgz = isset($_POST["has_rgz"]) ? $_POST["has_rgz"] : 0;
$has_control = isset($_POST["has_control"]) ? $_POST["has_control"] : 0;
$has_credit = isset($_POST["has_credit"]) ? $_POST["has_credit"] : 0;
$has_exam = isset($_POST["has_exam"]) ? $_POST["has_exam"] : 0;

$is_rgz_passed = $has_rgz ? ($rgz_status === "сдал") : true;
$is_control_passed = $has_control ? ($control_status === "сдал") : true;
$is_credit_passed = $has_credit ? ($credit_status === "сдал") : true;
$is_exam_passed = $has_exam ? ($exam_status === "сдал") : true;

$exam_grade = ($is_rgz_passed && $is_control_passed && $is_credit_passed && $is_exam_passed) ? 5 : "NULL";

$sql = "UPDATE subjects SET 
            rgz_status = '$rgz_status', 
            control_status = '$control_status', 
            credit_status = '$credit_status', 
            exam_status = '$exam_status', 
            exam_grade = " . ($exam_grade === "NULL" ? "NULL" : $exam_grade) . "
        WHERE id = " . intval($subject_id);

if ($conn->query($sql)) {
    header("Location: student.php?id=$student_id");
    exit();
} else {
    echo "Ошибка: " . $conn->error;
}
?>
