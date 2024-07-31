<?php
// view.php
require 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM pages WHERE id = ?');
    $stmt->execute([$id]);
    $page = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$page) {
    die("Page non trouvée");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($page['title']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1><?= htmlspecialchars($page['title']) ?></h1>
    <div><?= nl2br(htmlspecialchars($page['content'])) ?></div>
    <a href="edit.php?id=<?= $page['id'] ?>">Éditer</a>
    <a href="delete.php?id=<?= $page['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?');">Supprimer</a>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>
