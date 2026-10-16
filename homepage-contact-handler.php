<?php
$product_slug = 'homepage';
$product = ['name' => 'Peatech Services homepage'];
$enquiry_default_interest = 'General enquiry';
$enquiry_email_subject = 'New Peatech website contact enquiry';
$enquiry_context_label = 'Source';
$enquiry_redirect_url = '/?contact=sent#contact';
require __DIR__ . '/product-enquiry-handler.php';
$contact_escape = static function ($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); };
