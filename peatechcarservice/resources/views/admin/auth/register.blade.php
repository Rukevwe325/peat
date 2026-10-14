<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register | Peamech</title>

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
            color: #60efff;
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
            background: #0f172a;
        }

        .register-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 480px;
            color: #fff;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .register-card h2 {
            text-align: center;
            margin-bottom: 0.5rem;
            font-weight: 700;
            font-size: 2rem;
            color: #00fff7;
        }

        .register-card .subtitle {
            text-align: center;
            color: #94a3b8;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .form-label {
            color: #cbd5e1;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.3);
            color: #fff;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            transition: all 0.3s;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
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
            color: #667eea;
        }

        .btn-register {
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 255, 247, 0.6);
            background: #00d9d2;
        }

        .photo-preview-wrapper {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .photo-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            display: none;
            margin: 0 auto;
            border: 3px solid #00fff7;
            box-shadow: 0 4px 15px rgba(0, 255, 247, 0.3);
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .upload-btn {
            background: rgba(0, 255, 247, 0.15);
            color: #00fff7;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            border: 1px solid rgba(0, 255, 247, 0.3);
        }

        .upload-btn:hover {
            background: rgba(0, 255, 247, 0.25);
            border-color: #00fff7;
        }

        .upload-btn-wrapper input[type=file] {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
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

        .alert {
            border-radius: 0.75rem;
            border: none;
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

    .register-card {
        padding: 2rem 1.5rem;
    }

    .register-card h2 {
        font-size: 1.75rem;
    }
}

@media (max-width: 576px) {
    .register-card {
        padding: 1.5rem 1rem;
        border-radius: 1rem;
    }

    .register-card h2 {
        font-size: 1.5rem;
    }

    .left-content h1 {
        font-size: 2rem;
    }

    .btn-register {
        padding: 0.75rem;
    }
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
            <h1>Join Our Mechanic Network</h1>
            <p>List your workshop and connect with customers looking for trusted automotive services.</p>

            <div class="feature-list">
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Reach more customers</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Manage bookings easily</span>
                </div>
                <div class="feature-item">
                    <i class="fas fa-check-circle"></i>
                    <span>Grow your business</span>
                </div>
            </div>
        </div>
    </div>

    <!-- RIGHT SIDE FORM -->
    <div class="right-side">
        <div class="register-card">

            <h2>Create Account</h2>
            <p class="subtitle">Join us and start growing your workshop</p>

            <form method="POST" action="{{ route('admin.register.submit') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">

                <div class="photo-preview-wrapper">
                    <img id="photoPreview" class="photo-preview" alt="Profile Preview" />
                    <div class="upload-btn-wrapper">
                        <div class="upload-btn">
                            <i class="fas fa-camera"></i> Upload Profile Photo
                        </div>
                        <input type="file" name="profile_photo" id="photoInput" accept="image/*" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                </div>

                <div class="mb-3">
                    <input type="tel" name="phone" class="form-control" placeholder="Phone Number" required>
                </div>

                <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                </div>

                <div class="mb-3 password-wrapper">
                    <input type="password" name="password" class="form-control" placeholder="Password" id="password" required>
                    <i class="fa-solid fa-eye" id="togglePassword"></i>
                </div>

                <div class="mb-3 password-wrapper">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" id="passwordConfirm" required>
                    <i class="fa-solid fa-eye" id="togglePasswordConfirm"></i>
                </div>

                <div class="mb-3">
                    <textarea name="address" class="form-control" rows="3" placeholder="Workshop address (e.g. Cleveland Ohio)" required></textarea>
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-register">Create Account</button>
                </div>

                <div class="text-center">
                    <small class="text-muted">Already have an account?
                        <a href="{{ route('admin.login') }}">Sign In</a>
                    </small>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ✅ ADDED: LOCATION MODAL (NEW, NOTHING REMOVED) -->
<div class="modal fade" id="locationModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark text-white border-0 rounded-4">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <i class="fas fa-location-dot text-info me-2"></i>
                    Enable Location
                </h5>
            </div>
            <div class="modal-body text-center">
                <p>Please turn on your location to help us accurately register your workshop.</p>
                <small class="text-muted">This is required.</small>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button class="btn btn-outline-info" data-bs-dismiss="modal">
                    Okay, I understand
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ORIGINAL GEOLOCATION SCRIPT (ENHANCED, NOT REMOVED) -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const locationModal = new bootstrap.Modal(
        document.getElementById('locationModal'),
        { backdrop: 'static', keyboard: false }
    );

    locationModal.show();

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            position => {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;

                console.log('Latitude:', position.coords.latitude);
                console.log('Longitude:', position.coords.longitude);

                locationModal.hide();
            },
            error => {
                console.warn("Location permission denied", error);
            }
        );
    } else {
        console.warn('Geolocation is not supported by this browser');
    }
});
</script>

<!-- YOUR ORIGINAL PASSWORD + PHOTO JS (UNCHANGED) -->
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
    const password = document.querySelector('#password');
    const passwordConfirm = document.querySelector('#passwordConfirm');

    togglePassword.addEventListener('click', () => {
        password.type = password.type === 'password' ? 'text' : 'password';
        togglePassword.classList.toggle('fa-eye-slash');
    });

    togglePasswordConfirm.addEventListener('click', () => {
        passwordConfirm.type = passwordConfirm.type === 'password' ? 'text' : 'password';
        togglePasswordConfirm.classList.toggle('fa-eye-slash');
    });

    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');

    photoInput.addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = () => {
            photoPreview.src = reader.result;
            photoPreview.style.display = 'block';
        };
        reader.readAsDataURL(e.target.files[0]);
    });

    document.querySelector('form').addEventListener('submit', e => {
        if (password.value !== passwordConfirm.value) {
            e.preventDefault();
            alert('Passwords do not match!');
        }
        if (password.value.length < 8) {
            e.preventDefault();
            alert('Password must be at least 8 characters long!');
        }
    });
</script>

</body>
</html>
