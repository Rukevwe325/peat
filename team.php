<?php
$teamMembers = require __DIR__ . '/team-members.php';
$slug = $_GET['member'] ?? null;
$member = is_string($slug) ? ($teamMembers[$slug] ?? null) : null;
$profileMissing = $slug !== null && $member === null;
if ($profileMissing) {
    http_response_code(404);
}
$pageTitle = $member['name'] ?? ($profileMissing ? 'Team member not found' : 'Our team');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?> | Peatech Services</title>
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="stylesheet" href="/assets/site.css">
    <script src="/assets/site.js" defer></script>
</head>
<body class="site-team">
    <a class="site-team-skip" href="#main">Skip to content</a>
    <?php $site_active = 'team'; require __DIR__ . '/site-header.php'; ?>
    <main id="main">
        <?php if ($member !== null): ?>
            <section class="site-team-profile-hero" aria-labelledby="team-heading">
                <div class="site-shell site-team-profile">
                    <div class="site-team-profile-identity">
                        <a class="site-team-link" href="/team">← Back to our team</a>
                        <h1 id="team-heading"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
                        <p><?= htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8') ?></p>
                        <?php if (isset($member['email'])): ?>
                            <a class="site-team-email" href="mailto:<?= htmlspecialchars($member['email'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($member['email'], ENT_QUOTES, 'UTF-8') ?></a>
                        <?php endif; ?>
                    </div>
                    <?php require __DIR__ . '/team-portrait.php'; ?>
                </div>
            </section>
            <div class="site-shell site-team-profile-body" id="<?= rawurlencode($slug) ?>">
                <section class="site-team-bio" aria-labelledby="role-heading">
                    <h2 id="role-heading">Role at Peatech</h2>
                    <?php foreach ($member['bio'] as $paragraph): ?>
                        <p><?= htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endforeach; ?>
                    <?php if (isset($member['website'])): ?>
                        <p><a class="site-team-website" href="<?= htmlspecialchars($member['website'], ENT_QUOTES, 'UTF-8') ?>">Visit Bathlomew’s website <span aria-hidden="true">↗</span></a></p>
                    <?php endif; ?>
                </section>
                <section class="site-team-focus" aria-labelledby="focus-heading">
                    <h2 id="focus-heading">Areas of focus</h2>
                    <ul>
                        <?php foreach ($member['focus'] as $area): ?>
                            <li><?= htmlspecialchars($area, ENT_QUOTES, 'UTF-8') ?></li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </div>
        <?php else: ?>
            <section class="site-team-intro" aria-labelledby="team-heading">
                <div class="site-shell">
                    <?php if ($profileMissing): ?>
                        <a class="site-team-link" href="/team">← Back to our team</a>
                    <?php endif; ?>
                    <h1 id="team-heading"><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></h1>
                    <?php if (!$profileMissing): ?>
                        <p>Meet the people behind Peatech’s software, systems engineering, and automation work.</p>
                    <?php endif; ?>
                </div>
            </section>
            <?php if (!$profileMissing): ?>
                <section class="site-team-members site-shell" aria-label="Leadership">
                    <?php require __DIR__ . '/team-cards.php'; ?>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <?php require __DIR__ . '/site-footer.php'; ?>
</body>
</html>
