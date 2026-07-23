<?php
require_once 'config.php';

$slug = $_GET['slug'] ?? '';

// Check if user is logged in
$user_id = $_SESSION['user_id'] ?? null;

// Build query - show published articles to everyone, pending_review only to reviewers
if ($user_id) {
    // Logged in user - show published OR pending_review if they are a reviewer
    $stmt = $pdo->prepare("SELECT a.*, u.username as author_name 
                           FROM articles a 
                           LEFT JOIN users u ON a.author_id = u.id 
                           WHERE a.slug = ? 
                           AND (a.status = 'published' 
                                OR (a.review_status = 'pending_review' 
                                    AND EXISTS (
                                        SELECT 1 FROM article_review_assignments ara 
                                        WHERE ara.article_id = a.id 
                                        AND ara.reviewer_id = ? 
                                        AND ara.status = 'pending'
                                    )
                                   )
                               )");
    $stmt->execute([$slug, $user_id]);
} else {
    // Not logged in - only show published articles
    $stmt = $pdo->prepare("SELECT a.*, u.username as author_name 
                           FROM articles a 
                           LEFT JOIN users u ON a.author_id = u.id 
                           WHERE a.slug = ? AND a.status = 'published'");
    $stmt->execute([$slug]);
}

$article = $stmt->fetch();

if (!$article) {
    header('HTTP/1.0 404 Not Found');
    die('<h1>Article not found</h1><a href="articles.php">Back to articles</a>');
}

// Track view (only for published articles)
if ($article['status'] == 'published') {
    $stmt = $pdo->prepare("INSERT INTO article_views (article_id, viewer_ip) VALUES (?, ?)");
    $stmt->execute([$article['id'], $_SERVER['REMOTE_ADDR']]);
}

// Show a preview banner for pending articles
$is_pending_preview = ($article['review_status'] == 'pending_review');

$page_url = "https://" . $_SERVER['HTTP_HOST'] . "/article.php?slug=" . $slug;
$share_text = urlencode($article['heading'] . " - " . ($article['summary'] ?: strip_tags(substr($article['content'], 0, 150))));

// Function to clean content for display
function cleanDisplayContent($content) {
    // Remove empty paragraphs
    $content = preg_replace('/<p>\s*<\/p>/', '', $content);
    $content = preg_replace('/<p><\/p>/', '', $content);
    $content = preg_replace('/<p>\s*<br\s*\/?>\s*<\/p>/', '', $content);
    
    // Replace non-breaking spaces with regular spaces
    $content = str_replace('&nbsp;', ' ', $content);
    
    // Remove extra whitespace
    $content = preg_replace('/\s+/', ' ', $content);
    
    return trim($content);
}

$clean_content = cleanDisplayContent($article['content']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="<?php echo htmlspecialchars($article['heading']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(substr(strip_tags($article['content']), 0, 200)); ?>">
    <?php if ($article['featured_image']): ?>
        <meta property="og:image" content="<?php echo htmlspecialchars($article['featured_image']); ?>">
        <meta name="twitter:image" content="<?php echo htmlspecialchars($article['featured_image']); ?>">
    <?php endif; ?>
    <meta property="og:url" content="<?php echo $page_url; ?>">
    <meta property="og:type" content="article">
    <meta name="twitter:card" content="summary_large_image">
    <title><?php echo htmlspecialchars($article['heading']); ?> - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #266075;
            --accent-orange: #ff7b25;
            --dark-blue: #1a2a3a;
            --light-grey: #f8f9fa;
            --text-dark: #2c3e50;
            --text-light: #6c757d;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: white;
            line-height: 1.6;
        }
        
        /* Preview Banner */
        .preview-banner {
            background: #fff3cd;
            border-bottom: 3px solid var(--accent-orange);
            padding: 12px 0;
            text-align: center;
            font-weight: 500;
        }
        .preview-banner i {
            color: var(--accent-orange);
        }
        
        /* Article Header - Mobile First */
        .article-header {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 100%);
            color: white;
            padding: 40px 0;
            position: relative;
            overflow: hidden;
        }
        
        @media (min-width: 768px) {
            .article-header {
                padding: 80px 0;
            }
        }
        
        .article-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            pointer-events: none;
        }
        
        .article-subject {
            display: inline-block;
            background: rgba(255,255,255,0.2);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
        }
        
        @media (min-width: 768px) {
            .article-subject {
                font-size: 0.9rem;
                padding: 8px 20px;
            }
        }
        
        .article-title {
            font-size: 1.8rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.3;
        }
        
        @media (min-width: 768px) {
            .article-title {
                font-size: 2.8rem;
            }
        }
        
        @media (min-width: 992px) {
            .article-title {
                font-size: 3.5rem;
            }
        }
        
        .article-meta {
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }
        
        @media (min-width: 768px) {
            .article-meta {
                font-size: 0.95rem;
            }
        }
        
        .article-meta i {
            margin-right: 5px;
        }
        
        /* Featured Image */
        .article-featured-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            margin: 1.5rem 0;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        @media (min-width: 768px) {
            .article-featured-image {
                max-height: 500px;
                margin: 2rem 0;
                border-radius: 20px;
            }
        }
        
        /* Article Content */
        .article-content {
            font-size: 1rem;
            line-height: 1.8;
            color: var(--text-dark);
        }
        
        @media (min-width: 768px) {
            .article-content {
                font-size: 1.1rem;
            }
        }
        
        .article-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--dark-blue);
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--primary-blue);
        }
        
        @media (min-width: 768px) {
            .article-content h2 {
                font-size: 1.8rem;
                margin-top: 2.5rem;
            }
        }
        
        .article-content h3 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            color: var(--primary-blue);
        }
        
        @media (min-width: 768px) {
            .article-content h3 {
                font-size: 1.5rem;
            }
        }
        
        .article-content p {
            margin-bottom: 1.2rem;
        }
        
        @media (min-width: 768px) {
            .article-content p {
                margin-bottom: 1.5rem;
            }
        }
        
        .article-content p:empty {
            display: none;
        }
        
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 1.5rem 0;
        }
        
        .article-content blockquote {
            border-left: 4px solid var(--primary-blue);
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            background: var(--light-grey);
            border-radius: 12px;
            font-style: italic;
            color: var(--text-dark);
        }
        
        .article-content ul, 
        .article-content ol {
            margin: 1rem 0;
            padding-left: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.5rem;
        }
        
        /* Share Section - Mobile Optimized */
        .share-section {
            background: var(--light-grey);
            padding: 1.5rem;
            border-radius: 16px;
            margin: 2rem 0;
        }
        
        @media (min-width: 768px) {
            .share-section {
                padding: 2rem;
                margin: 2.5rem 0;
                border-radius: 20px;
            }
        }
        
        .share-title {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
        }
        
        @media (min-width: 768px) {
            .share-title {
                font-size: 1.1rem;
                margin-bottom: 1.2rem;
            }
        }
        
        .share-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }
        
        .share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.3s;
            flex: 1;
            min-width: 100px;
        }
        
        @media (min-width: 576px) {
            .share-btn {
                flex: 0 1 auto;
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
        
        .share-btn:hover {
            transform: translateY(-2px);
            color: white;
            filter: brightness(1.05);
        }
        
        .share-btn.facebook { background: #1877f2; }
        .share-btn.twitter { background: #1da1f2; }
        .share-btn.linkedin { background: #0077b5; }
        .share-btn.copy-link { background: var(--primary-blue); }
        
        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin: 2rem 0;
            color: var(--primary-blue);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            padding: 10px 20px;
            background: var(--light-grey);
            border-radius: 50px;
        }
        
        .back-button:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateX(-5px);
        }
        
        /* Copy Success Toast */
        .copy-success {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #28a745;
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            display: none;
            z-index: 1000;
            font-size: 0.9rem;
            font-weight: 500;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        @media (max-width: 576px) {
            .copy-success {
                font-size: 0.8rem;
                padding: 10px 20px;
                white-space: nowrap;
            }
        }
        
        /* Author Box */
        .author-box {
            background: var(--light-grey);
            padding: 1.5rem;
            border-radius: 16px;
            margin: 2rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        @media (min-width: 768px) {
            .author-box {
                padding: 2rem;
                gap: 1.5rem;
            }
        }
        
        .author-avatar {
            width: 60px;
            height: 60px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }
        
        @media (min-width: 768px) {
            .author-avatar {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }
        }
        
        .author-info h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        
        @media (min-width: 768px) {
            .author-info h4 {
                font-size: 1.3rem;
            }
        }
        
        .author-info p {
            font-size: 0.85rem;
            color: var(--text-light);
            margin: 0;
        }
        
        /* Reading Progress Bar */
        .progress-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: transparent;
            z-index: 1001;
        }
        
        .progress-bar {
            height: 3px;
            background: var(--accent-orange);
            width: 0%;
            transition: width 0.3s;
        }
        
        /* Responsive Container Padding */
        .container {
            padding-left: 20px;
            padding-right: 20px;
        }
        
        @media (min-width: 768px) {
            .container {
                padding-left: 30px;
                padding-right: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Reading Progress Bar -->
    <div class="progress-container">
        <div class="progress-bar" id="progressBar"></div>
    </div>
    
    <?php include 'navbar-fragment.php'; ?>
    
   <!-- Preview Banner for Pending Articles -->
<?php if ($is_pending_preview): ?>
    <div class="preview-banner">
        <i class="fas fa-eye me-2"></i>
        <strong>Preview Mode:</strong> This article is pending review and is not yet published.
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/article-review.php" class="text-dark fw-bold ms-2">Go to Reviews →</a>
        <?php endif; ?>
    </div>
<?php endif; ?>
    
    <section class="article-header">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="article-subject">
                        <i class="fas fa-tag me-1"></i> <?php echo htmlspecialchars($article['subject']); ?>
                        <?php if ($is_pending_preview): ?>
                            <span class="badge bg-warning text-dark ms-2">Pending Review</span>
                        <?php endif; ?>
                    </div>
                    <h1 class="article-title"><?php echo htmlspecialchars($article['heading']); ?></h1>
                    <div class="article-meta">
                        <span><i class="far fa-calendar-alt"></i> <?php echo date('F j, Y', strtotime($article['date_posted'])); ?></span>
                        <?php if ($article['author_name']): ?>
                            <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($article['author_name']); ?></span>
                        <?php endif; ?>
                        <span><i class="far fa-clock"></i> <?php echo ceil(str_word_count(strip_tags($article['content'])) / 200); ?> min read</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <?php 
                // Fix image path
                if ($article['featured_image']): 
                    $image_path = $article['featured_image'];
                    if (!preg_match('/^https?:\/\//', $image_path) && !str_starts_with($image_path, '/')) {
                        $image_path = '/' . $image_path;
                    }
                    $image_path = str_replace('//', '/', $image_path);
                ?>
                    <img src="<?php echo htmlspecialchars($image_path); ?>" class="article-featured-image" alt="<?php echo htmlspecialchars($article['heading']); ?>">
                <?php endif; ?>
                
                <!-- Share Section (only for published articles) -->
                <?php if (!$is_pending_preview): ?>
                    <div class="share-section">
                        <div class="share-title">
                            <i class="fas fa-share-alt me-2"></i> Share this article
                        </div>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($page_url); ?>" target="_blank" class="share-btn facebook">
                                <i class="fab fa-facebook-f"></i> <span class="d-none d-sm-inline">Facebook</span>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text=<?php echo $share_text; ?>&url=<?php echo urlencode($page_url); ?>" target="_blank" class="share-btn twitter">
                                <i class="fab fa-twitter"></i> <span class="d-none d-sm-inline">Twitter</span>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode($page_url); ?>&title=<?php echo urlencode($article['heading']); ?>" target="_blank" class="share-btn linkedin">
                                <i class="fab fa-linkedin-in"></i> <span class="d-none d-sm-inline">LinkedIn</span>
                            </a>
                            <button onclick="copyToClipboard('<?php echo $page_url; ?>')" class="share-btn copy-link">
                                <i class="fas fa-copy"></i> <span class="d-none d-sm-inline">Copy Link</span>
                            </button>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Article Content -->
                <div class="article-content">
                    <?php echo nl2br(htmlspecialchars_decode($clean_content)); ?>
                </div>
                
                <!-- Author Box -->
                <?php if ($article['author_name']): ?>
                <div class="author-box">
                    <div class="author-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="author-info">
                        <h4><?php echo htmlspecialchars($article['author_name']); ?></h4>
                        <p>Author at Peatech Services - The Connection Company</p>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Back Button -->
<div class="text-center">
    <a href="/articles.php" class="back-button">
        <i class="fas fa-arrow-left me-2"></i> Back to all articles
    </a>
</div>
            </div>
        </div>
    </div>
    
    <div class="copy-success" id="copySuccess">
        <i class="fas fa-check-circle me-2"></i> Link copied to clipboard!
    </div>
    
    <?php include 'footer-fragment.php'; ?>
    
    <script>
        // Copy to clipboard function
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                var successDiv = document.getElementById('copySuccess');
                successDiv.style.display = 'block';
                setTimeout(function() {
                    successDiv.style.display = 'none';
                }, 2000);
            });
        }
        
        // Reading progress bar
        window.addEventListener('scroll', function() {
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.getElementById('progressBar').style.width = scrolled + '%';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>