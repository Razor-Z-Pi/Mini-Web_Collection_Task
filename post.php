<?php
require 'includes/db.php';
require 'includes/functions.php';

$slug = $_GET['slug'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
	<link rel="stylesheet" href="./assets/styles/normalize.css">
	<link rel="stylesheet" href="./assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/atom-one-dark.min.css">
</head>
<body>
    <header>
        <h1><a href="index.php">Мой блог</a></h1>
    </header>

    <main>
        <article class="post">
            <h2><?= htmlspecialchars($post['title']) ?></h2>
            <div class="post-content">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </div>
            <?php if(!empty($post['code_block'])): ?>
            <div class="code-block">
                <?= highlightCode($post['code_block']) ?>
            </div>
            <?php endif; ?>
            <div class="post-meta">
                <?= date('d.m.Y H:i', strtotime($post['created_at'])) ?>
            </div>
        </article>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
</body>
</html>