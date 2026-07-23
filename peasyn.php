<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PeaSyn is a physics-guided platform that unifies machine behavior, process data, simulation, and digital twins to predict, optimize, and accelerate advanced manufacturing.">
    <title>PeaSyn - Machine-Aware Simulation Intelligence | Peatech Services</title>
    <link rel="icon" href="favicon.png" type="image/png">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-teal: #1a6f5e;
            --primary-teal-glow: rgba(26, 111, 94, 0.15);
            --brand-green: #10b981;
            --brand-green-glow: rgba(16, 185, 129, 0.2);
            --primary-blue: #266075;
            --dark-blue: #1a2a3a;
            --accent-orange: #ff7b25;
            --bg-slate: #0b131a;
            --text-dark: #1e293b;
            --text-light: #64748b;
            --bg-light: #f8fafc;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: #ffffff;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
        }

        /* Hero Section */
        .hero-section {
            padding: 80px 0;
            background: radial-gradient(circle at 80% 20%, rgba(26, 111, 94, 0.08) 0%, rgba(255, 255, 255, 0) 60%);
            position: relative;
        }

        .tag-introducing {
            display: inline-block;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 2px;
            color: var(--brand-green);
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .logo-peasyn {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .logo-text-peasyn {
            font-family: 'Outfit', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark-blue);
            margin: 0;
        }

        .logo-text-peasyn span {
            color: var(--brand-green);
        }

        .hero-heading {
            font-size: 2.8rem;
            line-height: 1.2;
            color: var(--dark-blue);
            margin-bottom: 1.5rem;
        }

        @media (min-width: 992px) {
            .hero-heading {
                font-size: 3.5rem;
            }
        }

        .hero-description {
            font-size: 1.15rem;
            color: var(--text-light);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn-peasyn-primary {
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--brand-green) 100%);
            color: white;
            border: none;
            padding: 14px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(26, 111, 94, 0.3);
        }

        .btn-peasyn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 111, 94, 0.4);
            color: white;
        }

        .btn-peasyn-secondary {
            background: white;
            color: var(--primary-teal);
            border: 2px solid var(--primary-teal);
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-peasyn-secondary:hover {
            background: var(--bg-light);
            color: var(--primary-teal);
            transform: translateY(-2px);
        }

        .hero-banner-text {
            font-size: 0.9rem;
            color: var(--text-light);
            border-top: 1px solid #e2e8f0;
            padding-top: 1.5rem;
            margin-top: 2.5rem;
        }

        /* PeaSyn Twin Interface Mockup */
        .twin-mockup {
            background: var(--bg-slate);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            padding: 1.25rem;
            color: #f8fafc;
            position: relative;
            overflow: hidden;
        }

        .twin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 0.75rem;
            margin-bottom: 1rem;
        }

        .twin-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #f8fafc;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .twin-dot {
            width: 8px;
            height: 8px;
            background-color: var(--brand-green);
            border-radius: 50%;
            animation: pulse-green 2s infinite;
        }

        @keyframes pulse-green {
            0% { transform: scale(0.9); opacity: 0.7; }
            50% { transform: scale(1.2); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.7; }
        }

        .twin-body {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        @media (min-width: 576px) {
            .twin-body {
                grid-template-columns: 2.2fr 1fr;
            }
        }

        .twin-simulation-box {
            background: #111e29;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            height: 230px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .twin-sidebar {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .twin-panel-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 0.75rem;
        }

        .twin-panel-title {
            font-size: 0.75rem;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .bead-graph {
            height: 60px;
            width: 100%;
        }

        .twin-insights {
            grid-column: 1 / -1;
            background: rgba(16, 185, 129, 0.05);
            border: 1px solid rgba(16, 185, 129, 0.15);
            border-radius: 10px;
            padding: 0.9rem;
        }

        .insight-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        @media (min-width: 480px) {
            .insight-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        .insight-stat {
            text-align: center;
        }

        .insight-label {
            font-size: 0.68rem;
            color: #94a3b8;
        }

        .insight-val {
            font-size: 1.1rem;
            font-weight: 700;
            color: #ffffff;
            font-family: 'Outfit', sans-serif;
        }

        .insight-rec {
            font-size: 0.78rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 0.5rem;
            color: #fcd34d;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* 3D Bead Simulation Graphic (SVG + CSS) */
        .simulation-mesh {
            width: 80%;
            height: 80%;
            display: block;
        }

        /* 4-Column Feature Row */
        .feature-block {
            background-color: var(--bg-light);
            padding: 60px 0;
            border-bottom: 1px solid #edf2f7;
        }

        .feature-item-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        .feature-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-teal);
        }

        .feature-icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background-color: var(--primary-teal-glow);
            color: var(--primary-teal);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .feature-item-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .feature-item-desc {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0;
        }

        .section-title {
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto 3rem;
        }

        /* Challenge vs Solution Section */
        .challenges-section {
            padding: 80px 0;
        }

        .comparison-wrapper {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
            align-items: center;
        }

        @media (min-width: 992px) {
            .comparison-wrapper {
                grid-template-columns: 1.25fr 0.8fr 1.25fr;
            }
        }

        .comp-card {
            border-radius: 16px;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        .comp-card-challenge {
            border: 1px dashed #f87171;
            background-color: rgba(254, 242, 242, 0.4);
        }

        .comp-card-solution {
            border: 1px solid var(--brand-green);
            background-color: rgba(240, 253, 250, 0.5);
            box-shadow: 0 10px 25px var(--brand-green-glow);
        }

        .comp-header {
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 1.5px;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .comp-header-challenge { color: #dc2626; }
        .comp-header-solution { color: #059669; }

        .comp-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .comp-list-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-size: 0.95rem;
            font-weight: 550;
        }

        .comp-icon-fail {
            color: #ef4444;
            font-size: 1.15rem;
            margin-top: 2px;
        }

        .comp-icon-pass {
            color: var(--brand-green);
            font-size: 1.15rem;
            margin-top: 2px;
        }

        .comp-center-graphic {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .rotating-ring {
            width: 140px;
            height: 140px;
            border: 2px dashed rgba(26, 111, 94, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: rotate-cw 20s linear infinite;
        }

        @keyframes rotate-cw {
            100% { transform: rotate(360deg); }
        }

        .peasyn-core-badge {
            width: 80px;
            height: 80px;
            background: white;
            border: 2px solid var(--primary-teal);
            border-radius: 50%;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(26, 111, 94, 0.15);
        }

        .arrow-connector {
            font-size: 1.5rem;
            color: var(--primary-teal);
            margin-top: 15px;
            display: none;
        }

        @media (min-width: 992px) {
            .arrow-connector {
                display: block;
            }
        }

        /* How PeaSyn Works Flow */
        .how-works-section {
            background-color: var(--bg-light);
            padding: 80px 0;
            border-top: 1px solid #edf2f7;
            border-bottom: 1px solid #edf2f7;
        }

        .pipeline-flow {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            position: relative;
            margin-top: 2.5rem;
        }

        @media (min-width: 992px) {
            .pipeline-flow {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .pipeline-step {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            flex: 1;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.03);
            position: relative;
        }

        .pipeline-step:hover {
            transform: translateY(-5px);
            border-color: var(--primary-teal);
            box-shadow: 0 12px 20px -8px rgba(26, 111, 94, 0.15);
        }

        .step-number {
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--brand-green);
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }

        .step-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.75rem;
        }

        .step-desc {
            font-size: 0.85rem;
            color: var(--text-light);
            margin-bottom: 0;
        }

        .pipeline-arrow {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 1.25rem;
        }

        @media (min-width: 992px) {
            .pipeline-arrow {
                margin: 0 -0.5rem;
            }
        }

        /* The PeaSyn Platform Grid */
        .platform-section {
            padding: 80px 0;
        }

        .platform-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 2.5rem;
        }

        @media (min-width: 576px) {
            .platform-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 992px) {
            .platform-grid {
                grid-template-columns: repeat(5, 1fr);
            }
        }

        .platform-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            transition: all 0.3s;
        }

        .platform-card:hover {
            border-color: var(--primary-teal);
            box-shadow: 0 4px 12px rgba(26, 111, 94, 0.08);
        }

        .platform-card-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .platform-list {
            padding-left: 1rem;
            margin: 0;
            font-size: 0.82rem;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        /* Interactive Single-Bead WAAM Section */
        .waam-section {
            padding: 80px 0;
            background-color: var(--bg-light);
            border-top: 1px solid #edf2f7;
            border-bottom: 1px solid #edf2f7;
        }

        .waam-interactive-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .waam-tabs {
            display: flex;
            border-bottom: 2px solid #e2e8f0;
            margin-bottom: 1.5rem;
            overflow-x: auto;
            gap: 1.5rem;
        }

        .waam-tab-btn {
            background: none;
            border: none;
            padding: 0.75rem 0;
            font-weight: 600;
            font-size: 0.92rem;
            color: var(--text-light);
            position: relative;
            white-space: nowrap;
            transition: all 0.2s;
        }

        .waam-tab-btn.active {
            color: var(--primary-teal);
        }

        .waam-tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--primary-teal);
        }

        .waam-tab-content {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .waam-tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .tab-visual-box {
            background: #ffffff;
            border-radius: 12px;
            height: 330px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-dark);
            padding: 1.5rem;
            overflow: hidden;
            position: relative;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        /* 4-Column Research Row */
        .research-section {
            padding: 80px 0;
        }

        .research-card {
            text-align: center;
            padding: 1rem;
            height: 100%;
        }

        .research-icon {
            font-size: 2.2rem;
            color: var(--primary-teal);
            margin-bottom: 1rem;
        }

        .research-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }

        .research-desc {
            font-size: 0.9rem;
            color: var(--text-light);
            margin-bottom: 0;
        }

        /* CTE Banner bottom */
        .cte-banner-block {
            background: linear-gradient(135deg, var(--dark-blue) 0%, var(--primary-blue) 100%);
            color: white;
            padding: 60px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cte-banner-block::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.05) 0%, rgba(255, 255, 255, 0) 65%);
            pointer-events: none;
        }

        .cta-bottom-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            .cta-bottom-title {
                font-size: 2.2rem;
            }
        }

        .cta-bottom-desc {
            color: #cbd5e1;
            font-size: 1.05rem;
            margin-bottom: 2rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta-light {
            background: white;
            color: var(--dark-blue);
            border: 2px solid white;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-cta-light:hover {
            background: transparent;
            color: white;
            transform: translateY(-2px);
        }

        .btn-cta-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-cta-outline:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        /* Navigation (Index Style) */
        .navbar {
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background-color: white !important;
        }
        
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
            color: var(--dark-blue) !important;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--primary-blue) !important;
        }

        /* Top Bar (Index Style) */
        .top-bar {
            background-color: var(--dark-blue);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
        }
        
        .top-bar a {
            color: white;
            text-decoration: none;
        }
        
        .top-bar a:hover {
            color: var(--accent-orange);
        }

        /* Footer (Index Style) */
        .footer {
            background-color: #111;
            color: #aaa;
            padding: 50px 0 20px;
        }
        
        .footer-logo {
            height: 35px;
            width: auto;
            margin-bottom: 1.5rem;
        }
        
        .footer p {
            margin-bottom: 1rem;
        }
        
        .footer a {
            color: #aaa;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: white;
        }
        
        .footer h5 {
            color: white;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .footer ul {
            list-style: none;
            padding: 0;
        }
        
        .footer ul li {
            margin-bottom: 0.75rem;
        }
        
        .footer ul li a {
            color: #aaa;
            text-decoration: none;
        }

        .footer ul li a:hover {
            color: white;
        }
        
        .social-icons a {
            display: inline-block;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            text-align: center;
            line-height: 36px;
            margin-right: 10px;
            transition: all 0.3s;
            color: white;
        }
        
        .social-icons a:hover {
            background-color: var(--primary-blue);
            color: white;
        }
        
        .footer-divider {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 2rem 0 1.5rem;
        }
        
        .copyright {
            text-align: center;
            font-size: 0.9rem;
            color: #777;
        }

        /* Demo/Partner Request Modal Placeholders */
        #demoRequestModal input::placeholder,
        #demoRequestModal textarea::placeholder {
            color: #94a3b8 !important;
            opacity: 1; /* Firefox */
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    Need help? Call us <a href="tel:1-800-123-4567">1-800-123-4567</a>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="https://facebook.com/peatech" class="mx-2"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/peatech" class="mx-2"><i class="fab fa-twitter"></i></a>
                    <a href="https://instagram.com/peatech" class="mx-2"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="images/peatechlogo.webp" alt="Peatech Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="peasyn.php">PeaSyn</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#services">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#vision">Vision</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="logo-peasyn">
                        <!-- Custom SVG PeaSyn Logo Icon -->
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="16" stroke="#1a6f5e" stroke-width="2.5" stroke-dasharray="4 2"/>
                            <circle cx="20" cy="20" r="10" fill="#10b981"/>
                            <path d="M20 6V14M20 26V34M6 20H14M26 20H34" stroke="#1a6f5e" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <h2 class="logo-text-peasyn">Pea<span>Syn</span></h2>
                    </div>
                    <span class="tag-introducing">Introducing</span>
                    <h1 class="hero-heading">Machine-Aware Simulation Intelligence for Advanced Manufacturing</h1>
                    <p class="hero-description">PeaSyn is a physics-guided platform that unifies machine behavior, process data, simulation, and digital twins to predict, optimize, and accelerate advanced manufacturing.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#partner-section" class="btn btn-peasyn-primary">Explore PeaSyn <i class="fas fa-arrow-right ms-1"></i></a>
                        <a href="#waam-section" class="btn btn-peasyn-secondary"><i class="far fa-file-alt me-1"></i> View Technical Overview</a>
                    </div>
                    <p class="hero-banner-text">
                        <i class="fas fa-microchip me-2"></i> Built for engineers. Validated by physics. Designed for impact.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="twin-mockup">
                        <div class="twin-header">
                            <h5 class="twin-title"><span class="twin-dot"></span> PeaSyn Twin</h5>
                            <span class="badge bg-opacity-25 bg-secondary text-light" style="font-size: 0.7rem;">Active Mode</span>
                        </div>
                        <div class="twin-body">
                            <!-- Visual box representing the WAAM printed model -->
                            <div class="twin-simulation-box">
                                <span class="position-absolute top-0 start-0 m-2 badge bg-dark bg-opacity-50 text-white" style="font-size: 0.65rem;">Process Twin — WAAM Single-Bead</span>
                                <span class="position-absolute top-0 end-0 m-2 text-white" style="font-size: 0.65rem; opacity: 0.8;">Time: 12.45s</span>
                                
                                <svg class="simulation-mesh" viewBox="0 0 200 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Base block -->
                                    <path d="M20 70 L90 40 L180 70 L110 100 Z" fill="#1e293b" stroke="#334155" stroke-width="0.75"/>
                                    <!-- Heat printed bead (3D cylinder shape) -->
                                    <path d="M40 70 C 60 55, 140 55, 160 70 L 158 74 C 138 59, 58 59, 42 74 Z" fill="url(#bead-heat)" opacity="0.9"/>
                                    <!-- Laser head pointer -->
                                    <line x1="160" y1="20" x2="160" y2="70" stroke="#06b6d4" stroke-width="1.5" stroke-dasharray="2 2"/>
                                    <circle cx="160" cy="70" r="4" fill="#ef4444" filter="drop-shadow(0px 0px 4px #ff0000)"/>
                                    <!-- Spark dots -->
                                    <circle cx="157" cy="67" r="1" fill="#fcd34d"/>
                                    <circle cx="164" cy="69" r="0.75" fill="#f59e0b"/>
                                    <circle cx="162" cy="73" r="1" fill="#ef4444"/>
                                    
                                    <defs>
                                        <linearGradient id="bead-heat" x1="0" y1="0" x2="1" y2="0">
                                            <stop offset="0%" stop-color="#3b82f6"/>
                                            <stop offset="30%" stop-color="#06b6d4"/>
                                            <stop offset="60%" stop-color="#eab308"/>
                                            <stop offset="90%" stop-color="#ef4444"/>
                                            <stop offset="100%" stop-color="#ffffff"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                            </div>
                            
                            <div class="twin-sidebar">
                                <!-- Melt Pool temp gauge -->
                                <div class="twin-panel-card">
                                    <div class="twin-panel-title">Melt Pool Temp. (°C)</div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div style="font-size: 0.95rem; font-weight: 700; font-family: 'Outfit'; color: #ef4444;">1623°C</div>
                                        <svg width="40" height="20" viewBox="0 0 40 20">
                                            <path d="M5 15 A 15 15 0 0 1 35 15" stroke="#334155" stroke-width="3" fill="none"/>
                                            <path d="M5 15 A 15 15 0 0 1 25 5" stroke="#ef4444" stroke-width="3" fill="none"/>
                                            <polygon points="20,15 23,8 20,4 17,8" fill="#ffffff" transform="rotate(35, 20, 15)"/>
                                        </svg>
                                    </div>
                                    <div class="progress mt-1" style="height: 4px; background-color: #334155;">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <!-- Bead Geometry plot -->
                                <div class="twin-panel-card">
                                    <div class="twin-panel-title">Bead Geometry</div>
                                    <svg class="bead-graph" viewBox="0 0 100 40">
                                        <!-- Weld bead contour shape -->
                                        <path d="M10 35 C 30 10, 70 10, 90 35 Z" fill="rgba(16, 185, 129, 0.15)" stroke="#10b981" stroke-width="1.5"/>
                                        <line x1="10" y1="35" x2="90" y2="35" stroke="#475569" stroke-width="1"/>
                                        <line x1="50" y1="15" x2="50" y2="35" stroke="#3b82f6" stroke-width="1" stroke-dasharray="1 1"/>
                                        <text x="53" y="27" fill="#3b82f6" font-size="6">h:2.35</text>
                                    </svg>
                                </div>
                            </div>
                            
                            <!-- Key Insights -->
                            <div class="twin-insights">
                                <div class="insight-grid">
                                    <div class="insight-stat">
                                        <div class="insight-label">Max Temp</div>
                                        <div class="insight-val">1623°C</div>
                                    </div>
                                    <div class="insight-stat">
                                        <div class="insight-label">Cooling Rate</div>
                                        <div class="insight-val">28.4°C/s</div>
                                    </div>
                                    <div class="insight-stat">
                                        <div class="insight-label">Bead Height</div>
                                        <div class="insight-val">2.35mm</div>
                                    </div>
                                    <div class="insight-stat">
                                        <div class="insight-label">Deposition Rate</div>
                                        <div class="insight-val">85.7g/min</div>
                                    </div>
                                </div>
                                <div class="insight-rec">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    <span><strong>Recommendation:</strong> Reduce travel speed by 8% to minimize residual stress.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Key Features row -->
    <section class="feature-block">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-item-card">
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <h4 class="feature-item-title">Physics-Guided</h4>
                        <p class="feature-item-desc">Grounded in first-principles thermal, mechanical, and metallurgical models for credible predictions.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-item-card">
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-robot"></i>
                        </div>
                        <h4 class="feature-item-title">Machine-Aware</h4>
                        <p class="feature-item-desc">Learns from actual robot paths, CNC codes, and sensor data to adapt to real-world machine behaviors.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-item-card">
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-clone"></i>
                        </div>
                        <h4 class="feature-item-title">Reduced-Order Twin</h4>
                        <p class="feature-item-desc">Uses advanced model reduction to deliver real-time simulation speeds without sacrificing accuracy.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-item-card">
                        <div class="feature-icon-wrapper">
                            <i class="fas fa-bullseye"></i>
                        </div>
                        <h4 class="feature-item-title">Use Case: WAAM</h4>
                        <p class="feature-item-desc">Starting with wire-arc additive manufacturing (WAAM) to solve the industry's toughest scaling challenges.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Challenges vs Solutions Section -->
    <section class="challenges-section">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">From Simulation Challenges to Intelligent Solutions</h2>
                    <p class="section-subtitle">Current simulation software is too slow, and hardware monitoring doesn't predict physical defects. PeaSyn bridges this gap.</p>
                </div>
            </div>
            <div class="comparison-wrapper">
                <!-- Challenge card -->
                <div class="comp-card comp-card-challenge">
                    <div class="comp-header comp-header-challenge"><i class="fas fa-skull-crossbones me-2"></i> The Challenge</div>
                    <ul class="comp-list">
                        <li class="comp-list-item">
                            <i class="fas fa-times-circle comp-icon-fail"></i>
                            <span>Slow, expensive, and compute-heavy FEM simulations taking days to finish.</span>
                        </li>
                        <li class="comp-list-item">
                            <i class="fas fa-times-circle comp-icon-fail"></i>
                            <span>Simulation models that fail to reflect actual machine kinematics and build variations.</span>
                        </li>
                        <li class="comp-list-item">
                            <i class="fas fa-times-circle comp-icon-fail"></i>
                            <span>Complete disconnection between live sensor data, physical models, and process decisions.</span>
                        </li>
                        <li class="comp-list-item">
                            <i class="fas fa-times-circle comp-icon-fail"></i>
                            <span>Limited ability to predict thermal accumulation and prevent defects before they happen.</span>
                        </li>
                    </ul>
                </div>
                <!-- Connector graphic -->
                <div class="comp-center-graphic">
                    <div class="rotating-ring"></div>
                    <div class="peasyn-core-badge">
                        <svg width="36" height="36" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="20" cy="20" r="10" fill="#10b981"/>
                            <path d="M20 6V14M20 26V34M6 20H14M26 20H34" stroke="#1a6f5e" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div class="arrow-connector"><i class="fas fa-long-arrow-alt-right"></i></div>
                </div>
                <!-- Solution card -->
                <div class="comp-card comp-card-solution">
                    <div class="comp-header comp-header-solution"><i class="fas fa-magic me-2"></i> The PeaSyn Solution</div>
                    <ul class="comp-list">
                        <li class="comp-list-item">
                            <i class="fas fa-check-circle comp-icon-pass"></i>
                            <span>Physics-guided reduced-order models delivering high-fidelity simulations in seconds.</span>
                        </li>
                        <li class="comp-list-item">
                            <i class="fas fa-check-circle comp-icon-pass"></i>
                            <span>Machine-aware calibration that matches simulator outputs directly with robot path signals.</span>
                        </li>
                        <li class="comp-list-item">
                            <i class="fas fa-check-circle comp-icon-pass"></i>
                            <span>A unified intelligence platform going from sensor inputs straight to the digital twin.</span>
                        </li>
                        <li class="comp-list-item">
                            <i class="fas fa-check-circle comp-icon-pass"></i>
                            <span>Actionable closed-loop insights that suggest parameter optimizations during runtime.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- How PeaSyn Works Section -->
    <section class="how-works-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">How PeaSyn Works</h2>
                    <p class="section-subtitle">Five distinct steps to transition physical manufacturing data into actionable closed-loop decisions.</p>
                </div>
            </div>
            <div class="pipeline-flow">
                <div class="pipeline-step">
                    <div class="step-number">Step 01</div>
                    <h4 class="step-title">1. Capture</h4>
                    <p class="step-desc">Collect real-time machine log data, tool paths, temperature readings, and acoustic force signals.</p>
                </div>
                <div class="pipeline-arrow"><i class="fas fa-chevron-right d-none d-lg-block"></i><i class="fas fa-chevron-down d-block d-lg-none my-2"></i></div>
                <div class="pipeline-step">
                    <div class="step-number">Step 02</div>
                    <h4 class="step-title">2. Translate</h4>
                    <p class="step-desc">Convert uncalibrated telemetry signals into physics-informed boundary conditions and inputs.</p>
                </div>
                <div class="pipeline-arrow"><i class="fas fa-chevron-right d-none d-lg-block"></i><i class="fas fa-chevron-down d-block d-lg-none my-2"></i></div>
                <div class="pipeline-step">
                    <div class="step-number">Step 03</div>
                    <h4 class="step-title">3. Simulate</h4>
                    <p class="step-desc">Run high-fidelity analytical models for instant thermal-fluid and stress-strain fields.</p>
                </div>
                <div class="pipeline-arrow"><i class="fas fa-chevron-right d-none d-lg-block"></i><i class="fas fa-chevron-down d-block d-lg-none my-2"></i></div>
                <div class="pipeline-step">
                    <div class="step-number">Step 04</div>
                    <h4 class="step-title">4. Twin</h4>
                    <p class="step-desc">Synthesize results into a real-time digital twin process monitor running concurrently with production.</p>
                </div>
                <div class="pipeline-arrow"><i class="fas fa-chevron-right d-none d-lg-block"></i><i class="fas fa-chevron-down d-block d-lg-none my-2"></i></div>
                <div class="pipeline-step">
                    <div class="step-number">Step 05</div>
                    <h4 class="step-title">5. Decide</h4>
                    <p class="step-desc">Deliver closed-loop control suggestions to optimization modules to adjust paths and speeds.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- The PeaSyn Platform Grid -->
    <section class="platform-section">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">The PeaSyn Platform Architecture</h2>
                    <p class="section-subtitle">A comprehensive structure integrating hardware streams, translation engines, solvers, and digital twins.</p>
                </div>
            </div>
            <div class="platform-grid">
                <div class="platform-card">
                    <h5 class="platform-card-title"><i class="fas fa-sign-in-alt text-primary"></i> Machine Inputs</h5>
                    <ul class="platform-list">
                        <li>CNC & Robot G-Codes</li>
                        <li>Sensor Data (Pyrometer)</li>
                        <li>Process Telemetry</li>
                        <li>Substrate Geometry</li>
                    </ul>
                </div>
                <div class="platform-card">
                    <h5 class="platform-card-title"><i class="fas fa-exchange-alt text-success"></i> Physics Translation</h5>
                    <ul class="platform-list">
                        <li>Feature Extraction</li>
                        <li>Telemetry Sync</li>
                        <li>Uncertainty Mapping</li>
                        <li>State Estimation</li>
                    </ul>
                </div>
                <div class="platform-card">
                    <h5 class="platform-card-title"><i class="fas fa-wave-square text-info"></i> High-Fi Models</h5>
                    <ul class="platform-list">
                        <li>Thermal Transients</li>
                        <li>Solidification Rates</li>
                        <li>Phase Transformation</li>
                        <li>Melt Pool Dynamics</li>
                    </ul>
                </div>
                <div class="platform-card">
                    <h5 class="platform-card-title"><i class="fas fa-network-wired text-warning"></i> ROM Twin</h5>
                    <ul class="platform-list">
                        <li>Model Order Reduction</li>
                        <li>Real-Time Prediction</li>
                        <li>Parameter Estimation</li>
                        <li>State Correction</li>
                    </ul>
                </div>
                <div class="platform-card">
                    <h5 class="platform-card-title"><i class="fas fa-lightbulb text-danger"></i> Actionable Insights</h5>
                    <ul class="platform-list">
                        <li>Defect Anomaly Alarms</li>
                        <li>Weld Geometry Monitor</li>
                        <li>Thermal Accumulation</li>
                        <li>Feed & Path Override</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Starting with Single-Bead WAAM (Interactive Tabs Section) -->
    <section id="waam-section" class="waam-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <h2 class="section-title mb-4">Starting with Single-Bead WAAM</h2>
                    <p class="mb-4">We focus on the most fundamental building block of wire-arc additive manufacturing — the single bead. By understanding thermal cycles, melt pool dynamics, and bead geometry, PeaSyn enables reliable scaling to complex aerospace and industrial parts.</p>
                    
                    <ul class="list-unstyled mb-4 d-flex flex-column gap-3">
                        <li class="d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <span>Predict melt pool size, shape, and transient peak temperature.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <span>Estimate bead width, height, and interlayer bonding fusion.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <span>Assess residual thermal stresses and structural distortion risk.</span>
                        </li>
                        <li class="d-flex align-items-start gap-2">
                            <i class="fas fa-check-circle text-success mt-1"></i>
                            <span>Optimize process parameters to guarantee print quality.</span>
                        </li>
                    </ul>
                    
                    <a href="#partner-section" class="btn btn-peasyn-primary">Explore WAAM Use Case <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
                
                <div class="col-lg-7">
                    <div class="waam-interactive-card">
                        <div class="waam-tabs">
                            <button class="waam-tab-btn active" onclick="switchWaamTab(event, 'thermal-field')">Thermal Field</button>
                            <button class="waam-tab-btn" onclick="switchWaamTab(event, 'melt-pool')">Melt Pool</button>
                            <button class="waam-tab-btn" onclick="switchWaamTab(event, 'bead-geometry')">Bead Geometry</button>
                            <button class="waam-tab-btn" onclick="switchWaamTab(event, 'residual-stress')">Residual Stress</button>
                        </div>
                        
                        <!-- Thermal Field content -->
                        <div id="thermal-field" class="waam-tab-content active">
                            <div class="tab-visual-box">
                                <span class="position-absolute top-0 start-0 m-3 text-secondary" style="font-size: 0.8rem; font-weight: 600;"><i class="fas fa-fire me-1 text-danger"></i> Transient Thermal Gradient</span>
                                
                                <svg width="100%" height="100%" viewBox="0 0 450 280" style="display: block;">
                                    <defs>
                                        <!-- Blurred heat filters -->
                                        <filter id="heatBlur-lg" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="16" />
                                        </filter>
                                        <filter id="heatBlur-md" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="10" />
                                        </filter>
                                        <filter id="heatBlur-sm" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="6" />
                                        </filter>
                                        <filter id="heatBlur-xs" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="3" />
                                        </filter>

                                        <!-- Substrate Cool Blue Gradient -->
                                        <linearGradient id="subGrad" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#2563eb" stop-opacity="0.8"/>
                                            <stop offset="100%" stop-color="#1d4ed8" stop-opacity="0.95"/>
                                        </linearGradient>

                                        <!-- Bead Track Base Cool Blue Gradient -->
                                        <linearGradient id="beadCoolGrad" x1="0" y1="0" x2="1" y2="1">
                                            <stop offset="0%" stop-color="#1e40af"/>
                                            <stop offset="100%" stop-color="#1d4ed8"/>
                                        </linearGradient>

                                        <!-- Legend Color Gradient -->
                                        <linearGradient id="legendGrad" x1="0" y1="1" x2="0" y2="0">
                                            <stop offset="0%" stop-color="#0544b6"/>
                                            <stop offset="25%" stop-color="#00a2e8"/>
                                            <stop offset="50%" stop-color="#3af205"/>
                                            <stop offset="75%" stop-color="#fff200"/>
                                            <stop offset="90%" stop-color="#ff7f27"/>
                                            <stop offset="100%" stop-color="#ed1c24"/>
                                        </linearGradient>

                                        <!-- Reflection Fade Mask -->
                                        <linearGradient id="reflectFade" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#ffffff" stop-opacity="0.3"/>
                                            <stop offset="100%" stop-color="#ffffff" stop-opacity="1"/>
                                        </linearGradient>
                                    </defs>

                                    <!-- 1. Reflected 3D block (Upside down, lower opacity) -->
                                    <g opacity="0.15" transform="scale(1, -1) translate(0, -390)">
                                        <!-- Substrate bottom/front faces -->
                                        <path d="M 60 150 L 200 90 L 340 140 L 200 200 Z" fill="url(#subGrad)" stroke="#3b82f6" stroke-width="1"/>
                                        <path d="M 60 150 L 200 200 L 200 215 L 60 165 Z" fill="#1e3a8a" stroke="#3b82f6" stroke-width="1"/>
                                        <path d="M 200 200 L 340 140 L 340 155 L 200 215 Z" fill="#172554" stroke="#3b82f6" stroke-width="1"/>
                                        <!-- Raised Bead track reflection -->
                                        <path d="M 120 120 L 140 110 L 280 150 L 260 160 Z" fill="url(#beadCoolGrad)" stroke="#60a5fa" stroke-width="0.75"/>
                                    </g>
                                    <!-- Overlay rect to smoothly fade out the reflection -->
                                    <rect x="20" y="200" width="360" height="70" fill="url(#reflectFade)"/>

                                    <!-- 2. Main 3D Substrate Block -->
                                    <!-- Base Substrate Top Face -->
                                    <path d="M 60 150 L 200 90 L 340 140 L 200 200 Z" fill="url(#subGrad)" stroke="#60a5fa" stroke-width="1.25"/>
                                    <!-- Base Substrate Front-Left Face -->
                                    <path d="M 60 150 L 200 200 L 200 215 L 60 165 Z" fill="#1d4ed8" stroke="#3b82f6" stroke-width="1.25"/>
                                    <!-- Base Substrate Front-Right Face -->
                                    <path d="M 200 200 L 340 140 L 340 155 L 200 215 Z" fill="#1e3a8a" stroke="#3b82f6" stroke-width="1.25"/>

                                    <!-- 3. Raised Weld Bead Track -->
                                    <!-- Bead Track Top Surface -->
                                    <path d="M 120 120 L 140 110 L 280 150 L 260 160 Z" fill="url(#beadCoolGrad)" stroke="#93c5fd" stroke-width="1"/>
                                    <!-- Bead Track Front-Left Face -->
                                    <path d="M 120 120 L 260 160 L 260 166 L 120 126 Z" fill="#1e3a8a" stroke="#3b82f6" stroke-width="1"/>
                                    <!-- Bead Track Front-Right Face -->
                                    <path d="M 260 160 L 280 150 L 280 156 L 260 166 Z" fill="#172554" stroke="#3b82f6" stroke-width="1"/>

                                    <!-- 4. Thermal Overlay (Blurred Heat Map Layers) -->
                                    <!-- Large Cool Blue/Cyan Expansion Glow -->
                                    <ellipse cx="205" cy="138" rx="80" ry="38" fill="#00a2e8" opacity="0.35" filter="url(#heatBlur-lg)" transform="rotate(-15, 205, 138)"/>
                                    <!-- Greenish Transition Glow -->
                                    <ellipse cx="202" cy="136" rx="55" ry="26" fill="#3af205" opacity="0.45" filter="url(#heatBlur-md)" transform="rotate(-15, 202, 136)"/>
                                    <!-- Yellow Warm Zone -->
                                    <ellipse cx="198" cy="134" rx="38" ry="18" fill="#fff200" opacity="0.75" filter="url(#heatBlur-sm)" transform="rotate(-15, 198, 134)"/>
                                    <!-- Orange High Heat Zone -->
                                    <ellipse cx="192" cy="132" rx="26" ry="12" fill="#ff7f27" opacity="0.85" filter="url(#heatBlur-sm)" transform="rotate(-15, 192, 132)"/>
                                    <!-- Red Hot Melt Core -->
                                    <ellipse cx="186" cy="129" rx="16" ry="7" fill="#ed1c24" opacity="0.95" filter="url(#heatBlur-xs)" transform="rotate(-15, 186, 129)"/>
                                    <!-- White-Hot center pointer -->
                                    <ellipse cx="180" cy="126" rx="6" ry="3" fill="#ffffff" opacity="0.95" filter="url(#heatBlur-xs)" transform="rotate(-15, 180, 126)"/>

                                    <!-- 5. Colorbar Legend (Right side) -->
                                    <g transform="translate(390, 45)">
                                        <!-- Gradient bar -->
                                        <rect x="0" y="20" width="10" height="140" fill="url(#legendGrad)" rx="2"/>
                                        <!-- Title label -->
                                        <text x="5" y="10" fill="#475569" font-size="11" font-weight="700" font-family="'Outfit', sans-serif" text-anchor="middle">°C</text>
                                        <!-- Ticks / Values -->
                                        <text x="18" y="25" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">1600</text>
                                        <text x="18" y="67" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">1200</text>
                                        <text x="18" y="109" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">800</text>
                                        <text x="18" y="155" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">400</text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Melt Pool content -->
                        <div id="melt-pool" class="waam-tab-content">
                            <div class="tab-visual-box">
                                <span class="position-absolute top-0 start-0 m-3 text-secondary" style="font-size: 0.8rem; font-weight: 600;"><i class="fas fa-circle-notch me-1 text-primary"></i> Melt Pool Shape & Temperature Profile</span>
                                
                                <svg width="100%" height="100%" viewBox="0 0 450 280" style="display: block;">
                                    <defs>
                                        <!-- Blurred heat filters -->
                                        <filter id="mpBlur-lg" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="14" />
                                        </filter>
                                        <filter id="mpBlur-md" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="8" />
                                        </filter>
                                        <filter id="mpBlur-sm" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="4" />
                                        </filter>
                                        <filter id="mpBlur-xs" x="-50%" y="-50%" width="200%" height="200%">
                                            <feGaussianBlur stdDeviation="2" />
                                        </filter>

                                        <!-- Cool Blue Base Metal -->
                                        <linearGradient id="baseMetalGrad" x1="0" y1="0" x2="0" y2="1">
                                            <stop offset="0%" stop-color="#1e3a8a"/>
                                            <stop offset="100%" stop-color="#0f172a"/>
                                        </linearGradient>

                                        <!-- Legend Color Gradient -->
                                        <linearGradient id="legendGrad2" x1="0" y1="1" x2="0" y2="0">
                                            <stop offset="0%" stop-color="#0544b6"/>
                                            <stop offset="25%" stop-color="#00a2e8"/>
                                            <stop offset="50%" stop-color="#3af205"/>
                                            <stop offset="75%" stop-color="#fff200"/>
                                            <stop offset="90%" stop-color="#ff7f27"/>
                                            <stop offset="100%" stop-color="#ed1c24"/>
                                        </linearGradient>
                                    </defs>

                                    <!-- Base cool metal background -->
                                    <rect x="30" y="30" width="330" height="220" fill="url(#baseMetalGrad)" rx="10" stroke="#334155" stroke-width="1.5"/>

                                    <!-- Weld bead track boundaries (solidified track behind, moving left to right) -->
                                    <path d="M 30 110 L 220 110" stroke="#475569" stroke-width="2" stroke-dasharray="4 4"/>
                                    <path d="M 30 170 L 220 170" stroke="#475569" stroke-width="2" stroke-dasharray="4 4"/>
                                    <!-- Solidified bead ripples -->
                                    <path d="M 50 110 C 60 120, 60 160, 50 170" fill="none" stroke="#334155" stroke-width="1.5"/>
                                    <path d="M 80 110 C 90 120, 90 160, 80 170" fill="none" stroke="#334155" stroke-width="1.5"/>
                                    <path d="M 110 110 C 120 120, 120 160, 110 170" fill="none" stroke="#334155" stroke-width="1.5"/>
                                    <path d="M 140 110 C 150 120, 150 160, 140 170" fill="none" stroke="#334155" stroke-width="1.5"/>
                                    <path d="M 170 110 C 180 120, 180 160, 170 170" fill="none" stroke="#334155" stroke-width="1.5"/>

                                    <!-- Melt Pool Heat Profile (Trailing from Right to Left as Torch moves Left to Right) -->
                                    <!-- Large thermal dissipation zone (cyan) -->
                                    <ellipse cx="200" cy="140" rx="90" ry="45" fill="#00a2e8" opacity="0.3" filter="url(#mpBlur-lg)"/>
                                    <!-- Green transition zone -->
                                    <ellipse cx="210" cy="140" rx="65" ry="32" fill="#3af205" opacity="0.4" filter="url(#mpBlur-md)"/>
                                    <!-- Yellow heat affected zone -->
                                    <ellipse cx="220" cy="140" rx="45" ry="22" fill="#fff200" opacity="0.6" filter="url(#mpBlur-sm)"/>
                                    <!-- Orange liquid pool boundary -->
                                    <ellipse cx="225" cy="140" rx="32" ry="16" fill="#ff7f27" opacity="0.8" filter="url(#mpBlur-sm)"/>
                                    <!-- Red molten center -->
                                    <ellipse cx="230" cy="140" rx="20" ry="10" fill="#ed1c24" opacity="0.9" filter="url(#mpBlur-xs)"/>
                                    <!-- White-hot arc spot -->
                                    <ellipse cx="235" cy="140" rx="8" ry="4" fill="#ffffff" opacity="0.95" filter="url(#mpBlur-xs)"/>

                                    <!-- Torch direction indicator -->
                                    <g transform="translate(280, 75)">
                                        <line x1="0" y1="0" x2="40" y2="0" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="2 2"/>
                                        <polygon points="40,0 35,-3 35,3" fill="#94a3b8"/>
                                        <text x="20" y="-8" fill="#94a3b8" font-size="8" font-family="'Inter', sans-serif" text-anchor="middle" font-weight="600">Travel Direction</text>
                                    </g>

                                    <!-- Colorbar Legend (Right side) -->
                                    <g transform="translate(390, 45)">
                                        <!-- Gradient bar -->
                                        <rect x="0" y="20" width="10" height="140" fill="url(#legendGrad2)" rx="2"/>
                                        <!-- Title label -->
                                        <text x="5" y="10" fill="#475569" font-size="11" font-weight="700" font-family="'Outfit', sans-serif" text-anchor="middle">°C</text>
                                        <!-- Ticks / Values -->
                                        <text x="18" y="25" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">1600</text>
                                        <text x="18" y="67" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">1200</text>
                                        <text x="18" y="109" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">800</text>
                                        <text x="18" y="155" fill="#475569" font-size="10" font-family="'Inter', sans-serif" font-weight="500">400</text>
                                    </g>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Bead Geometry content -->
                        <div id="bead-geometry" class="waam-tab-content">
                            <div class="tab-visual-box">
                                <span class="position-absolute top-0 start-0 m-3 text-secondary" style="font-size: 0.8rem; font-weight: 600;"><i class="fas fa-shapes me-1 text-success"></i> Transverse Bead Cross-Section</span>
                                
                                <svg width="100%" height="100%" viewBox="0 0 450 280" style="display: block;">
                                    <!-- Base substrate line -->
                                    <line x1="40" y1="180" x2="360" y2="180" stroke="#334155" stroke-width="3"/>
                                    
                                    <!-- Substrate base block outline for visual context -->
                                    <rect x="40" y="180" width="320" height="60" fill="#e2e8f0" stroke="#cbd5e1" stroke-width="1.5" rx="2"/>
                                    
                                    <!-- Penetration zone (under substrate) -->
                                    <path d="M120 180 C 150 205, 250 205, 280 180 Z" fill="rgba(239, 68, 68, 0.15)" stroke="#ef4444" stroke-width="1.5" stroke-dasharray="3 3"/>
                                    
                                    <!-- Bead profile (above substrate) -->
                                    <path d="M120 180 C 140 100, 260 100, 280 180 Z" fill="rgba(16, 185, 129, 0.2)" stroke="#10b981" stroke-width="3"/>
                                    
                                    <!-- Dimension Calls & Labels -->
                                    <!-- Width Dimension -->
                                    <line x1="120" y1="195" x2="280" y2="195" stroke="#475569" stroke-width="1"/>
                                    <line x1="120" y1="190" x2="120" y2="200" stroke="#475569" stroke-width="1"/>
                                    <line x1="280" y1="190" x2="280" y2="200" stroke="#475569" stroke-width="1"/>
                                    <text x="200" y="212" fill="#1e293b" font-size="11" font-family="'Outfit', sans-serif" font-weight="600" text-anchor="middle">Width: 6.8mm</text>
                                    
                                    <!-- Height Dimension -->
                                    <line x1="295" y1="125" x2="295" y2="180" stroke="#475569" stroke-width="1"/>
                                    <line x1="290" y1="125" x2="300" y2="125" stroke="#475569" stroke-width="1"/>
                                    <line x1="290" y1="180" x2="300" y2="180" stroke="#475569" stroke-width="1"/>
                                    <text x="306" y="157" fill="#1e293b" font-size="11" font-family="'Outfit', sans-serif" font-weight="600" alignment-baseline="middle">Height: 2.35mm</text>

                                    <!-- Center Line -->
                                    <line x1="200" y1="120" x2="200" y2="190" stroke="#94a3b8" stroke-width="1" stroke-dasharray="2 2"/>

                                    <!-- Labels for features -->
                                    <text x="200" y="160" fill="#10b981" font-size="11" font-family="'Outfit', sans-serif" font-weight="700" text-anchor="middle">Weld Bead Profile</text>
                                    <text x="200" y="190" fill="#ef4444" font-size="9" font-family="'Outfit', sans-serif" font-weight="700" text-anchor="middle">Dilution/Penetration</text>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Residual Stress content -->
                        <div id="residual-stress" class="waam-tab-content">
                            <div class="tab-visual-box">
                                <span class="position-absolute top-0 start-0 m-3 text-secondary" style="font-size: 0.8rem; font-weight: 600;"><i class="fas fa-chart-line me-1 text-primary"></i> Thermal Stress vs Cooling Cycle</span>
                                
                                <svg width="100%" height="100%" viewBox="0 0 450 280" style="display: block;">
                                    <!-- Chart Grid Lines -->
                                    <line x1="50" y1="60" x2="380" y2="60" stroke="#e2e8f0" stroke-width="1"/>
                                    <line x1="50" y1="110" x2="380" y2="110" stroke="#e2e8f0" stroke-width="1"/>
                                    <line x1="50" y1="160" x2="380" y2="160" stroke="#e2e8f0" stroke-width="1"/>
                                    
                                    <!-- Chart Axes -->
                                    <line x1="50" y1="40" x2="50" y2="210" stroke="#475569" stroke-width="1.5"/>
                                    <line x1="50" y1="210" x2="400" y2="210" stroke="#475569" stroke-width="1.5"/>
                                    
                                    <!-- Axis Labels -->
                                    <text x="35" y="45" fill="#475569" font-size="10" font-family="'Outfit', sans-serif" font-weight="600" text-anchor="end">Temp (°C)</text>
                                    <text x="390" y="225" fill="#475569" font-size="10" font-family="'Outfit', sans-serif" font-weight="600" text-anchor="end">Time (s)</text>
                                    
                                    <!-- Axis Ticks & Values -->
                                    <text x="42" y="64" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="end">1600</text>
                                    <text x="42" y="114" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="end">1000</text>
                                    <text x="42" y="164" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="end">400</text>
                                    <text x="42" y="214" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="end">0</text>

                                    <text x="50" y="224" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="middle">0</text>
                                    <text x="160" y="224" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="middle">10</text>
                                    <text x="270" y="224" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="middle">20</text>
                                    <text x="380" y="224" fill="#64748b" font-size="9" font-family="'Inter', sans-serif" text-anchor="middle">30</text>
                                    
                                    <!-- Curves -->
                                    <!-- actual cooling curve (Unoptimized - high stress) -->
                                    <path d="M50 60 C 100 70, 150 180, 380 205" fill="none" stroke="#ef4444" stroke-width="3"/>
                                    <!-- target cooling curve (Optimized - low stress) -->
                                    <path d="M50 60 C 130 110, 220 195, 380 208" fill="none" stroke="#10b981" stroke-width="2.5" stroke-dasharray="4 3"/>
                                    
                                    <!-- Legend Labels inside Chart -->
                                    <rect x="230" y="55" width="140" height="45" fill="rgba(255,255,255,0.9)" rx="6" stroke="#e2e8f0" stroke-width="1"/>
                                    
                                    <line x1="240" y1="68" x2="260" y2="68" stroke="#ef4444" stroke-width="3"/>
                                    <text x="268" y="72" fill="#1e293b" font-size="9.5" font-family="'Outfit', sans-serif" font-weight="600">Unoptimized Path</text>
                                    
                                    <line x1="240" y1="88" x2="260" y2="88" stroke="#10b981" stroke-width="2.5" stroke-dasharray="3 2"/>
                                    <text x="268" y="92" fill="#1e293b" font-size="9.5" font-family="'Outfit', sans-serif" font-weight="600">Optimized Target</text>

                                    <!-- Title / Helper -->
                                    <text x="215" y="25" fill="#1e293b" font-size="11" font-family="'Outfit', sans-serif" font-weight="700" text-anchor="middle">Transient Thermal Relaxation Profile</text>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Research Row -->
    <section class="research-section">
        <div class="container">
            <div class="row mb-5 text-center">
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title">Research-Driven. Validated. Continuously Improving.</h2>
                    <p class="section-subtitle">We balance rigorous mathematical physics with empirical validation to build simulator twins you can trust.</p>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="research-card">
                        <div class="research-icon"><i class="fas fa-atom"></i></div>
                        <h4 class="research-title">Physics & Simulation</h4>
                        <p class="research-desc">First-principles thermal and structural solvers calibrated for advanced metallurgy.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="research-card">
                        <div class="research-icon"><i class="fas fa-hdd"></i></div>
                        <h4 class="research-title">Machine Data</h4>
                        <p class="research-desc">Direct machine telemetry capture and sync protocols matching simulation time steps.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="research-card">
                        <div class="research-icon"><i class="fas fa-flask"></i></div>
                        <h4 class="research-title">Experimental Validation</h4>
                        <p class="research-desc">Continuous laboratory trials and mechanical stress tests to confirm model predictions.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="research-card">
                        <div class="research-icon"><i class="fas fa-sync-alt"></i></div>
                        <h4 class="research-title">Continuous Learning</h4>
                        <p class="research-desc">Closed-loop refinement algorithms adapting to machine wear and environment shifts.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Hook / CTA Banner -->
    <section id="partner-section" class="cte-banner-block">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-10 mx-auto">
                    <h2 class="cta-bottom-title">We connect machines, physics, data, and intelligence to build the future of advanced manufacturing.</h2>
                    <p class="cta-bottom-desc">Peatech develops deep-tech software platforms that turn complex, high-variability manufacturing processes into predictable, optimized, and sustainable industrial operations.</p>
                    
                    <div class="d-flex justify-content-center gap-4 flex-wrap mb-4">
                        <div style="font-size: 0.9rem;"><i class="fas fa-award text-success me-1"></i> Deep-Tech R&D Driven</div>
                        <div style="font-size: 0.9rem;"><i class="fas fa-cogs text-success me-1"></i> Built for Industry Impact</div>
                        <div style="font-size: 0.9rem;"><i class="fas fa-handshake text-success me-1"></i> Partnering for a Smarter Future</div>
                    </div>
                    
                    <hr style="border-color: rgba(255,255,255,0.15); margin: 2rem 0;">
                    
                    <h3 class="fs-4 mb-4">Let's build the future of manufacturing—together.</h3>
                    <p class="text-white-50 mb-4">Partner with Peatech to accelerate research, pilot projects, and industrial deployments of PeaSyn.</p>
                    
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <button class="btn btn-cta-light" data-bs-toggle="modal" data-bs-target="#demoRequestModal" data-bs-mode="partner">Partner With Us</button>
                        <button class="btn btn-cta-outline" data-bs-toggle="modal" data-bs-target="#demoRequestModal" data-bs-mode="demo">Request a Demo</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <img src="images/peatechlogo.webp" alt="Peatech Logo" class="footer-logo">
                    <p>Peatech Services — The Connection Company. We build bridges that make life and business flow better.</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i> 5247 Wilson Mills RD #1012 Richmond Heights, OH 44143-3016 United States</p>
                    <p><a href="#">Show on map</a></p>
                    <div class="social-icons mt-4">
                        <a href="https://facebook.com/peatech"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/peatech"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/peatech"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h5>Need to connect?</h5>
                    <p><i class="fas fa-phone me-2"></i> <a href="tel:+18001234567">+1-800-123-4567</a></p>
                    <p class="text-muted">Monday – Friday: 8:00-18:00<br>Saturday: 9:00 – 14:00</p>
                    <hr class="footer-divider">
                    <p><i class="fas fa-envelope me-2"></i> <a href="mailto:info@peatechservice.com">info@peatechservice.com</a></p>
                </div>
                <div class="col-lg-4">
                    <h5>Connection Points</h5>
                    <ul>
                        <li><a href="index.php#services">Our Services</a></li>
                        <li><a href="peasyn.php">PeaSyn</a></li>
                        <li><a href="index.php#vision">Our Vision</a></li>
                        <li><a href="#">Case Studies</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="careers">Join Our Team</a></li>
                        <li><a href="index.php#contact">Connect With Us</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="copyright">
                <p class="mb-0">© 2026 Peatech Services. All rights reserved. | The Connection Company | <a href="privacy-policy.php" style="color: #bbb; text-decoration: none;">Privacy Policy</a></p>
            </div>
        </div>
    </footer>

    <!-- Demo Request Modal -->
    <div class="modal fade" id="demoRequestModal" tabindex="-1" aria-labelledby="demoRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2); background-color: #1a2a3a; color: #f8fafc;">
                <div class="modal-header" style="border-bottom: 1px solid #2d3e50;">
                    <h5 class="modal-title" id="demoRequestModalLabel" style="font-family: 'Outfit'; font-weight: 700; color: #10b981;"><i class="fas fa-laptop-code me-2"></i>Request a PeaSyn Demo</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form id="demoRequestForm">
                        <div class="mb-3">
                            <label for="demoName" class="form-label" style="font-size: 0.9rem; font-weight: 500; color: #cbd5e1;">Full Name</label>
                            <input type="text" class="form-control" id="demoName" required placeholder="Enter your full name" style="background-color: #111e2b; border: 1px solid #2d3e50; color: #f8fafc; border-radius: 8px; padding: 10px;">
                        </div>
                        <div class="mb-3">
                            <label for="demoEmail" class="form-label" style="font-size: 0.9rem; font-weight: 500; color: #cbd5e1;">Work Email</label>
                            <input type="email" class="form-control" id="demoEmail" required placeholder="name@company.com" style="background-color: #111e2b; border: 1px solid #2d3e50; color: #f8fafc; border-radius: 8px; padding: 10px;">
                        </div>
                        <div class="mb-3">
                            <label for="demoCompany" class="form-label" style="font-size: 0.9rem; font-weight: 500; color: #cbd5e1;">Company / Organization</label>
                            <input type="text" class="form-control" id="demoCompany" required placeholder="Enter your company name" style="background-color: #111e2b; border: 1px solid #2d3e50; color: #f8fafc; border-radius: 8px; padding: 10px;">
                        </div>
                        <div class="mb-3">
                            <label for="demoMessage" class="form-label" style="font-size: 0.9rem; font-weight: 500; color: #cbd5e1;">Your Project Use Case</label>
                            <textarea class="form-control" id="demoMessage" rows="3" placeholder="Describe your WAAM simulation or production goals..." style="background-color: #111e2b; border: 1px solid #2d3e50; color: #f8fafc; border-radius: 8px; padding: 10px;"></textarea>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn w-100" style="background-color: #10b981; border: none; padding: 12px; font-weight: 600; border-radius: 8px; color: #1a2a3a; transition: all 0.3s; font-family: 'Outfit';">Submit Request</button>
                        </div>
                    </form>
                    <div id="demoSuccessMessage" class="text-center d-none py-4">
                        <i class="fas fa-check-circle text-success mb-3" style="font-size: 3.5rem;"></i>
                        <h4 style="font-family: 'Outfit'; color: #f8fafc; font-weight: 700;">Demo Request Received!</h4>
                        <p class="text-white-50 mt-2 px-2" style="font-size: 0.95rem;">Thank you for your interest. A PeaSyn technical specialist will contact you shortly to schedule your live simulation demo.</p>
                        <button type="button" class="btn btn-outline-light mt-3" data-bs-dismiss="modal" style="border-radius: 8px; padding: 8px 20px;">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // JS Function to switch interactive tabs for WAAM section
        function switchWaamTab(evt, tabName) {
            // Get all elements with class="waam-tab-content" and hide them
            const tabContents = document.getElementsByClassName("waam-tab-content");
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove("active");
            }

            // Get all elements with class="waam-tab-btn" and remove the class "active"
            const tabBtns = document.getElementsByClassName("waam-tab-btn");
            for (let i = 0; i < tabBtns.length; i++) {
                tabBtns[i].classList.remove("active");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).classList.add("active");
            evt.currentTarget.classList.add("active");
        }

        // Dynamic Modal content updater based on triggering button
        const demoRequestModal = document.getElementById('demoRequestModal');
        demoRequestModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const mode = button.getAttribute('data-bs-mode') || 'demo';
            
            const modalTitle = demoRequestModal.querySelector('.modal-title');
            const submitBtn = demoRequestModal.querySelector('button[type="submit"]');
            const successTitle = demoRequestModal.querySelector('#demoSuccessMessage h4');
            const successText = demoRequestModal.querySelector('#demoSuccessMessage p');
            
            if (mode === 'partner') {
                modalTitle.innerHTML = '<i class="fas fa-handshake me-2"></i>Partner with Peatech / PeaSyn';
                submitBtn.textContent = 'Submit Partnership Request';
                successTitle.textContent = 'Partnership Request Received!';
                successText.textContent = 'Thank you for your interest. A partnership coordinator from our team will contact you shortly.';
            } else {
                modalTitle.innerHTML = '<i class="fas fa-laptop-code me-2"></i>Request a PeaSyn Demo';
                submitBtn.textContent = 'Submit Request';
                successTitle.textContent = 'Demo Request Received!';
                successText.textContent = 'Thank you for your interest. A PeaSyn technical specialist will contact you shortly to schedule your live simulation demo.';
            }
        });

        // Demo request form submission handler
        document.getElementById('demoRequestForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('demoRequestForm').classList.add('d-none');
            document.getElementById('demoSuccessMessage').classList.remove('d-none');
        });

        // Reset form on modal hide
        document.getElementById('demoRequestModal').addEventListener('hidden.bs.modal', function() {
            document.getElementById('demoRequestForm').reset();
            document.getElementById('demoRequestForm').classList.remove('d-none');
            document.getElementById('demoSuccessMessage').classList.add('d-none');
        });
    </script>
</body>
</html>
