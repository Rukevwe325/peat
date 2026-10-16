<section id="enquiry" class="pp-section pp-enquiry" aria-labelledby="enquiry-heading">
    <div class="pp-container pp-enquiry-grid">
        <div>
            <p class="pp-eyebrow">Start a conversation</p>
            <h2 id="enquiry-heading">Let’s talk about<br><?php echo $escape($product['name']); ?>.</h2>
            <p class="pp-enquiry-intro">Tell us what you have in mind. Whether you have a question, want a demo, or are exploring a partnership, our team would like to hear from you.</p>
            <div class="pp-enquiry-product"><span class="pp-mark" aria-hidden="true"><?php echo $escape($product['mark']); ?></span><div><strong><?php echo $escape($product['name']); ?></strong><span><?php echo $escape($product['category']); ?></span></div></div>
        </div>
        <div class="pp-enquiry-card">
            <?php if ($enquiry_sent): ?>
            <div class="pp-form-success" role="status" tabindex="-1">
                <span class="pp-success-mark" aria-hidden="true">✓</span>
                <h3>Thank you for getting in touch.</h3>
                <p>Your <?php echo $escape($product['name']); ?> enquiry has been sent to our team. We’ll reply using the email address you provided.</p>
            </div>
            <?php else: ?>
            <?php if ($enquiry_errors): ?>
            <div class="pp-form-errors" role="alert" tabindex="-1"><h3>Please check your enquiry.</h3><ul><?php foreach ($enquiry_errors as $error): ?><li><?php echo $escape($error); ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <form class="pp-enquiry-form" action="/<?php echo $escape($product_slug); ?>#enquiry" method="post">
                <input type="hidden" name="enquiry_token" value="<?php echo $escape($_SESSION['product_enquiry_token']); ?>">
                <div class="pp-form-trap" aria-hidden="true"><label for="enquiry-website">Leave this field empty</label><input type="text" id="enquiry-website" name="website" tabindex="-1" autocomplete="off"></div>
                <p class="pp-form-required">Fields marked <span aria-hidden="true">*</span> are required.</p>
                <div class="pp-form-row">
                    <div><label for="enquiry-name">Your name <span aria-hidden="true">*</span></label><input id="enquiry-name" name="name" type="text" autocomplete="name" maxlength="120" value="<?php echo $escape($enquiry_values['name']); ?>" required></div>
                    <div><label for="enquiry-email">Email address <span aria-hidden="true">*</span></label><input id="enquiry-email" name="email" type="email" autocomplete="email" maxlength="254" value="<?php echo $escape($enquiry_values['email']); ?>" required></div>
                </div>
                <div class="pp-form-row">
                    <div><label for="enquiry-organization">Organization <span class="pp-optional">(optional)</span></label><input id="enquiry-organization" name="organization" type="text" autocomplete="organization" maxlength="180" value="<?php echo $escape($enquiry_values['organization']); ?>"></div>
                    <div><label for="enquiry-phone">Phone <span class="pp-optional">(optional)</span></label><input id="enquiry-phone" name="phone" type="tel" autocomplete="tel" maxlength="50" value="<?php echo $escape($enquiry_values['phone']); ?>"></div>
                </div>
                <div><label for="enquiry-interest">What would you like to discuss? <span aria-hidden="true">*</span></label><select id="enquiry-interest" name="interest" required><option value="">Choose an enquiry type</option><?php foreach ($enquiry_interests as $interest): ?><option value="<?php echo $escape($interest); ?>" <?php echo $enquiry_values['interest'] === $interest ? 'selected' : ''; ?>><?php echo $escape($interest); ?></option><?php endforeach; ?></select></div>
                <div><label for="enquiry-message">Your message <span aria-hidden="true">*</span></label><textarea id="enquiry-message" name="message" rows="5" maxlength="4000" required><?php echo $escape($enquiry_values['message']); ?></textarea></div>
                <p class="pp-form-privacy">We’ll use these details to respond to your enquiry.</p>
                <button class="pp-button" type="submit">Send enquiry <span aria-hidden="true">↗</span></button>
            </form>
            <?php endif; ?>
        </div>
    </div>
</section>
