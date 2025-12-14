<?php
/**
 * City-Service Router
 * Handles dedicated city+service pages for high-opportunity queries
 * Example: /siding-replacement-warsaw, /vinyl-siding-south-bend
 * 
 * These pages are created for queries with high impressions but low CTR
 * to provide clean intent alignment
 */

// Get the URL path
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $path);

// High-opportunity city-service mappings from GSC data
$cityServicePages = [
    // Warsaw - HIGH PRIORITY (position 9.91, 0 clicks)
    'siding-replacement-warsaw' => [
        'city' => 'Warsaw',
        'state' => 'Indiana',
        'service' => 'Siding Replacement',
        'serviceSlug' => 'siding-replacement',
        'query' => 'siding replacement warsaw indiana',
        'position' => 9.91,
        'impressions' => 76,
        'intent' => 'transactional-local'
    ],
    // South Bend - High impressions
    'vinyl-siding-south-bend' => [
        'city' => 'South Bend',
        'state' => 'Indiana',
        'service' => 'Vinyl Siding',
        'serviceSlug' => 'vinyl-siding',
        'query' => 'vinyl siding south bend',
        'position' => 27.92,
        'impressions' => 117,
        'intent' => 'transactional-local'
    ],
    // Granger - Good position
    'siding-installation-granger' => [
        'city' => 'Granger',
        'state' => 'Indiana',
        'service' => 'Siding Installation',
        'serviceSlug' => 'siding-installation',
        'query' => 'siding installation granger, indiana',
        'position' => 23.68,
        'impressions' => 100,
        'intent' => 'transactional-local'
    ],
];

// Check if this is a city-service page
$pageKey = $path;
$pageData = $cityServicePages[$pageKey] ?? null;

if (!$pageData) {
    return false; // Continue routing - not a city-service page
}

// Use AdvancedMetaManager for unique metadata
require_once __DIR__ . '/../lib/AdvancedMetaManager.php';

// Generate metadata specifically for this query
$pageType = 'service';
$pageContext = [
    'city' => $pageData['city'],
    'service' => $pageData['service'],
    'query' => $pageData['query'],
    'intent' => $pageData['intent']
];

// Override metadata to match query intent exactly
$pageTitle = "{$pageData['service']} in {$pageData['city']}, {$pageData['state']} – Expert Installation";
$pageDescription = "Professional {$pageData['service']} services in {$pageData['city']}, {$pageData['state']}. Licensed contractors with local expertise. Free estimates. Call 574-931-2119.";

// Ensure length compliance
if (mb_strlen($pageTitle) > 60) {
    $pageTitle = mb_substr($pageTitle, 0, 57) . '...';
}
if (mb_strlen($pageDescription) < 120) {
    $pageDescription .= " Serving {$pageData['city']} and surrounding Northern Indiana communities.";
}
if (mb_strlen($pageDescription) > 155) {
    $pageDescription = mb_substr($pageDescription, 0, 152) . '...';
}

// Set page type and context for header
$pageType = 'service';
$pageContext = [
    'city' => $pageData['city'],
    'service' => $pageData['service'],
    'query' => $pageData['query'],
    'intent' => $pageData['intent']
];

// Include header (will use $pageTitle and $pageDescription if set)
include __DIR__ . '/../../partials/header.php';
?>

<section class="hero">
    <div class="container w-full text-left">
        <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="h1"><?= htmlspecialchars($pageData['service']) ?> in <?= htmlspecialchars($pageData['city']) ?>, <?= htmlspecialchars($pageData['state']) ?></h1>
            <p class="lead">Professional <?= htmlspecialchars(strtolower($pageData['service'])) ?> services for <?= htmlspecialchars($pageData['city']) ?> homeowners. Licensed, insured, and locally trusted.</p>
            <div class="hero-cta">
                <a class="btn btn-primary" href="/contact">Get Free Estimate</a>
                <a class="btn btn-outline" href="tel:574-931-2119">Call 574-931-2119</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container w-full text-left">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <h2>Why Choose Hoosier Cladding for <?= htmlspecialchars($pageData['service']) ?> in <?= htmlspecialchars($pageData['city']) ?>?</h2>
                <p>We are your trusted local experts for <?= htmlspecialchars(strtolower($pageData['service'])) ?> in <?= htmlspecialchars($pageData['city']) ?>, <?= htmlspecialchars($pageData['state']) ?>. With years of experience serving Northern Indiana, we deliver quality craftsmanship and reliable service.</p>
                
                <h3>Our <?= htmlspecialchars($pageData['service']) ?> Services Include:</h3>
                <ul>
                    <li>Professional installation and replacement</li>
                    <li>Expert repair and maintenance</li>
                    <li>Quality materials and craftsmanship</li>
                    <li>Licensed and insured contractors</li>
                    <li>Free estimates and consultations</li>
                </ul>
                
                <h3>Service Area</h3>
                <p>We proudly serve <?= htmlspecialchars($pageData['city']) ?>, <?= htmlspecialchars($pageData['state']) ?> and surrounding areas, including South Bend, Mishawaka, Elkhart, Granger, and throughout Michiana.</p>
                
                <div class="mt-8">
                    <a href="/contact" class="btn btn-primary">Contact Us Today</a>
                    <a href="/service-area" class="btn btn-outline">View All Service Areas</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Add LocalBusiness schema for this city
$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    'name' => 'Hoosier Cladding LLC',
    'description' => "Professional {$pageData['service']} services in {$pageData['city']}, {$pageData['state']}",
    'url' => 'https://www.hoosiercladding.com',
    'telephone' => '+15749312119',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => '721 Lincoln Way E',
        'addressLocality' => 'South Bend',
        'addressRegion' => 'IN',
        'postalCode' => '46601',
        'addressCountry' => 'US'
    ],
    'areaServed' => [
        [
            '@type' => 'City',
            'name' => $pageData['city'],
            'containedInPlace' => [
                '@type' => 'State',
                'name' => $pageData['state']
            ]
        ]
    ],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => $pageData['service'],
        'itemListElement' => [
            [
                '@type' => 'Offer',
                'itemOffered' => [
                    '@type' => 'Service',
                    'name' => $pageData['service'],
                    'description' => "Professional {$pageData['service']} in {$pageData['city']}, {$pageData['state']}"
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>

<?php include __DIR__ . '/../../partials/footer.php'; 
return true; // Signal that we handled this route
?>

