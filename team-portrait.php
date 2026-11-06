<?php if (isset($member['photo'])): ?>
    <img class="site-team-portrait" src="<?= htmlspecialchars($member['photo'], ENT_QUOTES, 'UTF-8') ?>" width="160" height="160" alt="">
<?php else: ?>
    <span class="site-team-portrait" aria-hidden="true"><?= htmlspecialchars($member['initials'], ENT_QUOTES, 'UTF-8') ?></span>
<?php endif; ?>
