<?php
session_start();
require '../includes/db.php';
require '../includes/functions.php';

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $code = $_POST['code'] ?? '';
    $slug = createSlug($title);
    
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, title, slug, content, code_block) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_id'], $title, $slug, $content, $code]);
    
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новый пост</title>
	<link rel="stylesheet" href="../assets/styles/normalize.css">
	<link rel="stylesheet" href="../assets/styles/style.css">
</head>
<body>
    <div class="admin-container">
        <h2>Создать новый пост</h2>
        <form method="POST">
            <input type="text" name="title" placeholder="Заголовок" required>
            <textarea name="content" placeholder="Содержание" required></textarea>
            <textarea name="code" placeholder="Код (необязательно)"></textarea>
            <button type="submit">Опубликовать</button>
        </form>
    </div>
</body>
</html>