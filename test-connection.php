<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';
$dbname = 'bathlome_article';
$username = 'bathlome_article';
$password = 'rumbleguy.2ado';

echo "<h1>Fix Peatech Password</h1>";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // New password hash for "Fastingtea.2"
    $new_hash = password_hash('Fastingtea.2', PASSWORD_DEFAULT);
    
    echo "<p>New hash created: <code>" . $new_hash . "</code></p>";
    
    // Update the user
    $stmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE username = 'Peatech'");
    $stmt->execute([$new_hash]);
    
    if ($stmt->rowCount() > 0) {
        echo "<p style='color:green'>✓ Password updated successfully!</p>";
        echo "<p>You can now login with:</p>";
        echo "<ul>";
        echo "<li><strong>Username:</strong> Peatech</li>";
        echo "<li><strong>Password:</strong> Fastingtea.2</li>";
        echo "</ul>";
    } else {
        // If update failed, user might not exist - insert instead
        echo "<p style='color:orange'>User 'Peatech' not found, creating new user...</p>";
        
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
        $stmt->execute(['Peatech', $new_hash]);
        
        echo "<p style='color:green'>✓ User created successfully!</p>";
        echo "<p>You can now login with:</p>";
        echo "<ul>";
        echo "<li><strong>Username:</strong> Peatech</li>";
        echo "<li><strong>Password:</strong> Fastingtea.2</li>";
        echo "</ul>";
    }
    
    // Verify the password works
    echo "<h2>Testing the password...</h2>";
    $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE username = 'Peatech'");
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user && password_verify('Fastingtea.2', $user['password_hash'])) {
        echo "<p style='color:green'>✓ Password verification SUCCESSFUL!</p>";
        echo "<p><a href='login.php' style='background: #266075; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Login Page →</a></p>";
    } else {
        echo "<p style='color:red'>✗ Password verification FAILED. Please try again.</p>";
    }
    
} catch(PDOException $e) {
    echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
}
?>