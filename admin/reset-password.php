<?php
require_once '../config.php';

if (!isLoggedIn() || !isAdmin()) {
    header('Location: ../login.php');
    exit();
}

$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user = getUserById($pdo, $user_id);

if (!$user) {
    header('Location: create-user.php');
    exit();
}

$new_password = 'Password123';
$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password_hash = ?, must_change_password = 1 WHERE id = ?");
$stmt->execute([$password_hash, $user_id]);

$_SESSION['message'] = "Password reset for '{$user['username']}'. New password: $new_password";
header('Location: create-user.php');
exit();
?>