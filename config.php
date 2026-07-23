<?php
if (basename($_SERVER['PHP_SELF']) == 'config.php') die('Access denied');

session_start();

// Database configuration
$host = 'localhost';
$dbname = 'bathlome_article';
$username = 'bathlome_article';
$password = 'rumbleguy.2ado';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Function to check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
}

// Function to generate slug from heading
function createSlug($string) {
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    return trim($string, '-');
}

// Function to clean TinyMCE editor content
function cleanEditorContent($content) {
    $content = str_replace('&nbsp;', ' ', $content);
    $content = str_replace("\xC2\xA0", ' ', $content);
    $content = preg_replace('/<p>\s*<\/p>/', '', $content);
    $content = preg_replace('/<p><\/p>/', '', $content);
    $content = preg_replace('/<p>\s*<br\s*\/?>\s*<\/p>/', '', $content);
    $content = preg_replace('/\s+/', ' ', $content);
    $content = preg_replace('/>\s+</', '><', $content);
    return trim($content);
}

// Function to get user departments
function getUserDepartments($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT d.* FROM departments d 
                           JOIN user_departments ud ON d.id = ud.department_id 
                           WHERE ud.user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll();
}

// Function to check if user can review an article
function canReviewArticle($pdo, $article_id, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM article_review_assignments 
                           WHERE article_id = ? AND reviewer_id = ? AND status = 'pending'");
    $stmt->execute([$article_id, $user_id]);
    return $stmt->rowCount() > 0;
}

// Function to get pending review count for user
function getPendingReviewCount($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM article_review_assignments 
                           WHERE reviewer_id = ? AND status = 'pending'");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
}

// Function to get user by ID
function getUserById($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetch();
}

// Function to check if user can edit article
function canEditArticle($pdo, $article_id, $user_id) {
    $stmt = $pdo->prepare("SELECT author_id FROM articles WHERE id = ?");
    $stmt->execute([$article_id]);
    $article = $stmt->fetch();
    
    if (!$article) return false;
    if ($article['author_id'] == $user_id) return true;
    
    // Admin can edit any article
    $user = getUserById($pdo, $user_id);
    return $user && $user['role'] == 'admin';
}

// Function to generate random password
function generateRandomPassword($length = 10) {
    return 'Password123';
}

// Function to create notification
function createNotification($pdo, $user_id, $article_id, $type, $message) {
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, article_id, type, message) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $article_id, $type, $message]);
}

// Function to get unread notification count
function getUnreadNotificationCount($pdo, $user_id) {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn();
}
?>