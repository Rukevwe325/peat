<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Connection Solutions, Peatech Services, Digital Platforms, IoT Solutions, Healthcare Technology, Business Connections">
    <meta name="description" content="Peatech Services - The Connection Company. We build bridges that make life and business flow better.">
    <title>Peatech Services - The Connection Company</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.png" type="image/png">
    
    <style>
    
    
    
    
    <!-- Add this to your existing CSS style section -->
    .talent-card {
        transition: all 0.3s ease;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }
    
    .talent-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        border-color: var(--primary-blue);
    }
    
    .talent-card::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-blue), var(--accent-orange));
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .talent-card:hover::after {
        opacity: 1;
    }
    
    .talent-card .btn-outline-primary {
        border-color: var(--primary-blue);
        color: var(--primary-blue);
        transition: all 0.3s ease;
    }
    
    .talent-card:hover .btn-outline-primary {
        background-color: var(--primary-blue);
        color: white;
    }

    
    
    
    
    
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
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            line-height: 1.6;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
        }
        
        .section-padding {
            padding: 80px 0;
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
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 120px 0;
            text-align: center;
        }
        
        .hero-title {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            font-weight: 500;
        }
        
        .hero-tagline {
            font-size: 1.1rem;
            margin-bottom: 3rem;
            color: var(--accent-orange);
            font-weight: 500;
        }
        
        .btn-primary-custom {
            background-color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            color: white;
            padding: 12px 30px;
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-primary-custom:hover {
            background-color: transparent;
            color: var(--primary-blue);
        }
        
        /* Services Section */
        .services-section {
            background-color: var(--light-grey);
        }
        
        .service-card {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: none;
            border-top: 4px solid var(--primary-blue);
        }
        
        .service-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }
        
        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: var(--primary-blue);
        }
        
        .service-title {
            color: var(--dark-blue);
            font-size: 1.3rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .service-text {
            color: var(--text-light);
            line-height: 1.6;
        }
        
        .card-body-custom {
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        /* About Section */
        .about-section {
            background-color: white;
        }
        
        .about-image img {
            width: 100%;
            height: auto;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }
        
        .feature-list i {
            color: var(--primary-blue);
            margin-right: 10px;
            margin-top: 5px;
            flex-shrink: 0;
        }
        
        /* Connection Solutions Section */
        .connection-section {
            background-color: var(--light-grey);
        }
        
        .connection-card {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: none;
            border-top: 4px solid var(--primary-blue);
        }
        
        .connection-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }
        
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1.2rem;
            color: var(--primary-blue);
        }
        
        .card-title {
            color: var(--dark-blue);
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
            font-weight: 600;
        }
        
        .card-subtitle {
            color: var(--primary-blue);
            font-size: 0.9rem;
            margin-bottom: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .card-text {
            color: var(--text-light);
            line-height: 1.6;
            font-size: 0.95rem;
        }
        
        .card-body {
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .card-highlight {
            background: var(--dark-blue);
            color: white;
            border-top: 4px solid var(--accent-orange);
        }
        
        .card-highlight .card-title,
        .card-highlight .card-subtitle,
        .card-highlight .card-text {
            color: white;
        }
        
        .card-highlight .card-icon {
            color: white;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
        }
        
        .cta-title {
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
        }
        
        .cta-text {
            font-size: 1.1rem;
            margin-bottom: 2.5rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .btn-light-custom {
            background-color: white;
            color: var(--dark-blue);
            padding: 12px 30px;
            font-weight: 500;
            border: 2px solid white;
            transition: all 0.3s;
        }
        
        .btn-light-custom:hover {
            background-color: transparent;
            color: white;
        }
        
        /* Vision Section */
        .vision-section {
            background-color: white;
        }
        
        .vision-content {
            background-color: var(--light-grey);
            padding: 3rem;
            height: 100%;
        }
        
        .vision-stats {
            margin-top: 2rem;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            color: var(--primary-blue);
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Testimonials Section */
        .testimonials-section {
            background-color: var(--light-grey);
        }
        
        .testimonial-card {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            height: 100%;
            border: none;
            padding: 2rem;
        }
        
        .testimonial-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: 1.5rem;
            color: var(--text-dark);
        }
        
        .testimonial-author {
            font-weight: 600;
            color: var(--dark-blue);
            margin-bottom: 0.25rem;
        }
        
        .testimonial-date {
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .testimonial-divider {
            height: 2px;
            background: var(--primary-blue);
            width: 50px;
            margin: 1rem 0;
        }
        
        /* Technology Section */
        .technology-section {
            background-color: white;
        }
        
        .tech-item {
            margin-bottom: 2rem;
        }
        
        .tech-title {
            color: var(--dark-blue);
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .tech-divider {
            height: 2px;
            background: var(--primary-blue);
            width: 40px;
            margin-bottom: 1rem;
        }
        
        .tech-description {
            color: var(--text-light);
        }
        
        /* FAQ Section */
        .faq-section {
            background-color: var(--light-grey);
        }
        
        .accordion-button {
            font-weight: 500;
            color: var(--dark-blue);
            padding: 1.25rem 1.5rem;
        }
        
        .accordion-button:not(.collapsed) {
            background-color: rgba(38, 96, 117, 0.05);
            color: var(--primary-blue);
        }
        
        .accordion-button:focus {
            box-shadow: 0 0 0 0.25rem rgba(38, 96, 117, 0.1);
        }
        
        .accordion-body {
            padding: 1.5rem;
            color: var(--text-light);
        }
        
        /* Contact Section */
        .contact-section {
            background-color: white;
        }
        
        .contact-form {
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
        }
        
        .form-control {
            padding: 12px 15px;
            border: 1px solid #e1e5e9;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(38, 96, 117, 0.1);
        }
        
        .contact-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        /* Map Section */
        .map-section {
            background-color: var(--light-grey);
        }
        
        .map-container {
            height: 400px;
            width: 100%;
        }
        
        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        
        /* Footer CTA */
        .footer-cta {
            background-color: var(--dark-blue);
            color: white;
            padding: 50px 0;
        }
        
        .footer-cta-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
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
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .section-padding {
                padding: 60px 0;
            }
            
            .vision-content {
                margin-top: 2rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .section-padding {
                padding: 50px 0;
            }
            
            .card-body-custom, .card-body {
                padding: 1.5rem 1rem;
            }
            
            .cta-title {
                font-size: 1.8rem;
            }
            
            .footer-cta-title {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 575.98px) {
            .hero-section {
                padding: 80px 0;
            }
            
            .hero-title {
                font-size: 1.8rem;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
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
            <a class="navbar-brand" href="#">
                <img src="images/peatechlogo.webp" alt="Peatech Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="peasyn.php">PeaSyn</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="articles.php">Articles</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vision">Vision</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#faq">FAQ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <h1 class="hero-title">PEATECH SERVICES</h1>
            <h2 class="hero-subtitle">The Connection Company</h2>
            <p class="hero-tagline">"Connecting Possibility."</p>
            <p class="lead mb-5">We build bridges that make life and business flow better — connecting people to people, people to products, and products to products.</p>
            <a href="#contact" class="btn btn-primary-custom btn-lg">Connect With Us</a>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Our Connection Solutions</h2>
                    <p class="section-subtitle">We provide comprehensive connection solutions across four specialized divisions, each focused on a different aspect of connectivity.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="card-body-custom text-center">
                            <div class="service-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h3 class="service-title">Peatech Connect</h3>
                            <p class="service-text">Digital platforms connecting people to people & businesses through apps, websites, and marketplaces.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="card-body-custom text-center">
                            <div class="service-icon">
                                <i class="fas fa-network-wired"></i>
                            </div>
                            <h3 class="service-title">Peatech Systems</h3>
                            <p class="service-text">Automation, software, and IoT solutions that connect products to products and systems to systems.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="card-body-custom text-center">
                            <div class="service-icon">
                                <i class="fas fa-bullhorn"></i>
                            </div>
                            <h3 class="service-title">Peatech Media</h3>
                            <p class="service-text">Digital marketing and storytelling that connect brands to customers and businesses to audiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="service-card">
                        <div class="card-body-custom text-center">
                            <div class="service-icon">
                                <i class="fas fa-heartbeat"></i>
                            </div>
                            <h3 class="service-title">Peatech HealthConnect</h3>
                            <p class="service-text">Healthcare innovations connecting patients, caregivers, and medical devices for better outcomes.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="section-title mb-4">About Peatech Services</h2>
                    <p class="mb-4">Born in Cleveland, Peatech started as a technology service company. Today, we are a global bridge-builder — connecting people, products, and organizations through intelligent platforms and human-centered innovation.</p>
                    <p class="mb-4">At Peatech Services, our mission is to connect people, products, and businesses using technology, creativity, and insight — breaking barriers of distance, complexity, and access.</p>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Connecting people through digital experiences</li>
                        <li><i class="fas fa-check"></i> Connecting products through intelligent systems</li>
                        <li><i class="fas fa-check"></i> Connecting businesses to their audience</li>
                        <li><i class="fas fa-check"></i> Connecting care to communities</li>
                    </ul>
                    <a href="#contact" class="btn btn-primary-custom mt-4">Connect With Our Team</a>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Team Collaboration">
                    </div>
                </div>
            </div>
        </div>
    </section>

       <!-- Connection Solutions Section -->
<section id="connection" class="connection-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Our Connection Ecosystem</h2>
                <p class="section-subtitle">We build bridges across all aspects of business and society, creating seamless connections that drive growth and innovation.</p>
            </div>
        </div>
        
        <div class="row g-4 justify-content-center">
            <!-- People Connection Card -->
            <div class="col-md-6 col-lg-4">
                <div class="connection-card">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4 class="card-subtitle">People Connection</h4>
                        <h3 class="card-title">Connect People</h3>
                        <p class="card-text">Platforms like GH App (Get Help/Give Help) and U-Mail that bring people together through intuitive digital experiences designed for meaningful interactions.</p>
                    </div>
                </div>
            </div>
            
            <!-- Business Connection Card -->
            <div class="col-md-6 col-lg-4">
                <div class="connection-card">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h4 class="card-subtitle">Business Connection</h4>
                        <h3 class="card-title">Connect Businesses</h3>
                        <p class="card-text">Digital marketing and brand strategy that connects companies to their markets, creating lasting relationships and driving sustainable growth.</p>
                    </div>
                </div>
            </div>
            
            <!-- IoT Connection Card -->
            <div class="col-md-6 col-lg-4">
                <div class="connection-card">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-network-wired"></i>
                        </div>
                        <h4 class="card-subtitle">IoT Connection</h4>
                        <h3 class="card-title">Connect Products</h3>
                        <p class="card-text">IoT and automation systems enabling seamless product-to-product communication, creating intelligent ecosystems that work in harmony.</p>
                    </div>
                </div>
            </div>
            
            <!-- Healthcare Connection Card -->
            <div class="col-md-6 col-lg-4">
                <div class="connection-card">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                        <h4 class="card-subtitle">Healthcare Connection</h4>
                        <h3 class="card-title">Connect Health</h3>
                        <p class="card-text">VPExam deployment and telemedicine solutions connecting patients to care, revolutionizing healthcare accessibility and delivery.</p>
                    </div>
                </div>
            </div>
            
            <!-- Community Connection Card -->
            <div class="col-md-6 col-lg-4">
                <div class="connection-card">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h4 class="card-subtitle">Community Connection</h4>
                        <h3 class="card-title">Connect Communities</h3>
                        <p class="card-text">Worker-voice platforms and tools that empower community connections, fostering collaboration and shared growth opportunities.</p>
                    </div>
                </div>
            </div>
            
            <!-- Future Technology Card -->
            <div class="col-md-6 col-lg-4">
                <div class="connection-card">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h4 class="card-subtitle">Future Technology</h4>
                        <h3 class="card-title">Connect the Future</h3>
                        <p class="card-text">R&D initiatives building tomorrow's connection technologies today, pushing boundaries to create the next generation of connectivity.</p>
                    </div>
                </div>
            </div>
            
            <!-- Staffing & Talent Solutions Card - Linked to careers.php -->
            <div class="col-md-6 col-lg-4 mx-lg-auto" style="max-width: 400px;">
                <a href="careers.php" class="text-decoration-none" style="display: block;">
                    <div class="connection-card h-100 talent-card">
                        <div class="card-body text-center">
                            <div class="card-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <h4 class="card-subtitle">Talent Connection</h4>
                            <h3 class="card-title">Staffing & Talent Solutions</h3>
                            <p class="card-text">Specialized staffing solutions connecting businesses with pre-vetted engineers, data scientists, developers, and STEM professionals. We deliver talent that is technically proven, business-ready, and aligned with your project goals.</p>
                            <p class="card-text small mt-2">Right talent. Right structure. Real results.</p>
                            <div class="mt-3">
                                <span class="btn btn-outline-primary btn-sm">Join Our Team →</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>


    <!-- CTA Section -->
    <section class="cta-section section-padding">
        <div class="container">
            <h2 class="cta-title">Ready to build better connections?</h2>
            <p class="cta-text">Discover how Peatech Services can transform your business with connection-focused solutions tailored to your unique needs.</p>
            <a href="#contact" class="btn btn-light-custom btn-lg">Get Free Consultation</a>
        </div>
    </section>

    <!-- Vision Section -->
    <section id="vision" class="vision-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=2072&q=80" alt="Our Vision">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-content">
                        <h2 class="section-title mb-4">Our Vision</h2>
                        <p class="mb-4">To become the world's most trusted platform for seamless human and digital connection — empowering individuals, businesses, and products to find, communicate, and grow together.</p>
                        <p class="mb-4">We envision a world where connection is seamless, where technology bridges gaps rather than creating them, and where every person, product, and business can reach its full potential through better connections.</p>
                        
                        <div class="vision-stats">
                            <div class="row text-center">
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="stat-item">
                                        <div class="stat-number">100%</div>
                                        <div class="stat-label">Connection-Focused</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 mb-4 mb-md-0">
                                    <div class="stat-item">
                                        <div class="stat-number">100%</div>
                                        <div class="stat-label">Innovation-Driven</div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="stat-item">
                                        <div class="stat-number">100%</div>
                                        <div class="stat-label">Future-Forward</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Connection Success Stories</h2>
                    <p class="section-subtitle">Hear from our clients about how Peatech's connection solutions have transformed their businesses and operations.</p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Peatech's connection platform transformed how our teams collaborate across continents. Their solutions bridged communication gaps we'd struggled with for years."</p>
                        <div class="testimonial-divider"></div>
                        <h5 class="testimonial-author">Alex Gerald</h5>
                        <p class="testimonial-date">March 2025</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"The HealthConnect system Peatech developed for our medical facility has revolutionized patient care coordination. Their team truly understands connection."</p>
                        <div class="testimonial-divider"></div>
                        <h5 class="testimonial-author">Sarah Nelson</h5>
                        <p class="testimonial-date">December 2024</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <p class="testimonial-text">"Implementing Peatech's IoT connection platform gave our products unprecedented interoperability. We're now leading our industry in connected solutions."</p>
                        <div class="testimonial-divider"></div>
                        <h5 class="testimonial-author">David Theodore</h5>
                        <p class="testimonial-date">May 2025</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- Case Studies Section -->
<section class="case-studies-section section-padding" style="background-color: white;">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Real-World Connection Impact</h2>
                <p class="section-subtitle">See how we’ve helped early-stage businesses and organizations build smarter, more connected systems.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Healthcare Case Study" style="height: 200px; object-fit: cover; border-bottom: 4px solid var(--primary-blue);">
                    <div class="card-body-custom p-4">
                        <h3 class="service-title">Remote Patient Monitoring</h3>
                        <p class="service-text text-muted small mb-2">Healthcare</p>
                        <p class="service-text">Connected 12 rural clinics to specialists via secure video and diagnostic tools, reducing patient wait times by 65%.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100">
                    <img src="https://images.unsplash.com/photo-1556742111-a301076d9d18?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="IoT Case Study" style="height: 200px; object-fit: cover; border-bottom: 4px solid var(--primary-blue);">
                    <div class="card-body-custom p-4">
                        <h3 class="service-title">Factory Equipment Sync</h3>
                        <p class="service-text text-muted small mb-2">Manufacturing</p>
                        <p class="service-text">Linked 18 machines to a real-time monitoring dashboard, cutting unplanned downtime by 40% in the first quarter.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="service-card h-100">
                    <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" class="card-img-top" alt="Community Case Study" style="height: 200px; object-fit: cover; border-bottom: 4px solid var(--primary-blue);">
                    <div class="card-body-custom p-4">
                        <h3 class="service-title">Local Volunteer Network</h3>
                        <p class="service-text text-muted small mb-2">Community</p>
                        <p class="service-text">Built a coordination platform for a nonprofit, connecting 850 volunteers and enabling 1,200+ service exchanges in 4 months.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Technology Section -->
    <section class="technology-section section-padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <h2 class="section-title mb-4">Our Connection Technologies</h2>
                    <div class="tech-item">
                        <h3 class="tech-title">Digital Connection Platforms</h3>
                        <div class="tech-divider"></div>
                        <p class="tech-description">Apps, websites, and marketplaces that connect people to people and businesses through intuitive interfaces and seamless experiences.</p>
                    </div>
                    <div class="tech-item">
                        <h3 class="tech-title">IoT & Automation Systems</h3>
                        <div class="tech-divider"></div>
                        <p class="tech-description">Smart solutions that connect products, devices, and systems seamlessly, creating intelligent ecosystems that work in harmony.</p>
                    </div>
                    <div class="tech-item">
                        <h3 class="tech-title">Communication Infrastructure</h3>
                        <div class="tech-divider"></div>
                        <p class="tech-description">Platforms and tools that enable seamless information exchange across organizations, teams, and systems.</p>
                    </div>
                    <div class="tech-item">
                        <h3 class="tech-title">Healthcare Connection Tech</h3>
                        <div class="tech-divider"></div>
                        <p class="tech-description">Specialized solutions connecting patients, providers, and medical devices for improved healthcare outcomes.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" alt="Technology Infrastructure">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="faq-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Frequently Asked Questions</h2>
                    <p class="section-subtitle">Find answers to common questions about our connection services and solutions.</p>
                </div>
            </div>
            
                       <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item mb-3 border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    What does "The Connection Company" mean?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    As The Connection Company, we specialize in building bridges that make life and business flow better. We connect people to people through digital platforms, people to products through marketplaces and apps, and products to products through IoT and automation systems. Our focus is on eliminating barriers and creating seamless interactions.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3 border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    How do your four service divisions work together?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Our four divisions — Connect, Systems, Media, and HealthConnect — work as an integrated ecosystem. Peatech Connect builds the platforms that bring people together. Peatech Systems creates the technological infrastructure. Peatech Media ensures the right messaging reaches the right audiences. And Peatech HealthConnect applies our connection expertise to healthcare challenges. Together, they provide comprehensive connection solutions.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3 border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Can you help with existing systems integration?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Absolutely. Connection is our specialty, and that includes connecting new solutions with existing systems. We have extensive experience integrating with ERP systems, legacy software, proprietary platforms, and various industry-specific tools. We assess your current infrastructure and design connection strategies that maximize value while minimizing disruption.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3 border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    What industries benefit from your connection solutions?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Virtually every industry can benefit from better connections. We work with healthcare providers to connect patients and care teams, manufacturers to connect production systems, retailers to connect with customers, logistics companies to connect supply chains, and tech companies to connect platforms. Our connection-focused approach applies universally while being tailored to each industry's specific needs.
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item mb-3 border-0">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    How is Peatech different from other tech companies?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Three key differentiators: 1) We're connection specialists, not just technology providers — every solution is designed with connection as the primary goal. 2) Our unique four-division structure allows us to approach connection challenges from multiple angles simultaneously. 3) We combine deep technical expertise with human-centered design, ensuring our connections are both technologically robust and genuinely useful to people. We don't just build technology — we build bridges.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <!-- Partners & Ecosystem Section -->
    <section class="partners-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Our Connection Partners</h2>
                    <p class="section-subtitle">We collaborate with industry leaders to deliver end-to-end connection solutions.</p>
                </div>
            </div>

            <div class="row justify-content-center g-5 align-items-center">
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Google_2015_logo.svg/2560px-Google_2015_logo.svg.png" alt="Google Cloud" class="img-fluid" style="max-height: 50px; filter: grayscale(1); opacity: 0.7; transition: 0.3s;">
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/44/Microsoft_logo.svg/2048px-Microsoft_logo.svg.png" alt="Microsoft Azure" class="img-fluid" style="max-height: 50px; filter: grayscale(1); opacity: 0.7; transition: 0.3s;">
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Firebase_logo.png/1024px-Firebase_logo.png" alt="Firebase" class="img-fluid" style="max-height: 50px; filter: grayscale(1); opacity: 0.7; transition: 0.3s;">
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/93/Amazon_Web_Services_Logo.svg/2560px-Amazon_Web_Services_Logo.svg.png" alt="AWS" class="img-fluid" style="max-height: 50px; filter: grayscale(1); opacity: 0.7; transition: 0.3s;">
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Twilio-logo-red.svg/2560px-Twilio-logo-red.svg.png" alt="Twilio" class="img-fluid" style="max-height: 50px; filter: grayscale(1); opacity: 0.7; transition: 0.3s;">
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9e/HubSpot_Logo.svg/2560px-HubSpot_Logo.svg.png" alt="HubSpot" class="img-fluid" style="max-height: 50px; filter: grayscale(1); opacity: 0.7; transition: 0.3s;">
                </div>
            </div>

            <div class="text-center mt-5">
                <p class="text-muted">Powered by best-in-class infrastructure and communication platforms.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="section-title">Connect With Peatech Services</h2>
                    <p class="section-subtitle">Ready to build better connections? Get in touch with our team to discuss how we can help transform your business.</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="contact-form">
                        <h3 class="mb-4">Send us a message</h3>
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter a valid email address">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="4" placeholder="What connections would you like to build?"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary-custom w-100">Connect Now</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-image">
                        <img src="images/digital-tablet-screen-with-smart-home-controller-wooden-table_53876-102347.webp" alt="Contact Us">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="map-section">
        <div class="map-container">
           <iframe 
    src="https://maps.google.com/maps?q=3355%20Richmond%20Rd%2C%20Unit%20183%2C%20Beachwood%2C%20OH%2044122%2C%20United%20States&t=m&z=14&output=embed" 
    width="100%" 
    height="450" 
    style="border:0;" 
    allowfullscreen="">
</iframe>

        </div>
    </section>

    <!-- Footer CTA -->
    <section class="footer-cta">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 mb-4 mb-md-0">
                    <h2 class="footer-cta-title">Ready to transform your operations?</h2>
                    <p class="mb-0">Let's discuss how our connection solutions can give you a competitive edge.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="#contact" class="btn btn-light-custom btn-lg">Contact Our Team</a>
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
                        <li><a href="#services">Our Services</a></li>
                        <li><a href="#connection">Connection Ecosystem</a></li>
                        <li><a href="#vision">Our Vision</a></li>
                        <li><a href="#">Case Studies</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="#">Join Our Team</a></li>
                        <li><a href="#contact">Connect With Us</a></li>
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