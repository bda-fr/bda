<?php
// view.php
require 'header.php';

$page = $_GET['page'] ?? null;

if ($page && file_exists("pages/$page")) {
    $content = file_get_contents("pages/$page");
} else {
    die("Page non trouvée");
}
?>

<h2><?= htmlspecialchars(basename($page, '.txt')) ?></h2>
<div><?= nl2br(htmlspecialchars($content)) ?></div>
<a href="edit.php?page=<?= urlencode($page) ?>">Éditer</a>
<a href="delete.php?page=<?= urlencode($page) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?');">Supprimer</a>
<a href="index.html">Retour à l'accueil</a>

<?php require 'footer.php'; ?>
