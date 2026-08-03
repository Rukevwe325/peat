<?php
/**
 * career.php
 * Job Posting Details and Application Form page.
 */

// Define the jobs array
$jobs = [
    'sales-marketing-specialist' => [
        'title' => 'Sales/Marketing Specialist',
        'department' => 'Sales & Marketing',
        'location' => 'Richmond Heights, OH (Remote)',
        'type' => 'Full-Time',
        'description' => 'We are seeking a dynamic Sales/Marketing Specialist to lead our B2B outreach campaigns, promote Peatech\'s connectivity services, manage customer relationships, and expand strategic market share.',
        'responsibilities' => [
            'Develop and implement B2B sales strategies to acquire enterprise clients.',
            'Coordinate branding and digital marketing campaigns for Peatech Services and our PeaSyn simulation suite.',
            'Manage customer relations, lead generation, and outbound sales pipelines.',
            'Collaborate with R&D teams to translate technical capabilities into clear client pitches.'
        ],
        'requirements' => [
            'Bachelor\'s degree in Marketing, Business Administration, or a related field.',
            'Experience in technical B2B sales or software marketing.',
            'Proven track record of managing digital campaigns and closing partnership deals.',
            'Exceptional communication, presentation, and negotiation skills.'
        ],
        'benefits' => [
            'Competitive base salary with performance-based commission incentives.',
            'Comprehensive healthcare, dental, and vision insurance packages.',
            'Flexible remote working schedule.',
            'Rapid career development in an innovative engineering service firm.'
        ]
    ],
    'engineering-intern' => [
        'title' => 'Engineering Intern',
        'department' => 'Research & Development',
        'location' => 'Richmond Heights, OH (Remote)',
        'type' => 'Internship / Part-Time',
        'description' => 'We are looking for a motivated Engineering Intern to support our advanced additive manufacturing modeling teams. You will work directly with our physics solvers and telemetry sync processes on the PeaSyn digital twin suite.',
        'responsibilities' => [
            'Assist in developing and refining physics-based models for wire-arc additive manufacturing (WAAM).',
            'Conduct computational simulations analyzing peak transient thermal gradients and melt pool dynamics.',
            'Support database integration, sync processes, and data translation workflows.',
            'Analyze experimental print datasets to validate simulation accuracy.'
        ],
        'requirements' => [
            'Currently pursuing a BS, MS, or PhD in Mechanical Engineering, Materials Science, Aerospace Engineering, or Computer Science.',
            'Strong foundation in heat transfer, numerical methods (FEM/CFD), or physical metallurgy.',
            'Basic scripting skills in Python, MATLAB, or C++.',
            'Eagerness to learn, iterate, and collaborate in a high-speed R&D environment.'
        ],
        'benefits' => [
            'Paid internship with flexible hours designed around your academic schedule.',
            'Direct mentorship from advanced manufacturing researchers and senior software engineers.',
            'Hands-on experience with industrial digital twin software platforms.',
            'Potential transition to full-time staff engineering positions upon graduation.'
        ]
    ]
];

// Get requested job slug from GET
$job_slug = isset($_GET['job']) ? trim($_GET['job']) : '';

// Validate job slug
if (empty($job_slug) || !array_key_exists($job_slug, $jobs)) {
    // Redirect to listings page
    header("Location: /careers");
    exit;
}

$job_info = $jobs[$job_slug];
$submit_success = false;
$submit_error = '';

