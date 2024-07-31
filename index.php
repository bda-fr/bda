<?php
// index.php
require 'db.php';

$stmt = $pdo->query('SELECT id, title FROM pages');
$pages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Wiki</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Simple Wiki</h1>
    <ul>
        <?php foreach ($pages as $page): ?>
            <li><a href="view.php?id=<?= $page['id'] ?>"><?= htmlspecialchars($page['title']) ?></a></li>
        <?php endforeach; ?>
    </ul>
    <a href="create.php">Créer une nouvelle page</a>
</body>
</html>
