<?php
/**
 * careers.php
 * Careers landing page. Lists open positions.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Join Peatech Services - The Connection Company. View open positions and apply to join our team.">
    <title>Careers - Peatech Services | The Connection Company</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.png" type="image/png">
    
    <style>
        :root {
            --primary-blue: #266075;
            --dark-blue: #1a2a3a;
            --accent-orange: #ff7b25;
            --light-grey: #f8f9fa;
            --medium-grey: #e9ecef;
            --text-dark: #333;
            --text-light: #6c757d;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
            background-color: var(--light-grey);
        }
        
        /* Top Bar */
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
        
        /* Navigation */
        .navbar {
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            background-color: white;
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
        
        /* Hero Section */
        .careers-hero {
            background: linear-gradient(rgba(26, 42, 58, 0.8), rgba(26, 42, 58, 0.9)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 90px 0;
            text-align: center;
        }
        
        .careers-hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .careers-hero p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 800px;
            margin: 0 auto;
        }
        
        /* Openings Grid */
        .openings-section {
            padding: 80px 0;
            background-color: white;
        }

        .section-title {
            color: var(--dark-blue);
            font-weight: 700;
            text-align: center;
            margin-bottom: 10px;
        }

        .section-subtitle {
            color: var(--text-light);
            text-align: center;
            max-width: 600px;
            margin: 0 auto 50px;
        }
        
        .opening-card {
            border: 1px solid var(--medium-grey);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 24px;
            transition: all 0.3s;
            background-color: white;
            box-shadow: 0 2px 8 rgba(0, 0, 0, 0.02);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .opening-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 8px 24px rgba(38, 96, 117, 0.08);
            transform: translateY(-3px);
        }
        
        .opening-title {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 10px;
        }
        
        .opening-meta {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .opening-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .badge-custom {
            background-color: rgba(38, 96, 117, 0.1);
            color: var(--primary-blue);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .opening-desc {
            color: #555;
            margin-bottom: 25px;
            flex-grow: 1;
        }

        .btn-view-job {
            background-color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            color: white;
            padding: 10px 24px;
            font-weight: 600;
            border-radius: 6px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            margin-top: auto;
        }

        .btn-view-job:hover {
            background-color: #1d4d60;
            border-color: #1d4d60;
            color: white;
        }
        
        /* Benefits Section */
        .benefits-section {
            padding: 80px 0;
            background-color: var(--light-grey);
        }
        
        .benefit-item {
            text-align: center;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            height: 100%;
            border: 1px solid var(--medium-grey);
            transition: all 0.3s;
        }

        .benefit-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }
        
        .benefit-icon {
            font-size: 2.5rem;
            color: var(--accent-orange);
            margin-bottom: 15px;
        }
        
        .benefit-title {
            color: var(--dark-blue);
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .benefit-desc {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-bottom: 0;
        }
        
        /* Footer */
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
        
        .social-icons a {
            display: inline-block;
            width: 36px;
            height: 36px;
            background-color: rgba(255, 255, 255, 0.1);
            text-align: center;
            line-height: 36px;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background-color: var(--primary-blue);
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
                    <li class="nav-item"><a class="nav-link" href="peasyn.php">PeaSyn</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#services">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php#vision">Vision</a></li>
                    <li class="nav-item"><a class="nav-link active" href="careers.php">Careers</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="careers-hero">
        <div class="container">
            <h1>Careers at Peatech</h1>
            <p>Connect your career with innovation. Join a growing, multi-disciplinary team building digital ecosystems and physics-guided digital twins that solve complex real-world challenges.</p>
        </div>
    </section>

    <!-- Openings Section -->
    <section class="openings-section">
        <div class="container">
            <h2 class="section-title">Current Openings</h2>
            <p class="section-subtitle">Browse our open positions below. Click on any role to view detailed responsibilities, requirements, and apply directly.</p>
            
            <div class="row g-4">
                <!-- Sales/Marketing Specialist -->
                <div class="col-md-6">
                    <div class="opening-card">
                        <h3 class="opening-title">Sales/Marketing Specialist</h3>
                        <div class="opening-meta">
                            <span><i class="fas fa-briefcase"></i> Sales & Marketing</span>
                            <span><i class="fas fa-map-marker-alt"></i> Richmond Heights, OH (On-Site)</span>
                            <span class="badge-custom">Full-Time</span>
                        </div>
                        <p class="opening-desc">Drive customer outreach, manage B2B pipelines, packaging complex digital twins and physics simulation solutions into impactful brand campaigns, and coordinate partnership strategies.</p>
                        <a href="career/sales-marketing-specialist" class="btn-view-job">View Job & Apply</a>
                    </div>
                </div>

                <!-- Engineering Intern -->
                <div class="col-md-6">
                    <div class="opening-card">
                        <h3 class="opening-title">Engineering Intern</h3>
                        <div class="opening-meta">
                            <span><i class="fas fa-briefcase"></i> Research & Development</span>
                            <span><i class="fas fa-map-marker-alt"></i> Richmond Heights, OH (On-Site)</span>
                            <span class="badge-custom">Internship</span>
                        </div>
                        <p class="opening-desc">Work with modeling algorithms and telemetry data translation processes on our PeaSyn digital twin simulation suite. Assist in simulating thermal gradients and melt pool dynamics.</p>
                        <a href="career/engineering-intern" class="btn-view-job">View Job & Apply</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="benefits-section">
        <div class="container">
            <h2 class="section-title">Why Join Peatech?</h2>
            <p class="section-subtitle">We believe in fostering collaborative connections, supporting continuous learning, and enabling our team to tackle ambitious engineering and business hurdles.</p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-lightbulb"></i></div>
                        <h4 class="benefit-title">Innovative Projects</h4>
                        <p class="benefit-desc">Develop cutting-edge industrial systems, advanced manufacturing digital twins, and healthcare platforms.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-users"></i></div>
                        <h4 class="benefit-title">Diverse Team</h4>
                        <p class="benefit-desc">Collaborate with experienced software architects, physics modelers, and sales professionals.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-item">
                        <div class="benefit-icon"><i class="fas fa-graduation-cap"></i></div>
                        <h4 class="benefit-title">Growth & Mentorship</h4>
                        <p class="benefit-desc">Expand your skill set with professional guidance, peer code reviews, and industry exposure.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <img src="images/peatechlogo.webp" alt="Peatech Logo" class="footer-logo" style="filter: brightness(0) invert(1);">
                    <p>Building secure, reliable, and intelligent connections between people, products, and systems across healthcare, business, and industry.</p>
                    <div class="social-icons">
                        <a href="https://facebook.com/peatech"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/peatech"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/peatech"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5>Quick Navigation</h5>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="peasyn.php">PeaSyn</a></li>
                        <li><a href="index.php#services">Our Services</a></li>
                        <li><a href="articles.php">Articles</a></li>
                        <li><a href="index.php#vision">Our Vision</a></li>
                        <li><a href="index.php#contact">Connect With Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Connection Points</h5>
                    <ul>
                        <li><a href="index.php#services">Our Services</a></li>
                        <li><a href="index.php#connection">Connection Ecosystem</a></li>
                        <li><a href="index.php#vision">Our Vision</a></li>
                        <li><a href="#">Case Studies</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="careers.php">Join Our Team</a></li>
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>