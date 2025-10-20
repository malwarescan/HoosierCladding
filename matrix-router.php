<?php
/**
 * Matrix Landing Page Router
 * 
 * Routes requests to programmatic landing pages from convex_matrix_expanded.csv
 * Handles URLs like: /matrix/{city-slug}/{service-slug}/{pain-slug}
 * 
 * Integration: Add this to your .htaccess or main router
 */

declare(strict_types=1);

// Load dependencies
require_once __DIR__ . '/includes/schema_renderer.php';
require_once __DIR__ . '/includes/html_layout.php';

/**
 * Load CSV data once and cache it
 */
class MatrixDataLoader {
    private static $data = null;
    private static $csvPath = __DIR__ . '/data_matrix/convex_matrix_expanded.csv';
    
    public static function loadAll(): array {
        if (self::$data !== null) {
            return self::$data;
        }
        
        self::$data = [];
        
        if (!file_exists(self::$csvPath)) {
            error_log("Matrix CSV not found at: " . self::$csvPath);
            return self::$data;
        }
        
        $handle = fopen(self::$csvPath, 'r');
        $headers = fgetcsv($handle, 0, ',', '"', '');
        
        // Clean headers
        $headers = array_map('trim', $headers);
        
        while (($row = fgetcsv($handle, 0, ',', '"', '')) !== false) {
            if (count($row) === count($headers)) {
                $data = array_combine($headers, $row);
                
                // Index by slug for fast lookup
                if (!empty($data['slug'])) {
                    self::$data[trim($data['slug'])] = $data;
                }
            }
        }
        
        fclose($handle);
        return self::$data;
    }
    
    public static function findBySlug(string $slug): ?array {
        $allData = self::loadAll();
        return $allData[$slug] ?? null;
    }
}

/**
 * Route the request and render the page
 */
function routeMatrixPage(): void {
    // Parse URL
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    
    // Remove 'matrix/' prefix if present
    $slug = preg_replace('#^matrix/#', '', $uri);
    
    // Load the row data
    $row = MatrixDataLoader::findBySlug($slug);
    
    if (!$row) {
        // Try fuzzy matching for near-miss URLs
        require_once __DIR__.'/app/lib/MatrixIndex.php';
        $idx = new MatrixIndex(__DIR__.'/data_matrix/convex_matrix_expanded.csv');
        
        // Parse slug into service and location parts
        $parts = explode('/', $slug);
        if (count($parts) >= 2) {
            $serviceSlug = $parts[count($parts) - 2];
            $locSlug = $parts[count($parts) - 1];
            
            $nearMatch = $idx->nearest($serviceSlug, $locSlug);
            if ($nearMatch && isset($nearMatch['url'])) {
                // 301 redirect to the canonical URL
                header('Location: '.$nearMatch['url'], true, 301);
                exit;
            }
        }
        
        // No match found, return 404
        http_response_code(404);
        include __DIR__ . '/partials/404.php';
        return;
    }
    
    // Make row data available globally for schema injection
    $GLOBALS['matrix_row'] = $row;
    
    // Render the page
    renderMatrixLandingPage($row);
}

/**
 * Render a complete landing page from CSV data
 */
function renderMatrixLandingPage(array $row): void {
    // Extract common variables
    $pageTitle = $row['seo_title'] ?? 'Service';
    $metaDesc = $row['meta_description'] ?? '';
    $h1 = $row['h1'] ?? $pageTitle;
    $location = $row['location'] ?? '';
    $brandName = $row['brand_name'] ?? 'Hoosier Cladding';
    $phone = $row['contact_phone'] ?? '+1 574-555-0123';
    $email = $row['contact_email'] ?? 'info@hoosiercladding.com';
    $primaryKeyword = $row['primary_keyword'] ?? 'Service';
    $painPoint = $row['pain_point'] ?? '';
    
    // Build breadcrumbs
    $breadcrumbs = [
        ['href' => '/', 'label' => 'Home'],
    ];
    
    if (!empty($location)) {
        $breadcrumbs[] = ['href' => '#', 'label' => $location];
    }
    if (!empty($primaryKeyword)) {
        $breadcrumbs[] = ['href' => '#', 'label' => $primaryKeyword];
    }
    
    // Start output
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDesc, ENT_QUOTES) ?>">
    
    <?php
    // Canonical URL and robots meta
    if (function_exists('canonicalTag')) {
        $canonicalUrl = 'https://www.hoosiercladding.com' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        canonicalTag($canonicalUrl);
    }
    if (function_exists('robotsHeader')) {
        robotsHeader(true); // index,follow
    }
    ?>
    
    <!-- JSON-LD injected via app/bootstrap/head_injector.php for matrix pages -->
    
    <?php /* JSON-LD is injected by the global header include on matrix pages */ ?>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="/public/styles/output.css">
