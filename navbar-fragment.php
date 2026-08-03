<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="images/peatechlogo.webp" alt="Peatech Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/peasyn">PeaSyn</a></li>
                <li class="nav-item"><a class="nav-link" href="/articles">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="/careers">Careers</a></li>
                
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link" href="/post-article"><i class="fas fa-pen-alt"></i> Write</a></li>
                    
                    <!-- Pending Reviews Badge -->
                    <?php
                    $pending_review_count = 0;
                    if (isset($_SESSION['user_id'])) {
                        $pending_review_count = getPendingReviewCount($pdo, $_SESSION['user_id']);
                    }
                    ?>
                    <?php if ($pending_review_count > 0): ?>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="/article-review">
                                <i class="fas fa-clipboard-list"></i> Reviews
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    <?php echo $pending_review_count; ?>
                                </span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/article-review"><i class="fas fa-clipboard-list"></i> Reviews</a></li>
                    <?php endif; ?>
                    
                    <!-- Notifications Badge -->
                    <?php
                    $notification_count = 0;
                    if (isset($_SESSION['user_id'])) {
                        $notification_count = getUnreadNotificationCount($pdo, $_SESSION['user_id']);
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="/notifications">
                            <i class="fas fa-bell"></i>
                            <?php if ($notification_count > 0): ?>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                                    <?php echo $notification_count; ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                    
                    <!-- My Submissions -->
                    <li class="nav-item"><a class="nav-link" href="/my-submissions"><i class="fas fa-file-alt"></i> My Posts</a></li>
                    
                    <!-- Change Password -->
                    <li class="nav-item"><a class="nav-link" href="/change-password"><i class="fas fa-key"></i> Change PW</a></li>
                    
                    <!-- Admin Panel - Only for admins -->
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="/admin/dashboard"><i class="fas fa-cog"></i> Admin</a></li>
                        <li class="nav-item"><a class="nav-link" href="/admin/create-user"><i class="fas fa-user-plus"></i> Add User</a></li>
                    <?php endif; ?>
                    
                    <!-- Logout -->
                    <li class="nav-item"><a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>