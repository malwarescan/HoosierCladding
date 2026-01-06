<?php
/**
 * Front Controller / Router
 * Handles all incoming requests and routes them to the appropriate page
 */

// PRIORITY 0: Handle healthcheck endpoint FIRST (before any redirects)
$__path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ($__path === '/health.php') {
    header("Content-Type: text/plain");
    echo "ok";
    exit;
}

// PRIORITY 0.5: Crawl Hygiene - Handle query parameter pollution
require_once __DIR__ . '/app/lib/CrawlHygiene.php';

// Check if we should redirect to clean URL (301)
$redirectUrl = CrawlHygiene::shouldRedirect();
if ($redirectUrl !== null) {
    // Redirect to clean URL (301 permanent)
    header("Location: $redirectUrl", true, 301);
    exit;
}

// Add noindex header for any remaining unknown params (defense in depth)
CrawlHygiene::addNoindexIfNeeded();

// PRIORITY 1: Force www canonical (server-level enforcement)
// This handles cases where .htaccess redirect may not execute (e.g., CDN/proxy)
// BUT: Only redirect if we're NOT already on www (prevent loops)
$host = $_SERVER['HTTP_HOST'] ?? '';
if ($host === 'hoosiercladding.com' && strpos($host, 'www.') !== 0) {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    // Prevent redirect loops - check if we're already redirecting to www
    if (!isset($_SERVER['HTTP_X_FORWARDED_HOST']) || strpos($_SERVER['HTTP_X_FORWARDED_HOST'], 'www.') === false) {
        header("Location: https://www.hoosiercladding.com{$uri}", true, 301);
        exit;
    }
}

// PRIORITY 1.5: Force HTTPS
// Ensure all traffic uses secure connection
$isHttps = (
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ||
    ($_SERVER['SERVER_PORT'] ?? 0) == 443 ||
    ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
);

if (!$isHttps && strpos($host, 'localhost') !== 0 && strpos($host, '127.0.0.1') === false) {
    $redirectUrl = "https://" . ($host ?: 'www.hoosiercladding.com') . ($_SERVER['REQUEST_URI'] ?? '/');
    header("Location: $redirectUrl", true, 301);
    exit;
}

// PRIORITY: Handle favicon and icon files SECOND (before any routing logic)

// Serve favicon files with proper content-type headers
$faviconFiles = [
    '/favicon.ico' => ['file' => __DIR__ . '/favicon.ico', 'type' => 'image/x-icon'],
    '/favicon-16x16.png' => ['file' => __DIR__ . '/favicon-16x16.png', 'type' => 'image/png'],
    '/favicon-32x32.png' => ['file' => __DIR__ . '/favicon-32x32.png', 'type' => 'image/png'],
    '/favicon.svg' => ['file' => __DIR__ . '/favicon.svg', 'type' => 'image/svg+xml'],
    '/apple-touch-icon.png' => ['file' => __DIR__ . '/apple-touch-icon.png', 'type' => 'image/png'],
    '/android-chrome-192x192.png' => ['file' => __DIR__ . '/android-chrome-192x192.png', 'type' => 'image/png'],
    '/android-chrome-512x512.png' => ['file' => __DIR__ . '/android-chrome-512x512.png', 'type' => 'image/png'],
    '/site.webmanifest' => ['file' => __DIR__ . '/site.webmanifest', 'type' => 'application/manifest+json'],
];

if (isset($faviconFiles[$__path])) {
    $favicon = $faviconFiles[$__path];
    if (file_exists($favicon['file'])) {
        header('Content-Type: ' . $favicon['type']);
        header('Cache-Control: public, max-age=2592000, stale-while-revalidate=86400');
        readfile($favicon['file']);
        exit;
    }
}

// PRIORITY: Handle feeds SECOND (before any routing logic)
if ($__path === '/feeds/products.ndjson') { require __DIR__ . '/public/feeds/products.ndjson.php'; exit; }

// PRIORITY: Handle sitemaps THIRD (before any routing logic)
if ($__path === '/sitemap.xml')        { require __DIR__ . '/sitemap-index.php';  exit; }
if ($__path === '/sitemap-static.xml') { require __DIR__ . '/sitemap-static.php'; exit; }
if ($__path === '/sitemap-blog.xml')   { require __DIR__ . '/sitemap-blog.php';   exit; }
if ($__path === '/sitemap-matrix.xml') { require __DIR__ . '/sitemap-matrix.php'; exit; }
if ($__path === '/sitemap-products.xml') { require __DIR__ . '/sitemap-products.php'; exit; }
// Also handle numbered matrix sitemaps
if (preg_match('#^/sitemap-matrix-(\d+)\.xml$#', $__path, $m)) {
    $file = __DIR__ . '/public/sitemap-matrix-' . $m[1] . '.xml';
    if (file_exists($file)) {
        header('Content-Type: application/xml; charset=UTF-8');
        header('X-Robots-Tag: noindex, nofollow');
        readfile($file);
        exit;
    }
}

