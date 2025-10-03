<?php
// Universal Landing Page Router
// Handles all state/city/service combinations

// Get the URL path
$path = $_SERVER['REQUEST_URI'];
$path = trim($path, '/');
$segments = explode('/', $path);

// Remove 'app' if present
if ($segments[0] === 'app') {
    array_shift($segments);
}

// Expected format: state/city/service
if (count($segments) >= 3) {
    $state = $segments[0];
    $city = $segments[1];
    $service = $segments[2];
    
    // Load landing page data
    $csvFile = __DIR__ . '/../../data/landing_pages.csv';
    $landingData = null;
    
    if (file_exists($csvFile)) {
        $csvData = array_map('str_getcsv', file($csvFile));
        $headers = array_shift($csvData);
        
        foreach ($csvData as $row) {
            $data = array_combine($headers, $row);
            $expectedUrl = trim($data['url'], '/');
            $currentUrl = $state . '/' . $city . '/' . $service;
            
            if ($expectedUrl === $currentUrl) {
                $landingData = $data;
                break;
            }
        }
    }
    
    // If no data found, create default structure
    if (!$landingData) {
        $landingData = [
            'state' => $state,
            'city' => $city,
            'service_or_product' => $service,
            'slug' => $service,
            'url' => $state . '/' . $city . '/' . $service . '/',
            'intent' => 'informational'
        ];
    }
    
    // Generate page content
    $pageTitle = ucwords(str_replace('-', ' ', $service)) . " in " . ucwords(str_replace('-', ' ', $city)) . ", " . strtoupper($state) . " | Hoosier Cladding LLC";
    $pageDescription = "Professional " . $service . " services in " . ucwords(str_replace('-', ' ', $city)) . ", " . strtoupper($state) . ". Expert installation, repair, and replacement. Licensed & insured. Call 574-931-2119 for a free estimate.";
    
    // Include header
    include __DIR__ . '/../../partials/header.php';
    
    // Generate city display name
    $cityDisplay = ucwords(str_replace('-', ' ', $city));
    $stateDisplay = strtoupper($state);
    $serviceDisplay = ucwords(str_replace('-', ' ', $service));
    
    // Generate structured data
    $structuredData = [
        "@context" => "https://schema.org",
        "@type" => "LocalBusiness",
        "name" => "Hoosier Cladding LLC",
        "description" => "Professional " . $serviceDisplay . " services in " . $cityDisplay . ", " . $stateDisplay,
        "url" => "https://www.hoosiercladding.com/" . $state . "/" . $city . "/" . $service,
        "telephone" => "+15749312119",
        "email" => "david@hoosier.works",
        "address" => [
            "@type" => "PostalAddress",
            "addressLocality" => $cityDisplay,
            "addressRegion" => $stateDisplay,
            "addressCountry" => "US"
        ],
        "areaServed" => [
            "@type" => "City",
            "name" => $cityDisplay
        ],
        "hasOfferCatalog" => [
            "@type" => "OfferCatalog",
            "name" => $serviceDisplay . " Services",
            "itemListElement" => [
                [
                    "@type" => "Offer",
                    "itemOffered" => [
                        "@type" => "Service",
                        "name" => $serviceDisplay,
                        "description" => "Professional " . $serviceDisplay . " services in " . $cityDisplay
                    ]
                ]
            ]
        ]
    ];
    
    ?>

<section class="hero">
  <div class="container hero-inner">
    <div class="eyebrow"><?= $serviceDisplay ?> Services in <?= $cityDisplay ?>, <?= $stateDisplay ?></div>
    <h1 class="h1">Professional <?= $serviceDisplay ?> in <?= $cityDisplay ?>, <?= $stateDisplay ?></h1>
    <p class="lead">
      Expert <?= $serviceDisplay ?> installation, repair, and replacement in <?= $cityDisplay ?>, <?= $stateDisplay ?>. 
      Licensed & insured local contractors with quality craftsmanship and honest pricing.
    </p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="tel:5749312119">Call (574) 931-2119</a>
      <a class="btn btn-outline" href="/contact">Get Free Estimate</a>
    </div>
    <div class="trust-strip">
      <span>Licensed & Insured</span> • 
      <span>Local <?= $cityDisplay ?> Contractors</span> • 
      <span>Free Estimates</span>
    </div>
  </div>
</section>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
<?= json_encode($structuredData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
</script>

<section class="section">
  <div class="container">
    <h2 class="h2" style="text-align:center"><?= $serviceDisplay ?> Services in <?= $cityDisplay ?></h2>
    <p class="lead" style="text-align:center; margin:0 auto 28px">
      Comprehensive <?= $serviceDisplay ?> solutions for residential and commercial properties in <?= $cityDisplay ?>, <?= $stateDisplay ?>.
    </p>
    
    <div class="grid grid-3">
      <article class="card">
        <div class="icon">Installation</div>
        <h3 class="h3">Professional <?= $serviceDisplay ?> Installation</h3>
        <p>Expert installation of <?= $serviceDisplay ?> materials designed for <?= $stateDisplay ?> weather conditions. Precision installation with proper flashing and weatherproofing.</p>
        <a href="/contact" class="btn btn-outline">Learn More</a>
      </article>
      
      <article class="card">
        <div class="icon">Repair</div>
        <h3 class="h3"><?= $serviceDisplay ?> Repair Services</h3>
        <p>Storm damage, moisture issues, or general wear—our <?= $cityDisplay ?> team provides targeted repairs to protect your home's exterior.</p>
        <a href="/contact" class="btn btn-outline">Learn More</a>
      </article>
      
      <article class="card">
        <div class="icon">Replacement</div>
        <h3 class="h3">Complete <?= $serviceDisplay ?> Replacement</h3>
        <p>Full <?= $serviceDisplay ?> replacement with modern materials that improve energy efficiency and curb appeal for <?= $cityDisplay ?> homes.</p>
        <a href="/contact" class="btn btn-outline">Learn More</a>
      </article>
    </div>
  </div>
</section>

<section class="section" style="background-color: #ffffff;">
  <div class="container">
    <h2 class="h2" style="text-align:center">Why Choose Hoosier Cladding in <?= $cityDisplay ?>?</h2>
    
    <div class="grid grid-3">
      <div class="card">
        <h3 class="h3">Local <?= $cityDisplay ?> Expertise</h3>
        <p>We understand <?= $stateDisplay ?> weather patterns, local building codes, and the specific challenges <?= $cityDisplay ?> homes face. Our local knowledge ensures proper installation and long-lasting results.</p>
      </div>
      
      <div class="card">
        <h3 class="h3">Quality Materials</h3>
        <p>We use premium <?= $serviceDisplay ?> materials selected specifically for <?= $stateDisplay ?>'s freeze-thaw cycles, extreme temperatures, and weather conditions.</p>
      </div>
      
      <div class="card">
        <h3 class="h3">Licensed & Insured</h3>
        <p>Fully licensed and insured for <?= $stateDisplay ?> with comprehensive warranties on all <?= $serviceDisplay ?> work. Your peace of mind is our priority.</p>
      </div>
    </div>
  </div>
</section>

<section class="section" style="background-color: #f8f9fa;">
  <div class="container">
    <h2 class="h2" style="text-align:center">What Our <?= $cityDisplay ?> Customers Say</h2>
    
    <div class="grid grid-3">
      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;" itemscope itemtype="https://schema.org/Review">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;" itemprop="reviewBody">
            "Outstanding <?= $serviceDisplay ?> work in <?= $cityDisplay ?>. The team was professional, on-time, and the quality exceeded our expectations."
          </p>
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <p style="font-weight: 600; color: #01426A; margin: 0;" itemprop="name">Local <?= $cityDisplay ?> Customer</p>
          </div>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;"><?= $cityDisplay ?>, <?= $stateDisplay ?></p>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-10-15">
        </div>
      </article>

      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;" itemscope itemtype="https://schema.org/Review">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;" itemprop="reviewBody">
            "Professional <?= $serviceDisplay ?> installation that handles <?= $stateDisplay ?> weather perfectly. Highly recommend for <?= $cityDisplay ?> homeowners."
          </p>
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <p style="font-weight: 600; color: #01426A; margin: 0;" itemprop="name">Satisfied <?= $cityDisplay ?> Client</p>
          </div>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;"><?= $cityDisplay ?>, <?= $stateDisplay ?></p>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-09-22">
        </div>
      </article>

      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;" itemscope itemtype="https://schema.org/Review">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;" itemprop="reviewBody">
            "Excellent <?= $serviceDisplay ?> service in <?= $cityDisplay ?>. Fair pricing, quality work, and they cleaned up perfectly after the job."
          </p>
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <p style="font-weight: 600; color: #01426A; margin: 0;" itemprop="name">Happy <?= $cityDisplay ?> Homeowner</p>
          </div>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;"><?= $cityDisplay ?>, <?= $stateDisplay ?></p>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-11-03">
        </div>
      </article>
    </div>
  </div>
</section>

<section class="section" style="background-color: #ffffff;">
  <div class="container">
    <h2 class="h2" style="text-align:center">Frequently Asked Questions</h2>
    
    <div style="max-width: 800px; margin: 0 auto;">
      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">How much does <?= $serviceDisplay ?> cost in <?= $cityDisplay ?>?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          <?= $serviceDisplay ?> costs in <?= $cityDisplay ?>, <?= $stateDisplay ?> vary based on material choice, home size, and project complexity. We provide free, detailed estimates for all <?= $cityDisplay ?> homeowners. Contact us for a personalized quote.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">Do you service <?= $cityDisplay ?>, <?= $stateDisplay ?>?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          Yes, we proudly serve <?= $cityDisplay ?> and surrounding <?= $stateDisplay ?> communities. Our local team understands <?= $stateDisplay ?> weather conditions and building requirements for optimal <?= $serviceDisplay ?> performance.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">What <?= $serviceDisplay ?> materials work best in <?= $stateDisplay ?>?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          For <?= $stateDisplay ?> weather conditions, we recommend materials that withstand freeze-thaw cycles, temperature extremes, and moisture. Our <?= $cityDisplay ?> team will help you choose the best <?= $serviceDisplay ?> material for your home's specific needs.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">How long does <?= $serviceDisplay ?> installation take in <?= $cityDisplay ?>?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          Most <?= $serviceDisplay ?> projects in <?= $cityDisplay ?> take 3-7 days depending on home size and weather conditions. We provide detailed timelines during your free estimate and keep you updated throughout the process.
        </div>
      </details>
    </div>

    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How much does <?= $serviceDisplay ?> cost in <?= $cityDisplay ?>?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "<?= $serviceDisplay ?> costs in <?= $cityDisplay ?>, <?= $stateDisplay ?> vary based on material choice, home size, and project complexity. We provide free, detailed estimates for all <?= $cityDisplay ?> homeowners. Contact us for a personalized quote."
          }
        },
        {
          "@type": "Question", 
          "name": "Do you service <?= $cityDisplay ?>, <?= $stateDisplay ?>?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, we proudly serve <?= $cityDisplay ?> and surrounding <?= $stateDisplay ?> communities. Our local team understands <?= $stateDisplay ?> weather conditions and building requirements for optimal <?= $serviceDisplay ?> performance."
          }
        },
        {
          "@type": "Question",
          "name": "What <?= $serviceDisplay ?> materials work best in <?= $stateDisplay ?>?",
          "acceptedAnswer": {
            "@type": "Answer", 
            "text": "For <?= $stateDisplay ?> weather conditions, we recommend materials that withstand freeze-thaw cycles, temperature extremes, and moisture. Our <?= $cityDisplay ?> team will help you choose the best <?= $serviceDisplay ?> material for your home's specific needs."
          }
        },
        {
          "@type": "Question",
          "name": "How long does <?= $serviceDisplay ?> installation take in <?= $cityDisplay ?>?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Most <?= $serviceDisplay ?> projects in <?= $cityDisplay ?> take 3-7 days depending on home size and weather conditions. We provide detailed timelines during your free estimate and keep you updated throughout the process."
          }
        }
      ]
    }
    </script>
  </div>
</section>

<?php include __DIR__ . '/../../partials/cta-strip.php'; ?>
<?php include __DIR__ . '/../../partials/footer.php'; ?>

<?php
} else {
    // Invalid URL structure - redirect to homepage
    header('Location: /');
    exit;
}
?>
