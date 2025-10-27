<?php
/**
 * Front Controller / Router
 * Handles all incoming requests and routes them to the appropriate page
 */

// PRIORITY: Handle sitemaps FIRST (before any routing logic)
$__path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ($__path === '/sitemap.xml')        { require __DIR__ . '/sitemap-index.php';  exit; }
if ($__path === '/sitemap-static.xml') { require __DIR__ . '/sitemap-static.php'; exit; }
if ($__path === '/sitemap-blog.xml')   { require __DIR__ . '/sitemap-blog.php';   exit; }
if ($__path === '/sitemap-matrix.xml') { require __DIR__ . '/sitemap-matrix.php'; exit; }
// Also handle numbered matrix sitemaps
if (preg_match('#^/sitemap-matrix-(\d+)\.xml$#', $__path, $m)) {
    $file = __DIR__ . '/public/sitemap-matrix-' . $m[1] . '.xml';
    if (file_exists($file)) {
        header('Content-Type: application/xml; charset=UTF-8');
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
        
    case 'service-area':
    case 'service-area.php':
        include __DIR__ . '/service-area.php';
        break;
        
    case 'siding':
    case 'siding-page':
    case 'siding-page.php':
        include __DIR__ . '/siding-page.php';
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
