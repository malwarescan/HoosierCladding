<?php
/**
 * Service Page Router
 * Handles service-specific pages like /cabinet-installation-south-bend, /window-replacement-south-bend, etc.
 */

// Get the URL path
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
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
        'title' => 'Vinyl Siding in Michiana & South Bend, IN | Hoosier Cladding LLC',
        'description' => 'Professional vinyl siding installation and replacement in South Bend and throughout Michiana. Energy-efficient, low-maintenance solutions. Call 574-931-2119.',
        'h1' => 'Vinyl Siding Services in Michiana',
        'service' => 'Vinyl Siding',
        'location' => 'Michiana, Indiana'
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

// Include header
include __DIR__ . '/../../partials/header.php';
?>

<section class="hero">
    <div class="container w-full text-left">
        <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="h1"><?= htmlspecialchars($pageData['h1']) ?></h1>
            <p class="lead">Professional <?= htmlspecialchars($pageData['service']) ?> services in <?= htmlspecialchars($pageData['location']) ?>.</p>
            <div class="hero-cta">
                <a class="btn btn-primary" href="/contact">Get Free Estimate</a>
                <a class="btn btn-outline" href="/service-area">View Service Areas</a>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container w-full text-left">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                <h2>Why Choose Hoosier Cladding LLC for <?= htmlspecialchars($pageData['service']) ?>?</h2>
                <p>We are your trusted local experts for <?= htmlspecialchars($pageData['service']) ?> in <?= htmlspecialchars($pageData['location']) ?>. With years of experience and a commitment to quality, we deliver exceptional results on every project.</p>
                
                <h3>Our Services Include:</h3>
                <ul>
                    <li>Professional installation and replacement</li>
                    <li>Expert repair and maintenance</li>
                    <li>Quality materials and craftsmanship</li>
                    <li>Licensed and insured contractors</li>
                    <li>Free estimates and consultations</li>
                </ul>
                
                <h3>Service Areas</h3>
                <p>We proudly serve <?= htmlspecialchars($pageData['location']) ?> and surrounding areas, including South Bend, Mishawaka, Elkhart, Granger, and throughout Michiana.</p>
                
                <div class="mt-8">
                    <a href="/contact" class="btn btn-primary">Contact Us Today</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../../partials/footer.php'; ?>

