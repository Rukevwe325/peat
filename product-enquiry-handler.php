<?php
// Runs before page output. Product identity comes from the page, never from a submitted field.
if (!isset($product_slug, $product)) {
    http_response_code(404);
    exit;
}
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'cookie_samesite' => 'Lax'
    ]);
}
if (empty($_SESSION['product_enquiry_token'])) {
    $_SESSION['product_enquiry_token'] = bin2hex(random_bytes(32));
}
$enquiry_errors = [];
$enquiry_fields = ['name', 'email', 'organization', 'phone', 'interest', 'message'];
$enquiry_values = array_fill_keys($enquiry_fields, '');
$enquiry_interests = ['General enquiry', 'Request a demo', 'Access and availability', 'Partnership'];
$enquiry_sent = false;
$request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($request_method === 'GET') {
    $enquiry_sent = !empty($_SESSION['product_enquiry_success'][$product_slug]);
    unset($_SESSION['product_enquiry_success'][$product_slug]);
}
if ($request_method === 'POST') {
    foreach ($enquiry_fields as $field) {
        $enquiry_values[$field] = is_string($_POST[$field] ?? null) ? trim($_POST[$field]) : '';
    }
    if ($enquiry_values['interest'] === '' && isset($enquiry_default_interest)) {
        $enquiry_values['interest'] = $enquiry_default_interest;
    }
    $token = is_string($_POST['enquiry_token'] ?? null) ? $_POST['enquiry_token'] : '';
    if (!hash_equals($_SESSION['product_enquiry_token'], $token)) {
        $enquiry_errors[] = 'Your form session has expired. Please submit the form again.';
    }
    if (!empty($_POST['website'])) {
        $enquiry_errors[] = 'We could not submit this enquiry. Please try again.';
    }
    if ($enquiry_values['name'] === '' || strlen($enquiry_values['name']) > 120) {
        $enquiry_errors[] = 'Please enter your name (up to 120 characters).';
    }
    if (!filter_var($enquiry_values['email'], FILTER_VALIDATE_EMAIL)
        || preg_match('/[\r\n]/', $enquiry_values['email']) || strlen($enquiry_values['email']) > 254) {
        $enquiry_errors[] = 'Please enter a valid email address.';
    }
    if (!in_array($enquiry_values['interest'], $enquiry_interests, true)) {
        $enquiry_errors[] = 'Please choose what you would like to discuss.';
    }
    if ($enquiry_values['message'] === '' || strlen($enquiry_values['message']) > 4000) {
        $enquiry_errors[] = 'Please enter your message (up to 4,000 characters).';
    }
    if (strlen($enquiry_values['organization']) > 180 || strlen($enquiry_values['phone']) > 50) {
        $enquiry_errors[] = 'Please shorten your organization or phone details.';
    }
    if (!empty($_SESSION['product_enquiry_last_sent']) && time() - $_SESSION['product_enquiry_last_sent'] < 60) {
        $enquiry_errors[] = 'Your recent enquiry has been sent. Please wait a minute before sending another.';
    }
    if (!$enquiry_errors) {
        $to = 'info@peatechservice.com, peatechservices89@gmail.com';
        $subject = $enquiry_email_subject ?? ('New ' . $product['name'] . ' product enquiry');
        $body = ($enquiry_context_label ?? 'Product') . ': ' . $product['name'] . "\n"
            . "Enquiry: " . $enquiry_values['interest'] . "\n\n"
            . "Name: " . $enquiry_values['name'] . "\n"
            . "Email: " . $enquiry_values['email'] . "\n"
            . "Organization: " . ($enquiry_values['organization'] ?: 'Not provided') . "\n"
            . "Phone: " . ($enquiry_values['phone'] ?: 'Not provided') . "\n\n"
            . "Message:\n" . $enquiry_values['message'] . "\n";
        $headers = "From: Peatech Products <info@peatechservice.com>\r\n"
            . 'Reply-To: ' . $enquiry_values['email'] . "\r\n"
            . "MIME-Version: 1.0\r\n"
            . "Content-Type: text/plain; charset=UTF-8\r\n";
        if (function_exists('mail') && @mail($to, $subject, $body, $headers)) {
            $_SESSION['product_enquiry_success'][$product_slug] = true;
            $_SESSION['product_enquiry_last_sent'] = time();
            $_SESSION['product_enquiry_token'] = bin2hex(random_bytes(32));
            header('Location: ' . ($enquiry_redirect_url ?? ('/' . $product_slug . '?enquiry=sent#enquiry')), true, 303);
            exit;
        }
        $enquiry_errors[] = 'Your enquiry could not be sent right now. Please try again shortly.';
    }
    if ($enquiry_errors) {
        http_response_code(422);
    }
}