// JAMES HARDIE PRODUCT ROUTES: Handle product pages first
if (preg_match('#^/products/james-hardie/#', $__path)) {
    require_once __DIR__ . '/app/lib/ProductSchema.php';
    $product = ProductSchema::findByUrl($__path);
    if ($product) {
        require __DIR__ . '/templates/james-hardie-product.php';
        exit;
    }
}

// BLOG ROUTES: Direct blog slug routes to deterministic blog-router
if (preg_match('#^/home-siding-blog/[^/]+/?$#', $__path)) {
  require __DIR__.'/app/routes/blog-router.php';
  exit;
}

// Blog hub at exactly /home-siding-blog
if ($__path === '/home-siding-blog') {
  require __DIR__.'/app/routes/blog-router.php';
  exit;
}

// AUTHOR PAGES: Handled by CrawlHygiene now (all unknown params get noindex + redirect)
// Legacy code removed - CrawlHygiene handles this globally at PRIORITY 0.5

// CITY-SERVICE ROUTES: Handle high-opportunity city+service pages first
// These match top GSC queries with high impressions but low CTR
$cityServiceRouter = __DIR__ . '/app/routes/city-service-router.php';
if (file_exists($cityServiceRouter)) {
    ob_start();
    $result = require $cityServiceRouter;
    $output = ob_get_clean();
    if ($result !== false) {
        echo $output;
        exit;
    }
}

// SERVICE PAGE ROUTES: Handle service-specific pages
// Try service page router first
$serviceRouter = __DIR__ . '/app/routes/service-page-router.php';
if (file_exists($serviceRouter)) {
    ob_start();
    $result = require $serviceRouter;
    $output = ob_get_clean();
    if ($result !== false) {
        echo $output;
        exit;
    }
}

// Get the request URI and clean it
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request_uri = trim($request_uri, '/');

// Remove trailing slashes for consistency
$request_uri = rtrim($request_uri, '/');

