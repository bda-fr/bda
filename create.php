<?php
// create.php
require 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $filename = "pages/" . preg_replace('/[^a-zA-Z0-9_-]/', '_', $title) . ".txt";

    if ($title && $content) {
        file_put_contents($filename, $content);
        require 'generate_index.php'; // Regenerate index.html after creating a new page
        header('Location: index.html');
        exit;
    }
}
?>

<h2>Créer une nouvelle page</h2>
<form method="post">
    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>
    <br>
    <label for="content">Contenu</label>
    <textarea name="content" id="content" required></textarea>
    <br>
    <button type="submit">Créer</button>
</form>
<a href="index.html">Retour à l'accueil</a>

<?php require 'footer.php'; ?>
