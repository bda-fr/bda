<?php
// delete.php
require 'db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare('DELETE FROM pages WHERE id = ?');
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
?>
