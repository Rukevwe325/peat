<?php $teamMembers = require __DIR__ . '/team-members.php'; ?>
<ul class="site-team-grid">
    <?php foreach ($teamMembers as $slug => $member): ?>
        <li>
            <a class="site-team-card" href="/team/<?= rawurlencode($slug) ?>">
                <div class="site-team-card-media">
                    <?php require __DIR__ . '/team-portrait.php'; ?>
                </div>
                <div class="site-team-card-details">
                    <div class="site-team-card-name"><?= htmlspecialchars($member['name'], ENT_QUOTES, 'UTF-8') ?></div>
                    <div class="site-team-card-role"><?= htmlspecialchars($member['role'], ENT_QUOTES, 'UTF-8') ?></div>
                    <span class="site-team-card-action" aria-hidden="true">View profile <span>→</span></span>
                </div>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
