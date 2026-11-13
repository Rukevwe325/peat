<?php
$product_slug = 'peasyn';
$product = ['name' => 'PeaSyn', 'mark' => 'PS', 'category' => 'Predictive engineering', 'enquiry_intro' => 'What decision are you trying to make? Tell us about your process, the tools you use and the results you need. Help shape PeaSyn around your engineering workflow.'];
$site_active = 'peasyn';
$site_contact_href = '#enquiry';
$escape = static function ($text) { return htmlspecialchars($text, ENT_QUOTES, 'UTF-8'); };
require __DIR__ . '/product-enquiry-handler.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PeaSyn — Predictive engineering | Peatech Services</title>
    <meta name="description" content="Explore PeaSyn, a platform in development connecting engineering models, process data and existing tools to help teams explore predictions and make better decisions.">
    <meta property="og:title" content="PeaSyn — Faster predictions. Better engineering decisions.">
    <meta property="og:description" content="Connect your models, data and tools. Explore what could happen before making a change.">
    <meta property="og:type" content="website">
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="stylesheet" href="/assets/products.css">
    <link rel="stylesheet" href="/assets/site.css">
    <link rel="stylesheet" href="/assets/peasyn.css">
    <link rel="stylesheet" href="/assets/peasyn-visual.css">
    <script src="/assets/site.js" defer></script>
    <script src="/assets/peasyn.js" defer></script>
