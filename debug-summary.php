<?php
require_once 'config.php';

if (!isLoggedIn() || !isAdmin()) {
    die('Access denied');
}

echo "<h1>Database Summary</h1>";

// Users
$users = $pdo->query("SELECT u.*, GROUP_CONCAT(d.name) as departments 
                      FROM users u 
                      LEFT JOIN user_departments ud ON u.id = ud.user_id 
                      LEFT JOIN departments d ON ud.department_id = d.id 
                      GROUP BY u.id")->fetchAll();
echo "<h2>Users (" . count($users) . ")</h2>";
echo "<pre>";
foreach ($users as $u) {
    echo "ID: {$u['id']} | Username: {$u['username']} | Role: {$u['role']} | Depts: {$u['departments']}\n";
}
echo "</pre>";

// Departments
$depts = $pdo->query("SELECT * FROM departments")->fetchAll();
echo "<h2>Departments (" . count($depts) . ")</h2>";
echo "<pre>";
foreach ($depts as $d) {
    echo "ID: {$d['id']} | Name: {$d['name']}\n";
}
echo "</pre>";

// Pending Articles
$pending = $pdo->query("SELECT a.id, a.heading, a.review_status, d.name as dept 
                        FROM articles a 
                        LEFT JOIN departments d ON a.review_department_id = d.id 
                        WHERE a.review_status = 'pending_review'")->fetchAll();
echo "<h2>Pending Reviews (" . count($pending) . ")</h2>";
echo "<pre>";
foreach ($pending as $p) {
    echo "ID: {$p['id']} | Title: {$p['heading']} | Dept: {$p['dept']}\n";
}
echo "</pre>";

// Review Assignments
$assignments = $pdo->query("SELECT COUNT(*) as count FROM article_review_assignments")->fetchColumn();
echo "<h2>Review Assignments: $assignments records</h2>";

// User-Department assignments
$user_dept = $pdo->query("SELECT COUNT(*) as count FROM user_departments")->fetchColumn();
echo "<h2>User-Department assignments: $user_dept records</h2>";

echo "<hr>";
echo "<p><a href='debug-database.php' class='btn btn-primary'>View Full Database →</a></p>";