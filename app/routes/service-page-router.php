<?php
/**
 * Service Page Router
 * Handles service-specific pages like /cabinet-installation-south-bend, /window-replacement-south-bend, etc.
 */

// Get the URL path (remove leading/trailing slashes)
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
// Normalize: remove trailing slash for matching
$path = rtrim($path, '/');
$segments = explode('/', $path);

// Service page mapping
$servicePages = [
    'cabinet-installation-south-bend' => [
        'title' => 'Cabinet Installation in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional cabinet installation services in South Bend, Indiana. Expert craftsmanship, quality materials, and custom solutions. Call 574-931-2119 for a free estimate.',
        'h1' => 'Professional Cabinet Installation in South Bend',
        'service' => 'Cabinet Installation',
        'location' => 'South Bend, Indiana'
    ],
    'our-results' => [
        'title' => 'Our Results - Before & After Gallery | Hoosier Cladding LLC',
        'description' => 'View our portfolio of completed siding, window, and home improvement projects in Northern Indiana. See the quality craftsmanship and results we deliver.',
        'h1' => 'Our Results & Portfolio',
        'service' => 'Portfolio',
        'location' => 'Northern Indiana'
    ],
    'interior-painting-south-bend' => [
        'title' => 'Interior Painting Services in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional interior painting services in South Bend, Indiana. Expert color consultation, premium paints, and flawless finishes. Call 574-931-2119.',
        'h1' => 'Interior Painting Services in South Bend',
        'service' => 'Interior Painting',
        'location' => 'South Bend, Indiana'
    ],
    'siding-contractor-faq-installation-maintenance-cost' => [
        'title' => 'Siding Contractor FAQ: Installation, Maintenance & Cost | Hoosier Cladding LLC',
        'description' => 'Frequently asked questions about siding installation, maintenance, and costs in Northern Indiana. Expert answers from licensed siding contractors.',
        'h1' => 'Siding Contractor FAQ',
        'service' => 'Siding FAQ',
        'location' => 'Northern Indiana'
    ],
    'door-replacement-south-bend' => [
        'title' => 'Door Replacement in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional door replacement services in South Bend, Indiana. Energy-efficient entry doors, storm doors, and custom solutions. Call 574-931-2119.',
        'h1' => 'Door Replacement Services in South Bend',
        'service' => 'Door Replacement',
        'location' => 'South Bend, Indiana'
    ],
    'painting-services-south-bend' => [
        'title' => 'Painting Services in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional interior and exterior painting services in South Bend, Indiana. Expert color consultation and premium finishes. Call 574-931-2119.',
        'h1' => 'Painting Services in South Bend',
        'service' => 'Painting Services',
        'location' => 'South Bend, Indiana'
    ],
    'kitchen-renovation-south-bend' => [
        'title' => 'Kitchen Renovation in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Complete kitchen renovation services in South Bend, Indiana. Design, cabinets, countertops, and installation. Call 574-931-2119 for a free estimate.',
        'h1' => 'Kitchen Renovation Services in South Bend',
        'service' => 'Kitchen Renovation',
        'location' => 'South Bend, Indiana'
    ],
    'vinyl-siding-michiana-south-bend' => [
        'title' => 'Vinyl Siding in South Bend, IN – Expert Installation',
        'description' => 'Professional vinyl siding installation and replacement in South Bend, Indiana. Licensed contractors with local expertise. Free estimates. Call 574-931-2119.',
        'h1' => 'Vinyl Siding in South Bend, Indiana',
        'service' => 'Vinyl Siding',
        'location' => 'South Bend, Indiana'
    ],
    'contact-us' => [
        'title' => 'Contact Us - Free Estimate | Hoosier Cladding LLC',
        'description' => 'Contact Hoosier Cladding LLC for professional siding, window, and home improvement services. Call 574-931-2119 or request a free estimate online.',
        'h1' => 'Contact Us',
        'service' => 'Contact',
        'location' => 'Northern Indiana'
    ],
    'home-siding-blog/repair-house-siding' => [
        'title' => 'How to Repair House Siding | Home Siding Blog | Hoosier Cladding LLC',
        'description' => 'Learn how to repair house siding, identify common issues, and when to call a professional. Expert tips from Hoosier Cladding LLC.',
        'h1' => 'How to Repair House Siding',
        'service' => 'Siding Repair Guide',
        'location' => 'Northern Indiana'
    ],
    'about-us' => [
        'title' => 'About Us - Hoosier Cladding LLC | Professional Siding Contractors',
        'description' => 'Learn about Hoosier Cladding LLC, your trusted siding contractors in Northern Indiana. Licensed, insured, and committed to quality craftsmanship.',
        'h1' => 'About Hoosier Cladding LLC',
        'service' => 'About Us',
        'location' => 'Northern Indiana'
    ],
    'our-services' => [
        'title' => 'Our Services - Siding, Windows, Doors & More | Hoosier Cladding LLC',
        'description' => 'Comprehensive home improvement services including siding installation, window replacement, door installation, and painting in Northern Indiana.',
        'h1' => 'Our Services',
        'service' => 'Services',
        'location' => 'Northern Indiana'
    ],
    'window-replacement-south-bend' => [
        'title' => 'Window Replacement in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional window replacement services in South Bend, Indiana. Energy-efficient windows, expert installation, and lifetime warranties. Call 574-931-2119.',
        'h1' => 'Window Replacement Services in South Bend',
        'service' => 'Window Replacement',
        'location' => 'South Bend, Indiana'
    ],
    'products' => [
        'title' => 'Products - Siding Materials & Home Improvement Products | Hoosier Cladding LLC',
        'description' => 'Browse our selection of premium siding materials, windows, doors, and home improvement products. Quality brands and expert installation.',
        'h1' => 'Our Products',
        'service' => 'Products',
        'location' => 'Northern Indiana'
    ],
    'services' => [
        'title' => 'Services - Siding, Windows, Doors & Home Improvement | Hoosier Cladding LLC',
        'description' => 'Professional home improvement services including siding installation, window replacement, door installation, painting, and more in Northern Indiana.',
        'h1' => 'Our Services',
        'service' => 'Services',
        'location' => 'Northern Indiana'
    ],
    'home' => [
        'title' => 'Professional Siding Services in Northern Indiana | Hoosier Cladding LLC',
        'description' => 'Expert siding installation, repair, and replacement in South Bend, Mishawaka, Elkhart, and throughout Michiana. Licensed & insured. Call 574-931-2119.',
        'h1' => 'Professional Siding Services',
        'service' => 'Home',
        'location' => 'Northern Indiana'
    ],
    'vinyl-siding-certifications' => [
        'title' => 'Vinyl Siding Certifications & Credentials | Hoosier Cladding LLC',
        'description' => 'Learn about our vinyl siding certifications, manufacturer partnerships, and professional credentials. Trusted certified installers in Northern Indiana.',
        'h1' => 'Vinyl Siding Certifications',
        'service' => 'Certifications',
        'location' => 'Northern Indiana'
    ],
    'vinyl-siding-installers' => [
        'title' => 'Vinyl Siding Installers Near Me – South Bend, IN',
        'description' => 'Professional vinyl siding installers serving South Bend, Mishawaka, and Northern Indiana. Licensed, insured contractors with expert installation. Free estimates.',
        'h1' => 'Vinyl Siding Installers Near Me',
        'service' => 'Vinyl Siding Installation',
        'location' => 'Northern Indiana'
    ],
    'house-siding-replacement' => [
        'title' => 'House Siding Replacement in South Bend, IN',
        'description' => 'Complete house siding replacement services in South Bend and Northern Indiana. Expert installation, quality materials, and professional service. Free estimates.',
        'h1' => 'House Siding Replacement Services',
        'service' => 'Siding Replacement',
        'location' => 'Northern Indiana'
    ],
    'residential-siding-contractor' => [
        'title' => 'Residential Siding Contractor in South Bend, IN',
        'description' => 'Licensed residential siding contractor serving South Bend, Mishawaka, and Northern Indiana. Expert installation, repair, and replacement. Call 574-931-2119.',
        'h1' => 'Residential Siding Contractor',
        'service' => 'Siding Contractor',
        'location' => 'Northern Indiana'
    ],
    'exterior-painting-south-bend' => [
        'title' => 'Exterior Painting in South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional exterior painting services in South Bend, Indiana. Expert color consultation, premium paints, and weather-resistant finishes. Call 574-931-2119.',
        'h1' => 'Exterior Painting Services in South Bend',
        'service' => 'Exterior Painting',
        'location' => 'South Bend, Indiana'
    ],
    'home-improvement-blog/repair-house-siding' => [
        'title' => 'How to Repair House Siding | Home Improvement Blog | Hoosier Cladding LLC',
        'description' => 'Learn how to repair house siding, identify common issues, and when to call a professional. Expert tips from Hoosier Cladding LLC.',
        'h1' => 'How to Repair House Siding',
        'service' => 'Siding Repair Guide',
        'location' => 'Northern Indiana'
    ],
];