</head>
<body>

<!-- Header -->
<?php include __DIR__ . '/partials/header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="hero hero--compact">
        <div class="container">
            <!-- Breadcrumbs -->
            <?= HtmlLayout\breadcrumbs($breadcrumbs) ?>
            
            <!-- H1 -->
            <h1 class="h1"><?= htmlspecialchars($h1, ENT_QUOTES) ?></h1>
            
            <!-- Intro Block -->
            <?= HtmlLayout\introBlock($row) ?>
        </div>
    </section>
    
    <!-- Main Content -->
    <section class="section">
        <div class="container">
            <div class="grid grid-2">
                <div>
                    <h2 class="h2">Professional <?= htmlspecialchars($primaryKeyword, ENT_QUOTES) ?></h2>
                    <p><?= htmlspecialchars($metaDesc, ENT_QUOTES) ?></p>
                    
                    <?php if (!empty($painPoint)): ?>
                    <div class="callout callout--info">
                        <h3 class="h3">Solving <?= htmlspecialchars($painPoint, ENT_QUOTES) ?></h3>
                        <p>
                            We understand the challenges of <?= htmlspecialchars(strtolower($painPoint), ENT_QUOTES) ?>. 
                            Our expert team in <?= htmlspecialchars($location, ENT_QUOTES) ?> has the experience 
                            and tools to address this issue effectively.
                        </p>
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="h3">Why Choose <?= htmlspecialchars($brandName, ENT_QUOTES) ?>?</h3>
                    <ul class="checklist">
                        <li>Licensed & insured professionals</li>
                        <li>Free inspections and estimates</li>
                        <li>Fast turnaround times</li>
                        <li>Durable, high-quality materials</li>
                        <li>Local expertise in <?= htmlspecialchars($location, ENT_QUOTES) ?></li>
                    </ul>
                </div>
                
                <div>
                    <!-- Contact Card -->
                    <div class="card card--primary">
                        <h3 class="h3">Get Your Free Estimate</h3>
                        <p>Ready to solve your siding issues? Contact us today.</p>
                        <div class="contact-info">
                            <p><strong>Phone:</strong> <a href="tel:<?= str_replace(['+', ' ', '-', '(', ')'], '', $phone) ?>"><?= htmlspecialchars($phone, ENT_QUOTES) ?></a></p>
                            <p><strong>Email:</strong> <a href="mailto:<?= htmlspecialchars($email, ENT_QUOTES) ?>"><?= htmlspecialchars($email, ENT_QUOTES) ?></a></p>
                        </div>
                        <a href="/contact.php" class="btn btn-primary btn-block">Request Estimate</a>
                    </div>
                    
                    <!-- Trust Signals -->
                    <div class="trust-chips">
                        <span class="chip">Licensed & Insured</span>
                        <span class="chip">Free Inspections</span>
                        <span class="chip">Local Crews</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section (Required for FAQPage schema compliance) -->
    <section class="section section--gray">
        <div class="container">
            <h2 class="h2">Frequently Asked Questions</h2>
            <?= HtmlLayout\faqFromRow($row) ?>
        </div>
    </section>
    
    <!-- CTA Strip -->
    <section class="section section--cta">
        <div class="container">
            <h2 class="h2">Ready to Get Started?</h2>
            <p class="lead">
                Contact <?= htmlspecialchars($brandName, ENT_QUOTES) ?> today for professional 
                <?= htmlspecialchars(strtolower($primaryKeyword), ENT_QUOTES) ?> in <?= htmlspecialchars($location, ENT_QUOTES) ?>.
            </p>
            <div class="btn-group">
                <a href="tel:<?= str_replace(['+', ' ', '-', '(', ')'], '', $phone) ?>" class="btn btn-primary">
                    Call Now
                </a>
                <a href="/contact.php" class="btn btn-outline">
                    Request Estimate
                </a>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<?php include __DIR__ . '/partials/footer.php'; ?>

</body>
</html>
    <?php
}

// If accessed directly, route the request
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    routeMatrixPage();
}

