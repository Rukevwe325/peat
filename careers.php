<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Join Peatech Services - The Connection Company. Apply for open positions and submit your resume.">
    <title>Careers at Peatech - Join Our Team</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
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
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.3;
        }
        
        .section-padding {
            padding: 80px 0;
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
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        
        .careers-hero h1 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
        }
        
        /* Form Styles */
        .application-form-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        .form-header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--medium-grey);
        }
        
        .form-header h2 {
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }
        
        .form-header p {
            color: var(--text-light);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }
        
        .form-control, .form-select {
            padding: 12px 15px;
            border: 1px solid #e1e5e9;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(38, 96, 117, 0.1);
        }
        
        .required-field::after {
            content: " *";
            color: #dc3545;
        }
        
        .file-upload-area {
            border: 2px dashed var(--medium-grey);
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            background-color: #fafafa;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        
        .file-upload-area:hover {
            border-color: var(--primary-blue);
            background-color: #f0f8ff;
        }
        
        .file-upload-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        .file-input-label {
            cursor: pointer;
            color: var(--primary-blue);
            font-weight: 500;
        }
        
        .file-input-label:hover {
            text-decoration: underline;
        }
        
        .file-name {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        
        .checkbox-label {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .checkbox-label input {
            margin-top: 0.3rem;
            margin-right: 10px;
        }
        
        .btn-submit-application {
    width: auto !important;
    min-width: 220px;
    padding: 12px 45px;
    margin: 0 auto;
    display: block;
}
        
        .btn-primary-custom {
            background-color: var(--primary-blue);
            border: 2px solid var(--primary-blue);
            color: white;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s;
            width: 100%;
            font-size: 1.1rem;
        }
        
        .btn-primary-custom:hover {
            background-color: #1d4d60;
            border-color: #1d4d60;
        }
        
        /* Current Openings */
        .openings-section {
            background-color: white;
        }
        
        .opening-card {
            border: 1px solid var(--medium-grey);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s;
        }
        
        .opening-card:hover {
            border-color: var(--primary-blue);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        
        .opening-title {
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
        }
        
        .opening-meta {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .opening-meta span {
            margin-right: 15px;
        }
        
        .opening-meta i {
            margin-right: 5px;
        }
        
        .badge-custom {
            background-color: rgba(38, 96, 117, 0.1);
            color: var(--primary-blue);
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        /* Benefits Section */
        .benefits-section {
            background-color: var(--light-grey);
        }
        
        .benefit-item {
            text-align: center;
            padding: 1.5rem;
        }
        
        .benefit-icon {
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 1rem;
        }
        
        .benefit-title {
            color: var(--dark-blue);
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        /* Footer */
        .footer {
            background-color: #111;
            color: #aaa;
            padding: 50px 0 20px;
            margin-top: 80px;
        }
        
        .footer-logo {
            height: 35px;
            width: auto;
            margin-bottom: 1.5rem;
        }
        
        .footer a {
            color: #aaa;
            text-decoration: none;
        }
        
        .footer a:hover {
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
        }
        
        .social-icons a:hover {
            background-color: var(--primary-blue);
        }
        
        .copyright {
            text-align: center;
            font-size: 0.9rem;
            color: #777;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        /* Responsive */
        @media (max-width: 767.98px) {
            .section-padding {
                padding: 60px 0;
            }
            
            .careers-hero {
                padding: 80px 0;
            }
            
            .careers-hero h1 {
                font-size: 2.2rem;
            }
            
            .application-form-container {
                padding: 1.5rem;
                margin-top: -30px;
            }
        }
        
        @media (max-width: 575.98px) {
            .careers-hero h1 {
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
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="images/peatechlogo.webp" alt="Peatech Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/peasyn">PeaSyn</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#services">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#vision">Vision</a></li>
                    <li class="nav-item"><a class="nav-link" href="/#contact">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link active" href="/careers">Careers</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="careers-hero">
        <div class="container">
            <h1>Join Our Talent Network</h1>
            <p class="lead mb-4">Connect your career with innovation. Be part of a team that builds bridges across technology and business.</p>
            <a href="#apply-now" class="btn btn-primary-custom btn-lg" style="width: auto; display: inline-block;">Apply Now</a>
        </div>
    </section>

    <!-- Application Form -->
    <section id="apply-now" class="section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="application-form-container">
                        <div class="form-header">
                            <h2>Application Form</h2>
                            <p>Fill out the form below to apply for a position at Peatech Services</p>
                        </div>
                        
                        <form id="careerApplicationForm">
                            <!-- Personal Information -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="firstName" class="form-label required-field">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName" class="form-label required-field">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="email" class="form-label required-field">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label required-field">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                            </div>
                            
                            <!-- Address -->
                            <div class="mb-4">
                                <label for="address" class="form-label">Street Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control" id="city" name="city">
                                </div>
                                <div class="col-md-3">
                                    <label for="state" class="form-label">State</label>
                                    <input type="text" class="form-control" id="state" name="state">
                                </div>
                                <div class="col-md-3">
                                    <label for="zipCode" class="form-label">ZIP Code</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode">
                                </div>
                            </div>
                            
                            <!-- Position Selection -->
                            <div class="mb-4">
                                <label for="position" class="form-label required-field">Position Applying For</label>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="" selected disabled>Select a position</option>
                                    <option value="software-engineer">Software Engineer</option>
                                    <option value="data-scientist">Data Scientist</option>
                                    <option value="iot-developer">IoT Developer</option>
                                    <option value="frontend-developer">Frontend Developer</option>
                                    <option value="backend-developer">Backend Developer</option>
                                    <option value="fullstack-developer">Full Stack Developer</option>
                                    <option value="devops-engineer">DevOps Engineer</option>
                                    <option value="ai-ml-engineer">AI/ML Engineer</option>
                                    <option value="cloud-architect">Cloud Architect</option>
                                    <option value="project-manager">Project Manager</option>
                                    <option value="product-manager">Product Manager</option>
                                    <option value="ux-ui-designer">UX/UI Designer</option>
                                    <option value="qa-engineer">QA Engineer</option>
                                    <option value="system-analyst">System Analyst</option>
                                    <option value="network-engineer">Network Engineer</option>
                                    <option value="security-analyst">Security Analyst</option>
                                    <option value="technical-writer">Technical Writer</option>
                                    <option value="research-scientist">Research Scientist</option>
                                    <option value="other">Other (Specify in cover letter)</option>
                                </select>
                            </div>
                            
                            <!-- Employment Type -->
                            <div class="mb-4">
                                <label class="form-label required-field">Employment Type</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="employmentType" id="fullTime" value="full-time" required>
                                            <label class="form-check-label" for="fullTime">
                                                Full Time
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="employmentType" id="partTime" value="part-time">
                                            <label class="form-check-label" for="partTime">
                                                Part Time
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="employmentType" id="contract" value="contract">
                                            <label class="form-check-label" for="contract">
                                                Contract
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Experience Level -->
                            <div class="mb-4">
                                <label for="experience" class="form-label required-field">Years of Experience</label>
                                <select class="form-select" id="experience" name="experience" required>
                                    <option value="" selected disabled>Select experience level</option>
                                    <option value="entry">Entry Level (0-2 years)</option>
                                    <option value="mid">Mid Level (3-5 years)</option>
                                    <option value="senior">Senior (6-10 years)</option>
                                    <option value="lead">Lead/Principal (10+ years)</option>
                                </select>
                            </div>
                            
                            <!-- Salary Expectations -->
                            <div class="mb-4">
                                <label for="salary" class="form-label">Salary Expectations (Annual)</label>
                                <input type="text" class="form-control" id="salary" name="salary" placeholder="e.g., $80,000 - $100,000">
                            </div>
                            
                            <!-- Availability -->
                            <div class="mb-4">
                                <label for="availability" class="form-label">When can you start?</label>
                                <select class="form-select" id="availability" name="availability">
                                    <option value="" selected>Select availability</option>
                                    <option value="immediately">Immediately</option>
                                    <option value="2weeks">2 Weeks</option>
                                    <option value="1month">1 Month</option>
                                    <option value="2months">2 Months</option>
                                    <option value="negotiable">Negotiable</option>
                                </select>
                            </div>
                            
                            <!-- Resume Upload -->
                            <div class="mb-4">
                                <label class="form-label required-field">Resume / CV</label>
                                <div class="file-upload-area" id="resumeUploadArea">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-file-upload"></i>
                                    </div>
                                    <label for="resume" class="file-input-label">
                                        Click to upload your resume
                                    </label>
                                    <input type="file" class="d-none" id="resume" name="resume" accept=".pdf,.doc,.docx" required>
                                    <p class="file-name" id="resumeFileName">No file chosen</p>
                                    <p class="text-muted small">Accepted formats: PDF, DOC, DOCX (Max size: 5MB)</p>
                                </div>
                            </div>
                            
                            <!-- Cover Letter -->
                            <div class="mb-4">
                                <label for="coverLetter" class="form-label">Cover Letter</label>
                                <textarea class="form-control" id="coverLetter" name="coverLetter" rows="4" placeholder="Tell us why you're interested in joining Peatech Services and what makes you a great fit..."></textarea>
                            </div>
                            
                            <!-- LinkedIn Profile -->
                            <div class="mb-4">
                                <label for="linkedin" class="form-label">LinkedIn Profile URL</label>
                                <input type="url" class="form-control" id="linkedin" name="linkedin" placeholder="https://linkedin.com/in/yourprofile">
                            </div>
                            
                            <!-- Portfolio/GitHub -->
                            <div class="mb-4">
                                <label for="portfolio" class="form-label">Portfolio or GitHub URL</label>
                                <input type="url" class="form-control" id="portfolio" name="portfolio" placeholder="https://github.com/yourusername or portfolio link">
                            </div>
                            
                            <!-- Referral -->
                            <div class="mb-4">
                                <label for="referral" class="form-label">How did you hear about us?</label>
                                <select class="form-select" id="referral" name="referral">
                                    <option value="" selected>Select an option</option>
                                    <option value="linkedin">LinkedIn</option>
                                    <option value="indeed">Indeed</option>
                                    <option value="glassdoor">Glassdoor</option>
                                    <option value="company-website">Company Website</option>
                                    <option value="employee-referral">Employee Referral</option>
                                    <option value="job-fair">Job Fair</option>
                                    <option value="social-media">Social Media</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            
                            <!-- Consent -->
                            <div class="mb-4">
                                <div class="checkbox-label">
                                    <input type="checkbox" id="consent" name="consent" required>
                                    <label for="consent">
                                        I consent to Peatech Services collecting and processing my personal data for recruitment purposes. I understand that my information will be stored securely and used solely for evaluating my application.
                                    </label>
                                </div>
                                
                                <div class="checkbox-label">
                                    <input type="checkbox" id="newsletter" name="newsletter">
                                    <label for="newsletter">
                                        I would like to receive occasional updates about career opportunities and company news from Peatech Services.
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary-custom">
                                <i class="fas fa-paper-plane me-2"></i> Submit Application
                            </button>
                            
                            <p class="text-muted small mt-3">
                                <i class="fas fa-info-circle me-1"></i> We'll review your application and contact you if your qualifications match our needs. Due to high volume, we may not be able to respond to all applications individually.
                            </p>
                        </form>
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
                    <p><i class="fas fa-map-marker-alt me-2"></i> 13110 Cedar Road, Cleveland Heights, Ohio, 44118</p>
                    <div class="social-icons mt-4">
                        <a href="https://facebook.com/peatech"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://twitter.com/peatech"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com/peatech"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h5>Need to connect?</h5>
                    <p><i class="fas fa-phone me-2"></i> <a href="tel:+18001234567">+1-800-123-4567</a></p>
                    <p class="text-muted">Monday – Friday: 8:00-18:00</p>
                    <hr class="footer-divider">
                    <p><i class="fas fa-envelope me-2"></i> <a href="mailto:careers@peatechservices.com">careers@peatechservices.com</a></p>
                </div>
                <div class="col-lg-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="index.html#services">Our Services</a></li>
                        <li><a href="index.html#connection">Connection Ecosystem</a></li>
                        <li><a href="index.html#contact">Contact Us</a></li>
                        <li><a href="#apply-now">Apply Now</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p class="mb-0">© 2025 Peatech Services. All rights reserved. | The Connection Company</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // File upload functionality
        document.getElementById('resume').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
            document.getElementById('resumeFileName').textContent = fileName;
            
            // Add visual feedback
            const uploadArea = document.getElementById('resumeUploadArea');
            uploadArea.style.borderColor = '#266075';
            uploadArea.style.backgroundColor = '#f0f8ff';
        });
        
        // Form submission handling
        document.getElementById('careerApplicationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.style.borderColor = '#dc3545';
                    isValid = false;
                } else {
                    field.style.borderColor = '#e1e5e9';
                }
            });
            
            if (!isValid) {
                alert('Please fill in all required fields.');
                return;
            }
            
            // File size validation
            const resumeFile = document.getElementById('resume').files[0];
            if (resumeFile && resumeFile.size > 5 * 1024 * 1024) { // 5MB limit
                alert('Resume file size must be less than 5MB.');
                return;
            }
            
            // In a real application, you would send this data to a server
            // For now, we'll just show a success message
            alert('Thank you for your application! We will review your submission and contact you if there\'s a match with our current opportunities.');
            
            // Reset form
            this.reset();
            document.getElementById('resumeFileName').textContent = 'No file chosen';
            document.getElementById('resumeUploadArea').style.borderColor = '';
            document.getElementById('resumeUploadArea').style.backgroundColor = '';
        });
        
        // Add focus styling to form elements
        const formElements = document.querySelectorAll('.form-control, .form-select');
        formElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.style.borderColor = '#266075';
                this.style.boxShadow = '0 0 0 0.25rem rgba(38, 96, 117, 0.1)';
            });
            
            element.addEventListener('blur', function() {
                this.style.boxShadow = '';
            });
        });
    </script>
</body>
</html>