// Check if this is a service page
$pageKey = $path;
$pageData = $servicePages[$pageKey] ?? null;

// Handle blog posts - these should be handled by blog router, not service router
if (strpos($path, 'home-siding-blog/') === 0 || strpos($path, 'home-improvement-blog/') === 0) {
    return false; // Let blog router handle it
}

// If no match, return false to continue routing
if (!$pageData) {
    return false;
}

// DEBUG: Log that we matched (remove after fixing)
error_log("Service router matched: $pageKey");

// Ensure we output content, not a redirect
// This prevents any accidental redirect loops
if (headers_sent()) {
    // Headers already sent, can't redirect anyway
    return false;
}

// Use AdvancedMetaManager to generate unique metadata
require_once __DIR__ . '/../lib/AdvancedMetaManager.php';
$pageType = 'service';
$pageContext = [
    'service' => $pageData['service'] ?? null,
    'location' => $pageData['location'] ?? null,
    'h1' => $pageData['h1'] ?? null
];
$pageTitle = AdvancedMetaManager::generateTitle($path, $pageType, $pageContext);
$pageDescription = AdvancedMetaManager::generateDescription($path, $pageType, $pageContext);

// CRITICAL: Set response code to 200 to prevent any redirect caching
http_response_code(200);

// CRITICAL: Prevent Railway Edge from caching redirects
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