// Route the request to the appropriate file
switch ($request_uri) {
    case '':
    case 'index':
    case 'index.php':
        // Homepage
        include __DIR__ . '/home.php';
        break;
        
    // Sitemap routes
    case 'sitemap.xml':
        include __DIR__ . '/sitemap-index.php';
        break;
    case 'sitemap-matrix.xml':
        include __DIR__ . '/sitemap-matrix.php';
        break;
    case 'sitemap-static.xml':
        include __DIR__ . '/sitemap-static.php';
        break;
    case 'sitemap-blog.xml':
        include __DIR__ . '/sitemap-blog.php';
        break;
        
    // API routes
    case 'api/chat.php':
    case 'api/chat':
        include __DIR__ . '/api/chat.php';
        break;
        
    case 'contact':
    case 'contact.php':
        include __DIR__ . '/contact.php';
        break;
    case 'contact-us':
        // Redirect /contact-us to /contact for canonical consistency
        header('Location: /contact', true, 301);
        exit;
        break;
        
    case 'home':
        // Redirect /home to / for canonical consistency
        header('Location: /', true, 301);
        exit;
        break;
        
    case 'products':
        // Redirect /products to /products/ or handle products page
        if (substr($__path, -1) !== '/') {
            header('Location: /products/', true, 301);
            exit;
        }
        // Fall through to default for now - products page should be handled by service router
        break;
        
    case 'services':
    case 'our-services':
        // Create a services page or redirect
        $pageTitle = "Our Services - Siding, Windows, Doors & More | Hoosier Cladding LLC";
        $pageDescription = "Comprehensive home improvement services including siding installation, window replacement, door installation, and painting in Northern Indiana.";
        include __DIR__ . '/partials/header.php';
        ?>
        <section class="hero">
            <div class="container w-full text-left">
                <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="h1">Our Services</h1>
                    <p class="lead">Comprehensive home improvement services in Northern Indiana.</p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container w-full text-left">
                <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <div class="card">
                            <h3 class="h3">Siding Services</h3>
                            <p>Professional siding installation, repair, and replacement.</p>
                            <a href="/siding" class="btn btn-outline">Learn More</a>
                        </div>
                        <div class="card">
                            <h3 class="h3">Window Replacement</h3>
                            <p>Energy-efficient window installation and replacement.</p>
                            <a href="/window-replacement-south-bend" class="btn btn-outline">Learn More</a>
                        </div>
                        <div class="card">
                            <h3 class="h3">Door Installation</h3>
                            <p>Entry doors, storm doors, and custom door solutions.</p>
                            <a href="/door-replacement-south-bend" class="btn btn-outline">Learn More</a>
                        </div>
                        <div class="card">
                            <h3 class="h3">Painting Services</h3>
                            <p>Interior and exterior painting with premium finishes.</p>
                            <a href="/painting-services-south-bend" class="btn btn-outline">Learn More</a>
                        </div>
                        <div class="card">
                            <h3 class="h3">Kitchen Renovation</h3>
                            <p>Complete kitchen remodeling and renovation services.</p>
                            <a href="/kitchen-renovation-south-bend" class="btn btn-outline">Learn More</a>
                        </div>
                        <div class="card">
                            <h3 class="h3">Cabinet Installation</h3>
                            <p>Custom cabinet design and professional installation.</p>
                            <a href="/cabinet-installation-south-bend" class="btn btn-outline">Learn More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include __DIR__ . '/partials/footer.php';
        break;
        
    case 'about-us':
        $pageTitle = "About Us - Hoosier Cladding LLC | Professional Siding Contractors";
        $pageDescription = "Learn about Hoosier Cladding LLC, your trusted siding contractors in Northern Indiana. Licensed, insured, and committed to quality craftsmanship.";
        include __DIR__ . '/partials/header.php';
        ?>
        <section class="hero">
            <div class="container w-full text-left">
                <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="h1">About Hoosier Cladding LLC</h1>
                    <p class="lead">Your trusted local experts for home improvement in Northern Indiana.</p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container w-full text-left">
                <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose prose-lg max-w-none">
                        <h2>Our Story</h2>
                        <p>Hoosier Cladding LLC is a locally owned and operated home improvement company serving Northern Indiana and Michiana. We specialize in siding installation, window replacement, door installation, and comprehensive home renovation services.</p>
                        <h2>Why Choose Us</h2>
                        <ul>
                            <li>Licensed and insured contractors</li>
                            <li>Years of local experience</li>
                            <li>Quality craftsmanship guaranteed</li>
                            <li>Free estimates and consultations</li>
                            <li>Customer satisfaction focused</li>
                        </ul>
                        <h2>Service Areas</h2>
                        <p>We proudly serve South Bend, Mishawaka, Elkhart, Granger, and throughout Michiana.</p>
                        <div class="mt-8">
                            <a href="/contact" class="btn btn-primary">Contact Us Today</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include __DIR__ . '/partials/footer.php';
        break;
        
    case 'our-results':
        $pageTitle = "Our Results - Before & After Gallery | Hoosier Cladding LLC";
        $pageDescription = "View our portfolio of completed siding, window, and home improvement projects in Northern Indiana. See the quality craftsmanship and results we deliver.";
        include __DIR__ . '/partials/header.php';
        ?>
        <section class="hero">
            <div class="container w-full text-left">
                <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="h1">Our Results & Portfolio</h1>
                    <p class="lead">See the quality craftsmanship and results we deliver.</p>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container w-full text-left">
                <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="prose prose-lg max-w-none">
                        <p>We're proud of the work we do and the results we achieve for our customers. Our portfolio showcases completed projects including siding installation, window replacement, door installation, and comprehensive home renovations throughout Northern Indiana.</p>
                        <p>Contact us today to see how we can transform your home.</p>
                        <div class="mt-8">
                            <a href="/contact" class="btn btn-primary">Get Your Free Estimate</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include __DIR__ . '/partials/footer.php';
        break;
        
    case 'service-area':
    case 'service-area.php':
        // Strict Entity Definition (Day 6 Rules)
        $pageTitle = "Service Areas for Siding Contractors in Northern Indiana | Hoosier Cladding";
        $pageDescription = "Hoosier Cladding provides siding installation and repair services across Northern Indiana. Service areas include South Bend, Plymouth, Warsaw, and Granger.";
        include __DIR__ . '/partials/header.php';
?>
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 max-w-3xl">
        <h1 class="text-3xl font-bold mb-6">Service Areas for Siding Contractors in Northern Indiana</h1>
        
        <div class="prose prose-lg text-gray-800 mb-8">
            <p>
                Hoosier Cladding provides siding installation, siding replacement, and siding repair services across Northern Indiana. All service areas listed below are locations where crews are actively dispatched for residential siding projects.
            </p>
        </div>

        <h2 class="text-2xl font-bold mb-4">Primary Service Areas</h2>
        <div class="mb-8">
            <ul class="list-none pl-0 space-y-2 text-lg">
                <li><a href="/siding-contractor-south-bend-in" class="text-blue-600 hover:underline">South Bend, IN</a></li>
                <li><a href="/siding-companies-plymouth-in" class="text-blue-600 hover:underline">Plymouth, IN</a></li>
                <li><a href="/siding-replacement-warsaw-indiana" class="text-blue-600 hover:underline">Warsaw, IN</a></li>
                <li><a href="/siding-contractor-granger-in" class="text-blue-600 hover:underline">Granger, IN</a></li>
            </ul>
        </div>

        <h2 class="text-2xl font-bold mb-4">Service Coverage Notes</h2>
        <div class="prose prose-lg text-gray-800 mb-8">
            <p>
                Service availability varies by project type, material, and scheduling. All estimates and inspections are based on confirmed service coverage within the listed cities and surrounding areas.
            </p>
        </div>
        
        <p class="mt-8 pt-8 border-t border-gray-200">
            Return to <a href="/" class="text-blue-600 hover:underline">siding contractor services</a>.
        </p>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "@id": "https://www.hoosiercladding.com/#localbusiness",
  "name": "Hoosier Cladding",
  "url": "https://www.hoosiercladding.com/",
  "areaServed": [
    {
      "@type": "City",
      "name": "South Bend",
      "address": { "@type": "PostalAddress", "addressRegion": "IN" }
    },
    {
      "@type": "City",
      "name": "Plymouth",
      "address": { "@type": "PostalAddress", "addressRegion": "IN" }
    },
    {
      "@type": "City",
      "name": "Warsaw",
      "address": { "@type": "PostalAddress", "addressRegion": "IN" }
    },
    {
      "@type": "City",
      "name": "Granger",
      "address": { "@type": "PostalAddress", "addressRegion": "IN" }
    }
  ]
}
</script>
<?php
        include __DIR__ . '/partials/footer.php';
        break;
        
    case 'siding':
    case 'siding-page':
    case 'siding-page.php':
        include __DIR__ . '/siding-page.php';
        break;

    case 'siding/repair':
    case 'siding/installation':
        header('Location: /siding', true, 301);
        exit;

    case 'siding/replacement':
        header('Location: /house-siding-replacement', true, 301);
        exit;

    case 'terms':
        $pageTitle = "Terms of Service | Hoosier Cladding LLC";
        $pageDescription = "Terms and conditions for using Hoosier Cladding LLC services.";
        include __DIR__ . '/partials/header.php';
