<?php
// generate_index.php

ob_start();
require 'header.php';

$pages = array_diff(scandir('pages'), ['..', '.']);
?>

<ul>
    <?php foreach ($pages as $page): ?>
        <li><a href="view.php?page=<?= urlencode($page) ?>"><?= htmlspecialchars(basename($page, '.txt')) ?></a></li>
    <?php endforeach; ?>
</ul>

<?php require 'footer.php';

$content = ob_get_clean();
file_put_contents('index.html', $content);

echo "index.html has been generated.";
?>
