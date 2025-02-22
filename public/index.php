<?php
include '../database/db_connect.php';

$sql = "SELECT * FROM students ORDER BY full_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список студентов</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php if (isset($_GET['success']) || isset($_GET['error'])): ?>
    <div class="alert <?= isset($_GET['success']) ? 'success' : 'error' ?>">
        <?php
        if (isset($_GET['success'])) {
            switch ($_GET['success']) {
                case 'student_added':
                    echo "✅ Студент успешно добавлен!";
                    break;
                case 'student_deleted':
                    echo "🗑️ Студент удален!";
                    break;
            }
        } elseif (isset($_GET['error'])) {
            switch ($_GET['error']) {
                case 'student_not_added':
                    echo "❌ Ошибка: студент не добавлен!";
                    break;
                case 'student_not_deleted':
                    echo "❌ Ошибка: студент не удален!";
                    break;
            }
        }
        ?>
    </div>
<?php endif; ?>

<h1>Список студентов</h1>
<div id="list">
    <a href="add_student.php" id="add">Добавить студента</a>
    <table>
        <tr>
            <th>ФИО</th>
            <th>Группа</th>
            <th>Действия</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><a href="student.php?id=<?= $row['id'] ?>" id="link"><?= $row['full_name'] ?></a></td>
                <td><?= $row['group_name'] ?></td>
                <td>
                    <form action="delete_student.php" method="post" onsubmit="return confirm('Удалить студента?');">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn_del">Удалить</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>
</body>
</html>

<?php $conn->close(); ?>