// Include header
include __DIR__ . '/../../partials/header.php';
?>

<section class="hero" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); color: white;">
    <div class="container w-full text-left">
        <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h1 class="h1 text-white mb-4"><?= htmlspecialchars($pageData['h1']) ?></h1>
            <?php if ($pageKey === 'vinyl-siding-michiana-south-bend'): ?>
                <p class="lead text-white/90 mb-6 text-xl">Professional vinyl siding installation, replacement, and repair in <strong>South Bend, Indiana</strong>. Licensed, insured contractors with local expertise. Free estimates available.</p>
            <?php elseif ($pageKey === 'vinyl-siding-installers'): ?>
                <p class="lead text-white/90 mb-6 text-xl">Find trusted vinyl siding installers near you in <strong>South Bend, Mishawaka, and Northern Indiana</strong>. Licensed, insured contractors with expert installation. Same-day quotes available.</p>
            <?php else: ?>
                <p class="lead text-white/90 mb-6 text-xl">Professional <?= htmlspecialchars($pageData['service']) ?> services in <?= htmlspecialchars($pageData['location']) ?>. Licensed, insured, and ready to serve you.</p>
            <?php endif; ?>
            
            <!-- Trust Badges -->
            <div class="flex flex-wrap gap-4 mb-8">
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-sm font-semibold">Licensed & Insured</span>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-sm font-semibold">Free Estimates</span>
                </div>
                <div class="bg-white/20 backdrop-blur-sm rounded-lg px-4 py-2">
                    <span class="text-sm font-semibold">Same-Day Quotes</span>
                </div>
            </div>
            
            <!-- Primary CTAs -->
            <div class="hero-cta flex flex-wrap gap-4">
                <a class="btn btn-primary bg-white text-blue-600 hover:bg-gray-100 text-lg px-8 py-4 font-bold" href="tel:5749312119">
                    Call Now: (574) 931-2119
                </a>
                <a class="btn btn-outline border-2 border-white text-white hover:bg-white hover:text-blue-600 text-lg px-8 py-4 font-bold" href="/contact">
                    Get Free Estimate
                </a>
            </div>
            
            <p class="text-white/80 text-sm mt-4">Available 7 days a week • Serving Northern Indiana since 2010</p>
        </div>
    </div>
