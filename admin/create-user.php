<?php
require_once '../config.php';

// Check if logged in and is admin
if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$error = '';
$success = '';
$new_password = '';

// Get all departments
$stmt = $pdo->query("SELECT * FROM departments ORDER BY name");
$departments = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $selected_departments = $_POST['departments'] ?? [];
    $role = $_POST['role'] ?? 'user';
    
    if (empty($username)) {
        $error = 'Username is required!';
    } else {
        // Check if username exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $error = 'Username already exists!';
        } else {
            $new_password = generateRandomPassword();
            $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            
            try {
                $pdo->beginTransaction();
                
                // Create user
                $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role, must_change_password) VALUES (?, ?, ?, 1)");
                $stmt->execute([$username, $password_hash, $role]);
                $user_id = $pdo->lastInsertId();
                
                // Assign departments
                if (!empty($selected_departments)) {
                    $stmt = $pdo->prepare("INSERT INTO user_departments (user_id, department_id) VALUES (?, ?)");
                    foreach ($selected_departments as $dept_id) {
                        $stmt->execute([$user_id, $dept_id]);
                    }
                }
                
                $pdo->commit();
                $success = "User '$username' created successfully!";
                
                // Clear form
                $_POST = [];
                
            } catch(PDOException $e) {
                $pdo->rollBack();
                $error = "Failed to create user: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --primary-blue: #266075; --accent-orange: #ff7b25; --dark-blue: #1a2a3a; --light-grey: #f8f9fa; }
        body { font-family: 'Inter', sans-serif; background: var(--light-grey); }
        .form-container { background: white; border-radius: 15px; padding: 2rem; margin: 2rem 0; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .btn-primary-custom { background: var(--primary-blue); border: none; padding: 12px 30px; color: white; border-radius: 8px; font-weight: 600; }
        .btn-primary-custom:hover { background: #1a4a5a; }
        .password-box { background: #e7f3ff; padding: 1rem; border-radius: 8px; border-left: 4px solid var(--primary-blue); }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php"><i class="fas fa-arrow-left me-2"></i> Back to Dashboard</a>
            <div><span class="text-white me-3"><?php echo htmlspecialchars($_SESSION['username']); ?></span><a href="../logout.php" class="btn btn-outline-light btn-sm">Logout</a></div>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <h2 class="mb-4"><i class="fas fa-user-plus me-2" style="color: var(--primary-blue);"></i> Create New User</h2>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i> <?php echo $success; ?>
                    <?php if ($new_password): ?>
                        <div class="password-box mt-3">
                            <strong><i class="fas fa-key me-2"></i> User Login Credentials:</strong><br>
                            Username: <strong><?php echo htmlspecialchars($_POST['username']); ?></strong><br>
                            Password: <strong><?php echo $new_password; ?></strong><br>
                            <small class="text-muted">User will be required to change password on first login.</small>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label fw-bold">Username *</label>
                    <input type="text" name="username" class="form-control form-control-lg" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Role</label>
                    <select name="role" class="form-select">
                        <option value="user">User (Can post and review)</option>
                        <option value="admin">Admin (Full access)</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Assign Departments</label>
                    <div class="row">
                        <?php foreach ($departments as $dept): ?>
                            <div class="col-md-4 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="departments[]" value="<?php echo $dept['id']; ?>" id="dept_<?php echo $dept['id']; ?>">
                                    <label class="form-check-label" for="dept_<?php echo $dept['id']; ?>">
                                        <?php echo htmlspecialchars($dept['name']); ?>
                                    </label>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <small class="text-muted">User can review articles from these departments</small>
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn-primary-custom"><i class="fas fa-save me-2"></i> Create User</button>
                </div>
            </form>
        </div>
        
        <!-- List Existing Users -->
        <div class="form-container mt-4">
            <h3 class="mb-3"><i class="fas fa-users me-2" style="color: var(--primary-blue);"></i> Existing Users</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr><th>ID</th><th>Username</th><th>Role</th><th>Departments</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT u.*, GROUP_CONCAT(d.name) as dept_names 
                                            FROM users u 
                                            LEFT JOIN user_departments ud ON u.id = ud.user_id 
                                            LEFT JOIN departments d ON ud.department_id = d.id 
                                            GROUP BY u.id 
                                            ORDER BY u.id DESC");
                        $users = $stmt->fetchAll();
                        foreach ($users as $user):
                            $dept_names = $user['dept_names'] ?: 'None';
                        ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><span class="badge bg-<?php echo $user['role'] == 'admin' ? 'danger' : 'primary'; ?>"><?php echo $user['role']; ?></span></td>
                                <td><small><?php echo htmlspecialchars($dept_names); ?></small></td>
                                <td>
                                    <a href="reset-password.php?id=<?php echo $user['id']; ?>" class="btn btn-warning btn-sm" onclick="return confirm('Reset password for this user?')">Reset Password</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>