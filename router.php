<?php
/**
 * router.php
 * Routing script for the PHP built-in development server (php -S).
 * Implements the same URL rewriting rules as defined in .htaccess.
 */

$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// 1. Serve static files directly if they exist on disk
if ($path !== '/' && file_exists(__DIR__ . $path)) {
    return false;
}

// 2. Handle specific rewrite rules
// Match /article/{slug} -> article.php?slug={slug}
if (preg_match('#^/article/([^/]+)$#', $path, $matches)) {
    $_GET['slug'] = $matches[1];
    require_once __DIR__ . '/article.php';
    return;
}

// 3. Fallback routing for extensionless PHP files
// E.g., /peasyn -> peasyn.php, /articles -> articles.php
$clean_path = trim($path, '/');
if ($clean_path && file_exists(__DIR__ . '/' . $clean_path . '.php')) {
    require_once __DIR__ . '/' . $clean_path . '.php';
    return;
}

// 4. Default fallback to homepage
require_once __DIR__ . '/index.php';
