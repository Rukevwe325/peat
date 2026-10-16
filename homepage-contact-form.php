<?php if ($enquiry_sent): ?>
<div class="alert alert-success" role="status">
    <h4 class="alert-heading">Thank you for getting in touch.</h4>
    <p class="mb-0">Your message has been sent to our team. We’ll reply using the email address you provided.</p>
</div>
<?php else: ?>
<?php if ($enquiry_errors): ?>
<div class="alert alert-danger" role="alert"><p class="fw-semibold mb-2">Please check your message.</p><ul class="mb-0"><?php foreach ($enquiry_errors as $error): ?><li><?php echo $contact_escape($error); ?></li><?php endforeach; ?></ul></div>
<?php endif; ?>
<form action="/#contact" method="post" id="homepage-contact-form">
    <input type="hidden" name="enquiry_token" value="<?php echo $contact_escape($_SESSION['product_enquiry_token']); ?>">
    <div hidden aria-hidden="true"><label for="contact-website">Leave this field empty</label><input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off"></div>
    <div class="mb-3">
        <label for="name" class="form-label">Name <span aria-hidden="true">*</span></label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autocomplete="name" maxlength="120" value="<?php echo $contact_escape($enquiry_values['name']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email <span aria-hidden="true">*</span></label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter a valid email address" autocomplete="email" maxlength="254" value="<?php echo $contact_escape($enquiry_values['email']); ?>" required>
    </div>
    <div class="mb-3">
        <label for="message" class="form-label">Message <span aria-hidden="true">*</span></label>
        <textarea class="form-control" id="message" name="message" rows="4" maxlength="4000" placeholder="Tell us about your idea, project, or technical challenge." required><?php echo $contact_escape($enquiry_values['message']); ?></textarea>
    </div>
    <p class="small text-muted">All fields are required. We’ll use these details to respond to your message.</p>
    <button type="submit" class="btn btn-primary-custom w-100">Send Message</button>
</form>
<?php endif; ?>
