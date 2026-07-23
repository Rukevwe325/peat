<?php
require_once 'config.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Mark all as read
if (isset($_GET['mark_read'])) {
    $stmt = $pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?");
    $stmt->execute([$user_id]);
    header('Location: notifications.php');
    exit();
}

// Get notifications
$stmt = $pdo->prepare("SELECT n.*, a.heading as article_title 
                       FROM notifications n
                       LEFT JOIN articles a ON n.article_id = a.id
                       WHERE n.user_id = ? 
                       ORDER BY n.created_at DESC
                       LIMIT 50");
$stmt->execute([$user_id]);
$notifications = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #266075; }
        body { font-family: 'Inter', sans-serif; background: #f8f9fa; }
        .notification-card { background: white; border-radius: 12px; padding: 1rem; margin-bottom: 0.75rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); transition: all 0.2s; }
        .notification-card.unread { background: #e7f3ff; border-left: 4px solid var(--primary-blue); }
        .notification-card:hover { transform: translateX(5px); }
        .notification-icon { width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
    </style>
</head>
<body>
    <?php include 'navbar-fragment.php'; ?>
    
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fas fa-bell me-2" style="color: var(--primary-blue);"></i> Notifications</h2>
            <?php if (count($notifications) > 0): ?>
                <a href="?mark_read=1" class="btn btn-sm btn-secondary">Mark all as read</a>
            <?php endif; ?>
        </div>
        
        <?php if (empty($notifications)): ?>
            <div class="text-center py-5">
                <i class="fas fa-bell-slash fa-4x text-muted mb-3"></i>
                <h4>No notifications</h4>
                <p class="text-muted">You're all caught up!</p>
            </div>
        <?php else: ?>
            <?php foreach ($notifications as $notif): ?>
                <div class="notification-card <?php echo $notif['is_read'] ? '' : 'unread'; ?>">
                    <div class="d-flex align-items-start gap-3">
                        <div class="notification-icon bg-<?php 
                            echo $notif['type'] == 'approved' ? 'success' : ($notif['type'] == 'rejected' ? 'danger' : 'warning'); 
                        ?> bg-opacity-25">
                            <i class="fas fa-<?php 
                                echo $notif['type'] == 'approved' ? 'check-circle text-success' : 
                                     ($notif['type'] == 'rejected' ? 'times-circle text-danger' : 'clock text-warning'); 
                            ?>"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-1"><?php echo htmlspecialchars($notif['message']); ?></p>
                            <?php if ($notif['article_title']): ?>
                                <small class="text-muted">Article: <?php echo htmlspecialchars($notif['article_title']); ?></small>
                            <?php endif; ?>
                            <br><small class="text-muted"><?php echo date('M j, Y g:i A', strtotime($notif['created_at'])); ?></small>
                        </div>
                        <?php if (!$notif['is_read']): ?>
                            <small class="text-primary">New</small>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    
    <?php include 'footer-fragment.php'; ?>
</body>
</html>