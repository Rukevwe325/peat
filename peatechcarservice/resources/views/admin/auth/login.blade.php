<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Your App</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: #0f2027;
        }

        /* Layout */
        .split-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left Image Section */
        .left-side {
            flex: 1;
            background: #0f2027;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .left-overlay {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800') center/cover no-repeat;
            opacity: 0.3;
        }

        .left-content {
            position: relative;
            z-index: 2;
            color: #fff;
            padding: 3rem;
            max-width: 500px;
            text-align: center;
        }

        .left-content h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .left-content p {
            font-size: 1.125rem;
            line-height: 1.6;
            opacity: 0.95;
        }

        .feature-list {
            margin-top: 2rem;
            text-align: left;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        .feature-item i {
            margin-right: 1rem;
            color: #00fff7;
            font-size: 1.25rem;
        }

        /* Floating elements */
        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: float 8s ease-in-out infinite;
        }

        .circle-1 {
            width: 300px;
            height: 300px;
            top: -100px;
            right: -100px;
            animation-delay: 0s;
        }

        .circle-2 {
            width: 200px;
            height: 200px;
            bottom: -50px;
            left: -50px;
            animation-delay: 2s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(5deg); }
        }

        /* Right Form Section */
        .right-side {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background: #0f2027;
        }

        .login-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 3rem 2rem;
            width: 100%;
            max-width: 450px;
            color: #fff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .login-card h2 {
            text-align: center;
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 2rem;
            color: #00fff7;
        }

        .login-card .subtitle {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 2.5rem;
            font-size: 0.9rem;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.3);
            color: #fff;
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #00fff7;
            box-shadow: 0 0 0 3px rgba(0, 255, 247, 0.2);
            color: #fff;
        }

        .form-control::placeholder {
            color: #64748b;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper i {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #94a3b8;
            transition: color 0.3s;
        }

        .password-wrapper i:hover {
            color: #00fff7;
        }

        .btn-login {
            background: #00fff7;
            color: #0f2027;
            font-weight: 600;
            border: none;
            border-radius: 0.75rem;
            padding: 0.875rem;
            font-size: 1rem;
            transition: transform 0.2s, box-shadow 0.3s;
            box-shadow: 0 4px 15px rgba(0, 255, 247, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 255, 247, 0.6);
            background: #00d9d2;
        }

        a {
            color: #00fff7;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #00d9d2;
            text-decoration: none;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .left-side {
                display: none;
            }

            .right-side {
                flex: 1;
                padding: 1.5rem;
            }

            .login-card {
                padding: 2.5rem 1.5rem;
            }

            .login-card h2 {
                font-size: 1.75rem;
            }
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
                border-radius: 1rem;
            }

            .login-card h2 {
                font-size: 1.5rem;
            }

            .left-content h1 {
                font-size: 2rem;
            }

            .btn-login {
                padding: 0.75rem;
            }
        }

        /* Success/Error Messages */
        .alert {
            border-radius: 0.75rem;
            border: none;
        }
    </style>
</head>

<body>

    <div class="split-container">
        
        <!-- LEFT SIDE IMAGE -->
        <div class="left-side">
            <div class="left-overlay"></div>
            <div class="floating-circle circle-1"></div>
            <div class="floating-circle circle-2"></div>
            
            <div class="left-content">
                <h1>Welcome Back</h1>
                <p>Sign in to manage your workshop and connect with customers seeking quality automotive services.</p>
                
                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Manage your listings</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Track bookings</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Grow your revenue</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE FORM -->
        <div class="right-side">
            <div class="login-card">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <h2>Admin Login</h2>
                <p class="subtitle">Enter your credentials to access your dashboard</p>

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <!-- Password -->
                    <div class="mb-3 password-wrapper">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
                        <i class="fa-solid fa-eye" id="togglePassword"></i>
                    </div>

                    <!-- Submit -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-login">Sign In</button>
                    </div>

                    <!-- Forgot Password -->
                    <div class="text-center">
                        <small><a href="#">Forgot Password?</a></small>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Toggle Password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            // Toggle type
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>