</section>

<!-- Why Choose Section -->
<section class="section bg-gray-50">
    <div class="container w-full text-left">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="h2 mb-4">Why Choose Hoosier Cladding LLC?</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Trusted by hundreds of Northern Indiana homeowners for quality craftsmanship and reliable service.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="h3 mb-3">15+ Years Experience</h3>
                    <p class="text-gray-600">Serving Northern Indiana since 2010 with thousands of successful installations.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="h3 mb-3">Fully Licensed & Insured</h3>
                    <p class="text-gray-600">Complete protection for your home and peace of mind for you.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h3 class="h3 mb-3">Fast, Reliable Service</h3>
                    <p class="text-gray-600">Same-day quotes, quick turnarounds, and on-time project completion.</p>
                </div>
            </div>
            
            <?php if ($pageKey === 'vinyl-siding-installers'): ?>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                    <h3 class="h3 mb-3">About Our Vinyl Siding Installers</h3>
                    <p class="mb-4">Hoosier Cladding LLC employs certified vinyl siding installers with extensive training and industry certifications. Our installation team is licensed in Indiana and specializes in professional vinyl siding installation services including:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <ul class="space-y-2 list-disc list-inside">
                            <li>New construction vinyl siding installation</li>
                            <li>Complete home re-siding projects</li>
                            <li>Storm damage repair and restoration</li>
                            <li>Energy-efficient siding system upgrades</li>
                        </ul>
                        <ul class="space-y-2 list-disc list-inside">
                            <li>Premium material selection and professional installation</li>
                            <li>Color matching and custom finish applications</li>
                            <li>Warranty-backed installation workmanship</li>
                            <li>Free on-site consultations and estimates</li>
                        </ul>
                    </div>
                    <p class="mt-4 text-gray-700"><strong>Our installers are available throughout Northern Indiana</strong> and provide same-day consultations for most service areas. All work is performed by licensed contractors with full insurance coverage.</p>
                </div>
            <?php elseif ($pageKey === 'vinyl-siding-michiana-south-bend'): ?>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                    <h3 class="h3 mb-3">Your South Bend Vinyl Siding Experts</h3>
                    <p class="mb-4">We are your trusted local experts for <strong>vinyl siding in South Bend, Indiana</strong>. With years of experience serving Northern Indiana homeowners, we deliver exceptional results on every installation, repair, and replacement project. Our licensed contractors specialize in energy-efficient vinyl siding solutions built to withstand Indiana's harsh weather.</p>
                </div>
            <?php else: ?>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg mb-8">
                    <h3 class="h3 mb-3">Professional <?= htmlspecialchars($pageData['service']) ?> Services</h3>
                    <p class="mb-4">We are your trusted local experts for <?= htmlspecialchars($pageData['service']) ?> in <?= htmlspecialchars($pageData['location']) ?>. With years of experience and a commitment to quality, we deliver exceptional results on every project.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Service Areas Section -->
