<?php
// delete.php
$page = $_GET['page'] ?? null;

if ($page && file_exists("pages/$page")) {
    unlink("pages/$page");
    require 'generate_index.php'; // Regenerate index.html after deleting a page
}

header('Location: index.html');
exit;
?>
