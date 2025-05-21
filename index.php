<?php
require 'includes/db.php';
require 'includes/functions.php';

$stmt = $pdo -> query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
	<head>
			<meta charset="UTF-8">
			<title>Книга<->задач!!!</title>
			<link rel="stylesheet" href="./assets/styles/normalize.css">
			<link rel="stylesheet" href="./assets/styles/style.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/atom-one-dark.min.css">
	</head>
	<body>
			<header>
					<h1>Мой блог</h1>
					<nav>
							<a href="admin/login.php">Админка</a>
					</nav>
			</header>

			<main>
					<?php foreach($posts as $post): ?>
					<article class="post">
							<h2><a href="post.php?slug=<?= $post['slug'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
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
					<?php endforeach; ?>
			</main>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
			<script>hljs.highlightAll();</script>
	</body>
</html>