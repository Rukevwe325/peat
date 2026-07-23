<?php
require_once 'config.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';
$error = '';

// Get user's departments
$user_depts = getUserDepartments($pdo, $user_id);
$dept_ids = array_column($user_depts, 'id');

// Handle approve/reject
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'], $_POST['assignment_id'])) {
    $assignment_id = (int)$_POST['assignment_id'];
    $action = $_POST['action'];
    $comments = $_POST['comments'] ?? '';
    
    // Verify this assignment belongs to the user and is pending
    $stmt = $pdo->prepare("SELECT ara.*, a.heading, a.author_id, a.review_department_id, a.slug
                           FROM article_review_assignments ara 
                           JOIN articles a ON ara.article_id = a.id 
                           WHERE ara.id = ? AND ara.reviewer_id = ? AND ara.status = 'pending'");
    $stmt->execute([$assignment_id, $user_id]);
    $assignment = $stmt->fetch();
    
    if ($assignment) {
        $pdo->beginTransaction();
        
        // Update assignment
        $stmt = $pdo->prepare("UPDATE article_review_assignments SET status = ?, reviewed_at = NOW(), comments = ? WHERE id = ?");
        $stmt->execute([$action, $comments, $assignment_id]);
        
        if ($action == 'approved') {
            // Check if any other reviewer already approved this article
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM article_review_assignments 
                                   WHERE article_id = ? AND status = 'approved' AND id != ?");
            $stmt->execute([$assignment['article_id'], $assignment_id]);
            $approved_count = $stmt->fetchColumn();
            
            if ($approved_count == 0) {
                // First approval - publish the article
                $stmt = $pdo->prepare("UPDATE articles SET review_status = 'published', status = 'published', 
                                       approved_at = NOW(), approved_by = ? WHERE id = ?");
                $stmt->execute([$user_id, $assignment['article_id']]);
                
                // Notify author
                createNotification($pdo, $assignment['author_id'], $assignment['article_id'], 'approved', 
                                  "Your article '{$assignment['heading']}' has been approved and published!");
            }
            
            $message = "Article approved successfully!";
        } else {
            // Rejected - mark as rejected but keep for revision
            $stmt = $pdo->prepare("UPDATE articles SET review_status = 'draft' WHERE id = ?");
            $stmt->execute([$assignment['article_id']]);
            
            // Notify author
            createNotification($pdo, $assignment['author_id'], $assignment['article_id'], 'rejected', 
                              "Your article '{$assignment['heading']}' needs revisions. " . ($comments ? "Reason: $comments" : "Please review and resubmit."));
            
            $message = "Article rejected. Author has been notified.";
        }
        
        $pdo->commit();
    } else {
        $error = "Invalid review assignment.";
    }
}

// Get pending reviews for this user (articles from their departments)
if (!empty($dept_ids)) {
    $placeholders = implode(',', array_fill(0, count($dept_ids), '?'));
    $stmt = $pdo->prepare("SELECT ara.*, a.heading, a.subject, a.content, a.submitted_at, a.slug, u.username as author_name
                           FROM article_review_assignments ara
                           JOIN articles a ON ara.article_id = a.id
                           JOIN users u ON a.author_id = u.id
                           WHERE ara.reviewer_id = ? AND ara.status = 'pending'
                           ORDER BY ara.id DESC");
    $stmt->execute([$user_id]);
    $pending_reviews = $stmt->fetchAll();
} else {
    $pending_reviews = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Reviews - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #266075; --accent-orange: #ff7b25; --dark-blue: #1a2a3a; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
        .review-card { background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .article-preview { background: #f8f9fa; padding: 1rem; border-radius: 8px; max-height: 300px; overflow-y: auto; font-size: 0.9rem; }
        .btn-approve { background: #28a745; border: none; padding: 10px 25px; border-radius: 8px; color: white; }
        .btn-reject { background: #dc3545; border: none; padding: 10px 25px; border-radius: 8px; color: white; }
        .btn-approve:hover, .btn-reject:hover { opacity: 0.9; color: white; }
        .btn-full-preview { background: var(--primary-blue); border: none; padding: 10px 25px; border-radius: 8px; color: white; }
        .btn-full-preview:hover { background: #1a4a5a; color: white; }
    </style>
</head>
<body>
    <?php include 'navbar-fragment.php'; ?>
    
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-clipboard-list me-2" style="color: var(--primary-blue);"></i> Pending Reviews</h2>
            <span class="badge bg-danger fs-6"><?php echo count($pending_reviews); ?> pending</span>
        </div>
        
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <?php if (empty($pending_reviews)): ?>
            <div class="text-center py-5">
                <i class="fas fa-check-circle fa-4x text-muted mb-3"></i>
                <h4>No pending reviews</h4>
                <p class="text-muted">All caught up! Check back later for new review requests.</p>
            </div>
        <?php else: ?>
            <?php foreach ($pending_reviews as $review): ?>
                <div class="review-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="badge bg-primary"><?php echo htmlspecialchars($review['subject']); ?></span>
                            <h3 class="mt-2 mb-1"><?php echo htmlspecialchars($review['heading']); ?></h3>
                            <small class="text-muted">
                                By <?php echo htmlspecialchars($review['author_name']); ?> | 
                                Submitted: <?php echo date('M j, Y g:i A', strtotime($review['submitted_at'])); ?>
                            </small>
                        </div>
                    </div>
                    
                    <div class="article-preview mt-3">
                        <strong>Preview:</strong>
                        <div class="mt-2"><?php echo nl2br(htmlspecialchars_decode(substr(strip_tags($review['content']), 0, 500))); ?>...</div>
                    </div>
                    
                    <form method="POST" class="mt-3">
                        <input type="hidden" name="assignment_id" value="<?php echo $review['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Comments (optional):</label>
                            <textarea name="comments" class="form-control" rows="2" placeholder="Add feedback for the author..."></textarea>
                        </div>
                        <div class="d-flex gap-3 flex-wrap">
                            <button type="submit" name="action" value="approved" class="btn-approve" onclick="return confirm('Approve this article? It will be published immediately.');">
                                <i class="fas fa-check me-2"></i> Approve & Publish
                            </button>
                            <button type="submit" name="action" value="rejected" class="btn-reject" onclick="return confirm('Reject this article? Author will be notified.');">
                                <i class="fas fa-times me-2"></i> Reject
                            </button>
                            <!-- FIXED: Full Preview link - uses relative path to go up one level -->
                            <a href="../article.php?slug=<?php echo urlencode($review['slug']); ?>" target="_blank" class="btn-full-preview">
                                <i class="fas fa-eye me-2"></i> Full Preview
                            </a>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <?php include 'footer-fragment.php'; ?>
</body>
</html>