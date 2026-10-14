<?php
// Shared five-step application used by the role-specific entry pages.
if (!isset($application_job_slug)) {
    http_response_code(404);
    exit;
}
require __DIR__ . '/career-jobs.php';
$application_job = $jobs[$application_job_slug];
$job_title = $application_job['title'];
$job_id = $application_job['job_id'];
$job_department = $application_job['department'];
$job_category = $application_job['category'] ?? $job_department;
$job_function = $application_job['function'] ?? $job_department;
$job_location = $application_job['location'];
$posting_date = date('m/d/Y, h:i A');
$job_url = '/career/' . $application_job_slug;
$available_roles = $application_job['roles'];
$screening_fields = $application_job['screening_fields'] ?? [];
$screening_answers = array_fill_keys(array_keys($screening_fields), '');
$attendance_question = $application_job_slug === 'engineering-intern'
    ? 'Are you available to work on-site for your agreed internship schedule?'
    : ($application_job_slug === 'smart-system-engineer'
        ? 'Are you available for hands-on integration and testing when required?'
        : 'Are you willing to work from the office five days a week if the job requires?');

$submit_success = false;
$submit_error = '';

// Variables
$appliedRole = count($available_roles) === 1 ? array_key_first($available_roles) : '';
$firstName = '';
$lastName = '';
$email = '';
$phone = '';
$address = '';
$city = '';
$state = '';
$zipCode = '';

// Questionnaire variables
$q_office_days = 'Yes';
$q_past_employee = 'No';
$q_past_contractor = 'No';
$q_visa_sponsorship = 'No';
$q_current_employee = 'No';

// Work & Education (JSON decoded arrays)
$experience_entries = [];
$education_entries = [];

$link1 = '';
$link2 = '';
$updates_optin = '0';
$esignature = '';

