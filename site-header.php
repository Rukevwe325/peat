<?php
$site_active = $site_active ?? '';
$site_contact_href = $site_contact_href ?? '/#contact';
$site_editorial = $site_editorial ?? false;
?>
<header class="site-header">
    <div class="site-shell site-header-inner">
        <a href="/" class="site-logo"><img src="/images/peatechlogo.webp" alt="Peatech Services home" width="151" height="44"></a>
        <button type="button" class="site-menu-button" aria-controls="site-navigation" aria-expanded="false">Menu <span aria-hidden="true">☰</span></button>
        <nav id="site-navigation" aria-label="Main navigation">
            <a href="/#services">Capabilities</a>
            <a href="/#products"<?php echo $site_active === 'products' ? ' class="site-active"' : ''; ?>>Portfolio</a>
            <a href="/team"<?php echo $site_active === 'team' ? ' class="site-active" aria-current="page"' : ''; ?>>Team</a>
            <a href="/articles"<?php echo $site_active === 'articles' ? ' class="site-active"' : ''; ?>>Articles</a>
            <a href="/careers"<?php echo $site_active === 'careers' ? ' class="site-active"' : ''; ?>>Careers</a>
            <?php if ($site_editorial): ?>
                <?php if (!empty($_SESSION['user_id'])): ?>
                    <details class="site-account"><summary>Account</summary><div>
                        <a href="/post-article">Write an article</a>
                        <a href="/article-review">Reviews<?php if (isset($pdo) && function_exists('getPendingReviewCount')) { $count = (int) getPendingReviewCount($pdo, $_SESSION['user_id']); if ($count > 0) echo ' (' . $count . ')'; } ?></a>
                        <a href="/notifications">Notifications<?php if (isset($pdo) && function_exists('getUnreadNotificationCount')) { $count = (int) getUnreadNotificationCount($pdo, $_SESSION['user_id']); if ($count > 0) echo ' (' . $count . ')'; } ?></a>
                        <a href="/my-submissions">My posts</a>
                        <a href="/change-password">Change password</a>
                        <?php if (($_SESSION['role'] ?? '') === 'admin'): ?><a href="/admin/dashboard">Admin dashboard</a><a href="/admin/create-user">Add user</a><?php endif; ?>
                        <a href="/logout">Sign out</a>
                    </div></details>
                <?php else: ?><a href="/login">Sign in</a><?php endif; ?>
            <?php endif; ?>
            <a class="site-contact" href="<?php echo htmlspecialchars($site_contact_href, ENT_QUOTES, 'UTF-8'); ?>">Contact <span aria-hidden="true">↗</span></a>
        </nav>
    </div>
</header>
