<?php
// create.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($title && $content) {
        $stmt = $pdo->prepare('INSERT INTO pages (title, content) VALUES (?, ?)');
        $stmt->execute([$title, $content]);
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Créer une page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Créer une nouvelle page</h1>
    <form method="post">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="content">Contenu</label>
        <textarea name="content" id="content" required></textarea>
        <br>
        <button type="submit">Créer</button>
    </form>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>
