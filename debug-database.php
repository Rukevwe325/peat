<?php
require_once 'config.php';

// Only allow admin to view this
if (!isLoggedIn() || !isAdmin()) {
    header('Location: login.php');
    exit();
}

$selected_table = $_GET['table'] ?? 'users';
$message = '';

// Get all tables
$stmt = $pdo->query("SHOW TABLES");
$tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Get data from selected table
$stmt = $pdo->query("SELECT * FROM $selected_table");
$data = $stmt->fetchAll();

// Get table structure
$stmt = $pdo->query("DESCRIBE $selected_table");
$structure = $stmt->fetchAll();

// Count rows
$row_count = count($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Viewer - Peatech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Courier New', monospace; background: #f5f5f5; }
        .table-card { background: white; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        .table-responsive { max-height: 600px; overflow: auto; }
        .table th { position: sticky; top: 0; background: #266075; color: white; }
        .nav-pills .nav-link { color: #266075; }
        .nav-pills .nav-link.active { background: #266075; }
        pre { background: #f8f9fa; padding: 1rem; border-radius: 8px; overflow-x: auto; }
        .badge-count { font-size: 0.8rem; margin-left: 5px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="admin/dashboard.php">
                <i class="fas fa-database me-2"></i> Database Viewer
            </a>
            <div>
                <span class="text-white me-3"><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar with tables -->
            <div class="col-md-3 mb-4">
                <div class="table-card">
                    <h5 class="mb-3">
                        <i class="fas fa-database me-2"></i> Tables
                    </h5>
                    <div class="nav flex-column nav-pills">
                        <?php foreach ($tables as $table): ?>
                            <a class="nav-link <?php echo $table == $selected_table ? 'active' : ''; ?>" 
                               href="?table=<?php echo $table; ?>">
                                <i class="fas fa-table me-2"></i> <?php echo $table; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <div class="col-md-9">
                <!-- Current Table Info -->
                <div class="table-card">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3>
                            <i class="fas fa-table me-2"></i> 
                            Table: <?php echo $selected_table; ?>
                            <span class="badge bg-secondary"><?php echo $row_count; ?> rows</span>
                        </h3>
                        <button class="btn btn-sm btn-info" onclick="document.getElementById('structure').style.display='block'">
                            <i class="fas fa-eye"></i> Show Structure
                        </button>
                    </div>

                    <!-- Table Structure (hidden by default) -->
                    <div id="structure" style="display: none;" class="mb-4">
                        <h5><i class="fas fa-code-branch me-2"></i> Table Structure</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead class="table-dark">
                                    <tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($structure as $field): ?>
                                        <tr>
                                            <td><strong><?php echo $field['Field']; ?></strong></td>
                                            <td><?php echo $field['Type']; ?></td>
                                            <td><?php echo $field['Null']; ?></td>
                                            <td><?php echo $field['Key']; ?></td>
                                            <td><?php echo $field['Default']; ?></td>
                                            <td><?php echo $field['Extra']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Table Data -->
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <?php if (!empty($data)): ?>
                                        <?php foreach (array_keys($data[0]) as $column): ?>
                                            <th><?php echo $column; ?></th>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <th>No data</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row): ?>
                                    <tr>
                                        <?php foreach ($row as $key => $value): ?>
                                            <td style="max-width: 300px; overflow: auto;">
                                                <?php 
                                                if (is_null($value)) {
                                                    echo '<span class="text-muted">NULL</span>';
                                                } elseif ($key == 'password_hash') {
                                                    echo substr($value, 0, 30) . '...';
                                                } elseif ($key == 'content') {
                                                    echo substr(strip_tags($value), 0, 100) . '...';
                                                } else {
                                                    echo htmlspecialchars($value);
                                                }
                                                ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if (empty($data)): ?>
                        <div class="alert alert-info mb-0">No data in this table.</div>
                    <?php endif; ?>
                </div>

                <!-- Quick SQL Query -->
                <div class="table-card">
                    <h5 class="mb-3"><i class="fas fa-terminal me-2"></i> Quick Diagnostic Queries</h5>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-outline-primary btn-sm w-100" onclick="runQuery('users')">
                                <i class="fas fa-users"></i> Show Users & Departments
                            </button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-outline-warning btn-sm w-100" onclick="runQuery('pending')">
                                <i class="fas fa-clock"></i> Show Pending Reviews
                            </button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-outline-info btn-sm w-100" onclick="runQuery('assignments')">
                                <i class="fas fa-tasks"></i> Show Review Assignments
                            </button>
                        </div>
                        <div class="col-md-6 mb-2">
                            <button class="btn btn-outline-danger btn-sm w-100" onclick="runQuery('dept_users')">
                                <i class="fas fa-building"></i> Department Members
                            </button>
                        </div>
                    </div>
                    <div id="queryResult" style="display: none; margin-top: 1rem;" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function runQuery(type) {
            let query = '';
            if (type === 'users') {
                query = `SELECT u.id, u.username, u.role, u.must_change_password, 
                        GROUP_CONCAT(d.name SEPARATOR ', ') as departments
                        FROM users u
                        LEFT JOIN user_departments ud ON u.id = ud.user_id
                        LEFT JOIN departments d ON ud.department_id = d.id
                        GROUP BY u.id
                        ORDER BY u.id`;
            } else if (type === 'pending') {
                query = `SELECT a.id, a.heading, a.subject, a.review_status, 
                        d.name as department_name, u.username as author
                        FROM articles a
                        LEFT JOIN departments d ON a.review_department_id = d.id
                        LEFT JOIN users u ON a.author_id = u.id
                        WHERE a.review_status = 'pending_review'
                        ORDER BY a.submitted_at DESC`;
            } else if (type === 'assignments') {
                query = `SELECT ara.id, a.heading, a.review_status, u.username as reviewer, ara.status as review_status
                        FROM article_review_assignments ara
                        JOIN articles a ON ara.article_id = a.id
                        JOIN users u ON ara.reviewer_id = u.id
                        ORDER BY ara.id DESC
                        LIMIT 20`;
            } else if (type === 'dept_users') {
                query = `SELECT d.name as department, 
                        GROUP_CONCAT(u.username ORDER BY u.username SEPARATOR ', ') as members
                        FROM departments d
                        LEFT JOIN user_departments ud ON d.id = ud.department_id
                        LEFT JOIN users u ON ud.user_id = u.id
                        GROUP BY d.id
                        ORDER BY d.name`;
            }
            
            fetch('run-query.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'query=' + encodeURIComponent(query)
            })
            .then(response => response.text())
            .then(html => {
                const resultDiv = document.getElementById('queryResult');
                resultDiv.innerHTML = html;
                resultDiv.style.display = 'block';
            });
        }
    </script>
</body>
</html>