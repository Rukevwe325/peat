<?php
require_once 'config.php';

if (!isLoggedIn() || !isAdmin()) {
    die('Access denied');
}

$query = $_POST['query'] ?? '';

if (empty($query)) {
    die('No query provided');
}

try {
    $stmt = $pdo->query($query);
    $results = $stmt->fetchAll();
    
    if (empty($results)) {
        echo '<div class="alert alert-info">No results found.</div>';
    } else {
        echo '<div class="table-responsive">';
        echo '<table class="table table-sm table-bordered">';
        echo '<thead class="table-dark"><tr>';
        foreach (array_keys($results[0]) as $col) {
            echo '<th>' . htmlspecialchars($col) . '</th>';
        }
        echo '</tr></thead><tbody>';
        
        foreach ($results as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . (is_null($value) ? '<span class="text-muted">NULL</span>' : htmlspecialchars($value)) . '</td>';
            }
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '</div>';
        echo '<small class="text-muted">' . count($results) . ' rows returned</small>';
    }
} catch(PDOException $e) {
    echo '<div class="alert alert-danger">Error: ' . htmlspecialchars($e->getMessage()) . '</div>';
}
?>