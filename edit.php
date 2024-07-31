<?php
// edit.php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if ($title && $content) {
        $stmt = $pdo->prepare('UPDATE pages SET title = ?, content = ? WHERE id = ?');
        $stmt->execute([$title, $content, $id]);
        header('Location: view.php?id=' . $id);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Éditer <?= htmlspecialchars($page['title']) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Éditer <?= htmlspecialchars($page['title']) ?></h1>
    <form method="post">
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($page['title']) ?>" required>
        <br>
        <label for="content">Contenu</label>
        <textarea name="content" id="content" required><?= htmlspecialchars($page['content']) ?></textarea>
        <br>
        <button type="submit">Enregistrer</button>
    </form>
    <a href="view.php?id=<?= $page['id'] ?>">Retour</a>
</body>
</html>