</head>
<body class="product-page peasyn-page">
    <a class="pp-skip" href="#main">Skip to content</a>
    <?php require __DIR__ . '/site-header.php'; ?>
    <main id="main">
        <section class="ps-hero"><div class="ps-container ps-hero-grid">
            <div class="ps-hero-copy">
                <p class="ps-eyebrow"><span class="ps-wordmark">PeaSyn<span aria-hidden="true">.</span></span><span class="ps-status">In development</span></p>
                <h1>Faster predictions.<br><span>Better engineering decisions.</span></h1>
                <p class="ps-lead">Explore what could happen <em>before</em> making a change. Bring engineering models, process data and your existing tools into one connected workflow.</p>
                <div class="ps-actions"><a class="ps-button" href="#platform">Explore the platform <span aria-hidden="true">↗</span></a><a class="ps-text-link" href="#enquiry">Discuss your application <span aria-hidden="true">→</span></a></div>
                <p class="ps-hero-note">Your engineering question. A clearer way forward.</p>
            </div>
            <div class="ps-hero-visual"><?php require __DIR__ . '/peasyn-visual.php'; ?></div>
        </div></section>
        <nav class="ps-section-nav" aria-label="PeaSyn page sections"><div class="ps-container"><a href="#platform">The platform</a><a href="#capabilities">What you can explore</a><a href="#integrations">Your tools, connected</a><a href="#approach">How it works</a><a href="#confidence">Prediction confidence</a></div></nav>

        <section id="platform" class="ps-section ps-intro">
            <div class="ps-container ps-intro-grid"><div><p class="ps-eyebrow">A shorter path from question to insight</p><h2>Make simulation part of the everyday.</h2></div><div><p class="ps-intro-lead">A design change. A different setting.<br>A result you didn’t expect.</p><p>Detailed simulation can help you understand the consequences, but specialist setup and long computation times can slow decisions down.</p><p>PeaSyn is being developed to bring models, inputs and results together, making it easier to compare options and investigate how a system may behave.</p></div></div>
            <div class="ps-container"><div class="ps-applications"><span>One core. Many engineering questions.</span><ul aria-label="Potential application areas"><li>Manufacturing</li><li>Robotics</li><li>Aviation</li><li>MedTech</li><li>And beyond</li></ul></div></div>
        </section>

        <section id="capabilities" class="ps-section ps-capabilities"><div class="ps-container">
            <div class="ps-section-heading"><div><p class="ps-eyebrow">Explore, connect, evaluate</p><h2>See the possibilities.<br>Understand the trade-offs.</h2></div><p>A shared core for running models, managing inputs and reviewing results. Adapted to the question you need to answer.</p></div>
            <div class="ps-capability-grid">
                <article class="ps-feature ps-feature-wide"><div><span class="ps-feature-index">01 / EXPLORE</span><h3>Compare before you commit.</h3><p>Explore alternative settings and design choices. Suitable simplified models can make repeated evaluations faster, so you can spend more time understanding the options.</p></div><div class="ps-scenario-demo" data-ps-scenarios><div class="ps-demo-heading"><span>Illustrative response</span><span class="ps-demo-tag">Concept only</span></div><svg viewBox="0 0 400 150" role="img" aria-label="Illustrative comparison of baseline and alternative response curves"><path class="ps-demo-grid" d="M20 20H380M20 65H380M20 110H380M20 140H380M20 10V140"/><path class="ps-baseline" d="M20 130C80 130 80 35 145 35S210 95 260 65S330 45 380 50"/><path class="ps-alternative" d="M20 130C85 130 95 78 150 70S240 55 285 52S345 50 380 50"/></svg><div class="ps-scenario-controls" role="group" aria-label="Illustrative scenario"><button type="button" data-scenario="steady" aria-pressed="true">Setting A</button><button type="button" data-scenario="responsive" aria-pressed="false">Setting B</button><span><i></i> Baseline <i></i> Alternative</span></div><p class="ps-demo-caption" aria-live="polite">Setting A · a smoother illustrative response. No engineering model is running.</p></div></article>
                <article class="ps-feature ps-feature-data"><span class="ps-feature-index">02 / CONNECT</span><div class="ps-data-symbol" aria-hidden="true"><span>Measurements</span><b>⇄</b><span>Model</span></div><h3>Bring observations<br>into the picture.</h3><p>Connect recorded or supported live measurements. Compare what you observe with what the model predicts, and see where to investigate further.</p></article>
                <article class="ps-feature ps-feature-small"><span class="ps-mini-icon" aria-hidden="true">↗</span><div><h3>Faster repeat evaluations</h3><p>Use models suited to your task to explore more alternatives with less computation.</p></div></article>
                <article class="ps-feature ps-feature-small"><span class="ps-mini-icon" aria-hidden="true">⌘</span><div><h3>A workflow that fits</h3><p>Bring compatible models, data sources and controllers together through defined interfaces.</p></div></article>
                <article class="ps-feature ps-feature-small"><span class="ps-mini-icon" aria-hidden="true">≡</span><div><h3>Keep the evidence</h3><p>Save inputs, settings, model versions and results so the work can be reviewed and revisited.</p></div></article>
            </div>
        </div></section>

        <section id="integrations" class="ps-section ps-integrations"><div class="ps-container ps-integration-grid">
            <div class="ps-connection-map" role="img" aria-label="Conceptual workflow: existing models, measurements and controllers connect to the PeaSyn core for predictions, comparisons and saved results"><div class="ps-map-inputs"><span><b>01</b>Your models</span><span><b>02</b>Your measurements</span><span><b>03</b>Your controllers</span></div><div class="ps-map-core"><span>PeaSyn<span>.</span></span><small>A connected core</small></div><div class="ps-map-outputs"><span>Run &amp; predict</span><span>Compare &amp; inspect</span><span>Save &amp; revisit</span></div><p>Defined inputs · Consistent units · Clear timing</p></div>
            <div><p class="ps-eyebrow">Built to work with your knowledge</p><h2>Your models.<br>Your tools.<br><span>Connected.</span></h2><p>Your engineering knowledge already lives in models, software and control methods. PeaSyn’s integration approach is designed to bring compatible tools into the same workflow.</p><p>A controller, for example, could evaluate candidate settings against a simulated process. You supply the inputs, inspect the predictions and compare the consequences.</p><a class="ps-text-link" href="#enquiry">Tell us about your tools <span aria-hidden="true">→</span></a></div>
        </div></section>

        <section id="approach" class="ps-section ps-workflow"><div class="ps-container"><p class="ps-eyebrow">From a question to a reviewable result</p><h2>Five steps. One connected workflow.</h2><ol class="ps-steps"><li><span>01</span><h3>Define</h3><p>Choose the decision and the outcome that matters.</p></li><li><span>02</span><h3>Select</h3><p>Find a model with evidence for your task and conditions.</p></li><li><span>03</span><h3>Connect</h3><p>Bring in settings, system information and measurements.</p></li><li><span>04</span><h3>Explore</h3><p>Compare alternatives and inspect predicted behaviour.</p></li><li><span>05</span><h3>Record</h3><p>Keep the configuration and results for review.</p></li></ol></div></section>

        <section id="confidence" class="ps-section ps-confidence"><div class="ps-container ps-confidence-grid"><div><p class="ps-eyebrow">Confidence comes from context</p><h2>A prediction is useful<br>when you know<br><span>where it applies.</span></h2><p>Good decisions need more than a curve on a screen. They need suitable models, reliable inputs and a clear view of the limits.</p><p>PeaSyn’s development centres on making that context visible. When materials, equipment or operating conditions change, the supporting evidence needs another look.</p></div><div class="ps-evidence"><div class="ps-evidence-heading"><span>Behind every useful prediction</span><span aria-hidden="true">↗</span></div><div><span>01</span><section><h3>A defined purpose</h3><p>What question is the model intended to answer?</p></section></div><div><span>02</span><section><h3>Evidence for the conditions</h3><p>Which inputs and operating ranges have been tested?</p></section></div><div><span>03</span><section><h3>Visible limitations</h3><p>What needs checking before the result informs a decision?</p></section></div><p class="ps-evidence-note">Application suitability is assessed case by case.</p></div></div></section>

        <section class="ps-closing"><div class="ps-container"><p class="ps-eyebrow">Built around real engineering work</p><h2>What are you trying<br>to understand?</h2><p>Share the question, the tools you use and what slows you down.<br>Your workflow can help shape what PeaSyn becomes.</p><a class="ps-button" href="#enquiry">Discuss your engineering challenge <span aria-hidden="true">↗</span></a></div></section>
        <?php require __DIR__ . '/product-enquiry-form.php'; ?>
    </main>
    <?php require __DIR__ . '/site-footer.php'; ?>
</body>
</html>