// Handle application submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appliedRole        = isset($_POST['appliedRole']) ? trim($_POST['appliedRole']) : '';
    $firstName          = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName           = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email              = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone              = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $address            = isset($_POST['address']) ? trim($_POST['address']) : '';
    $city               = isset($_POST['city']) ? trim($_POST['city']) : '';
    $state              = isset($_POST['state']) ? trim($_POST['state']) : '';
    $zipCode            = isset($_POST['zipCode']) ? trim($_POST['zipCode']) : '';

    $q_office_days      = isset($_POST['q_office_days']) ? trim($_POST['q_office_days']) : 'Yes';
    $q_past_employee    = isset($_POST['q_past_employee']) ? trim($_POST['q_past_employee']) : 'No';
    $q_past_contractor  = isset($_POST['q_past_contractor']) ? trim($_POST['q_past_contractor']) : 'No';
    $q_visa_sponsorship = isset($_POST['q_visa_sponsorship']) ? trim($_POST['q_visa_sponsorship']) : 'No';
    $q_current_employee = isset($_POST['q_current_employee']) ? trim($_POST['q_current_employee']) : 'No';

    $exp_json           = isset($_POST['experience_data']) ? trim($_POST['experience_data']) : '[]';
    $edu_json           = isset($_POST['education_data']) ? trim($_POST['education_data']) : '[]';

    $experience_entries = json_decode($exp_json, true) ?: [];
    $education_entries  = json_decode($edu_json, true) ?: [];

    $link1              = isset($_POST['link1']) ? trim($_POST['link1']) : '';
    $link2              = isset($_POST['link2']) ? trim($_POST['link2']) : '';
    $updates_optin      = isset($_POST['updates_optin']) ? '1' : '0';
    $esignature         = isset($_POST['esignature']) ? trim($_POST['esignature']) : '';

    foreach ($screening_fields as $field => $label) {
        $screening_answers[$field] = is_string($_POST[$field] ?? null) ? trim($_POST[$field]) : '';
    }

    // Validations
    if (!array_key_exists($appliedRole, $available_roles)) {
        $submit_error = 'Please select the role you are applying for.';
    } elseif (empty($firstName) || empty($lastName)) {
        $submit_error = 'First name and last name are required.';
    } elseif (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $submit_error = 'A valid email address is required.';
    } elseif (empty($phone)) {
        $submit_error = 'Phone number is required.';
    } elseif (empty($esignature)) {
        $submit_error = 'E-Signature (Full Name) is required to finalize application.';
    }

    foreach ($screening_fields as $field => $label) {
        if ($screening_answers[$field] === '' && $submit_error === '') {
            $submit_error = 'Please complete: ' . $label . '.';
        }
    }

    // File Upload Directory
    $upload_dir = __DIR__ . '/uploads';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploaded_resume_path = '';
    $original_resume_name = '';
    $uploaded_cover_path  = '';
    $original_cover_name  = '';
    $allowed_exts         = ['pdf', 'doc', 'docx'];

    // Handle Resume Upload (Mandatory)
    if (empty($submit_error)) {
        if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['resume']['tmp_name'];
            $original_resume_name = basename($_FILES['resume']['name']);
            $file_ext = strtolower(pathinfo($original_resume_name, PATHINFO_EXTENSION));

            if (!in_array($file_ext, $allowed_exts)) {
                $submit_error = 'Invalid resume format. Only PDF, DOC, and DOCX are allowed.';
            } elseif ($_FILES['resume']['size'] > 5 * 1024 * 1024) {
                $submit_error = 'Resume file exceeds 5MB limit.';
            } else {
                $unique_name = uniqid('resume_', true) . '.' . $file_ext;
                $uploaded_resume_path = $upload_dir . '/' . $unique_name;
                if (!move_uploaded_file($file_tmp, $uploaded_resume_path)) {
                    $submit_error = 'Failed to save uploaded resume file.';
                }
            }
        } else {
            $submit_error = 'Resume upload is required.';
        }
    }

    // Handle Cover Letter Upload (Optional)
    if (empty($submit_error) && isset($_FILES['coverLetterFile']) && $_FILES['coverLetterFile']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['coverLetterFile']['tmp_name'];
        $original_cover_name = basename($_FILES['coverLetterFile']['name']);
        $file_ext = strtolower(pathinfo($original_cover_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_exts) && $_FILES['coverLetterFile']['size'] <= 5 * 1024 * 1024) {
            $unique_name = uniqid('cover_', true) . '.' . $file_ext;
            $uploaded_cover_path = $upload_dir . '/' . $unique_name;
            move_uploaded_file($file_tmp, $uploaded_cover_path);
        }
    }

    if (empty($submit_error)) {
        $to = 'info@peatechservice.com, peatechservices89@gmail.com';
        $role_subject_suffix = !empty($appliedRole) ? " (" . $appliedRole . ")" : "";
        $subject = "New Job Application: " . $job_title . $role_subject_suffix . " - " . $firstName . " " . $lastName;

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'];
        $resume_url = !empty($uploaded_resume_path) ? $protocol . "://" . $host . "/uploads/" . basename($uploaded_resume_path) : '';
        $cover_url  = !empty($uploaded_cover_path) ? $protocol . "://" . $host . "/uploads/" . basename($uploaded_cover_path) : '';

        // Build HTML for Experience
        $experience_html = "";
        if (!empty($experience_entries)) {
            $experience_html .= "<ul style='padding-left:20px;'>";
            foreach ($experience_entries as $exp) {
                $title   = htmlspecialchars($exp['title'] ?? '');
                $company = htmlspecialchars($exp['company'] ?? '');
                $period  = htmlspecialchars($exp['period'] ?? '');
                $summary = htmlspecialchars($exp['summary'] ?? '');
                $experience_html .= "<li style='margin-bottom:8px;'><strong>$title</strong> at <em>$company</em> ($period)" . (!empty($summary) ? "<br><span style='color:#555;'>$summary</span>" : "") . "</li>";
            }
            $experience_html .= "</ul>";
        } else {
            $experience_html = "<p style='color:#777;'>None provided</p>";
        }

        // Build HTML for Education
        $education_html = "";
        if (!empty($education_entries)) {
            $education_html .= "<ul style='padding-left:20px;'>";
            foreach ($education_entries as $edu) {
                $degree = htmlspecialchars($edu['degree'] ?? '');
                $school = htmlspecialchars($edu['school'] ?? '');
                $year   = htmlspecialchars($edu['year'] ?? '');
                $education_html .= "<li style='margin-bottom:6px;'><strong>$degree</strong>, $school ($year)</li>";
            }
            $education_html .= "</ul>";
        } else {
            $education_html = "<p style='color:#777;'>None provided</p>";
        }

        $screening_html = '';
        foreach ($screening_fields as $field => $label) {
            $screening_html .= '<div class="row-item"><strong>' . htmlspecialchars($label) . ':</strong><br>'
                . nl2br(htmlspecialchars($screening_answers[$field])) . '</div>';
        }

        // Build HTML Email Body
        $html_body = "
        <html>
        <head>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #222; margin: 0; padding: 0; }
                .email-wrap { max-width: 650px; margin: 0 auto; border: 1px solid #dcdfe4; border-radius: 8px; overflow: hidden; }
                .email-header { background-color: #266075; color: white; padding: 20px; text-align: center; }
                .email-body { padding: 25px; }
                .sec-title { font-size: 15px; font-weight: bold; color: #1a2a3a; border-bottom: 2px solid #266075; padding-bottom: 4px; margin-top: 20px; }
                .row-item { margin: 7px 0; font-size: 14px; }
                .row-label { font-weight: bold; color: #555; width: 230px; display: inline-block; }
                .btn-dl { display: inline-block; background-color: #ff7b25; color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-weight: bold; margin-top: 6px; }
                .q-ans { font-weight: bold; color: #1a2a3a; }
            </style>
        </head>
        <body>
            <div class='email-wrap'>
                <div class='email-header'>
                    <h2 style='margin:0 0 6px;'>Peatech Application Submitted</h2>
                    <div style='font-size:15px; opacity:0.95;'>$job_title</div>
                    <div style='margin-top:6px; font-weight:bold; color:#ffddbb;'>Applied Role: " . htmlspecialchars($appliedRole) . "</div>
                </div>
                <div class='email-body'>
                    <div class='sec-title'>Applicant Personal Details</div>
                    <div class='row-item'><span class='row-label'>Candidate:</span> " . htmlspecialchars($firstName . " " . $lastName) . "</div>
                    <div class='row-item'><span class='row-label'>Email:</span> <a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></div>
                    <div class='row-item'><span class='row-label'>Phone:</span> " . htmlspecialchars($phone) . "</div>
                    <div class='row-item'><span class='row-label'>Address:</span> " . htmlspecialchars("$address, $city, $state $zipCode") . "</div>
                    " . (!empty($link1) ? "<div class='row-item'><span class='row-label'>Link 1:</span> <a href='" . htmlspecialchars($link1) . "'>" . htmlspecialchars($link1) . "</a></div>" : "") . "
                    " . (!empty($link2) ? "<div class='row-item'><span class='row-label'>Link 2:</span> <a href='" . htmlspecialchars($link2) . "'>" . htmlspecialchars($link2) . "</a></div>" : "") . "

                    <div class='sec-title'>Pre-Screening Questionnaire</div>
                    <div class='row-item'><span class='row-label'>" . htmlspecialchars($attendance_question) . "</span> <span class='q-ans'>" . htmlspecialchars($q_office_days) . "</span></div>
                    <div class='row-item'><span class='row-label'>Past Peatech employee:</span> <span class='q-ans'>" . htmlspecialchars($q_past_employee) . "</span></div>
                    <div class='row-item'><span class='row-label'>Past Peatech contractor:</span> <span class='q-ans'>" . htmlspecialchars($q_past_contractor) . "</span></div>
                    <div class='row-item'><span class='row-label'>Requires visa sponsorship:</span> <span class='q-ans'>" . htmlspecialchars($q_visa_sponsorship) . "</span></div>
                    <div class='row-item'><span class='row-label'>Current Peatech employee:</span> <span class='q-ans'>" . htmlspecialchars($q_current_employee) . "</span></div>

                    $screening_html
                    <div class='sec-title'>Work Experience</div>
                    $experience_html

                    <div class='sec-title'>Education History</div>
                    $education_html

                    <div class='sec-title'>Documents & Sign-off</div>
                    <div class='row-item'><span class='row-label'>Resume:</span> <a href='$resume_url' class='btn-dl'>Download " . htmlspecialchars($original_resume_name) . "</a></div>
                    " . (!empty($cover_url) ? "<div class='row-item' style='margin-top:10px;'><span class='row-label'>Cover Letter:</span> <a href='$cover_url' class='btn-dl' style='background-color:#266075;'>Download " . htmlspecialchars($original_cover_name) . "</a></div>" : "") . "
                    <div class='row-item' style='margin-top:12px;'><span class='row-label'>E-Signature:</span> <strong>" . htmlspecialchars($esignature) . "</strong></div>
                    <div class='row-item'><span class='row-label'>Job Alerts Opt-in:</span> " . ($updates_optin === '1' ? 'Yes' : 'No') . "</div>
                </div>
            </div>
        </body>
        </html>";

        // Boundary
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

        // Attach Resume
        if (file_exists($uploaded_resume_path)) {
            $file_content = chunk_split(base64_encode(file_get_contents($uploaded_resume_path)));
            $message .= "--{$mime_boundary}\n" .
                        "Content-Type: application/octet-stream;\n" .
                        " name=\"{$original_resume_name}\"\n" .
                        "Content-Disposition: attachment; filename=\"{$original_resume_name}\"\n" .
                        "Content-Transfer-Encoding: base64\n\n" .
                        $file_content . "\n\n";
        }

        // Attach Cover Letter if provided
        if (!empty($uploaded_cover_path) && file_exists($uploaded_cover_path)) {
            $cover_content = chunk_split(base64_encode(file_get_contents($uploaded_cover_path)));
            $message .= "--{$mime_boundary}\n" .
                        "Content-Type: application/octet-stream;\n" .
                        " name=\"{$original_cover_name}\"\n" .
                        "Content-Disposition: attachment; filename=\"{$original_cover_name}\"\n" .
                        "Content-Transfer-Encoding: base64\n\n" .
                        $cover_content . "\n\n";
        }

        $message .= "--{$mime_boundary}--";

        if (@mail($to, $subject, $message, $headers)) {
            $submit_success = true;
        } else {
            $submit_error = 'We could not send your application. Please try again and reattach your documents, or contact info@peatechservice.com.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Apply for <?php echo htmlspecialchars($job_title); ?> at Peatech Services.">
    <title>Apply - <?php echo htmlspecialchars($job_title); ?> | Peatech Services</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="favicon.png" type="image/png">

    <style>
        :root {
            --primary-blue: #266075;
            --primary-dark: #1a2a3a;
            --accent-orange: #ff7b25;
            --accent-orange-hover: #e56b1d;
            --light-bg: #f8fafc;
            --card-border: #e2e8f0;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: var(--light-bg);
            min-height: 100vh;
        }

        /* Top Utility Bar */
        .top-bar {
            background-color: var(--primary-dark);
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            padding: 8px 0;
        }

        .top-bar a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .top-bar a:hover {
            color: #ffffff;
        }

        /* Top Header Bar */
        .portal-header {
            background-color: white;
            border-bottom: 1px solid var(--card-border);
            padding: 12px 0;
            position: sticky;
            top: 0;
            z-index: 110;
        }

        .header-logo-img {
            height: 34px;
            width: auto;
        }

        .header-btn {
            font-size: 0.82rem;
            padding: 5px 12px;
            font-weight: 600;
            border-radius: 6px;
        }

        .job-title-bar {
            background: white;
            border-bottom: 1px solid var(--card-border);
            padding: 14px 0;
        }

        .back-nav-link {
            color: var(--text-dark);
            text-decoration: none;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 1.05rem;
            line-height: 1.3;
        }

        .back-nav-link:hover {
            color: var(--accent-orange);
        }

        .job-info-dropdown-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 6px 10px;
            border-radius: 6px;
        }

        .job-details-dropdown-card {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 16px 20px;
            font-size: 0.85rem;
            line-height: 1.7;
            max-width: 360px;
        }

        /* FIXED / STICKY STEPPER WRAPPER */
        .stepper-sticky-wrapper {
            position: sticky;
            top: 58px; /* sits right below sticky header */
            background: #ffffff;
            z-index: 100;
            border-bottom: 1px solid var(--card-border);
            box-shadow: 0 4px 12px rgba(0,0,0,0.04);
            padding: 14px 0 10px;
            transition: all 0.2s ease;
        }

        .stepper-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
            max-width: 720px;
            margin: 0 auto;
            padding: 0 10px;
        }

        .stepper-line-bg {
            position: absolute;
            top: 15px;
            left: 25px;
            right: 25px;
            height: 3px;
            background-color: #cbd5e1;
            z-index: 1;
        }

        .stepper-line-fill {
            position: absolute;
            top: 15px;
            left: 25px;
            height: 3px;
            background-color: var(--primary-blue);
            z-index: 2;
            transition: width 0.35s ease;
            width: 0%;
        }

        .step-item {
            position: relative;
            z-index: 3;
            text-align: center;
            cursor: pointer;
        }

        .step-dot {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: white;
            border: 3px solid #cbd5e1;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.78rem;
            font-weight: 700;
            color: #94a3b8;
            transition: all 0.25s;
        }

        .step-item.active .step-dot {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 4px rgba(38, 96, 117, 0.25);
            background-color: var(--primary-blue);
            color: white;
            font-weight: 700;
        }

        .step-item.completed .step-dot {
            border-color: var(--primary-blue);
            background-color: var(--primary-blue);
            color: white;
        }

        .step-name {
            margin-top: 6px;
            font-size: 0.76rem;
            font-weight: 600;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .step-item.active .step-name {
            color: var(--primary-blue);
            font-weight: 700;
        }

        /* Mobile Step Indicator Badge (Eliminates text overlapping on phones) */
        .mobile-step-badge {
            background-color: #f1f5f9;
            color: var(--primary-blue);
            font-size: 0.8rem;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 20px;
            border: 1px solid #cbd5e1;
            display: inline-block;
        }

        /* Container Card */
        .portal-card {
            background: white;
            border: 1px solid var(--card-border);
            border-radius: 12px;
            padding: 35px 30px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        .section-headline {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 6px;
        }

        .section-subtext {
            color: var(--text-muted);
            font-size: 0.92rem;
            margin-bottom: 22px;
        }

        .form-label {
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 0.88rem;
            margin-bottom: 6px;
        }

        .required-star::after {
            content: " *";
            color: #dc3545;
        }

        .form-control, .form-select {
            padding: 11px 14px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 0.92rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(38, 96, 117, 0.15);
        }

        /* Yes/No Pill Buttons */
        .question-block {
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1px solid #f1f5f9;
        }

        .question-block:last-of-type {
            border-bottom: none;
        }

        .question-label {
            font-size: 0.92rem;
            font-weight: 500;
            color: #334155;
            margin-bottom: 10px;
            display: block;
            line-height: 1.45;
        }

        .pill-toggle-group {
            display: flex;
            gap: 12px;
        }

        .pill-btn {
            border: 1.5px solid #cbd5e1;
            background: white;
            color: #334155;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 7px 26px;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.2s;
            min-width: 75px;
            text-align: center;
        }

        .pill-btn:hover {
            border-color: #94a3b8;
            background-color: #f8fafc;
        }

        .pill-btn.active {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            box-shadow: 0 2px 8px rgba(38, 96, 117, 0.25);
        }

        /* History Buttons */
        .history-btn-row {
            display: flex;
            gap: 16px;
            justify-content: center;
            margin: 25px 0 20px;
            flex-wrap: wrap;
        }

        .btn-history-pill {
            background: white;
            border: 1.5px solid var(--accent-orange);
            color: var(--accent-orange);
            font-weight: 700;
            font-size: 0.88rem;
            letter-spacing: 0.5px;
            padding: 11px 32px;
            border-radius: 50px;
            transition: all 0.25s;
            cursor: pointer;
            text-align: center;
        }

        .btn-history-pill:hover {
            background-color: var(--accent-orange);
            color: white;
            box-shadow: 0 4px 15px rgba(255, 123, 37, 0.3);
        }

        .history-card-item {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 16px;
            margin-bottom: 10px;
            position: relative;
        }

        .history-card-item .btn-remove-item {
            position: absolute;
            top: 10px;
            right: 12px;
            color: #ef4444;
            background: none;
            border: none;
            font-size: 0.85rem;
            cursor: pointer;
        }

        /* Upload Cards */
        .upload-card-box {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px 18px;
            text-align: center;
            background-color: #fafbfc;
            cursor: pointer;
            transition: all 0.25s;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .upload-card-box:hover {
            border-color: var(--accent-orange);
            background-color: #fff9f5;
        }

        .upload-card-icon {
            font-size: 2.5rem;
            color: #94a3b8;
            margin-bottom: 12px;
        }

        .upload-card-box:hover .upload-card-icon {
            color: var(--accent-orange);
        }

        .upload-link-text {
            color: var(--accent-orange);
            font-weight: 700;
            font-size: 0.92rem;
            text-decoration: underline;
            margin-top: 6px;
        }

        /* E-Signature & Privacy */
        .privacy-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 14px 18px;
            font-size: 0.86rem;
            color: var(--text-muted);
            margin: 14px 0;
            line-height: 1.6;
        }

        .btn-show-more {
            color: var(--accent-orange);
            cursor: pointer;
            font-weight: 600;
            font-size: 0.85rem;
            background: none;
            border: none;
            padding: 0;
        }

        /* Action Buttons & Mobile Optimization */
        .step-footer-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #edf2f7;
        }

        .btn-nav-prev {
            background: transparent;
            border: 1.5px solid #cbd5e1;
            color: #475569;
            padding: 12px 24px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.92rem;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-nav-prev:hover {
            background: #f1f5f9;
            color: var(--text-dark);
        }

        .btn-nav-next {
            background-color: var(--primary-blue);
            border: none;
            color: white;
            padding: 12px 30px;
            font-weight: 700;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.92rem;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-nav-next:hover {
            background-color: #1a4959;
            box-shadow: 0 4px 12px rgba(38, 96, 117, 0.25);
            color: white;
        }

        .btn-nav-submit {
            background-color: var(--accent-orange);
            border: none;
            color: white;
            padding: 12px 36px;
            font-weight: 700;
            border-radius: 8px;
            letter-spacing: 0.5px;
            transition: all 0.2s;
            font-size: 0.98rem;
            min-height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-nav-submit:hover {
            background-color: var(--accent-orange-hover);
            box-shadow: 0 6px 18px rgba(255, 123, 37, 0.35);
            color: white;
        }

        /* Success screen */
        .success-screen {
            text-align: center;
            padding: 50px 20px;
        }

        .success-screen i {
            font-size: 4rem;
            color: #10b981;
            margin-bottom: 18px;
        }

        /* RESPONSIVE MOBILE STYLING (< 576px) */
        @media (max-width: 576px) {
            .portal-header {
                padding: 10px 0;
            }
            .header-logo-img {
                height: 28px;
            }
            .header-btn {
                font-size: 0.75rem;
                padding: 4px 8px;
            }

            .job-title-bar {
                padding: 10px 0;
            }
            .back-nav-link {
                font-size: 0.92rem;
            }

            .stepper-sticky-wrapper {
                top: 50px;
                padding: 10px 0 8px;
            }

            .portal-card {
                padding: 20px 16px;
                border-radius: 10px;
                margin-top: 15px !important;
                margin-bottom: 20px;
            }

            .section-headline {
                font-size: 1.15rem;
            }
            .section-subtext {
                font-size: 0.85rem;
                margin-bottom: 16px;
            }

            .history-btn-row {
                flex-direction: column;
                gap: 10px;
            }
            .btn-history-pill {
                width: 100%;
                padding: 10px;
            }

            .step-footer-actions {
                gap: 10px;
                margin-top: 25px;
                padding-top: 16px;
            }
            .btn-nav-prev {
                flex: 0 0 35%;
                padding: 10px 12px;
                font-size: 0.88rem;
            }
            .btn-nav-next, .btn-nav-submit {
                flex: 1;
                padding: 10px 16px;
                font-size: 0.88rem;
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

    <!-- Portal Header (Sticky) -->
    <header class="portal-header">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="index.php">
                <img src="images/peatechlogo.webp" alt="Peatech Services" class="header-logo-img">
            </a>
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo htmlspecialchars($job_url); ?>" class="btn btn-outline-secondary header-btn">Job Overview</a>
                <a href="careers.php" class="btn btn-outline-primary header-btn" style="color: var(--primary-blue); border-color: var(--primary-blue);">All Positions</a>
            </div>
        </div>
    </header>

    <!-- Job Title Bar -->
    <div class="job-title-bar">
        <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="<?php echo htmlspecialchars($job_url); ?>" class="back-nav-link">
                    <i class="fas fa-chevron-left" style="font-size: 0.85rem;"></i>
                    <span><?php echo htmlspecialchars($job_title); ?></span>
                </a>

                <!-- Popover info button -->
                <div class="dropdown d-inline-block">
                    <button class="job-info-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Job Information">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end job-details-dropdown-card">
                        <?php if ($job_location !== ''): ?><div><strong>Location:</strong> <?php echo htmlspecialchars($job_location); ?></div><?php endif; ?>
                        <div><strong>Job Identification:</strong> <?php echo htmlspecialchars($job_id); ?></div>
                        <div><strong>Job Category:</strong> <?php echo htmlspecialchars($job_category); ?></div>
                        <div><strong>Posting Date:</strong> <?php echo htmlspecialchars($posting_date); ?></div>
                        <div><strong>Job Function:</strong> <?php echo htmlspecialchars($job_function); ?></div>
                    </div>
                </div>
            </div>

            <div class="text-muted small d-none d-sm-block">
                <i class="fas fa-lock text-primary me-1"></i> Secure Candidate Portal
            </div>
        </div>
    </div>

    <!-- STICKY PROGRESS STEPPER (Pinned at Top while Scrolling) -->
    <div class="stepper-sticky-wrapper" id="stepperWrapper">
        <div class="container" style="max-width: 860px;">
            <div class="stepper-bar">
                <div class="stepper-line-bg"></div>
                <div class="stepper-line-fill" id="stepperLine"></div>

                <div class="step-item active" id="dotStep1" onclick="navigateToStep(1)">
                    <div class="step-dot">1</div>
                    <div class="step-name d-none d-sm-block">Role & Contact</div>
                </div>
                <div class="step-item" id="dotStep2" onclick="navigateToStep(2)">
                    <div class="step-dot">2</div>
                    <div class="step-name d-none d-sm-block">Questionnaire</div>
                </div>
                <div class="step-item" id="dotStep3" onclick="navigateToStep(3)">
                    <div class="step-dot">3</div>
                    <div class="step-name d-none d-sm-block">History</div>
                </div>
                <div class="step-item" id="dotStep4" onclick="navigateToStep(4)">
                    <div class="step-dot">4</div>
                    <div class="step-name d-none d-sm-block">Documents</div>
                </div>
                <div class="step-item" id="dotStep5" onclick="navigateToStep(5)">
                    <div class="step-dot">5</div>
                    <div class="step-name d-none d-sm-block">E-Signature</div>
                </div>
            </div>

            <!-- Mobile Step Indicator: Prevents text overlapping on mobile screens -->
            <div class="mobile-step-indicator d-block d-sm-none text-center mt-2">
                <span class="mobile-step-badge" id="mobileStepText">Step 1 of 5: Role & Contact</span>
            </div>
        </div>
    </div>

    <!-- Main Application Canvas -->
    <main class="container my-3" style="max-width: 860px;">

        <?php if ($submit_success): ?>
            <!-- Success Confirmation -->
            <div class="portal-card success-screen">
                <i class="fas fa-check-circle"></i>
                <h2 style="font-weight: 700; color: var(--primary-dark); margin-bottom: 12px;">Application Submitted Successfully</h2>
                <p class="text-muted" style="font-size: 1.05rem; max-width: 580px; margin: 0 auto 30px; line-height: 1.6;">
                    Thank you, <strong><?php echo htmlspecialchars($firstName . ' ' . $lastName); ?></strong>. Your application for <strong><?php echo htmlspecialchars($appliedRole); ?></strong> has been securely transmitted to the Peatech recruitment team.
                </p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="<?php echo htmlspecialchars($job_url); ?>" class="btn btn-outline-secondary px-4 py-2">Back to Job Posting</a>
                    <a href="careers.php" class="btn btn-primary px-4 py-2" style="background-color: var(--primary-blue); border: none;">View All Careers</a>
                </div>
            </div>
        <?php else: ?>

            <?php if (!empty($submit_error)): ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> <?php echo htmlspecialchars($submit_error); ?>
                </div>
            <?php endif; ?>

            <!-- Form Card -->
            <div class="portal-card">
                <form id="candidateApplicationForm" method="POST" enctype="multipart/form-data" novalidate>

                    <!-- Hidden JSON inputs for experience & education -->
                    <input type="hidden" name="experience_data" id="experience_data_input" value="[]">
                    <input type="hidden" name="education_data" id="education_data_input" value="[]">

                    <!-- STEP 1: Role & Personal Details -->
                    <div class="step-pane" id="stepPane1">
                        <h2 class="section-headline">Candidate Information</h2>
                        <p class="section-subtext">Confirm the role you are applying for and enter your primary contact information.</p>

                        <div class="mb-3">
                            <label for="appliedRole" class="form-label required-star">Role You Are Applying For</label>
                            <select class="form-select" id="appliedRole" name="appliedRole" required>
                                <option value="" disabled <?php echo empty($appliedRole) ? 'selected' : ''; ?>>-- Select Coordinator Role --</option>
                                <?php foreach ($available_roles as $roleKey => $roleLabel): ?>
                                    <option value="<?php echo htmlspecialchars($roleKey); ?>" <?php echo ($appliedRole === $roleKey) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($roleLabel); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" id="roleFeedback">Please select the role you are applying for.</div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label required-star">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>" placeholder="First name" required>
                                <div class="invalid-feedback">First name is required.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label required-star">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>" placeholder="Last name" required>
                                <div class="invalid-feedback">Last name is required.</div>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="email" class="form-label required-star">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="name@example.com" required>
                                <div class="invalid-feedback">A valid email address is required.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="phone" class="form-label required-star">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" placeholder="+1 (555) 000-0000" required>
                                <div class="invalid-feedback">Phone number is required.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Street Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" placeholder="e.g. 5247 Wilson Mills Rd">
                        </div>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" value="<?php echo htmlspecialchars($city); ?>">
                            </div>
                            <div class="col-sm-3 col-6">
                                <label for="state" class="form-label">State</label>
                                <input type="text" class="form-control" id="state" name="state" value="<?php echo htmlspecialchars($state); ?>">
                            </div>
                            <div class="col-sm-3 col-6">
                                <label for="zipCode" class="form-label">Postal / ZIP</label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" value="<?php echo htmlspecialchars($zipCode); ?>">
                            </div>
                        </div>

                        <div class="step-footer-actions">
                            <div></div>
                            <button type="button" class="btn-nav-next" onclick="validateStep1AndProceed()">
                                Next: Questionnaire <i class="fas fa-chevron-right ms-2"></i>
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: Pre-Screening Questionnaire (Matches Screenshot 1) -->
                    <div class="step-pane d-none" id="stepPane2">
                        <h2 class="section-headline">Pre-Screening Questionnaire</h2>
                        <p class="section-subtext">Please review and answer the screening questions below.</p>

                        <?php foreach ($screening_fields as $field => $label): ?>
                        <div class="question-block">
                            <label for="<?php echo htmlspecialchars($field); ?>" class="question-label required-star"><?php echo htmlspecialchars($label); ?></label>
                            <textarea class="form-control" id="<?php echo htmlspecialchars($field); ?>" name="<?php echo htmlspecialchars($field); ?>" rows="3" required><?php echo htmlspecialchars($screening_answers[$field]); ?></textarea>
                            <div class="invalid-feedback">Please complete this field.</div>
                        </div>
                        <?php endforeach; ?>

                        <!-- Q1 -->
                        <div class="question-block">
                            <label class="question-label required-star"><?php echo htmlspecialchars($attendance_question); ?></label>
                            <input type="hidden" name="q_office_days" id="q_office_days" value="<?php echo htmlspecialchars($q_office_days); ?>">
                            <div class="pill-toggle-group" data-target="q_office_days">
                                <button type="button" class="pill-btn <?php echo ($q_office_days === 'Yes') ? 'active' : ''; ?>" data-val="Yes">Yes</button>
                                <button type="button" class="pill-btn <?php echo ($q_office_days === 'No') ? 'active' : ''; ?>" data-val="No">No</button>
                            </div>
                        </div>

                        <!-- Q2 -->
                        <div class="question-block">
                            <label class="question-label required-star">Have you ever worked as an employee for Peatech, or any other Peatech Legal Entity?</label>
                            <input type="hidden" name="q_past_employee" id="q_past_employee" value="<?php echo htmlspecialchars($q_past_employee); ?>">
                            <div class="pill-toggle-group" data-target="q_past_employee">
                                <button type="button" class="pill-btn <?php echo ($q_past_employee === 'No') ? 'active' : ''; ?>" data-val="No">No</button>
                                <button type="button" class="pill-btn <?php echo ($q_past_employee === 'Yes') ? 'active' : ''; ?>" data-val="Yes">Yes</button>
                            </div>
                        </div>

                        <!-- Q3 -->
                        <div class="question-block">
                            <label class="question-label required-star">Have you ever worked as a contractor for Peatech (currently or previously)?</label>
                            <input type="hidden" name="q_past_contractor" id="q_past_contractor" value="<?php echo htmlspecialchars($q_past_contractor); ?>">
                            <div class="pill-toggle-group" data-target="q_past_contractor">
                                <button type="button" class="pill-btn <?php echo ($q_past_contractor === 'No') ? 'active' : ''; ?>" data-val="No">No</button>
                                <button type="button" class="pill-btn <?php echo ($q_past_contractor === 'Yes') ? 'active' : ''; ?>" data-val="Yes">Yes</button>
                            </div>
                        </div>

                        <!-- Q4 -->
                        <div class="question-block">
                            <label class="question-label required-star">Will you now or in the future require Peatech to help you obtain an employment visa?</label>
                            <input type="hidden" name="q_visa_sponsorship" id="q_visa_sponsorship" value="<?php echo htmlspecialchars($q_visa_sponsorship); ?>">
                            <div class="pill-toggle-group" data-target="q_visa_sponsorship">
                                <button type="button" class="pill-btn <?php echo ($q_visa_sponsorship === 'No') ? 'active' : ''; ?>" data-val="No">No</button>
                                <button type="button" class="pill-btn <?php echo ($q_visa_sponsorship === 'Yes') ? 'active' : ''; ?>" data-val="Yes">Yes</button>
                            </div>
                        </div>

                        <!-- Q5 -->
                        <div class="question-block">
                            <label class="question-label required-star">Are you a current Peatech employee?</label>
                            <input type="hidden" name="q_current_employee" id="q_current_employee" value="<?php echo htmlspecialchars($q_current_employee); ?>">
                            <div class="pill-toggle-group" data-target="q_current_employee">
                                <button type="button" class="pill-btn <?php echo ($q_current_employee === 'No') ? 'active' : ''; ?>" data-val="No">No</button>
                                <button type="button" class="pill-btn <?php echo ($q_current_employee === 'Yes') ? 'active' : ''; ?>" data-val="Yes">Yes</button>
                            </div>
                        </div>

                        <div class="step-footer-actions">
                            <button type="button" class="btn-nav-prev" onclick="navigateToStep(1)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="button" class="btn-nav-next" onclick="navigateToStep(3)">Next: History <i class="fas fa-chevron-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- STEP 3: Work & Education History (Matches Screenshot 2) -->
                    <div class="step-pane d-none" id="stepPane3">
                        <h2 class="section-headline">Work and Education History</h2>
                        <p class="section-subtext">Please enter details about your work experience and education.</p>

                        <!-- Add Experience / Add Education Buttons -->
                        <div class="history-btn-row">
                            <button type="button" class="btn-history-pill" onclick="openModal('experienceModal')">ADD EXPERIENCE</button>
                            <button type="button" class="btn-history-pill" onclick="openModal('educationModal')">ADD EDUCATION</button>
                        </div>

                        <!-- Timeline & Dynamic Entry Lists -->
                        <div class="row g-4 mt-2">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2"><i class="fas fa-briefcase text-primary me-2"></i> Work Experience</h6>
                                <div id="experienceListContainer" class="mt-2">
                                    <p class="text-muted small" id="noExpText">No work experience added yet. Click <strong>ADD EXPERIENCE</strong> above to add.</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-dark border-bottom pb-2"><i class="fas fa-graduation-cap text-primary me-2"></i> Education</h6>
                                <div id="educationListContainer" class="mt-2">
                                    <p class="text-muted small" id="noEduText">No education added yet. Click <strong>ADD EDUCATION</strong> above to add.</p>
                                </div>
                            </div>
                        </div>

                        <div class="step-footer-actions">
                            <button type="button" class="btn-nav-prev" onclick="navigateToStep(2)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="button" class="btn-nav-next" onclick="navigateToStep(4)">Next: Documents <i class="fas fa-chevron-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- STEP 4: Supporting Documents & URLs (Both Links Now Optional as Requested) -->
                    <div class="step-pane d-none" id="stepPane4">
                        <h2 class="section-headline">Supporting Documents and URLs</h2>
                        <p class="section-subtext">Please add any additional documents or URLs.</p>

                        <div class="row g-3 mb-4">
                            <!-- Resume Upload Dropzone -->
                            <div class="col-md-6">
                                <div class="upload-card-box" id="resumeBox" onclick="document.getElementById('resumeInput').click();">
                                    <i class="fas fa-cloud-upload-alt upload-card-icon"></i>
                                    <div class="fw-semibold text-dark" id="resumeTitleDisplay">Drop Resume Here <span class="text-danger">*</span></div>
                                    <div class="text-muted small my-1">or</div>
                                    <div class="upload-link-text">Upload Resume</div>
                                    <div class="text-muted small mt-2" style="font-size:0.75rem;">PDF, DOC, DOCX (Max 5MB)</div>
                                    <input type="file" id="resumeInput" name="resume" class="d-none" accept=".pdf,.doc,.docx" required>
                                </div>
                                <div class="text-danger small mt-2 text-center" id="resumeErrFeedback" style="display:none;">Please attach your resume file.</div>
                            </div>

                            <!-- Cover Letter Upload Dropzone -->
                            <div class="col-md-6">
                                <div class="upload-card-box" id="coverBox" onclick="document.getElementById('coverInput').click();">
                                    <i class="fas fa-cloud-upload-alt upload-card-icon"></i>
                                    <div class="fw-semibold text-dark" id="coverTitleDisplay">Drop Cover Letter Here</div>
                                    <div class="text-muted small my-1">or</div>
                                    <div class="upload-link-text">Upload Cover Letter</div>
                                    <div class="text-muted small mt-2" style="font-size:0.75rem;">PDF, DOC, DOCX (Max 5MB)</div>
                                    <input type="file" id="coverInput" name="coverLetterFile" class="d-none" accept=".pdf,.doc,.docx">
                                </div>
                            </div>
                        </div>

                        <!-- BOTH LINKS NOW EXPLICITLY OPTIONAL (FOR IMAGE 1) -->
                        <div class="mb-3">
                            <label for="link1" class="form-label">Link 1 <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="text" class="form-control" id="link1" name="link1" value="<?php echo htmlspecialchars($link1); ?>" placeholder="e.g. LinkedIn Profile URL or Portfolio">
                        </div>

                        <div class="mb-3">
                            <label for="link2" class="form-label">Link 2 <span class="text-muted fw-normal">(Optional)</span></label>
                            <input type="text" class="form-control" id="link2" name="link2" value="<?php echo htmlspecialchars($link2); ?>" placeholder="e.g. Personal Website / GitHub / Additional Reference">
                        </div>

                        <div class="step-footer-actions">
                            <button type="button" class="btn-nav-prev" onclick="navigateToStep(3)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="button" class="btn-nav-next" onclick="validateStep4AndProceed()">Next: Sign-off <i class="fas fa-chevron-right ms-1"></i></button>
                        </div>
                    </div>

                    <!-- STEP 5: E-Signature & Review (Matches Screenshot 4) -->
                    <div class="step-pane d-none" id="stepPane5">
                        <h2 class="section-headline">Review & E-Signature</h2>
                        <p class="section-subtext">Please review your submission details and electronically sign to submit.</p>

                        <!-- Candidate Overview Card -->
                        <div class="p-3 mb-3 rounded-3 border" style="background-color: #f8fafc;">
                            <div class="row g-2 small">
                                <div class="col-sm-6"><strong>Position:</strong> <?php echo htmlspecialchars($job_title); ?></div>
                                <div class="col-sm-6"><strong>Target Role:</strong> <span class="text-primary fw-bold" id="revTargetRole">&mdash;</span></div>
                                <div class="col-sm-6"><strong>Applicant:</strong> <span id="revApplicantName">&mdash;</span></div>
                                <div class="col-sm-6"><strong>Contact:</strong> <span id="revApplicantContact">&mdash;</span></div>
                                <div class="col-sm-6"><strong>Resume Attached:</strong> <span class="text-success fw-bold" id="revResumeName">&mdash;</span></div>
                                <div class="col-sm-6"><strong>Attendance Availability:</strong> <span id="revOfficeDays">&mdash;</span></div>
                            </div>
                            <?php foreach ($screening_fields as $field => $label): ?>
                            <div class="small mt-2">
                                <strong><?php echo htmlspecialchars($label); ?>:</strong>
                                <div data-review-field="<?php echo htmlspecialchars($field); ?>" style="white-space: pre-wrap; overflow-wrap: anywhere;"></div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Updates Checkbox -->
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="updates_optin" name="updates_optin" value="1">
                            <label class="form-check-label text-dark small" for="updates_optin">
                                I agree to receive updates about new job opportunities.
                            </label>
                        </div>

                        <!-- E-Signature Section -->
                        <div class="mt-3">
                            <h5 class="fw-bold text-dark mb-1">E-Signature</h5>
                            <div class="small fw-semibold text-muted">Privacy Notice</div>

                            <div class="privacy-box" id="privacyNoticeBox">
                                <p class="mb-1">
                                    Peatech Services respects your privacy and is committed to protecting your personal data. We collect, store, and process your applicant information solely for the purposes of recruitment, candidate assessment, communication, and legal compliance.
                                </p>
                                <div id="morePrivacyText" style="display: none;" class="mt-2 pt-2 border-top">
                                    Your information will be handled confidentially and only accessed by authorized personnel and hiring managers. By providing your electronic signature below, you confirm that all statements made in this application are true, accurate, and complete. Any intentional misrepresentation or omission may result in disqualification or termination of employment.
                                </div>
                                <button type="button" class="btn-show-more mt-1" id="togglePrivacyBtn" onclick="togglePrivacyNotice()">
                                    <i class="fas fa-caret-down me-1"></i> Show More
                                </button>
                            </div>

                            <div class="mt-3 mb-2">
                                <label for="esignature" class="form-label required-star">Full Name</label>
                                <input type="text" class="form-control" id="esignature" name="esignature" value="<?php echo htmlspecialchars($esignature); ?>" placeholder="Type your legal full name" required>
                                <div class="invalid-feedback">Full name e-signature is required.</div>
                            </div>
                        </div>

                        <div class="step-footer-actions">
                            <button type="button" class="btn-nav-prev" onclick="navigateToStep(4)"><i class="fas fa-chevron-left me-1"></i> Back</button>
                            <button type="submit" class="btn-nav-submit" id="submitBtn">
                                SUBMIT
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        <?php endif; ?>
    </main>

    <!-- Modal: Add Experience -->
    <div class="modal fade" id="experienceModal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="experienceModalLabel">Add Work Experience</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required-star">Job Title</label>
                        <input type="text" class="form-control" id="m_exp_title" placeholder="e.g. Job title or project role">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-star">Company / Organization</label>
                        <input type="text" class="form-control" id="m_exp_company" placeholder="e.g. Acme Corp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Period / Dates</label>
                        <input type="text" class="form-control" id="m_exp_period" placeholder="e.g. Jan 2023 - Present">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Key Responsibilities / Summary</label>
                        <textarea class="form-control" id="m_exp_summary" rows="3" placeholder="Brief summary of duties and milestones..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" style="background-color: var(--primary-blue);" onclick="saveExperienceEntry()">Save Experience</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add Education -->
    <div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="educationModalLabel">Add Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required-star">Degree / Program</label>
                        <input type="text" class="form-control" id="m_edu_degree" placeholder="e.g. Bachelor of Science in Business Administration">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-star">School / University</label>
                        <input type="text" class="form-control" id="m_edu_school" placeholder="e.g. Ohio State University">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Graduation Year</label>
                        <input type="text" class="form-control" id="m_edu_year" placeholder="e.g. 2024">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" style="background-color: var(--primary-blue);" onclick="saveEducationEntry()">Save Education</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-muted small py-4 border-top bg-white">
        <div class="container">
            <div class="mb-2">
                <a href="https://www.facebook.com/share/1DqeqTDb7V/" class="mx-2 text-secondary" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                <!--<a href="https://twitter.com/peatech" class="mx-2 text-secondary"><i class="fab fa-twitter"></i></a>-->
                <a href="https://www.instagram.com/peatechsmartservices?stkn=MW5rN2RxbmZrd2Y0ZA==" class="mx-2 text-secondary" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/peatech-smart-services/" class="mx-2 text-secondary" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
            </div>
            © 2026 Peatech Services. All rights reserved. | The Connection Company
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let currentStep = 1;
        const totalSteps = 5;

        const stepNames = [
            "Step 1 of 5: Role & Contact",
            "Step 2 of 5: Questionnaire",
            "Step 3 of 5: History",
            "Step 4 of 5: Documents",
            "Step 5 of 5: E-Signature"
        ];

        // Data arrays for Experience & Education
        let experienceList = <?php echo json_encode($experience_entries, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
        let educationList = <?php echo json_encode($education_entries, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

        // Dynamic input invalidation clearing
        ['appliedRole', 'firstName', 'lastName', 'email', 'phone', 'esignature'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('input', () => el.classList.remove('is-invalid'));
                el.addEventListener('change', () => el.classList.remove('is-invalid'));
            }
        });

        // Pill button toggle interaction (Yes / No)
        document.querySelectorAll('.pill-toggle-group').forEach(group => {
            const targetInputId = group.getAttribute('data-target');
            const targetInput = document.getElementById(targetInputId);
            const buttons = group.querySelectorAll('.pill-btn');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    buttons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    if (targetInput) {
                        targetInput.value = btn.getAttribute('data-val');
                    }
                });
            });
        });

        // Resume & Cover Letter Upload Display
        const resumeInput = document.getElementById('resumeInput');
        const resumeTitleDisplay = document.getElementById('resumeTitleDisplay');
        const resumeErrFeedback = document.getElementById('resumeErrFeedback');

        if (resumeInput) {
            resumeInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    resumeTitleDisplay.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i> ' + file.name + '</span>';
                    if (resumeErrFeedback) resumeErrFeedback.style.display = 'none';
                }
            });
        }

        const coverInput = document.getElementById('coverInput');
        const coverTitleDisplay = document.getElementById('coverTitleDisplay');
        if (coverInput) {
            coverInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (file) {
                    coverTitleDisplay.innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-1"></i> ' + file.name + '</span>';
                }
            });
        }

        // Stepper Navigation
        function navigateToStep(step) {
            if (step > currentStep) {
                if (!validateStep1()) { navigateToStep(1); return; }
                if (step > 2 && !validateScreening()) { navigateToStep(2); return; }
                if (step > 4 && !validateStep4()) { navigateToStep(4); return; }
            }

            for (let i = 1; i <= totalSteps; i++) {
                const pane = document.getElementById('stepPane' + i);
                if (pane) pane.classList.add('d-none');
            }

            const currentPane = document.getElementById('stepPane' + step);
            if (currentPane) currentPane.classList.remove('d-none');

            currentStep = step;
            updateStepperVisuals();

            if (step === 5) {
                populateReviewDetails();
            }

            // Scroll to just below the sticky stepper
            const stepperElem = document.getElementById('stepperWrapper');
            if (stepperElem) {
                window.scrollTo({ top: stepperElem.offsetTop - 10, behavior: 'smooth' });
            }
        }

        function validateScreening() {
            let valid = true;
            document.querySelectorAll('#stepPane2 textarea[required]').forEach(el => {
                const complete = el.value.trim() !== '';
                el.classList.toggle('is-invalid', !complete);
                if (!complete) valid = false;
            });
            return valid;
        }

        function validateStep1() {
            const role = document.getElementById('appliedRole');
            const fName = document.getElementById('firstName');
            const lName = document.getElementById('lastName');
            const email = document.getElementById('email');
            const phone = document.getElementById('phone');

            let valid = true;
            [role, fName, lName, email, phone].forEach(el => {
                if (!el.checkValidity() || (el === role && !el.value)) {
                    el.classList.add('is-invalid');
                    valid = false;
                } else {
                    el.classList.remove('is-invalid');
                }
            });
            return valid;
        }

        function validateStep1AndProceed() {
            if (validateStep1()) {
                navigateToStep(2);
            }
        }

        function validateStep4() {
            const file = resumeInput.files && resumeInput.files[0];
            if (!file || !/\.(pdf|doc|docx)$/i.test(file.name) || file.size > 5 * 1024 * 1024) {
                if (resumeErrFeedback) {
                    resumeErrFeedback.textContent = 'Please attach a PDF, DOC, or DOCX resume of up to 5MB.';
                    resumeErrFeedback.style.display = 'block';
                }
                return false;
            }
            if (resumeErrFeedback) resumeErrFeedback.style.display = 'none';
            return true;
        }

        function validateStep4AndProceed() {
            if (validateStep4()) {
                navigateToStep(5);
            }
        }

        function updateStepperVisuals() {
            for (let i = 1; i <= totalSteps; i++) {
                const dot = document.getElementById('dotStep' + i);
                if (!dot) continue;
                dot.classList.remove('active', 'completed');

                if (i < currentStep) {
                    dot.classList.add('completed');
                    dot.querySelector('.step-dot').innerHTML = '<i class="fas fa-check"></i>';
                } else if (i === currentStep) {
                    dot.classList.add('active');
                    dot.querySelector('.step-dot').innerHTML = i;
                } else {
                    dot.querySelector('.step-dot').innerHTML = i;
                }
            }

            const fillPct = ((currentStep - 1) / (totalSteps - 1)) * 100;
            const line = document.getElementById('stepperLine');
            if (line) line.style.width = fillPct + '%';

            // Update mobile step indicator badge
            const mobileText = document.getElementById('mobileStepText');
            if (mobileText && stepNames[currentStep - 1]) {
                mobileText.textContent = stepNames[currentStep - 1];
            }
        }

        // Populate step 5 review summary
        function populateReviewDetails() {
            const roleSelect = document.getElementById('appliedRole');
            const roleText = roleSelect.options[roleSelect.selectedIndex]?.text || 'Not selected';
            const fName = document.getElementById('firstName').value.trim();
            const lName = document.getElementById('lastName').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const qOffice = document.getElementById('q_office_days').value;
            const resumeFile = resumeInput.files[0] ? resumeInput.files[0].name : 'None';

            document.getElementById('revTargetRole').textContent = roleText;
            document.getElementById('revApplicantName').textContent = (fName + ' ' + lName) || 'None';
            document.getElementById('revApplicantContact').textContent = (email + ' | ' + phone) || 'None';
            document.getElementById('revResumeName').textContent = resumeFile;
            document.getElementById('revOfficeDays').textContent = qOffice;
            document.querySelectorAll('[data-review-field]').forEach(el => {
                el.textContent = document.getElementById(el.dataset.reviewField).value.trim();
            });
        }

        // Privacy Notice Toggle
        function togglePrivacyNotice() {
            const moreText = document.getElementById('morePrivacyText');
            const btn = document.getElementById('togglePrivacyBtn');
            if (moreText.style.display === 'none') {
                moreText.style.display = 'block';
                btn.innerHTML = '<i class="fas fa-caret-up me-1"></i> Show Less';
            } else {
                moreText.style.display = 'none';
                btn.innerHTML = '<i class="fas fa-caret-down me-1"></i> Show More';
            }
        }

        // Modals management
        function openModal(modalId) {
            const m = new bootstrap.Modal(document.getElementById(modalId));
            m.show();
        }

        function saveExperienceEntry() {
            const title = document.getElementById('m_exp_title').value.trim();
            const company = document.getElementById('m_exp_company').value.trim();
            const period = document.getElementById('m_exp_period').value.trim();
            const summary = document.getElementById('m_exp_summary').value.trim();

            if (!title || !company) {
                alert('Please enter both job title and company.');
                return;
            }

            experienceList.push({ title, company, period, summary });
            renderExperienceList();

            document.getElementById('m_exp_title').value = '';
            document.getElementById('m_exp_company').value = '';
            document.getElementById('m_exp_period').value = '';
            document.getElementById('m_exp_summary').value = '';

            bootstrap.Modal.getInstance(document.getElementById('experienceModal')).hide();
        }

        function renderExperienceList() {
            const container = document.getElementById('experienceListContainer');
            const hiddenInput = document.getElementById('experience_data_input');
            hiddenInput.value = JSON.stringify(experienceList);

            if (experienceList.length === 0) {
                container.innerHTML = '<p class="text-muted small" id="noExpText">No work experience added yet. Click <strong>ADD EXPERIENCE</strong> above to add.</p>';
                return;
            }

            container.innerHTML = '';
            experienceList.forEach((item, idx) => {
                const card = document.createElement('div');
                card.className = 'history-card-item';
                card.innerHTML = `
                    <button type="button" class="btn-remove-item" onclick="removeExperienceEntry(${idx})"><i class="fas fa-trash-alt"></i></button>
                    <div class="fw-bold text-dark">${item.title}</div>
                    <div class="text-muted small">${item.company} ${item.period ? '• ' + item.period : ''}</div>
                    ${item.summary ? '<div class="small mt-1 text-secondary">' + item.summary + '</div>' : ''}
                `;
                container.appendChild(card);
            });
        }

        function removeExperienceEntry(idx) {
            experienceList.splice(idx, 1);
            renderExperienceList();
        }

        function saveEducationEntry() {
            const degree = document.getElementById('m_edu_degree').value.trim();
            const school = document.getElementById('m_edu_school').value.trim();
            const year = document.getElementById('m_edu_year').value.trim();

            if (!degree || !school) {
                alert('Please enter both degree and school.');
                return;
            }

            educationList.push({ degree, school, year });
            renderEducationList();

            document.getElementById('m_edu_degree').value = '';
            document.getElementById('m_edu_school').value = '';
            document.getElementById('m_edu_year').value = '';

            bootstrap.Modal.getInstance(document.getElementById('educationModal')).hide();
        }

        function renderEducationList() {
            const container = document.getElementById('educationListContainer');
            const hiddenInput = document.getElementById('education_data_input');
            hiddenInput.value = JSON.stringify(educationList);

            if (educationList.length === 0) {
                container.innerHTML = '<p class="text-muted small" id="noEduText">No education added yet. Click <strong>ADD EDUCATION</strong> above to add.</p>';
                return;
            }

            container.innerHTML = '';
            educationList.forEach((item, idx) => {
                const card = document.createElement('div');
                card.className = 'history-card-item';
                card.innerHTML = `
                    <button type="button" class="btn-remove-item" onclick="removeEducationEntry(${idx})"><i class="fas fa-trash-alt"></i></button>
                    <div class="fw-bold text-dark">${item.degree}</div>
                    <div class="text-muted small">${item.school} ${item.year ? '• ' + item.year : ''}</div>
                `;
                container.appendChild(card);
            });
        }

        function removeEducationEntry(idx) {
            educationList.splice(idx, 1);
            renderEducationList();
        }

        renderExperienceList();
        renderEducationList();

        // Form submission validation
        document.getElementById('candidateApplicationForm').addEventListener('submit', function(e) {
            if (!validateStep1()) { e.preventDefault(); navigateToStep(1); return; }
            if (!validateScreening()) { e.preventDefault(); navigateToStep(2); return; }
            if (!validateStep4()) { e.preventDefault(); navigateToStep(4); return; }
            const esign = document.getElementById('esignature');
            if (!esign.value.trim()) {
                e.preventDefault();
                esign.classList.add('is-invalid');
                esign.focus();
                return false;
            }
        });
    </script>
</body>
</html>
