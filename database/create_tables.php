<?php
$servername = $servername = "127.127.126.50";
$username = "root";
$password = "";
$dbname = "students_bd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$sql_students = "CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    group_name VARCHAR(50) NOT NULL
)";

$sql_subjects = "CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_name VARCHAR(100) NOT NULL,
    has_rgz BOOLEAN DEFAULT 0,
    has_control BOOLEAN DEFAULT 0,
    has_credit BOOLEAN DEFAULT 0,
    has_exam BOOLEAN DEFAULT 0,
    rgz_status ENUM('не сдал', 'сдал') DEFAULT NULL,
    control_status ENUM('не сдал', 'сдал') DEFAULT NULL,
    credit_status ENUM('не сдал', 'сдал') DEFAULT NULL,
    exam_status ENUM('не сдал', 'сдал') DEFAULT NULL,
    exam_grade INT DEFAULT NULL,
    FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE
)";

if ($conn->query($sql_students) === TRUE) {
    echo "Таблица students успешно создана!<br>";
} else {
    echo "Ошибка создания таблицы students: " . $conn->error . "<br>";
}

if ($conn->query($sql_subjects) === TRUE) {
    echo "Таблица subjects успешно создана!";
} else {
    echo "Ошибка создания таблицы subjects: " . $conn->error;
}

$conn->close();
?>