?>
<section class="hero bg-white py-16">
    <div class="container mx-auto px-6 max-w-4xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-amber-400">Terms of Service</h1>
        <div class="prose prose-lg text-gray-700">
            <p class="mb-6">Welcome to Hoosier Cladding LLC. By accessing our website and using our services, you agree to comply with and be bound by the following terms and conditions.</p>
            <h2 class="text-2xl font-bold mb-4 text-gray-900">1. Services</h2>
            <p class="mb-6">Hoosier Cladding LLC provides professional siding, window installation, and general home exterior services in South Bend, IN and surrounding areas.</p>
            <h2 class="text-2xl font-bold mb-4 text-gray-900">2. Estimates</h2>
            <p class="mb-6">All project estimates are valid for 30 days. Final pricing may vary based on material costs and discovery during installation.</p>
            <h2 class="text-2xl font-bold mb-4 text-gray-900">3. Liability</h2>
            <p class="mb-6">Hoosier Cladding LLC is fully licensed and insured. We are responsible for property protection during our installation process.</p>
        </div>
    </div>
</section>
<?php
        include __DIR__ . '/partials/footer.php';
        break;

    case 'privacy':
        $pageTitle = "Privacy Policy | Hoosier Cladding LLC";
        include __DIR__ . '/partials/header.php';
?>
<section class="hero bg-white py-16">
    <div class="container mx-auto px-6 max-w-4xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-amber-400">Privacy Policy</h1>
        <div class="prose prose-lg text-gray-700">
            <p class="mb-6">Your privacy is important to us. It is Hoosier Cladding LLC's policy to respect your privacy regarding any information we may collect from you across our website.</p>
            <p class="mb-6">We only ask for personal information when we truly need it to provide a service to you. We collect it by fair and lawful means, with your knowledge and consent.</p>
        </div>
    </div>
</section>
<?php
        include __DIR__ . '/partials/footer.php';
        break;
        
    default:
        // Check if it's a matrix route
        // Check if it's a matrix route
        if (strpos($request_uri, 'matrix/') === 0) {
            require_once __DIR__ . '/matrix-router.php';
            routeMatrixPage();
        } else {
            // 404 - Page not found
            http_response_code(404);
            $pageTitle = "Page Not Found | Hoosier Cladding LLC";
            $pageDescription = "The page you're looking for could not be found.";
include __DIR__ . '/partials/header.php';
?>
<section class="hero">
                <div class="container">
                    <h1 class="h1">Page Not Found</h1>
                    <p class="lead">Sorry, the page you're looking for doesn't exist.</p>
    <div class="hero-cta">
                        <a class="btn btn-primary" href="/">Go Home</a>
                        <a class="btn btn-outline" href="/contact">Contact Us</a>
    </div>
  </div>
</section>
            <?php
            include __DIR__ . '/partials/footer.php';
        }
        break;
}
