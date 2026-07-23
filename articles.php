<?php
require_once 'config.php';

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 9;
$offset = ($page - 1) * $per_page;

// Get total articles count
$stmt = $pdo->query("SELECT COUNT(*) FROM articles WHERE status = 'published'");
$total_articles = $stmt ? $stmt->fetchColumn() : 0;
$total_pages = ceil($total_articles / $per_page);

// Get articles for current page
$limit = (int)$per_page;
$offset_val = (int)$offset;
$stmt = $pdo->query("SELECT * FROM articles WHERE status = 'published' ORDER BY date_posted DESC LIMIT $limit OFFSET $offset_val");
$articles = $stmt ? $stmt->fetchAll() : [];

// Function to clean and truncate text for summary
function getSummary($text, $length = 150) {
    $clean_text = strip_tags($text);
    $clean_text = preg_replace('/\s+/', ' ', $clean_text);
    if (strlen($clean_text) > $length) {
        $clean_text = substr($clean_text, 0, $length);
        $last_space = strrpos($clean_text, ' ');
        if ($last_space !== false) {
            $clean_text = substr($clean_text, 0, $last_space);
        }
        $clean_text .= '...';
    }
    return $clean_text;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peatech Insights - Articles & Stories</title>
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
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: var(--light-grey);
            line-height: 1.6;
        }
        
        /* Header Section - Mobile First */
        .articles-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            color: white;
            padding: 50px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        @media (min-width: 768px) {
            .articles-header {
                padding: 80px 0;
            }
        }
        
        .articles-header::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -30%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
            pointer-events: none;
        }
        
        .articles-header h1 {
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        @media (min-width: 768px) {
            .articles-header h1 {
                font-size: 3rem;
            }
        }
        
        @media (min-width: 992px) {
            .articles-header h1 {
                font-size: 3.5rem;
            }
        }
        
        .articles-header .lead {
            font-size: 1rem;
            opacity: 0.9;
            position: relative;
        }
        
        @media (min-width: 768px) {
            .articles-header .lead {
                font-size: 1.25rem;
            }
        }
        
        /* Search and Filter Bar */
        .search-section {
            margin-top: -30px;
            margin-bottom: 2rem;
            position: relative;
            z-index: 10;
        }
        
        .search-card {
            background: white;
            border-radius: 20px;
            padding: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        @media (min-width: 768px) {
            .search-card {
                padding: 1.5rem;
            }
        }
        
        .search-input {
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(38, 96, 117, 0.1);
            outline: none;
        }
        
        .filter-select {
            border: 2px solid #e1e5e9;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            background: white;
            cursor: pointer;
        }
        
        /* Article Cards */
        .articles-grid {
            margin-top: 2rem;
        }
        
        .article-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 35px rgba(0,0,0,0.1);
        }
        
        .article-image-wrapper {
            position: relative;
            overflow: hidden;
            background: var(--light-grey);
        }
        
        .article-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }
        
        @media (min-width: 768px) {
            .article-image {
                height: 240px;
            }
        }
        
        .article-card:hover .article-image {
            transform: scale(1.05);
        }
        
        .article-category {
            position: absolute;
            top: 15px;
            left: 15px;
            background: var(--primary-blue);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 1;
        }
        
        @media (min-width: 768px) {
            .article-category {
                top: 20px;
                left: 20px;
                font-size: 0.75rem;
            }
        }
        
        .article-content {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        @media (min-width: 768px) {
            .article-content {
                padding: 1.5rem;
            }
        }
        
        .article-subject {
            color: var(--primary-blue);
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            display: inline-block;
        }
        
        @media (min-width: 768px) {
            .article-subject {
                font-size: 0.8rem;
            }
        }
        
        .article-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--dark-blue);
            line-height: 1.4;
        }
        
        @media (min-width: 768px) {
            .article-title {
                font-size: 1.25rem;
            }
        }
        
        .article-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .article-title a:hover {
            color: var(--primary-blue);
        }
        
        .article-summary {
            color: #666;
            font-size: 0.85rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex: 1;
        }
        
        @media (min-width: 768px) {
            .article-summary {
                font-size: 0.9rem;
                margin-bottom: 1.25rem;
            }
        }
        
        .article-meta {
            font-size: 0.75rem;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 0.75rem;
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        @media (min-width: 768px) {
            .article-meta {
                font-size: 0.8rem;
                padding-top: 1rem;
            }
        }
        
        .article-date {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-read-more {
            color: var(--primary-blue);
            font-weight: 600;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        
        .btn-read-more:hover {
            color: var(--accent-orange);
            gap: 8px;
        }
        
        /* Pagination */
        .pagination {
            gap: 5px;
        }
        
        .pagination .page-link {
            color: var(--primary-blue);
            border-radius: 10px;
            padding: 0.5rem 0.9rem;
            font-size: 0.85rem;
            border: 1px solid #dee2e6;
        }
        
        @media (min-width: 768px) {
            .pagination .page-link {
                padding: 0.6rem 1.1rem;
                font-size: 0.9rem;
            }
        }
        
        .pagination .page-link:hover {
            background-color: var(--primary-blue);
            color: white;
            border-color: var(--primary-blue);
        }
        
        .pagination .active .page-link {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            background: white;
            border-radius: 20px;
        }
        
        @media (min-width: 768px) {
            .empty-state {
                padding: 4rem 2rem;
            }
        }
        
        .empty-state i {
            font-size: 3rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        @media (min-width: 768px) {
            .empty-state i {
                font-size: 4rem;
            }
        }
        
        /* Load More Button (Optional) */
        .load-more {
            text-align: center;
            margin-top: 2rem;
        }
        
        .btn-primary-custom {
            background: var(--primary-blue);
            border: none;
            padding: 12px 30px;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            font-weight: 600;
        }
        
        .btn-primary-custom:hover {
            background: #1a4a5a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(38, 96, 117, 0.3);
        }
        
        /* Responsive Grid */
        @media (max-width: 576px) {
            .row.g-4 {
                --bs-gutter-y: 1rem;
            }
        }
    </style>
</head>
<body>
    <?php include 'navbar-fragment.php'; ?>
    
    <section class="articles-header">
        <div class="container">
            <h1 class="fw-bold">Peatech Insights</h1>
            <p class="lead mb-0">Stories, ideas, and connections that shape our world</p>
        </div>
    </section>
    
    <div class="container">
        <!-- Search Section -->
        <div class="search-section">
            <div class="search-card">
                <div class="row g-2 align-items-center">
                    <div class="col-12 col-md-8">
                        <div class="position-relative">
                            <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #999;"></i>
                            <input type="text" id="searchInput" class="search-input w-100" placeholder="Search articles..." style="padding-left: 40px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <select id="categoryFilter" class="filter-select w-100">
                            <option value="all">All Categories</option>
                            <option value="Technology">Technology</option>
                            <option value="Health">Health</option>
                            <option value="Business">Business</option>
                            <option value="Innovation">Innovation</option>
                            <option value="IoT">IoT</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Articles Grid -->
        <section class="articles-grid">
            <?php if (empty($articles)): ?>
                <div class="empty-state">
                    <i class="fas fa-newspaper"></i>
                    <h3 class="mb-2">No articles yet</h3>
                    <p class="text-muted mb-4">Check back soon for insights and updates!</p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="post-article.php" class="btn-primary-custom">
                            <i class="fas fa-plus"></i> Post Your First Article
                        </a>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="row g-4" id="articlesContainer">
                    <?php foreach ($articles as $article): ?>
                        <div class="col-md-6 col-lg-4 article-item" data-subject="<?php echo strtolower(htmlspecialchars($article['subject'])); ?>">
                            <div class="article-card">
                                <div class="article-image-wrapper">
                                    <?php if ($article['featured_image']): ?>
                                        <img src="<?php echo htmlspecialchars($article['featured_image']); ?>" class="article-image" alt="<?php echo htmlspecialchars($article['heading']); ?>" loading="lazy">
                                    <?php else: ?>
                                        <img src="https://placehold.co/600x400/266075/white?text=Peatech+Insights" class="article-image" alt="Article image" loading="lazy">
                                    <?php endif; ?>
                                    <span class="article-category">
                                        <i class="fas fa-tag me-1"></i> <?php echo htmlspecialchars($article['subject']); ?>
                                    </span>
                                </div>
                                <div class="article-content">
                                    <span class="article-subject">
                                        <i class="fas fa-folder-open me-1"></i> <?php echo htmlspecialchars($article['subject']); ?>
                                    </span>
                                    <h2 class="article-title">
                                        <a href="article.php?slug=<?php echo urlencode($article['slug']); ?>">
                                            <?php echo htmlspecialchars($article['heading']); ?>
                                        </a>
                                    </h2>
                                    <div class="article-summary">
                                        <?php 
                                        if (!empty($article['summary'])) {
                                            $summary = $article['summary'];
                                        } else {
                                            $summary = getSummary($article['content'], 120);
                                        }
                                        echo htmlspecialchars($summary);
                                        ?>
                                    </div>
                                    <div class="article-meta">
                                        <span class="article-date">
                                            <i class="far fa-calendar-alt"></i> <?php echo date('M j, Y', strtotime($article['date_posted'])); ?>
                                        </span>
                                        <a href="article.php?slug=<?php echo urlencode($article['slug']); ?>" class="btn-read-more">
                                            Read More <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <?php if ($total_pages > 1): ?>
                <div class="load-more">
                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page-1; ?>">
                                        <i class="fas fa-chevron-left"></i> Prev
                                    </a>
                                </li>
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
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $total_pages; ?>"><?php echo $total_pages; ?></a>
                                </li>
                            <?php endif; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $page+1; ?>">
                                        Next <i class="fas fa-chevron-right"></i>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </div>
    
    <?php include 'footer-fragment.php'; ?>
    
    <script>
        // Search and Filter functionality
        const searchInput = document.getElementById('searchInput');
        const categoryFilter = document.getElementById('categoryFilter');
        const articles = document.querySelectorAll('.article-item');
        
        function filterArticles() {
            const searchTerm = searchInput.value.toLowerCase();
            const category = categoryFilter.value.toLowerCase();
            
            articles.forEach(article => {
                const title = article.querySelector('.article-title a').textContent.toLowerCase();
                const summary = article.querySelector('.article-summary').textContent.toLowerCase();
                const subject = article.getAttribute('data-subject');
                
                const matchesSearch = title.includes(searchTerm) || summary.includes(searchTerm);
                const matchesCategory = category === 'all' || subject === category;
                
                if (matchesSearch && matchesCategory) {
                    article.style.display = 'block';
                } else {
                    article.style.display = 'none';
                }
            });
        }
        
        if (searchInput) {
            searchInput.addEventListener('input', filterArticles);
        }
        
        if (categoryFilter) {
            categoryFilter.addEventListener('change', filterArticles);
        }
        
        // Lazy loading images
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src || img.src;
                    observer.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('.article-image').forEach(img => {
            imageObserver.observe(img);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>