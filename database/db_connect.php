<?php
$servername = "127.127.126.50";
$username = "root";
$password = "";
$dbname = "students_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
