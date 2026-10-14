<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background: #0f2027;
        }

        .split-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left section */
        .left-side {
            flex: 1;
            background: #0f2027;
            position: relative;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3rem;
        }

        .left-overlay {
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800') center/cover no-repeat;
            opacity: 0.25;
        }

        .left-content {
            position: relative;
            color: white;
            z-index: 3;
            max-width: 500px;
            text-align: center;
        }

        .left-content h1 {
            font-size: 2.3rem;
            font-weight: 700;
        }

        .left-content p {
            font-size: 1.1rem;
            opacity: 0.95;
            margin-top: 1rem;
        }

        .floating-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            animation: float 8s ease-in-out infinite;
        }

        .circle-1 { width: 280px; height: 280px; top: -90px; right: -90px; }
        .circle-2 { width: 220px; height: 220px; bottom: -50px; left: -50px; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-25px); }
        }

        /* Right side login form */
        .right-side {
            flex: 1;
            background: #0f172a;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .login-card {
            background: rgba(30, 41, 59, 0.85);
            border-radius: 1.5rem;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.1);
            color: #fff;
        }

        .login-card h2 {
            text-align: center;
            font-weight: 700;
            margin-bottom: .5rem;
            color: #00fff7;
        }

        .login-card .subtitle {
            text-align: center;
            font-size: .9rem;
            color: #94a3b8;
            margin-bottom: 2rem;
        }

        .form-control {
            background: rgba(15,23,42,0.6);
            border: 1px solid rgba(255,255,255,.2);
            border-radius: .75rem;
            padding: .75rem 1rem;
            color: white;
        }

        .form-control:focus {
            background: rgba(15,23,42,0.8);
            border-color: #00fff7;
            box-shadow: 0 0 0 3px rgba(0,255,247,0.25);
            color: #fff;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper i {
            position: absolute;
            top: 50%;
            right: 15px;
            color: #94a3b8;
            cursor: pointer;
            transform: translateY(-50%);
        }

        .btn-login {
            background: #00fff7;
            border: none;
            width: 100%;
            padding: .85rem;
            color: #0f2027;
            font-weight: 600;
            border-radius: .75rem;
            transition: .3s;
        }

        .btn-login:hover {
            background: #00d7cf;
            transform: translateY(-2px);
        }

        @media(max-width: 991px){
            .left-side { display: none; }
        }
    </style>
</head>

<body>

    <div class="split-container">

        <!-- LEFT SIDE -->
        <div class="left-side">
            <div class="left-overlay"></div>
            <div class="floating-circle circle-1"></div>
            <div class="floating-circle circle-2"></div>

            <div class="left-content">
                <h1>Welcome Back</h1>
                <p>Sign in to access your dashboard, bookings, saved mechanics, and more.</p>
            </div>
        </div>

        <!-- RIGHT SIDE LOGIN -->
        <div class="right-side">
            <div class="login-card">

                <h2>Sign In</h2>
                <p class="subtitle">Access your account</p>

                <form method="POST" action="{{ route('user.login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                    </div>

                    <div class="mb-3 password-wrapper">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                        <i class="fa-solid fa-eye" id="togglePassword"></i>
                    </div>

                    <div class="d-grid mb-3">
                        <button type="submit" class="btn-login">Login</button>
                    </div>

                    <div class="text-center">
                        <small class="text-muted">
                            Don't have an account? 
                            <a href="{{ route('user.register') }}">Create one</a>
                        </small>
                    </div>

                </form>

            </div>
        </div>

    </div>

<script>
    // Password Toggle
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const type = password.type === 'password' ? 'text' : 'password';
        password.type = type;
        togglePassword.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>