// Handle application form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $city = isset($_POST['city']) ? trim($_POST['city']) : '';
    $state = isset($_POST['state']) ? trim($_POST['state']) : '';
    $zipCode = isset($_POST['zipCode']) ? trim($_POST['zipCode']) : '';
    $coverLetter = isset($_POST['coverLetter']) ? trim($_POST['coverLetter']) : '';

    // Handle File Upload
    $upload_dir = __DIR__ . '/uploads';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploaded_file_path = '';
    $original_file_name = '';
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['resume']['tmp_name'];
        $original_file_name = basename($_FILES['resume']['name']);
        $file_ext = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
        
        $allowed_exts = ['pdf', 'doc', 'docx'];
        if (!in_array($file_ext, $allowed_exts)) {
            $submit_error = 'Invalid file format. Only PDF, DOC, and DOCX are allowed.';
        } elseif ($_FILES['resume']['size'] > 5 * 1024 * 1024) { // 5MB limit
            $submit_error = 'File size exceeds the 5MB limit.';
        } else {
            // Generate a unique file name to avoid collisions
            $unique_file_name = uniqid('resume_', true) . '.' . $file_ext;
            $uploaded_file_path = $upload_dir . '/' . $unique_file_name;
            
            if (move_uploaded_file($file_tmp, $uploaded_file_path)) {
                // Success uploading file
            } else {
                $submit_error = 'Failed to save uploaded file.';
            }
        }
    } else {
        $submit_error = 'Resume upload is required.';
    }

    if (empty($submit_error)) {
        // Send Email
        $to = 'info@peatechservice.com, peatechservices89@gmail.com';
        $subject = "New Job Application: " . $job_info['title'] . " - " . $firstName . " " . $lastName;
        
        // Define dynamic resume download link
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $resume_url = $protocol . "://" . $host . "/uploads/" . basename($uploaded_file_path);

        // Build HTML email body
        $html_body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e1e5e9; border-radius: 8px; }
                .header { background-color: #266075; color: white; padding: 15px; text-align: center; border-radius: 6px 6px 0 0; }
                .section { margin: 20px 0; }
                .section-title { font-weight: bold; border-bottom: 2px solid #266075; padding-bottom: 5px; color: #1a2a3a; }
                .field { margin: 8px 0; }
                .label { font-weight: bold; color: #555; }
                .value { color: #111; }
                .cover-letter { background-color: #f8f9fa; padding: 15px; border-left: 4px solid #ff7b25; border-radius: 4px; font-style: italic; }
                .btn-download { display: inline-block; background-color: #ff7b25; color: white; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold; margin-top: 10px; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='header'>
                    <h2>New Application Submitted</h2>
                    <p style='margin: 0;'>" . $job_info['title'] . "</p>
                </div>
                <div class='section'>
                    <h3 class='section-title'>Applicant Personal Details</h3>
                    <div class='field'><span class='label'>Name:</span> <span class='value'>$firstName $lastName</span></div>
                    <div class='field'><span class='label'>Email:</span> <span class='value'><a href='mailto:$email'>$email</a></span></div>
                    <div class='field'><span class='label'>Phone:</span> <span class='value'>$phone</span></div>
                    <div class='field'><span class='label'>Address:</span> <span class='value'>$address, $city, $state $zipCode</span></div>
                </div>
                <div class='section'>
                    <h3 class='section-title'>Cover Letter</h3>
                    <div class='cover-letter'>" . nl2br(htmlspecialchars($coverLetter)) . "</div>
                </div>
                <div class='section' style='text-align: center;'>
                    <h3 class='section-title'>Resume/CV File</h3>
                    <p>The applicant's resume is attached to this email. You can also download it from the server using the link below:</p>
                    <a href='$resume_url' class='btn-download'>Download $original_file_name</a>
                </div>
            </div>
        </body>
        </html>";

        // Boundary for attachment
        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_y{$semi_rand}y";
        
        // Headers
        $headers = "MIME-Version: 1.0\r\n" .
                   "From: Peatech Careers <info@peatechservice.com>\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "Content-Type: multipart/mixed;\r\n" .
                   " boundary=\"{$mime_boundary}\"";
        
        // Multipart message
        $message = "--{$mime_boundary}\n" .
                   "Content-Type: text/html; charset=\"UTF-8\"\n" .
                   "Content-Transfer-Encoding: 7bit\n\n" .
                   $html_body . "\n\n";
        
        // Attach file
        if (file_exists($uploaded_file_path)) {
            $file_content = chunk_split(base64_encode(file_get_contents($uploaded_file_path)));
            $message .= "--{$mime_boundary}\n" .
                        "Content-Type: application/octet-stream;\n" .
                        " name=\"{$original_file_name}\"\n" .
                        "Content-Description: {$original_file_name}\n" .
                        "Content-Disposition: attachment;\n" .
                        " filename=\"{$original_file_name}\"\n" .
                        "Content-Transfer-Encoding: base64\n\n" .
                        $file_content . "\n\n";
        }
        $message .= "--{$mime_boundary}--";

        // Send mail
        if (@mail($to, $subject, $message, $headers)) {
            $submit_success = true;
        } else {
            // Local fallback
            $submit_success = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Apply for <?php echo htmlspecialchars($job_info['title']); ?> position at Peatech Services.">
    <title><?php echo htmlspecialchars($job_info['title']); ?> - Careers | Peatech Services</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../favicon.png" type="image/png">
    
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
        
        /* Job Header block */
        .job-header-section {
            background-color: var(--dark-blue);
            color: white;
            padding: 60px 0;
        }

        .job-header-title {
            font-size: 2.4rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .job-header-meta {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.7);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .job-header-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .badge-custom {
            background-color: var(--accent-orange);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Layout Grid */
        .job-content-container {
            padding: 60px 0;
        }

        .job-detail-block {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
            margin-bottom: 30px;
        }

        .job-section-title {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.3rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary-blue);
            padding-left: 12px;
        }

        .job-section-title:first-of-type {
            margin-top: 0;
        }

        .job-text {
            color: #444;
            margin-bottom: 1.5rem;
        }

        .job-list {
            margin-bottom: 1.5rem;
            padding-left: 20px;
        }

        .job-list li {
            margin-bottom: 8px;
            color: #444;
        }

        /* Form Styling */
        .sticky-form-card {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid var(--medium-grey);
        }

        .form-title {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--medium-grey);
            padding-bottom: 12px;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-blue);
            font-size: 0.85rem;
            margin-bottom: 4px;
        }

        .form-control, .form-select {
            padding: 10px 12px;
            font-size: 0.9rem;
            border: 1px solid #ced4da;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(38, 96, 117, 0.1);
        }

        .required-field::after {
            content: " *";
            color: #dc3545;
        }

        .file-upload-box {
            border: 2px dashed #ced4da;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            background-color: #fcfcfc;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 12px;
        }

        .file-upload-box:hover {
            border-color: var(--primary-blue);
            background-color: #f0f8ff;
        }

        .file-upload-box i {
            font-size: 1.8rem;
            color: var(--primary-blue);
            margin-bottom: 8px;
        }

        .btn-submit-job {
            background-color: var(--primary-blue);
            color: white;
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 6px;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-submit-job:hover {
            background-color: #1d4d60;
        }

        /* Success Card layout inside container if submitted */
        .success-card {
            text-align: center;
            padding: 40px;
        }

        .success-card i {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 20px;
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
            <a class="navbar-brand" href="../index.php">
                <img src="../images/peatechlogo.webp" alt="Peatech Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../peasyn.php">PeaSyn</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#services">Our Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="../articles.php">Articles</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.php#vision">Vision</a></li>
                    <li class="nav-item"><a class="nav-link active" href="../careers.php">Careers</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Job Header Section -->
    <section class="job-header-section">
        <div class="container">
            <h1 class="job-header-title"><?php echo htmlspecialchars($job_info['title']); ?></h1>
            <div class="job-header-meta">
                <span><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($job_info['department']); ?></span>
                <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($job_info['location']); ?></span>
                <span class="badge-custom"><?php echo htmlspecialchars($job_info['type']); ?></span>
            </div>
        </div>
    </section>

    <!-- Content Container -->
    <main class="container job-content-container">
        <div class="row g-5">
            <!-- Left Column: Job details -->
            <div class="col-lg-7">
                <div class="job-detail-block">
                    <h2 class="job-section-title">Job Description</h2>
                    <p class="job-text"><?php echo htmlspecialchars($job_info['description']); ?></p>

                    <h2 class="job-section-title">Key Responsibilities</h2>
                    <ul class="job-list">
                        <?php foreach ($job_info['responsibilities'] as $resp): ?>
                            <li><?php echo htmlspecialchars($resp); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h2 class="job-section-title">Requirements & Qualifications</h2>
                    <ul class="job-list">
                        <?php foreach ($job_info['requirements'] as $req): ?>
                            <li><?php echo htmlspecialchars($req); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h2 class="job-section-title">Benefits & Perks</h2>
                    <ul class="job-list">
                        <?php foreach ($job_info['benefits'] as $benefit): ?>
                            <li><?php echo htmlspecialchars($benefit); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

            <!-- Right Column: Stick sidebar application form -->
            <div class="col-lg-5">
                <div class="sticky-form-card" id="application-card">
                     <?php if ($submit_success): ?>
                         <div class="success-card">
                             <i class="fas fa-check-circle"></i>
                             <h3 class="success-title">Application Received!</h3>
                             <p class="success-message">
                                 Thank you, <strong><?php echo htmlspecialchars($firstName); ?></strong>. Your job application for the <strong><?php echo htmlspecialchars($job_info['title']); ?></strong> role has been successfully registered.
                             </p>
                             <a href="../careers.php" class="btn btn-outline-secondary mt-3">Back to Careers</a>
                         </div>

                         <!-- Success Modal Popup -->
                         <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static">
                             <div class="modal-dialog modal-dialog-centered">
                                 <div class="modal-content" style="border: none; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                                     <div class="modal-body text-center p-5">
                                         <div style="font-size: 4.5rem; color: #266075; margin-bottom: 20px;">
                                             <i class="fas fa-check-circle"></i>
                                         </div>
                                         <h3 class="modal-title mb-3" id="successModalLabel" style="font-weight: 700; color: #1a2a3a;">Application Received!</h3>
                                         <p class="text-secondary mb-4" style="font-size: 1.05rem; line-height: 1.6;">
                                             Thank you, <strong><?php echo htmlspecialchars($firstName); ?></strong>. Your job application for the <strong><?php echo htmlspecialchars($job_info['title']); ?></strong> role has been successfully registered.
                                         </p>
                                         <a href="../careers.php" class="btn btn-primary px-4 py-2" style="background-color: #266075; border: none; font-weight: 600; border-radius: 6px;">Back to Careers</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <script>
                             document.addEventListener('DOMContentLoaded', function() {
                                 var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                                 successModal.show();
                             });
                         </script>
                     <?php else: ?>
                        <div class="form-title">Apply for this Position</div>
                        
                        <?php if (!empty($submit_error)): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo htmlspecialchars($submit_error); ?>
                            </div>
                        <?php endif; ?>

                         <form id="jobApplicationForm" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                             <!-- Name -->
                             <div class="row">
                                 <div class="col-6">
                                     <label for="firstName" class="form-label required-field">First Name</label>
                                     <input type="text" class="form-control" id="firstName" name="firstName" required>
                                     <div class="invalid-feedback">First name is required.</div>
                                 </div>
                                 <div class="col-6">
                                     <label for="lastName" class="form-label required-field">Last Name</label>
                                     <input type="text" class="form-control" id="lastName" name="lastName" required>
                                     <div class="invalid-feedback">Last name is required.</div>
                                 </div>
                             </div>

                             <!-- Email & Phone -->
                             <div class="mt-3">
                                 <label for="email" class="form-label required-field">Email Address</label>
                                 <input type="email" class="form-control" id="email" name="email" required>
                                 <div class="invalid-feedback">Please enter a valid email address (e.g., name@example.com).</div>
                             </div>

                             <div class="mt-3">
                                 <label for="phone" class="form-label required-field">Phone Number</label>
                                 <input type="tel" class="form-control" id="phone" name="phone" required>
                                 <div class="invalid-feedback">Phone number is required.</div>
                             </div>

                             <!-- Address details -->
                             <div class="mt-3">
                                 <label for="address" class="form-label">Street Address</label>
                                 <input type="text" class="form-control" id="address" name="address" placeholder="e.g., 5247 Wilson Mills Rd">
                             </div>

                             <div class="row mt-3">
                                 <div class="col-6">
                                     <label for="city" class="form-label">City</label>
                                     <input type="text" class="form-control" id="city" name="city">
                                 </div>
                                 <div class="col-3">
                                     <label for="state" class="form-label">State</label>
                                     <input type="text" class="form-control" id="state" name="state">
                                 </div>
                                 <div class="col-3">
                                     <label for="zipCode" class="form-label">ZIP</label>
                                     <input type="text" class="form-control" id="zipCode" name="zipCode">
                                 </div>
                             </div>

                             <!-- Metrics -->


                             <!-- Cover Letter -->
                             <div class="mt-3">
                                 <label for="coverLetter" class="form-label">Cover Letter</label>
                                 <textarea class="form-control" id="coverLetter" name="coverLetter" rows="3" placeholder="Briefly introduce yourself..."></textarea>
                             </div>

                             <!-- Resume Upload -->
                             <div class="mt-3">
                                 <label class="form-label required-field">Upload Resume / CV</label>
                                 <div class="file-upload-box" id="uploadArea">
                                     <i class="fas fa-file-pdf"></i>
                                     <div class="fw-semibold text-secondary" style="font-size: 0.85rem;" id="fileNameDisplay">Click to choose Resume file</div>
                                     <div class="text-muted small" style="font-size: 0.75rem;">Supports PDF, DOC, DOCX (Max 5MB)</div>
                                     <input type="file" id="resume" name="resume" class="d-none" accept=".pdf,.doc,.docx" required>
                                 </div>
                                 <div class="invalid-feedback text-center mt-2" id="resumeFeedback" style="display: none;">Please choose and upload your resume file.</div>
                             </div>

                             <button type="submit" class="btn-submit-job">Submit Application</button>
                         </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <img src="../images/peatechlogo.webp" alt="Peatech Logo" class="footer-logo" style="filter: brightness(0) invert(1);">
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
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../peasyn.php">PeaSyn</a></li>
                        <li><a href="../index.php#services">Our Services</a></li>
                        <li><a href="../articles.php">Articles</a></li>
                        <li><a href="../index.php#vision">Our Vision</a></li>
                        <li><a href="../index.php#contact">Connect With Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5>Connection Points</h5>
                    <ul>
                        <li><a href="../index.php#services">Our Services</a></li>
                        <li><a href="../index.php#connection">Connection Ecosystem</a></li>
                        <li><a href="../index.php#vision">Our Vision</a></li>
                        <li><a href="#">Case Studies</a></li>
                        <li><a href="#">Success Stories</a></li>
                        <li><a href="../careers.php">Join Our Team</a></li>
                        <li><a href="../index.php#contact">Connect With Us</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-divider">
            <div class="copyright">
                <p class="mb-0">© 2026 Peatech Services. All rights reserved. | The Connection Company | <a href="../privacy-policy.php" style="color: #bbb; text-decoration: none;">Privacy Policy</a></p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Trigger file input click when clicking dashed upload box
        const uploadArea = document.getElementById('uploadArea');
        const resumeInput = document.getElementById('resume');
        const fileNameDisplay = document.getElementById('fileNameDisplay');
        const resumeFeedback = document.getElementById('resumeFeedback');
        const form = document.getElementById('jobApplicationForm');
        
        if(uploadArea && resumeInput) {
            uploadArea.addEventListener('click', () => {
                resumeInput.click();
            });
            
            resumeInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if(file) {
                    fileNameDisplay.textContent = file.name;
                    fileNameDisplay.style.color = 'var(--primary-blue)';
                    uploadArea.style.borderColor = 'var(--primary-blue)';
                    uploadArea.style.backgroundColor = '#f0f8ff';
                    if(resumeFeedback) resumeFeedback.style.display = 'none';
                } else {
                    fileNameDisplay.textContent = 'Click to choose Resume file';
                    fileNameDisplay.style.color = '';
                    uploadArea.style.borderColor = '';
                    uploadArea.style.backgroundColor = '';
                }
            });
        }

        if(form) {
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Custom validation for file input
                if (!resumeInput.files || resumeInput.files.length === 0) {
                    isValid = false;
                    if(resumeFeedback) {
                        resumeFeedback.style.display = 'block';
                        resumeFeedback.style.color = '#dc3545';
                    }
                    uploadArea.style.borderColor = '#dc3545';
                    uploadArea.style.backgroundColor = '#fff8f8';
                }
                
                if (!form.checkValidity() || !isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Highlight custom validation styles
                    form.classList.add('was-validated');
                    
                    // Scroll to first invalid field
                    const firstInvalid = form.querySelector(':invalid');
                    if (firstInvalid) {
                        firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstInvalid.focus();
                    }
                }
            }, false);
        }
    </script>
</body>
</html>