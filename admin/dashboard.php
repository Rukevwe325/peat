<?php
require_once '../config.php';

// Check if logged in
if (!isLoggedIn()) {
    header('Location: ../login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$is_admin = isAdmin();

// Handle delete request
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    
    // Check if user can delete this article (author or admin)
    if (canEditArticle($pdo, $id, $user_id)) {
        echo '<script>
            if(confirm("Are you sure you want to delete this article? This action cannot be undone!")) {
                window.location.href = "delete-article.php?id=' . $id . '";
            } else {
                window.location.href = "dashboard.php";
            }
        </script>';
    } else {
        header('Location: dashboard.php?error=unauthorized');
        exit();
    }
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 10;
$offset = ($page - 1) * $per_page;

// Build query based on user role
if ($is_admin) {
    // Admin sees all articles
    $count_stmt = $pdo->query("SELECT COUNT(*) FROM articles");
    $total_articles = $count_stmt ? $count_stmt->fetchColumn() : 0;
    
    $limit = (int)$per_page;
    $offset_val = (int)$offset;
    $stmt = $pdo->query("SELECT a.*, u.username as author_name, d.name as department_name
                          FROM articles a 
                          LEFT JOIN users u ON a.author_id = u.id 
                          LEFT JOIN departments d ON a.review_department_id = d.id
                          ORDER BY a.date_posted DESC 
                          LIMIT $limit OFFSET $offset_val");
} else {
    // Regular user sees only their own articles
    $count_stmt = $pdo->prepare("SELECT COUNT(*) FROM articles WHERE author_id = ?");
    $count_stmt->execute([$user_id]);
    $total_articles = $count_stmt->fetchColumn();
    
    $limit = (int)$per_page;
    $offset_val = (int)$offset;
    $stmt = $pdo->prepare("SELECT a.*, u.username as author_name, d.name as department_name
                          FROM articles a 
                          LEFT JOIN users u ON a.author_id = u.id 
                          LEFT JOIN departments d ON a.review_department_id = d.id
                          WHERE a.author_id = ?
                          ORDER BY a.date_posted DESC 
                          LIMIT $limit OFFSET $offset_val");
    $stmt->execute([$user_id]);
}
$articles = $stmt ? $stmt->fetchAll() : [];
$total_pages = ceil($total_articles / $per_page);

// Get pending review count for this user (articles assigned to them for review)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM article_review_assignments 
                       WHERE reviewer_id = ? AND status = 'pending'");
$stmt->execute([$user_id]);
$pending_review_count = $stmt->fetchColumn();

// Get actual pending reviews list for display
$stmt = $pdo->prepare("SELECT ara.*, a.heading, a.subject, a.content, a.slug, a.submitted_at, u.username as author_name, d.name as department_name
                       FROM article_review_assignments ara
                       JOIN articles a ON ara.article_id = a.id
                       JOIN users u ON a.author_id = u.id
                       LEFT JOIN departments d ON a.review_department_id = d.id
                       WHERE ara.reviewer_id = ? AND ara.status = 'pending'
                       ORDER BY ara.id DESC
                       LIMIT 5");
$stmt->execute([$user_id]);
$pending_reviews = $stmt->fetchAll();

// Get counts for stats
$published_count = $pdo->query("SELECT COUNT(*) FROM articles WHERE status = 'published'")->fetchColumn();
$draft_count = $pdo->query("SELECT COUNT(*) FROM articles WHERE status = 'draft' OR review_status = 'pending_review'")->fetchColumn();
$pending_review_total = $pdo->query("SELECT COUNT(*) FROM articles WHERE review_status = 'pending_review'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Articles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #266075;
            --accent-orange: #ff7b25;
            --dark-blue: #1a2a3a;
            --light-grey: #f8f9fa;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-grey);
        }
        .admin-header {
            background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .pending-reviews-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-left: 4px solid var(--accent-orange);
        }
        .btn-edit {
            background: #ffc107;
            color: #000;
            border: none;
            padding: 5px 12px;
            font-size: 0.85rem;
        }
        .btn-edit:hover {
            background: #e0a800;
            color: #000;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 0.85rem;
        }
        .btn-delete:hover {
            background: #c82333;
            color: white;
        }
        .btn-view {
            background: var(--primary-blue);
            color: white;
            border: none;
            padding: 5px 12px;
            font-size: 0.85rem;
        }
        .btn-view:hover {
            background: #1a4a5a;
            color: white;
        }
        .btn-review-now {
            background: var(--accent-orange);
            color: white;
            border: none;
            padding: 8px 20px;
            font-size: 0.85rem;
            border-radius: 20px;
        }
        .btn-review-now:hover {
            background: #e66a1a;
            color: white;
        }
        .btn-post-new {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-post-new:hover {
            background: #218838;
            color: white;
        }
        .btn-create-user {
            background: #ffc107;
            color: #000;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-create-user:hover {
            background: #e0a800;
            color: #000;
        }
        .btn-secondary {
            background: #6c757d;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            color: white;
        }
        .btn-secondary:hover {
            background: #5a6268;
            color: white;
        }
        .table th {
            background: var(--dark-blue);
            color: white;
            font-weight: 600;
        }
        .article-title {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .status-badge {
            padding: 3px 8px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .status-published {
            background: #28a745;
            color: white;
        }
        .status-draft {
            background: #6c757d;
            color: white;
        }
        .status-pending_review {
            background: #ffc107;
            color: #000;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 1rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
        }
        .quick-actions {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .pending-badge {
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 8px;
            font-size: 10px;
            margin-left: 5px;
        }
        .review-alert {
            background: #fff3cd;
            border-left: 4px solid var(--accent-orange);
        }
        .review-item {
            border-bottom: 1px solid #eee;
            padding: 12px 0;
        }
        .review-item:last-child {
            border-bottom: none;
        }
        .position-relative {
            position: relative;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <i class="fas fa-home me-2"></i> Peatech Services
            </a>
            <div>
                <span class="text-white me-3">
                    <i class="fas fa-user me-1"></i> <?php echo htmlspecialchars($_SESSION['username']); ?>
                    <?php if ($is_admin): ?>
                        <span class="badge bg-danger ms-1">Admin</span>
                    <?php endif; ?>
                </span>
                <a href="../logout.php" class="btn btn-outline-light btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="admin-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h1 class="display-5 fw-bold mb-2">
                        <i class="fas fa-cog me-3"></i> Article Management
                    </h1>
                    <p class="lead mb-0">Manage, edit, or delete your articles</p>
                </div>
                <div class="col-md-5 text-md-end mt-3 mt-md-0">
                    <?php if ($is_admin): ?>
                        <a href="create-user.php" class="btn btn-create-user btn-lg me-2">
                            <i class="fas fa-user-plus me-2"></i> Create User
                        </a>
                    <?php endif; ?>
                    <a href="../post-article.php" class="btn btn-post-new btn-lg">
                        <i class="fas fa-plus me-2"></i> Write Article
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <!-- PENDING REVIEWS SECTION - VISIBLE AND PROMINENT -->
        <?php if ($pending_review_count > 0): ?>
            <div class="pending-reviews-card">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">
                        <i class="fas fa-clipboard-list me-2" style="color: var(--accent-orange);"></i>
                        Articles Pending Your Review
                        <span class="pending-badge"><?php echo $pending_review_count; ?></span>
                    </h3>
                    <a href="../article-review.php" class="btn btn-review-now">
                        <i class="fas fa-arrow-right me-1"></i> Review All
                    </a>
                </div>
                <p class="text-muted mb-3">Articles sent to your department need your approval before they can be published.</p>
                
                <?php foreach ($pending_reviews as $review): ?>
                    <div class="review-item">
                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <strong><?php echo htmlspecialchars($review['heading']); ?></strong>
                                <br>
                                <small class="text-muted">
                                    <i class="fas fa-user me-1"></i> By <?php echo htmlspecialchars($review['author_name']); ?> | 
                                    <i class="fas fa-building me-1"></i> Department: <?php echo htmlspecialchars($review['department_name']); ?> |
                                    <i class="fas fa-clock me-1"></i> <?php echo date('M j, Y', strtotime($review['submitted_at'])); ?>
                                </small>
                            </div>
                            <div class="col-md-3">
                                <span class="status-badge status-pending_review">
                                    <i class="fas fa-clock me-1"></i> Pending Review
                                </span>
                            </div>
                            <div class="col-md-2 text-end">
                                <a href="../article-review.php" class="btn btn-review-now btn-sm">
                                    <i class="fas fa-check me-1"></i> Review
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Quick Stats Row -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="fas fa-newspaper fa-2x mb-2" style="color: var(--primary-blue);"></i>
                    <div class="stats-number"><?php echo $total_articles; ?></div>
                    <div class="text-muted">Total Articles</div>
                    <?php if (!$is_admin): ?>
                        <small class="text-muted">(Your articles)</small>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="fas fa-check-circle fa-2x mb-2" style="color: #28a745;"></i>
                    <div class="stats-number"><?php echo $published_count; ?></div>
                    <div class="text-muted">Published</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <i class="fas fa-clock fa-2x mb-2" style="color: var(--accent-orange);"></i>
                    <div class="stats-number"><?php echo $pending_review_total; ?></div>
                    <div class="text-muted">Pending Review (Total)</div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <h3><i class="fas fa-list me-2" style="color: var(--primary-blue);"></i> All Articles</h3>
                <div class="quick-actions">
                    <?php if ($pending_review_count > 0): ?>
                        <a href="../article-review.php" class="btn btn-review-now position-relative">
                            <i class="fas fa-clipboard-list me-2"></i> Pending Reviews
                            <span class="pending-badge"><?php echo $pending_review_count; ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if ($is_admin): ?>
                        <a href="create-user.php" class="btn btn-create-user">
                            <i class="fas fa-user-plus me-2"></i> Add User
                        </a>
                    <?php endif; ?>
                    <a href="../post-article.php" class="btn btn-post-new">
                        <i class="fas fa-plus me-2"></i> New Article
                    </a>
                    <a href="../articles.php" class="btn btn-secondary">
                        <i class="fas fa-eye me-2"></i> View Public
                    </a>
                </div>
            </div>
            
            <?php if (empty($articles)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-edit fa-4x text-muted mb-3"></i>
                    <h4>No articles yet</h4>
                    <p class="text-muted">Click "Write New Article" to create your first post!</p>
                    <a href="../post-article.php" class="btn btn-post-new mt-3">
                        <i class="fas fa-plus me-2"></i> Create Your First Article
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Subject</th>
                                <th>Author</th>
                                <th>Date Posted</th>
                                <th>Status</th>
                                <th>Review Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($articles as $article): ?>
                                <tr>
                                    <td><?php echo $article['id']; ?></td>
                                    <td class="article-title" title="<?php echo htmlspecialchars($article['heading']); ?>">
                                        <?php echo htmlspecialchars($article['heading']); ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($article['subject']); ?></td>
                                    <td><?php echo htmlspecialchars($article['author_name'] ?? 'Unknown'); ?></td>
                                    <td><?php echo date('M j, Y', strtotime($article['date_posted'])); ?></td>
                                    <td>
                                        <span class="status-badge status-<?php echo $article['status']; ?>">
                                            <?php echo ucfirst($article['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($article['review_status'] == 'pending_review'): ?>
                                            <span class="status-badge status-pending_review">
                                                <i class="fas fa-clock me-1"></i> Pending Review
                                                <?php if ($article['department_name']): ?>
                                                    <br><small>(<?php echo htmlspecialchars($article['department_name']); ?>)</small>
                                                <?php endif; ?>
                                            </span>
                                        <?php elseif ($article['review_status'] == 'published'): ?>
                                            <span class="status-badge status-published">
                                                <i class="fas fa-check me-1"></i> Published
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge status-draft">
                                                Draft
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($article['author_id'] == $user_id || $is_admin): ?>
                                            <a href="edit-article.php?id=<?php echo $article['id']; ?>" class="btn btn-edit me-1" title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="?delete=<?php echo $article['id']; ?>" class="btn btn-delete" title="Delete" onclick="return confirm('Delete this article?');">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">No actions</span>
                                        <?php endif; ?>
                                        <a href="../article.php?slug=<?php echo urlencode($article['slug']); ?>" class="btn btn-view ms-1" title="View" target="_blank">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <?php if ($total_pages > 1): ?>
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>">« Previous</a></li>
                        <?php endif; ?>
                        
                        <?php 
                        $start_page = max(1, $page - 2);
                        $end_page = min($total_pages, $page + 2);
                        
                        if ($start_page > 1): ?>
                            <li class="page-item"><a class="page-link" href="?page=1">1</a></li>
                            <?php if ($start_page > 2): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        
                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <?php if ($end_page < $total_pages): ?>
                            <?php if ($end_page < $total_pages - 1): ?>
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ($page < $total_pages): ?>
                            <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>">Next »</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>