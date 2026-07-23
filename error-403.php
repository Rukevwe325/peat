<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied - Peatech Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #266075;
            --accent-orange: #ff7b25;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary-blue), #1a2a3a);
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .error-card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .error-code {
            font-size: 6rem;
            font-weight: 700;
            color: var(--primary-blue);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="error-card">
                    <div class="error-code">403</div>
                    <i class="fas fa-lock fa-3x mb-3" style="color: var(--accent-orange);"></i>
                    <h2>Access Forbidden</h2>
                    <p class="text-muted">You don't have permission to access this directory.</p>
                    <a href="index.php" class="btn btn-primary-custom mt-3">Return to Homepage</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>