<section class="section">
    <div class="container w-full text-left">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="h2 text-center mb-8">Serving Northern Indiana</h2>
            <?php if ($pageKey === 'vinyl-siding-michiana-south-bend'): ?>
                <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">We proudly serve <strong>South Bend, Indiana</strong> and surrounding areas, including Mishawaka, Elkhart, Granger, and throughout Northern Indiana. Our licensed vinyl siding contractors have years of experience serving the Michiana region.</p>
            <?php elseif ($pageKey === 'vinyl-siding-installers'): ?>
                <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">Find vinyl siding installers near you! We serve <strong>South Bend, Mishawaka, Elkhart, Granger, Niles, Osceola</strong>, and throughout the Michiana region. Same-day service available in most areas.</p>
            <?php else: ?>
                <p class="text-center text-gray-600 mb-8 max-w-2xl mx-auto">We proudly serve <?= htmlspecialchars($pageData['location']) ?> and surrounding areas, including South Bend, Mishawaka, Elkhart, Granger, and throughout Michiana.</p>
            <?php endif; ?>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="font-bold text-lg">South Bend</div>
                    <div class="text-sm text-gray-600">IN</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="font-bold text-lg">Mishawaka</div>
                    <div class="text-sm text-gray-600">IN</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="font-bold text-lg">Elkhart</div>
                    <div class="text-sm text-gray-600">IN</div>
                </div>
                <div class="text-center p-4 bg-gray-50 rounded-lg">
                    <div class="font-bold text-lg">Granger</div>
                    <div class="text-sm text-gray-600">IN</div>
                </div>
            </div>
            
            <!-- CTA Section -->
            <div class="bg-blue-600 text-white rounded-lg p-8 text-center">
                <h3 class="h3 text-white mb-4">Ready to Get Started?</h3>
                <p class="text-lg mb-6 text-white/90">Call us today for a free, no-obligation estimate</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:5749312119" class="btn bg-white text-blue-600 hover:bg-gray-100 text-lg px-8 py-4 font-bold">
                        Call (574) 931-2119
                    </a>
                    <a href="/contact" class="btn border-2 border-white text-white hover:bg-white hover:text-blue-600 text-lg px-8 py-4 font-bold">
                        Get Free Estimate
                    </a>
                </div>
            </div>
                
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<?php if ($pageKey === 'vinyl-siding-installers'): ?>
<section class="section bg-gray-50">
    <div class="container w-full text-left">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="h2 text-center mb-8">Frequently Asked Questions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="h3 mb-3">How much does vinyl siding installation cost?</h3>
                    <p class="text-gray-600">Costs vary based on home size, material choice, and project complexity. We provide free, detailed estimates with no obligation. Most projects range from $8,000-$15,000 for average-sized homes.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="h3 mb-3">How long does installation take?</h3>
                    <p class="text-gray-600">Most vinyl siding installations are completed in 3-7 days, depending on home size and weather conditions. We work efficiently to minimize disruption to your daily routine.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="h3 mb-3">Do you offer warranties?</h3>
                    <p class="text-gray-600">Yes! We provide comprehensive warranties on both materials and workmanship. Most vinyl siding comes with manufacturer warranties of 20-50 years, plus our installation guarantee.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="h3 mb-3">Are you licensed and insured?</h3>
                    <p class="text-gray-600">Absolutely. We're fully licensed in Indiana, carry comprehensive liability insurance, and are bonded. Your home and investment are fully protected.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Final CTA Section -->
