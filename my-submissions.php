<?php
require_once 'config.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Handle resubmit
if (isset($_GET['resubmit']) && is_numeric($_GET['resubmit'])) {
    $article_id = (int)$_GET['resubmit'];
    
    // Verify ownership
    $stmt = $pdo->prepare("SELECT id FROM articles WHERE id = ? AND author_id = ? AND review_status = 'draft'");
    $stmt->execute([$article_id, $user_id]);
    if ($stmt->fetch()) {
        $stmt = $pdo->prepare("UPDATE articles SET review_status = 'pending_review' WHERE id = ?");
        $stmt->execute([$article_id]);
        $message = "Article resubmitted for review!";
    }
}

// Get user's articles
$stmt = $pdo->prepare("SELECT a.*, 
                       (SELECT COUNT(*) FROM article_review_assignments WHERE article_id = a.id AND status = 'approved') as approved_count,
                       (SELECT COUNT(*) FROM article_review_assignments WHERE article_id = a.id AND status = 'pending') as pending_count
                       FROM articles a 
                       WHERE a.author_id = ? 
                       ORDER BY a.date_posted DESC");
$stmt->execute([$user_id]);
$articles = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Submissions - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #266075; --dark-blue: #1a2a3a; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
        .table-container { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .status-badge { padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
        .status-draft { background: #6c757d; color: white; }
        .status-pending_review { background: #ffc107; color: #000; }
        .status-published { background: #28a745; color: white; }
    </style>
</head>
<body>
    <?php include 'navbar-fragment.php'; ?>
    
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-file-alt me-2" style="color: var(--primary-blue);"></i> My Submissions</h2>
            <a href="post-article.php" class="btn btn-primary"><i class="fas fa-plus me-2"></i> New Article</a>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr><th>ID</th><th>Title</th><th>Subject</th><th>Submitted</th><th>Status</th><th>Reviews</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                            <tr>
                                <td><?php echo $article['id']; ?></td>
                                <td><strong><?php echo htmlspecialchars($article['heading']); ?></strong></td>
                                <td><?php echo htmlspecialchars($article['subject']); ?></td>
                                <td><?php echo date('M j, Y', strtotime($article['date_posted'])); ?></td>
                                <td>
                                    <?php
                                    $status_class = '';
                                    $status_text = '';
                                    switch($article['review_status']) {
                                        case 'draft':
                                            $status_class = 'status-draft';
                                            $status_text = 'Draft';
                                            break;
                                        case 'pending_review':
                                            $status_class = 'status-pending_review';
                                            $status_text = 'Pending Review';
                                            break;
                                        case 'published':
                                            $status_class = 'status-published';
                                            $status_text = 'Published';
                                            break;
                                    }
                                    ?>
                                    <span class="status-badge <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                                 </td>
                                <td>
                                    <?php if ($article['pending_count'] > 0): ?>
                                        <span class="badge bg-warning text-dark"><?php echo $article['pending_count']; ?> pending</span>
                                    <?php endif; ?>
                                    <?php if ($article['approved_count'] > 0): ?>
                                        <span class="badge bg-success"><?php echo $article['approved_count']; ?> approved</span>
                                    <?php endif; ?>
                                 </td>
                                <td>
                                    <a href="edit-article.php?id=<?php echo $article['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <?php if ($article['review_status'] == 'draft'): ?>
                                        <a href="?resubmit=<?php echo $article['id']; ?>" class="btn btn-sm btn-primary" onclick="return confirm('Submit this article for review?')">Submit for Review</a>
                                    <?php endif; ?>
                                    <a href="article.php?slug=<?php echo $article['slug']; ?>" class="btn btn-sm btn-info" target="_blank">View</a>
                                 </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($articles)): ?>
                            <tr><td colspan="7" class="text-center py-4">No articles yet. <a href="post-article.php">Create your first article →</a></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <?php include 'footer-fragment.php'; ?>
</body>
</html>