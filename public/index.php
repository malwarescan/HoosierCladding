<?php
$pageTitle = "Professional Siding Services in Northern Indiana | Hoosier Cladding LLC";
$pageDescription = "Expert siding installation, repair, and replacement in South Bend, Mishawaka, Elkhart, and throughout Michiana. Licensed & insured. Winter-ready installations. Call 574-931-2119 for a free estimate.";
include __DIR__ . '/partials/header.php';
?>

<section class="hero">
  <div class="container hero-inner">
    <div class="eyebrow">Professional Siding Services in Northern Indiana</div>
    <h1 class="h1">Expert installation, repair, and replacement across Michiana</h1>
    <p class="lead">
      Quality craftsmanship designed for Indiana winters—freeze–thaw cycles, lake-effect snow, wind, and hail. 
      Local crews, clean jobsites, honest timelines.
    </p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>">Call <?= $PHONE ?></a>
      <a class="btn btn-outline" href="/contact.php">Get Free Estimate</a>
    </div>
    <div class="trust-strip">
      <span>Licensed & Insured</span> • 
      <span>Winter-Ready Installations</span> • 
      <span>Local Crews Only</span>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <h2 class="h2" style="text-align:center">Our Siding Services</h2>
    <p class="lead" style="text-align:center; margin:0 auto 28px">
      Comprehensive siding solutions for residential and commercial properties across Northern Indiana.
    </p>

    <div class="grid grid-3">
      <article class="card">
        <div class="icon">Installation</div>
        <p style="margin-bottom:12px">
          Premium materials selected for Indiana's climate. Precision flashing, house wrap integration, 
          and clean lines backed by strong warranties.
        </p>
        <a href="/service-area.php" style="font-weight:700">Learn More</a>
      </article>

      <article class="card">
        <div class="icon">Repair</div>
        <p style="margin-bottom:12px">
          Storm, moisture, or age—targeted repairs to protect the envelope. We color-match and restore performance.
        </p>
        <a href="/service-area.php" style="font-weight:700">Learn More</a>
      </article>

      <article class="card">
        <div class="icon">Replacement</div>
        <p style="margin-bottom:12px">
          Full tear-offs done right. Code-compliant details, improved energy performance, 
          and modern curb appeal built for Midwest weather.
        </p>
        <a href="/service-area.php" style="font-weight:700">Learn More</a>
      </article>
    </div>
  </div>
</section>

<section class="section" style="background:var(--surface); border-top:1px solid var(--border); border-bottom:1px solid var(--border)">
  <div class="container">
    <h2 class="h2" style="text-align:center; margin-bottom:8px">Why Choose Hoosier Cladding?</h2>
    <p class="lead" style="text-align:center; margin:0 auto 32px">
      Trusted by homeowners across Michiana for quality workmanship and reliable service.
    </p>
    
    <div class="grid grid-3">
      <div>
        <h3 class="h3" style="margin-bottom:6px">Local Expertise</h3>
        <p style="margin:0; color:var(--body)">
          We understand Northern Indiana's unique climate challenges—harsh winters, freeze-thaw cycles, 
          and lake-effect weather patterns.
        </p>
      </div>
      
      <div>
        <h3 class="h3" style="margin-bottom:6px">Premium Materials</h3>
        <p style="margin:0; color:var(--body)">
          We use only high-quality siding materials from trusted manufacturers, 
          designed for durability and long-term performance.
        </p>
      </div>
      
      <div>
        <h3 class="h3" style="margin-bottom:6px">Professional Installation</h3>
        <p style="margin:0; color:var(--body)">
          Our experienced craftsmen ensure proper installation techniques that protect your investment 
          and maintain your home's integrity.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="section" style="background-color: #f8f9fa;">
  <div class="container">
    <h2 class="h2" style="text-align:center; margin-bottom:2rem">What Our Customers Say</h2>
    
    <div class="grid grid-3">
      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;">
            "Our heating bills dropped right after replacing our old siding. The crew was fast, professional, and cleaned up everything."
          </p>
          <p style="font-weight: 600; color: #01426A; margin: 0;">Lisa Greene</p>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;">South Bend, IN</p>
        </div>
      </article>

      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;">
            "Winters in South Bend destroyed our last siding—this install already feels tighter and warmer."
          </p>
          <p style="font-weight: 600; color: #01426A; margin: 0;">Mark Jensen</p>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;">Mishawaka, IN</p>
        </div>
      </article>

      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;">
            "Professional installation and honest pricing. They explained everything and delivered on time."
          </p>
          <p style="font-weight: 600; color: #01426A; margin: 0;">Sarah Williams</p>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;">Elkhart, IN</p>
        </div>
      </article>
    </div>
  </div>
</section>

<?php include __DIR__ . '/partials/cta-strip.php'; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>