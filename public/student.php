<?php
include '../database/db_connect.php';

$id = $_GET['id'];
$sql = "SELECT * FROM students WHERE id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
$sql_subjects = "SELECT * FROM subjects WHERE student_id = $id";
$subjects = $conn->query($sql_subjects);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Студент</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<a href="index.php" class="btn-back">Назад</a>
<h1><?= $student['full_name'] ?> (<?= $student['group_name'] ?>)</h1>

<div id="add_subject">
    <h3>Добавить предмет:</h3>
    <form action="add_subject.php" method="post">
        <input type="hidden" name="student_id" value="<?= $id ?>">
        <input type="text" name="subject_name" placeholder="Название предмета" required>

        <label><input type="checkbox" name="has_rgz"> РГЗ</label>
        <label><input type="checkbox" name="has_control"> Контрольная</label>
        <label><input type="checkbox" name="has_credit"> Зачет</label>
        <label><input type="checkbox" name="has_exam"> Экзамен</label>

        <button type="submit" class="btn_add">Добавить</button>
    </form>
</div>

<div id="list_sbj">
    <h3>Список предметов:</h3>
    <form action="update_status.php" method="post">
        <input type="hidden" name="student_id" value="<?= $id ?>">

        <?php while ($subject = $subjects->fetch_assoc()) : ?>
            <h4>
                <?= htmlspecialchars($subject["subject_name"]) ?>
            </h4>
            <form action="update_status.php" method="post">
                <!-- Передаём ID предмета и студента -->
                <input type="hidden" name="subject_id" value="<?= $subject['id'] ?>">
                <input type="hidden" name="student_id" value="<?= $id ?>">
                <!-- Передаём информацию о том, какие тесты предусмотрены -->
                <input type="hidden" name="has_rgz" value="<?= $subject['has_rgz'] ?>">
                <input type="hidden" name="has_control" value="<?= $subject['has_control'] ?>">
                <input type="hidden" name="has_credit" value="<?= $subject['has_credit'] ?>">
                <input type="hidden" name="has_exam" value="<?= $subject['has_exam'] ?>">

                <?php if ($subject["has_rgz"]) : ?>
                    <label>РГЗ:
                        <select name="rgz_status">
                            <option value="не сдал" <?= $subject["rgz_status"] === "не сдал" ? "selected" : "" ?>>не сдал</option>
                            <option value="сдал" <?= $subject["rgz_status"] === "сдал" ? "selected" : "" ?>>сдал</option>
                        </select>
                    </label><br>
                <?php endif; ?>

                <?php if ($subject["has_control"]) : ?>
                    <label>Контрольная:
                        <select name="control_status">
                            <option value="не сдал" <?= $subject["control_status"] === "не сдал" ? "selected" : "" ?>>не сдал</option>
                            <option value="сдал" <?= $subject["control_status"] === "сдал" ? "selected" : "" ?>>сдал</option>
                        </select>
                    </label><br>
                <?php endif; ?>

                <?php if ($subject["has_credit"]) : ?>
                    <label>Зачёт:
                        <select name="credit_status">
                            <option value="не сдал" <?= $subject["credit_status"] === "не сдал" ? "selected" : "" ?>>не сдал</option>
                            <option value="сдал" <?= $subject["credit_status"] === "сдал" ? "selected" : "" ?>>сдал</option>
                        </select>
                    </label><br>
                <?php endif; ?>

                <?php if ($subject["has_exam"]) : ?>
                    <label>Экзамен:
                        <select name="exam_status">
                            <option value="не сдал" <?= $subject["exam_status"] === "не сдал" ? "selected" : "" ?>>не сдал</option>
                            <option value="сдал" <?= $subject["exam_status"] === "сдал" ? "selected" : "" ?>>сдал</option>
                        </select>
                    </label><br>
                <?php endif; ?>

                <button type="submit" id="btn_update">Обновить статус</button>
            </form>

        <form action="delete_subject.php" method="get" class="delete-form">
            <input type="hidden" name="id" value="<?= $subject["id"] ?>">
            <input type="hidden" name="student_id" value="<?= $id ?>">
            <button type="submit" class="btn_del" onclick="return confirm('Удалить предмет?');">Удалить</button>
        </form>

            <p id="main"><strong>Итог:</strong>
                <?= ($subject["exam_grade"] ? "Предмет сдан ✅" : "Предмет не сдан ❌") ?>
            </p>
            <hr>
        <?php endwhile; ?>

        <button type="submit" class="btn_add">Сохранить изменения</button>
    </form>
</div>

</body>
</html>

<?php $conn->close(); ?>