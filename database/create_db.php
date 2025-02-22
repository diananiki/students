<?php
$servername = "127.127.126.50";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Создание БД
$sql = "CREATE DATABASE students_bd CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if ($conn->query($sql) === TRUE) {
    echo "База данных students_bd успешно создана!";
} else {
    echo "Ошибка при создании БД: " . $conn->error;
}

$conn->close();
?>
<?php
