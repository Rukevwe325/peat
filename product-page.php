<?php
if (!isset($product_slug) || !in_array($product_slug, ['acuvita', 'koda', 'ghmera'], true)) {
    http_response_code(404);
    exit;
}
require __DIR__ . '/product-content.php';
$product = $product_pages[$product_slug];
$escape = static function ($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); };
$enquiry_url = '#enquiry';
require __DIR__ . '/product-enquiry-handler.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $escape($product['name'] . ' — ' . $product['category']); ?> | Peatech Services</title>
    <meta name="description" content="<?php echo $escape($product['meta']); ?>">
    <meta property="og:title" content="<?php echo $escape($product['name'] . ' | Peatech Services'); ?>">
    <meta property="og:description" content="<?php echo $escape($product['meta']); ?>">
    <meta property="og:type" content="website">
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700&display=swap">
    <link rel="stylesheet" href="/assets/products.css">
    <script src="/assets/products.js" defer></script>
</head>
<body class="product-page pp-<?php echo $escape($product_slug); ?>">
    <a class="pp-skip" href="#main">Skip to content</a>
    <header class="pp-header">
        <div class="pp-container pp-header-row">
            <a href="/" class="pp-company"><img src="/images/peatechlogo.webp" width="132" height="40" alt="Peatech Services home"></a>
            <button class="pp-menu-button" type="button" aria-expanded="false" aria-controls="product-navigation">Menu <span aria-hidden="true">☰</span></button>
            <nav id="product-navigation" class="pp-nav" aria-label="Main navigation">
                <a href="/#products">Our products</a>
                <a href="/peasyn">PeaSyn</a>
                <a href="/careers">Careers</a>
                <a class="pp-nav-contact" href="<?php echo $escape($enquiry_url); ?>">Let’s connect <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </header>
    <main id="main">
        <section class="pp-hero">
            <div class="pp-container">
                <div class="pp-breadcrumb"><a href="/">Peatech</a><span aria-hidden="true">/</span><a href="/#products">Products</a><span aria-hidden="true">/</span><span><?php echo $escape($product['name']); ?></span></div>
                <div class="pp-hero-grid">
                    <div class="pp-hero-copy">
                        <div class="pp-brand"><span class="pp-mark" aria-hidden="true"><?php echo $escape($product['mark']); ?></span><span><?php echo $escape($product['name']); ?></span></div>
                        <p class="pp-eyebrow"><?php echo $escape($product['category']); ?></p>
                        <h1><?php echo $escape($product['headline'][0]); ?><br><em><?php echo $escape($product['headline'][1]); ?></em></h1>
                        <p class="pp-lead"><?php echo $escape($product['intro']); ?></p>
                        <div class="pp-actions"><a href="<?php echo $escape($enquiry_url); ?>" class="pp-button"><?php echo $escape($product['cta']); ?> <span aria-hidden="true">↗</span></a><a href="#possibilities" class="pp-text-link">Explore the experience <span aria-hidden="true">↓</span></a></div>
                    </div>
                    <div class="pp-preview-wrap">
                        <div class="pp-orbit pp-orbit-one" aria-hidden="true"></div><div class="pp-orbit pp-orbit-two" aria-hidden="true"></div>
                        <div class="pp-preview">
                            <div class="pp-preview-top"><span class="pp-preview-brand"><?php echo $escape($product['name']); ?><span class="pp-status-dot" aria-hidden="true"></span></span><span class="pp-example">Experience preview</span></div>
                            <p class="pp-preview-heading"><?php echo $escape($product['preview_label']); ?></p>
                            <div class="pp-tabs" role="tablist" aria-label="Explore <?php echo $escape($product['name']); ?>">
                                <?php foreach ($product['previews'] as $i => $preview): ?>
                                <button type="button" role="tab" id="preview-tab-<?php echo $i; ?>" aria-controls="preview-panel-<?php echo $i; ?>" aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>" tabindex="<?php echo $i === 0 ? '0' : '-1'; ?>"><?php echo $escape($preview['label']); ?></button>
                                <?php endforeach; ?>
                            </div>
                            <?php foreach ($product['previews'] as $i => $preview): ?>
                            <div class="pp-tab-panel" role="tabpanel" id="preview-panel-<?php echo $i; ?>" aria-labelledby="preview-tab-<?php echo $i; ?>" tabindex="0" <?php echo $i > 0 ? 'hidden' : ''; ?>>
                                <div class="pp-panel-intro"><span class="pp-panel-symbol" aria-hidden="true"><?php echo ['✦', '◎', '↗'][$i]; ?></span><p class="pp-eyebrow"><?php echo $escape($preview['eyebrow']); ?></p><h2><?php echo $escape($preview['title']); ?></h2><p><?php echo $escape($preview['text']); ?></p></div>
                                <dl class="pp-preview-rows"><?php foreach ($preview['rows'] as $row): ?><div><dt><?php echo $escape($row[0]); ?></dt><dd><?php echo $escape($row[1]); ?></dd></div><?php endforeach; ?></dl>
                                <p class="pp-preview-note"><span aria-hidden="true">✓</span> <?php echo $escape($preview['note']); ?></p>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="pp-preview-caption"><?php echo $escape($product['preview_caption']); ?></p>
                    </div>
                </div>
                <div class="pp-highlights"><?php foreach ($product['highlights'] as $i => $highlight): ?><div><span aria-hidden="true">0<?php echo $i + 1; ?></span><?php echo $escape($highlight); ?></div><?php endforeach; ?></div>
            </div>
        </section>
        <section id="possibilities" class="pp-section pp-features">
            <div class="pp-container">
                <div class="pp-section-heading"><div><p class="pp-eyebrow">Built around real life</p><h2><?php echo $escape($product['feature_heading']); ?></h2></div><p><?php echo $escape($product['feature_intro']); ?></p></div>
                <p class="pp-audience"><?php echo $escape($product['audience']); ?></p>
                <div class="pp-feature-grid"><?php foreach ($product['features'] as $feature): ?><article class="pp-feature"><span class="pp-feature-number" aria-hidden="true"><?php echo $escape($feature[0]); ?></span><h3><?php echo $escape($feature[1]); ?></h3><p><?php echo $escape($feature[2]); ?></p></article><?php endforeach; ?></div>
            </div>
        </section>
        <?php if ($product_slug === 'ghmera'): ?>
        <section class="pp-section pp-credits" aria-labelledby="credit-title"><div class="pp-container pp-credit-grid"><div><p class="pp-eyebrow">Reciprocity, made practical</p><h2 id="credit-title">Help is a contribution.<br>Not a currency.</h2><p>Credits keep giving and receiving connected. They have no cash value and cannot be purchased, sold, or transferred.</p></div><div class="pp-credit-details"><div class="pp-credit-stats"><div><strong>5</strong><span>credits to start</span></div><div><strong>1</strong><span>per standard request</span></div><div><strong>+1</strong><span>after completed help</span></div></div><p>A standard request holds one credit while open. It is spent only after both people confirm completion. Cancel or delete the request, and the held credit is returned.</p><p><strong>Emergency non-medical support does not require a credit.</strong></p></div></div></section>
        <section class="pp-section pp-categories"><div class="pp-container"><p class="pp-eyebrow">Many ways to make a difference</p><h2>Everyday needs. Human connections.</h2><div class="pp-category-grid"><article><h3>A practical hand</h3><p>Errands, transportation, moving help, and food support.</p></article><article><h3>Knowledge or a listening ear</h3><p>Study help, technical support, advice, emotional support, and prayer or spiritual support.</p></article><article><h3>Care and coordination</h3><p>Childcare, elderly support, and urgent non-medical assistance, with additional attention to higher-risk requests.</p></article></div></div></section>
        <?php endif; ?>
        <section id="how-it-works" class="pp-section pp-journey"><div class="pp-container"><p class="pp-eyebrow">How it comes together</p><h2><?php echo $escape($product['journey_heading']); ?></h2><ol class="pp-steps"><?php foreach ($product['steps'] as $i => $step): ?><li><span class="pp-step-count" aria-hidden="true">0<?php echo $i + 1; ?></span><h3><?php echo $escape($step[0]); ?></h3><p><?php echo $escape($step[1]); ?></p></li><?php endforeach; ?></ol></div></section>
        <section id="trust" class="pp-section pp-trust"><div class="pp-container pp-trust-grid"><div><p class="pp-eyebrow">Trust & control</p><h2><?php echo $escape($product['trust_heading']); ?></h2><p class="pp-trust-intro"><?php echo $escape($product['trust_intro']); ?></p><aside class="pp-boundary"><span aria-hidden="true">↳</span><h3><?php echo $escape($product['boundary_title']); ?></h3><p><?php echo $escape($product['boundary']); ?></p></aside></div><div class="pp-trust-items"><?php foreach ($product['trust'] as $i => $item): ?><article><span aria-hidden="true">0<?php echo $i + 1; ?></span><div><h3><?php echo $escape($item[0]); ?></h3><p><?php echo $escape($item[1]); ?></p></div></article><?php endforeach; ?></div></div></section>
        <section id="questions" class="pp-section pp-faq"><div class="pp-container pp-faq-grid"><div><p class="pp-eyebrow">A few useful answers</p><h2>Good questions.<br>Clearer answers.</h2><p>Have something else in mind?<br><a class="pp-text-link" href="<?php echo $escape($enquiry_url); ?>">Ask our team <span aria-hidden="true">↗</span></a></p></div><div><?php foreach ($product['faqs'] as $faq): ?><details><summary><?php echo $escape($faq[0]); ?><span aria-hidden="true">+</span></summary><p><?php echo $escape($faq[1]); ?></p></details><?php endforeach; ?></div></div></section>
        <section class="pp-section pp-closing"><div class="pp-container pp-closing-inner"><div><p class="pp-eyebrow">Let’s connect</p><h2><?php echo $escape($product['closing']); ?></h2><p><?php echo $escape($product['closing_text']); ?></p></div><div><a class="pp-button" href="<?php echo $escape($enquiry_url); ?>"><?php echo $escape($product['cta']); ?> <span aria-hidden="true">↗</span></a></div></div></section>
        <?php require __DIR__ . '/product-enquiry-form.php'; ?>
        <section class="pp-more"><div class="pp-container"><p class="pp-eyebrow">More ways we connect</p><div class="pp-more-grid"><?php foreach ($product_pages as $slug => $other): if ($slug === $product_slug) continue; ?><a href="/<?php echo $escape($slug); ?>"><span class="pp-more-name"><?php echo $escape($other['name']); ?> <span aria-hidden="true">↗</span></span><span><?php echo $escape($other['category']); ?></span></a><?php endforeach; ?><a href="/peasyn"><span class="pp-more-name">PeaSyn <span aria-hidden="true">↗</span></span><span>Advanced manufacturing & digital twins</span></a></div></div></section>
    </main>
    <footer class="pp-footer"><div class="pp-container"><div><a href="/" class="pp-footer-name">PEATECH <span>SERVICES</span></a><p>Technology &amp; Engineering.</p></div><nav aria-label="Footer navigation"><a href="/#products">Our products</a><a href="/careers">Careers</a><a href="#enquiry">Contact Peatech</a></nav><p class="pp-copyright">© <?php echo date('Y'); ?> Peatech Services LLC.</p></div></footer>
</body>
</html>
