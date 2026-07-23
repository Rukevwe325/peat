<?php
require_once '../config.php';

// Check if logged in
if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // First, delete related records (article_views, article_categories, social_meta)
    // Foreign keys with CASCADE will handle this automatically
    
    // Delete the article
    $stmt = $pdo->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->execute([$id]);
    
    $_SESSION['message'] = 'Article deleted successfully!';
} else {
    $_SESSION['message'] = 'Invalid article ID.';
}

// Redirect back to dashboard
header('Location: dashboard.php');
exit();
?>