<?php
/**
 * privacy-policy.php
 * Privacy Policy page for Peatech Services.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Privacy Policy for Peatech Services - The Connection Company. Details on how we manage, connect, and protect your information.">
    <title>Privacy Policy - Peatech Services | The Connection Company</title>
    
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

        /* Header block */
        .page-header {
            background: linear-gradient(rgba(26, 42, 58, 0.85), rgba(26, 42, 58, 0.95)), url('https://images.unsplash.com/photo-1557683316-973673baf926?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 50px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.7);
        }

        /* Policy Card Styling */
        .policy-card {
            background-color: white;
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin-bottom: 50px;
        }

        .policy-section-title {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.4rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--accent-orange);
            padding-left: 12px;
        }

        .policy-section-title:first-of-type {
            margin-top: 0;
        }

        .policy-text {
            color: var(--text-dark);
            margin-bottom: 1.5rem;
        }

        /* Footer */
        .footer {
            background-color: #111;
            color: #aaa;
            padding: 50px 0 20px;
            margin-top: auto;
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
                    <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1 class="page-title">Privacy Policy</h1>
            <p class="page-subtitle">Last updated: July 23, 2026. Learn how we handle and protect your connectivity data.</p>
        </div>
    </header>

    <!-- Content Container -->
    <main class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="policy-card">
                    <h2 class="policy-section-title">1. Introduction</h2>
                    <p class="policy-text">
                        Welcome to Peatech Services ("the Company," "we," "us," or "our"). At Peatech, we are committed to protecting the privacy and security of our clients, users, partners, and site visitors. As "The Connection Company," our core mission is building stable bridges between people and systems. Doing this responsibly requires maintaining the highest standards of data security, compliance, and privacy.
                    </p>
                    <p class="policy-text">
                        This Privacy Policy describes how we collect, store, share, and process information when you visit our website, use our platforms (such as the PeaSyn industrial simulator), request technical demos, or contract with us for connection services.
                    </p>

                    <h2 class="policy-section-title">2. Information We Collect</h2>
                    <p class="policy-text">
                        Depending on your interactions with us, we may collect the following types of information:
                    </p>
                    <ul>
                        <li><strong>Personal Contact Data:</strong> Name, professional email, phone number, company organization, and details provided when submitting contact forms or demo request modal inputs.</li>
                        <li><strong>Simulation Telemetry Data:</strong> System parameters, machine config settings, and temporary test runs submitted via the PeaSyn simulation engine or client portals.</li>
                        <li><strong>Technical System Metrics:</strong> IP address, device specs, browser info, cookies, and website engagement history to optimize connection reliability.</li>
                    </ul>

                    <h2 class="policy-section-title">3. How We Use Your Information</h2>
                    <p class="policy-text">
                        We process your information for purposes based on legitimate business interests, performance of contracts, and compliance with statutory legal obligations. Specifically, we use your data to:
                    </p>
                    <ul>
                        <li>Provide, operate, and maintain Peatech platform connection features.</li>
                        <li>Schedule, validate, and conduct custom live technical demos for platforms like PeaSyn.</li>
                        <li>Assess, design, and implement customized connection ecosystems for enterprise clients.</li>
                        <li>Address security vulnerabilities, prevent fraud, and run analytics to ensure platform stability.</li>
                    </ul>

                    <h2 class="policy-section-title">4. Data Sharing and Protection</h2>
                    <p class="policy-text">
                        We prioritize the security of your data. We do not sell your personal contact information or industrial simulation telemetry to third parties. We only share information with partners or subcontractors who are contractually bound to confidentiality standards matching our own, or when legally compelled by regulatory bodies.
                    </p>
                    <p class="policy-text">
                        We implement appropriate technical and administrative security measures, including HTTPS encryption, firewall protection, and isolated database architectures (such as separating PeaSyn client dashboards from primary transactional services), to defend your data against unauthorized access, loss, or manipulation.
                    </p>

                    <h2 class="policy-section-title">5. Your Privacy Rights</h2>
                    <p class="policy-text">
                        Under applicable regional data protection laws (such as GDPR or local regulations), you possess rights regarding your data:
                    </p>
                    <ul>
                        <li><strong>Access & Correction:</strong> The right to review, update, or correct inaccuracies in your personal data.</li>
                        <li><strong>Deletion ("Right to be Forgotten"):</strong> The right to request the removal of personal profiles or demo telemetry from our databases.</li>
                        <li><strong>Opt-Out:</strong> The right to withdraw consent for email communications or marketing alerts at any time.</li>
                    </ul>

                    <h2 class="policy-section-title">6. Updates to This Policy</h2>
                    <p class="policy-text">
                        We may update this Privacy Policy periodically to reflect technological adjustments, legal compliance, or changes in our operational procedures. We encourage visitors to check this page regularly to stay informed about how we safeguard their connection security.
                    </p>

                    <h2 class="policy-section-title">7. Contact Us</h2>
                    <p class="policy-text">
                        If you have questions, comments, or data deletion requests regarding this privacy statement, please contact our data compliance coordinator at:
                    </p>
                    <p class="policy-text" style="font-weight: 500; color: var(--primary-blue);">
                        Email: <a href="mailto:info@peatechservice.com" style="color: var(--primary-blue); font-weight: 600;">info@peatechservice.com</a><br>
                        Address: 5247 Wilson Mills RD #1012 Richmond Heights, OH 44143-3016 United States
                    </p>
                </div>
            </div>
        </div>
    </main>

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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
