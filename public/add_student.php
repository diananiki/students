<?php
include '../database/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $group_name = $_POST['group_name'];
    $sql = "INSERT INTO students (full_name, group_name) VALUES ('$full_name', '$group_name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?success=student_added");
        exit;
    } else {
        header("Location: index.php?error=student_not_added");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить студента</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<a href="index.php" class="btn-back">Назад</a>
<h1>Добавить студента</h1>
<div id="add_student">
    <form method="post">
        <label>ФИО:</label>
        <input type="text" name="full_name" required><br>
        <label>Группа:</label>
        <input type="text" name="group_name" required><br>
        <button type="submit" class="btn_add">Добавить</button>
    </form>
</div>
</body>
</html>

<?php $conn->close(); ?>