<section class="section" style="background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);">
    <div class="container w-full text-center">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="h2 text-white mb-4">Ready to Transform Your Home?</h2>
            <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">Get your free estimate today. No obligation, just honest pricing and expert advice.</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="tel:5749312119" class="btn bg-white text-blue-600 hover:bg-gray-100 text-xl px-10 py-5 font-bold shadow-lg">
                    Call (574) 931-2119
                </a>
                <a href="/contact" class="btn border-2 border-white text-white hover:bg-white hover:text-blue-600 text-xl px-10 py-5 font-bold">
                    Get Free Estimate
                </a>
            </div>
            <p class="text-white/80 text-sm mt-6">Available 7 days a week • Same-day quotes available</p>
        </div>
    </div>
</section>

<?php
// Add LocalBusiness schema for transactional service pages
// Proper ontology: LocalBusiness (the installer company) offers Service (installation service)
if (in_array($pageKey, ['vinyl-siding-michiana-south-bend', 'vinyl-siding-installers', 'house-siding-replacement', 'residential-siding-contractor'])) {
    // Define service areas based on page
    $serviceAreas = [];
    if ($pageKey === 'vinyl-siding-installers') {
        $serviceAreas = [
            ['@type' => 'City', 'name' => 'South Bend', 'containedInPlace' => ['@type' => 'State', 'name' => 'Indiana']],
            ['@type' => 'City', 'name' => 'Mishawaka', 'containedInPlace' => ['@type' => 'State', 'name' => 'Indiana']],
            ['@type' => 'City', 'name' => 'Elkhart', 'containedInPlace' => ['@type' => 'State', 'name' => 'Indiana']],
            ['@type' => 'City', 'name' => 'Granger', 'containedInPlace' => ['@type' => 'State', 'name' => 'Indiana']],
            ['@type' => 'City', 'name' => 'Niles', 'containedInPlace' => ['@type' => 'State', 'name' => 'Michigan']],
            ['@type' => 'City', 'name' => 'Osceola', 'containedInPlace' => ['@type' => 'State', 'name' => 'Indiana']]
        ];
    } else {
        $serviceAreas = [
            ['@type' => 'City', 'name' => 'South Bend', 'containedInPlace' => ['@type' => 'State', 'name' => 'Indiana']]
        ];
    }
    
    // Service name matches query intent
    $serviceName = $pageKey === 'vinyl-siding-installers' ? 'Vinyl Siding Installation' : $pageData['service'];
    $serviceDescription = $pageKey === 'vinyl-siding-installers' 
        ? 'Professional vinyl siding installation services provided by licensed contractors'
        : "Professional {$pageData['service']} services in {$pageData['location']}";
    
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Hoosier Cladding LLC',
        'description' => $serviceDescription,
        'url' => 'https://www.hoosiercladding.com',
        'telephone' => '+15749312119',
        'email' => 'David@Hoosier.works',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => '721 Lincoln Way E',
            'addressLocality' => 'South Bend',
            'addressRegion' => 'IN',
            'postalCode' => '46601',
            'addressCountry' => 'US'
        ],
        'areaServed' => $serviceAreas,
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => $serviceName,
            'itemListElement' => [
                [
                    '@type' => 'Offer',
                    'itemOffered' => [
                        '@type' => 'Service',
                        '@id' => 'https://www.hoosiercladding.com/' . $pageKey . '#service',
                        'name' => $serviceName,
                        'description' => $serviceDescription,
                        'provider' => [
                            '@type' => 'LocalBusiness',
                            'name' => 'Hoosier Cladding LLC'
                        ],
                        'serviceType' => $pageKey === 'vinyl-siding-installers' ? 'Vinyl Siding Installation' : $pageData['service'],
                        'areaServed' => $serviceAreas
                    ],
                    'priceCurrency' => 'USD',
                    'availability' => 'https://schema.org/InStock'
                ]
            ]
        ]
    ];
    echo '<script type="application/ld+json">' . PHP_EOL;
    echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL;
    echo '</script>' . PHP_EOL;
}
?>

<?php include __DIR__ . '/../../partials/footer.php'; ?>

