<?php
/**
 * career.php
 * Job Posting Details page.
 */

require __DIR__ . '/career-jobs.php';

// Get requested job slug from GET
$job_slug = isset($_GET['job']) ? trim($_GET['job']) : '';

// Default fallback to the primary coordinators posting if no slug is provided
$default_slug = 'operations-and-executive-support-coordinators';
if (empty($job_slug)) {
    $job_slug = $default_slug;
}

// Validate job slug
if (!array_key_exists($job_slug, $jobs)) {
    header("Location: /careers");
    exit;
}

$job_info = $jobs[$job_slug];
$submit_success = false;
$submit_error = '';

$firstName = '';
$lastName = '';
$email = '';
$phone = '';
$appliedRole = '';
$address = '';
$city = '';
$state = '';
$zipCode = '';
$coverLetter = '';

// Handle embedded application form submission if used
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName   = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName    = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email       = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone       = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $appliedRole = isset($_POST['appliedRole']) ? trim($_POST['appliedRole']) : '';
    $address     = isset($_POST['address']) ? trim($_POST['address']) : '';
    $city        = isset($_POST['city']) ? trim($_POST['city']) : '';
    $state       = isset($_POST['state']) ? trim($_POST['state']) : '';
    $zipCode     = isset($_POST['zipCode']) ? trim($_POST['zipCode']) : '';
    $coverLetter = isset($_POST['coverLetter']) ? trim($_POST['coverLetter']) : '';

    if (!empty($job_info['roles']) && count($job_info['roles']) > 1 && empty($appliedRole)) {
        $submit_error = 'Please select the role you are applying for.';
    }

    $upload_dir = __DIR__ . '/uploads';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploaded_file_path = '';
    $original_file_name = '';

    if (empty($submit_error)) {
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['resume']['tmp_name'];
            $original_file_name = basename($_FILES['resume']['name']);
            $file_ext = strtolower(pathinfo($original_file_name, PATHINFO_EXTENSION));
            
            $allowed_exts = ['pdf', 'doc', 'docx'];
            if (!in_array($file_ext, $allowed_exts)) {
                $submit_error = 'Invalid file format. Only PDF, DOC, and DOCX are allowed.';
            } elseif ($_FILES['resume']['size'] > 5 * 1024 * 1024) {
                $submit_error = 'File size exceeds the 5MB limit.';
            } else {
                $unique_file_name = uniqid('resume_', true) . '.' . $file_ext;
                $uploaded_file_path = $upload_dir . '/' . $unique_file_name;
                
                if (!move_uploaded_file($file_tmp, $uploaded_file_path)) {
                    $submit_error = 'Failed to save uploaded file.';
                }
            }
        } else {
            $submit_error = 'Resume upload is required.';
        }
    }

    if (empty($submit_error)) {
        $to = 'info@peatechservice.com, peatechservices89@gmail.com';
        $role_subject_suffix = !empty($appliedRole) ? " (" . $appliedRole . ")" : "";
        $subject = "New Job Application: " . $job_info['title'] . $role_subject_suffix . " - " . $firstName . " " . $lastName;
        
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $resume_url = $protocol . "://" . $host . "/uploads/" . basename($uploaded_file_path);

        $role_header_badge = !empty($appliedRole) ? "<div style='margin-top:6px; font-weight:bold; font-size:1.1rem; color:#ffddbb;'>Role: " . htmlspecialchars($appliedRole) . "</div>" : "";
        $role_field_row = !empty($appliedRole) ? "<div class='field'><span class='label'>Selected Role:</span> <span class='value' style='color:#ff7b25; font-weight:bold;'>" . htmlspecialchars($appliedRole) . "</span></div>" : "";

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
                    <p style='margin: 0;'>" . htmlspecialchars($job_info['title']) . "</p>
                    $role_header_badge
                </div>
                <div class='section'>
                    <h3 class='section-title'>Applicant Personal Details</h3>
                    <div class='field'><span class='label'>Position:</span> <span class='value'>" . htmlspecialchars($job_info['title']) . "</span></div>
                    $role_field_row
                    <div class='field'><span class='label'>Name:</span> <span class='value'>" . htmlspecialchars($firstName . " " . $lastName) . "</span></div>
                    <div class='field'><span class='label'>Email:</span> <span class='value'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></span></div>
                    <div class='field'><span class='label'>Phone:</span> <span class='value'>" . htmlspecialchars($phone) . "</span></div>
                    <div class='field'><span class='label'>Address:</span> <span class='value'>" . htmlspecialchars("$address, $city, $state $zipCode") . "</span></div>
                </div>
                <div class='section'>
                    <h3 class='section-title'>Cover Letter</h3>
                    <div class='cover-letter'>" . nl2br(htmlspecialchars($coverLetter)) . "</div>
                </div>
                <div class='section' style='text-align: center;'>
                    <h3 class='section-title'>Resume/CV File</h3>
                    <p>The applicant's resume is attached to this email. You can also download it from the server using the link below:</p>
                    <a href='$resume_url' class='btn-download'>Download " . htmlspecialchars($original_file_name) . "</a>
                </div>
            </div>
        </body>
        </html>";

        $semi_rand = md5(time());
        $mime_boundary = "==Multipart_Boundary_y{$semi_rand}y";
        
        $headers = "MIME-Version: 1.0\r\n" .
                   "From: Peatech Careers <info@peatechservice.com>\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "Content-Type: multipart/mixed;\r\n" .
                   " boundary=\"{$mime_boundary}\"";
        
        $message = "--{$mime_boundary}\n" .
                   "Content-Type: text/html; charset=\"UTF-8\"\n" .
                   "Content-Transfer-Encoding: 7bit\n\n" .
                   $html_body . "\n\n";
        
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

        if (@mail($to, $subject, $message, $headers)) {
            $submit_success = true;
        } else {
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
    <meta name="description" content="View job details for <?php echo htmlspecialchars($job_info['title']); ?> at Peatech Services.">
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
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .job-header-meta {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.85);
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
            padding: 50px 0;
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

        .job-category-header {
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 1.05rem;
            margin-top: 1.4rem;
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .job-category-header i {
            color: var(--accent-orange);
            font-size: 0.85rem;
        }

        .job-text {
            color: #444;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .job-list {
            margin-bottom: 1.5rem;
            padding-left: 20px;
        }

        .job-list li {
            margin-bottom: 8px;
            color: #444;
        }

        /* Form / Sidebar Styling */
        .sticky-form-card {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid var(--medium-grey);
            position: sticky;
            top: 90px;
        }

        .form-title {
            color: var(--dark-blue);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--medium-grey);
            padding-bottom: 12px;
        }

        .btn-submit-job {
            background-color: var(--primary-blue);
            color: white;
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 6px;
            width: 100%;
            transition: all 0.3s;
            margin-top: 10px;
        }

        .btn-submit-job:hover {
            background-color: #1d4d60;
            color: white;
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
                    <!-- Need help? Call us <a href="tel:1-800-123-4567">1-800-123-4567</a> -->
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="https://www.facebook.com/share/1DqeqTDb7V/" class="mx-2" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                    <!--<a href="https://twitter.com/peatech" class="mx-2"><i class="fab fa-twitter"></i></a>-->
                    <a href="https://www.instagram.com/peatechsmartservices?stkn=MW5rN2RxbmZrd2Y0ZA==" class="mx-2" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/peatech-smart-services/" class="mx-2" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
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
            <div class="mb-3">
                <a href="../careers.php" class="text-white text-decoration-none small">
                    <i class="fas fa-arrow-left me-1"></i> Back to All Openings
                </a>
            </div>
            <h1 class="job-header-title"><?php echo htmlspecialchars($job_info['title']); ?></h1>
            <div class="job-header-meta">
                <span><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($job_info['department']); ?></span>
                <?php if (!empty($job_info['location'])): ?><span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($job_info['location']); ?></span><?php endif; ?>
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

                    <?php if (!empty($job_info['responsibilities'])): ?>
                        <h2 class="job-section-title">Key Responsibilities</h2>
                        <?php 
                        $is_assoc = (array_keys($job_info['responsibilities']) !== range(0, count($job_info['responsibilities']) - 1));
                        if ($is_assoc): ?>
                            <?php foreach ($job_info['responsibilities'] as $category => $resp_items): ?>
                                <h5 class="job-category-header">
                                    <i class="fas fa-chevron-circle-right"></i> <?php echo htmlspecialchars(ucwords($category)); ?>
                                </h5>
                                <ul class="job-list">
                                    <?php foreach ((array)$resp_items as $resp): ?>
                                        <li><?php echo htmlspecialchars($resp); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <ul class="job-list">
                                <?php foreach ($job_info['responsibilities'] as $resp): ?>
                                    <li><?php echo htmlspecialchars($resp); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if (!empty($job_info['requirements'])): ?>
                        <h2 class="job-section-title">Requirements & Qualifications</h2>
                        <ul class="job-list">
                            <?php foreach ($job_info['requirements'] as $req): ?>
                                <li><?php echo htmlspecialchars($req); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if (!empty($job_info['benefits'])): ?>
                        <h2 class="job-section-title">Benefits & Perks</h2>
                        <ul class="job-list">
                            <?php foreach ($job_info['benefits'] as $benefit): ?>
                                <li><?php echo htmlspecialchars($benefit); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <!-- Bottom Call To Action Button -->
                    <?php if (!empty($job_info['apply_url'])): ?>
                        <div class="mt-5 pt-4 border-top d-flex flex-wrap align-items-center justify-content-between gap-3">
                            <div>
                                <h4 class="mb-1 fw-bold text-dark">Interested in this opportunity?</h4>
                                <p class="text-muted mb-0 small">Proceed to our application portal to submit your details.</p>
                            </div>
                            <a href="<?php echo htmlspecialchars($job_info['apply_url']); ?>" class="btn btn-primary px-4 py-3 fw-bold" style="background-color: var(--primary-blue); border: none; border-radius: 6px;">
                                Apply for this Position <i class="fas fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right Column: Sidebar Action Card -->
            <div class="col-lg-5">
                <div class="sticky-form-card" id="application-card">
                    <?php if (!empty($job_info['apply_url'])): ?>
                        <!-- Quick Action Card directing to Progressive Application Page -->
                        <div class="form-title">Job Overview</div>
                        
                        <div class="mb-3">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size:0.75rem;">Position</div>
                            <div class="fw-bold" style="color: var(--dark-blue); font-size: 1.05rem;"><?php echo htmlspecialchars($job_info['title']); ?></div>
                        </div>

                        <div class="mb-3">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size:0.75rem;">Department</div>
                            <div class="fw-semibold text-dark"><?php echo htmlspecialchars($job_info['department']); ?></div>
                        </div>

                        <?php if (!empty($job_info['location'])): ?>
                        <div class="mb-3">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size:0.75rem;">Location</div>
                            <div class="fw-semibold text-dark"><?php echo htmlspecialchars($job_info['location']); ?></div>
                        </div>
                        <?php endif; ?>

                        <div class="mb-4">
                            <div class="text-muted small fw-semibold text-uppercase" style="font-size:0.75rem;">Employment Type</div>
                            <div class="fw-semibold text-dark"><?php echo htmlspecialchars($job_info['type']); ?></div>
                        </div>

                        <a href="<?php echo htmlspecialchars($job_info['apply_url']); ?>" class="btn-submit-job text-center text-decoration-none d-block py-3 fs-6">
                            Apply for this Position <i class="fas fa-arrow-right ms-2"></i>
                        </a>

                        <div class="mt-4 pt-3 border-top text-muted small">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-shield-alt text-primary"></i> Confidential hiring process
                            </div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="fas fa-layer-group text-primary"></i> 5-step progressive application form
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fas fa-file-pdf text-primary"></i> Resume / CV attachment required
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- Embedded Form Fallback for other jobs -->
                        <div class="form-title">Apply for this Position</div>
                        <?php if (!empty($submit_error)): ?>
                            <div class="alert alert-danger" role="alert"><?php echo htmlspecialchars($submit_error); ?></div>
                        <?php endif; ?>
                        <p class="text-muted small">Please contact us or submit your CV to <a href="mailto:info@peatechservice.com">info@peatechservice.com</a>.</p>
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
                        <a href="https://www.facebook.com/share/1DqeqTDb7V/" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/peatechsmartservices?stkn=MW5rN2RxbmZrd2Y0ZA==" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.linkedin.com/company/peatech-smart-services/" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
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
</body>
</html>