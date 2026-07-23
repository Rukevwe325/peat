<?php
require_once 'config.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Get user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if (!password_verify($current_password, $user['password_hash'])) {
        $error = 'Current password is incorrect!';
    } elseif (strlen($new_password) < 6) {
        $error = 'New password must be at least 6 characters!';
    } elseif ($new_password !== $confirm_password) {
        $error = 'Passwords do not match!';
    } else {
        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password_hash = ?, must_change_password = 0 WHERE id = ?");
        $stmt->execute([$new_hash, $_SESSION['user_id']]);
        $success = 'Password changed successfully!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { 
            --primary-blue: #266075; 
            --dark-blue: #1a2a3a; 
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background: #f8f9fa; 
        }
        .form-container { 
            background: white; 
            border-radius: 15px; 
            padding: 2rem; 
            max-width: 500px; 
            margin: 3rem auto; 
            box-shadow: 0 2px 8px rgba(0,0,0,0.08); 
        }
        .btn-primary-custom { 
            background: var(--primary-blue); 
            border: none; 
            padding: 12px; 
            width: 100%; 
            color: white; 
            border-radius: 8px; 
            font-weight: 600; 
        }
        .btn-primary-custom:hover { 
            background: #1a4a5a; 
        }
        .btn-dashboard {
            background: #28a745;
            border: none;
            padding: 12px;
            width: 100%;
            color: white;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .btn-dashboard:hover {
            background: #218838;
            color: white;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <?php include 'navbar-fragment.php'; ?>
    
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">
                <i class="fas fa-key me-2" style="color: var(--primary-blue);"></i> 
                Change Password
            </h2>
            
            <?php if ($success): ?>
                <div class="text-center">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="alert alert-success text-center">
                        <?php echo $success; ?>
                    </div>
                    <p class="text-muted mb-4">Your password has been updated. You can now use your new password to login.</p>
                    <a href="admin/dashboard.php" class="btn-dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i> Go to Dashboard
                    </a>
                    <hr class="my-4">
                    <a href="logout.php" class="text-muted">
                        <i class="fas fa-sign-out-alt me-1"></i> Or logout
                    </a>
                </div>
            <?php else: ?>
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['must_change_password']) && $_SESSION['must_change_password']): ?>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Welcome!</strong> Please change your password to continue.
                    </div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="new_password" class="form-control" required>
                        <small class="text-muted">Minimum 6 characters</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn-primary-custom">Update Password</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    
    <?php include 'footer-fragment.php'; ?>
</body>
</html>