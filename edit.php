<?php
// edit.php
require 'header.php';

$page = $_GET['page'] ?? null;

if ($page && file_exists("pages/$page")) {
    $content = file_get_contents("pages/$page");
} else {
    die("Page non trouvée");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newContent = $_POST['content'];
    file_put_contents("pages/$page", $newContent);
    require 'generate_index.php'; // Regenerate index.html after editing a page
    header("Location: view.php?page=" . urlencode($page));
    exit;
}
?>

<h2>Éditer <?= htmlspecialchars(basename($page, '.txt')) ?></h2>
<form method="post">
    <label for="content">Contenu</label>
    <textarea name="content" id="content" required><?= htmlspecialchars($content) ?></textarea>
    <br>
    <button type="submit">Enregistrer</button>
</form>
<a href="view.php?page=<?= urlencode($page) ?>">Retour</a>

<?php require 'footer.php'; ?>
