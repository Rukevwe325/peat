<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Peatech Services | Technology &amp; Engineering</title>
    <meta name="description" content="Peatech develops software, intelligent systems, and automation solutions that turn complex challenges into practical possibilities.">
    <meta property="og:title" content="Peatech Services — Technology &amp; Engineering">
    <meta property="og:description" content="Software, intelligent systems, and automation. Built for real-world impact.">
    <meta property="og:type" content="website">
    <link rel="icon" href="/favicon.png" type="image/png">
    <link rel="stylesheet" href="/assets/homepage.css">
    <link rel="stylesheet" href="/assets/site.css">
    <script src="/assets/site.js" defer></script>
</head>
<body class="home-page">
    <a class="home-skip" href="#main">Skip to content</a>
    <?php require __DIR__ . '/site-header.php'; ?>
    <main id="main">
        <section class="home-hero" aria-labelledby="home-headline">
            <img class="home-hero-image" src="/images/automation-workcell.webp" srcset="/images/automation-workcell-small.webp 720w, /images/automation-workcell.webp 1360w" sizes="100vw" width="1360" height="907" alt="" fetchpriority="high">
            <div class="home-container">
                <div class="home-hero-copy">
                    <h1 id="home-headline">Software, engineering,<br><span>and automation.</span></h1>
                    <p class="home-intro">Peatech builds digital products, integrates systems, and automates workflows.</p>
                    <div class="home-hero-actions"><a href="#contact" class="home-button">Discuss a project <span aria-hidden="true">↗</span></a><a href="#products" class="home-secondary">Explore PeaSyn <span aria-hidden="true">↓</span></a></div>
                </div>
            </div>
        </section>

        <section id="services" class="home-section home-capabilities" aria-labelledby="capabilities-heading">
            <span id="connection" class="home-anchor" aria-hidden="true"></span>
            <div class="home-container">
                <div class="home-section-heading"><h2 id="capabilities-heading">What we do</h2><a id="vision" href="/about" class="home-inline-link">How we work <span aria-hidden="true">↗</span></a></div>
                <div class="home-capability-list">
                    <article><h3>Software development</h3><p>Web and mobile applications, digital platforms, and tools built around the way you work.</p></article>
                    <article><h3>Systems engineering</h3><p>Integrate software, data, and physical equipment. Model and test how the system behaves.</p></article>
                    <article><h3>Automation</h3><p>Automate repeatable tasks and give teams better visibility into day-to-day operations.</p></article>
                </div>
            </div>
        </section>

        <section id="products" class="home-section home-products" aria-labelledby="products-heading">
            <div class="home-container">
                <div class="home-portfolio-heading">
                    <h2 id="products-heading">Engineering in practice</h2>
                    <p>Meet PeaSyn, our platform for simulation and manufacturing intelligence.</p>
                </div>
                <a class="home-work home-work-peasyn" href="/peasyn">
                    <img class="home-work-study" src="/images/peasyn-thermal-study.svg" width="640" height="340" loading="lazy" alt="Thermal simulation of heat spreading along a deposited metal bead">
                    <div class="home-work-copy"><p class="home-work-category">Simulation &amp; digital twins</p><h3>PeaSyn <span aria-hidden="true">↗</span></h3><p>Combines machine behavior, process data, and physics-guided models to help engineers understand how manufacturing processes behave.</p></div>
                </a>
            </div>
        </section>

        <section id="company" class="home-section home-company" aria-labelledby="company-heading">
            <div class="home-container home-company-grid">
                <div>
                    <p class="home-company-kicker">About Peatech</p>
                    <h2 id="company-heading">From research to working systems.</h2>
                    <p class="home-company-intro">Based in Cleveland, Ohio, Peatech is a technology and engineering company that brings applied research, software development, and systems integration together. We work with businesses, manufacturers, startups, and institutions to take an idea from a technical question to a solution they can test and use.</p>
                    <a href="/about" class="home-inline-link">Learn how we work <span aria-hidden="true">↗</span></a>
                </div>
                <div class="home-company-examples">
                    <h3>What that looks like</h3>
                    <dl>
                        <div><dt>Test a design before building it</dt><dd>Use simulation to study how a process behaves. With <a href="/peasyn">PeaSyn</a>, one example is examining how heat spreads as metal is deposited.</dd></div>
                        <div><dt>Make equipment data useful</dt><dd>Bring readings from equipment into a software interface so teams can monitor a process without checking each device separately.</dd></div>
                        <div><dt>Reduce manual work</dt><dd>Build a workflow that captures requests, tracks progress, and prompts the next action without relying on spreadsheets and follow-up emails.</dd></div>
                    </dl>
                </div>
            </div>
        </section>

        <section id="working-together" class="home-section home-engagement" aria-labelledby="engagement-heading">
            <div class="home-container">
                <div class="home-section-heading"><h2 id="engagement-heading">How a project starts</h2><a href="/about#approach" class="home-inline-link">More about our approach <span aria-hidden="true">↗</span></a></div>
                <ol class="home-engagement-steps">
                    <li><h3>Understand the problem</h3><p>Tell us what you’re trying to achieve, what’s in place today, and where the work gets stuck.</p></li>
                    <li><h3>Agree on a scope</h3><p>Identify the requirements, the constraints, and what a useful first version needs to do.</p></li>
                    <li><h3>Build and test</h3><p>Develop the solution in stages and check it against real workflows before expanding it.</p></li>
                </ol>
            </div>
        </section>

        <section id="team" class="home-section home-team" aria-labelledby="home-team-heading">
            <div class="home-container">
                <div class="home-section-heading"><h2 id="home-team-heading">Meet our team</h2></div>
                <?php require __DIR__ . '/team-cards.php'; ?>
            </div>
        </section>

        <section id="contact" class="home-section home-contact" aria-labelledby="contact-heading">
            <div class="home-container home-contact-grid">
                <div><h2 id="contact-heading">Discuss your project</h2><p>Tell us what you’re building, integrating, or trying to automate.</p></div>
                <div class="contact-form"><?php require __DIR__ . '/homepage-contact-form.php'; ?></div>
            </div>
        </section>
    </main>
    <?php require __DIR__ . '/site-footer.php'; ?>
</body>
</html>
