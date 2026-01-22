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
    // Use AdvancedMetaManager for unique metadata
    require_once __DIR__ . '/app/lib/AdvancedMetaManager.php';
    
    // Get current path
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri = trim($uri, '/');
    
    // Generate unique metadata
    $pageType = 'matrix';
    $pageContext = [
        'location' => $row['location'] ?? '',
        'primary_keyword' => $row['primary_keyword'] ?? '',
        'pain_point' => $row['pain_point'] ?? '',
        'slug' => $row['slug'] ?? ''
    ];
    $pageTitle = AdvancedMetaManager::generateTitle($uri, $pageType, $pageContext);
    $metaDesc = AdvancedMetaManager::generateDescription($uri, $pageType, $pageContext);
    
    // Extract common variables
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
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#111111">
    
    <!-- JSON-LD injected via app/bootstrap/head_injector.php for matrix pages -->
    
    <?php /* JSON-LD is injected by the global header include on matrix pages */ ?>
    
    <!-- Tailwind core (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Preline UI CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline@2.3.0/dist/preline.min.css">
    
    <!-- Construction Blue Theme Overrides -->
    <link rel="stylesheet" href="/public/css/preline-theme-overrides.css">
    
    <!-- Site CSS -->
    <link rel="stylesheet" href="/public/styles/output.css">
</head>
<body class="bg-blue-50 text-gray-900">

<!-- Header -->
<?php include __DIR__ . '/partials/header.php'; ?>

<main>
    <!-- Hero Section -->
    <section class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100 border-b border-gray-200">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumbs -->
            <nav class="mb-6 text-sm text-gray-600">
                <?php foreach ($breadcrumbs as $i => $crumb): ?>
                    <a href="<?= htmlspecialchars($crumb['href'], ENT_QUOTES) ?>" class="hover:text-blue-600">
                        <?= htmlspecialchars($crumb['label'], ENT_QUOTES) ?>
                    </a>
                    <?php if ($i < count($breadcrumbs) - 1): ?> › <?php endif; ?>
                <?php endforeach; ?>
            </nav>
            
            <!-- H1 -->
            <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 mb-6">
                <?= htmlspecialchars($h1, ENT_QUOTES) ?>
            </h1>
            
            <!-- Intro Block -->
            <p class="text-lg text-gray-700 mb-6">
                <?= htmlspecialchars($brandName, ENT_QUOTES) ?> – <?= htmlspecialchars($primaryKeyword, ENT_QUOTES) ?> in <?= htmlspecialchars($location, ENT_QUOTES) ?>
                <?php if (!empty($painPoint)): ?>
                    to address <strong><?= htmlspecialchars($painPoint, ENT_QUOTES) ?></strong>
                <?php endif; ?>
            </p>
            
            <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-4 text-white font-semibold hover:bg-blue-700 hover:text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                Get Started
            </button>
        </div>
    </section>
    
    <!-- Main Content -->
    <section class="py-16 bg-white">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Professional <?= htmlspecialchars($primaryKeyword, ENT_QUOTES) ?></h2>
                    <p class="text-lg text-gray-700 mb-6"><?= htmlspecialchars($metaDesc, ENT_QUOTES) ?></p>
                    
                    <?php if (!empty($painPoint)): ?>
                    <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-lg mb-8">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">Solving <?= htmlspecialchars($painPoint, ENT_QUOTES) ?></h3>
                        <p class="text-gray-700">
                            We understand the challenges of <?= htmlspecialchars(strtolower($painPoint), ENT_QUOTES) ?>. 
                            Our expert team in <?= htmlspecialchars($location, ENT_QUOTES) ?> has the experience 
                            and tools to address this issue effectively.
                        </p>
                    </div>
                    <?php endif; ?>
                    
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Why Choose <?= htmlspecialchars($brandName, ENT_QUOTES) ?>?</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Licensed & insured professionals</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Free inspections and estimates</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Fast turnaround times</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Durable, high-quality materials</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            <span class="text-gray-700">Local expertise in <?= htmlspecialchars($location, ENT_QUOTES) ?></span>
                        </li>
                    </ul>
                </div>
                
                <div>
                    <!-- Contact Card -->
                    <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 shadow-lg">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Get Your Free Estimate</h3>
                        <p class="text-gray-700 mb-6">Ready to solve your siding issues? Contact us today.</p>
                        <div class="space-y-3 mb-6">
                            <p class="text-gray-700">
                                <strong>Phone:</strong> 
                                <a href="tel:<?= str_replace(['+', ' ', '-', '(', ')'], '', $phone) ?>" class="text-blue-600 hover:text-blue-800">
                                    <?= htmlspecialchars($phone, ENT_QUOTES) ?>
                                </a>
                            </p>
                            <p class="text-gray-700">
                                <strong>Email:</strong> 
                                <a href="mailto:<?= htmlspecialchars($email, ENT_QUOTES) ?>" class="text-blue-600 hover:text-blue-800">
                                    <?= htmlspecialchars($email, ENT_QUOTES) ?>
                                </a>
                            </p>
                        </div>
                        <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center w-full rounded-lg bg-blue-600 px-8 py-4 text-white font-semibold hover:bg-blue-700 hover:text-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                            Request Estimate
                        </button>
                    </div>
                    
                    <!-- Trust Signals -->
                    <div class="flex flex-wrap gap-3 mt-6">
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Licensed & Insured
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.lu-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Free Inspections
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                            Local Crews
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- FAQ Section (Required for FAQPage schema compliance) -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Frequently Asked Questions</h2>
            <div class="space-y-4">
                <?php
                $hasFaq = false;
                for($i=1;$i<=6;$i++){
                    $q=trim($row["faq_q$i"]??''); $a=trim($row["faq_a$i"]??'');
                    if($q && $a){
                        $hasFaq=true;
                        echo "<details class='bg-white rounded-lg p-6 shadow-sm'>";
                        echo "<summary class='font-semibold text-gray-900 cursor-pointer'>".htmlspecialchars($q,ENT_QUOTES)."</summary>";
                        echo "<p class='mt-4 text-gray-700'>".htmlspecialchars($a,ENT_QUOTES)."</p>";
                        echo "</details>";
                    }
                }
                if (!$hasFaq) {
                    echo "<p class='text-gray-600'>No FAQs available at this time.</p>";
                }
                ?>
            </div>
        </div>
    </section>
    
    <!-- CTA Strip -->
    <section class="py-16 bg-blue-600">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Contact <?= htmlspecialchars($brandName, ENT_QUOTES) ?> today for professional 
                <?= htmlspecialchars(strtolower($primaryKeyword), ENT_QUOTES) ?> in <?= htmlspecialchars($location, ENT_QUOTES) ?>.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-4 text-blue-600 font-semibold hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl">
                    Call Now
                </button>
                <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center rounded-lg border-2 border-white px-8 py-4 text-white font-semibold hover:bg-white hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all duration-200">
                    Request Estimate
                </button>
            </div>
        </div>
    </section>
    
    <!-- Authority Hierarchy: Matrix Page Links UP to ONE Parent Service Page -->
    <?php
    // Determine parent service page based on matrix page content
    $parentUrl = null;
    $parentAnchor = null;
    $slug = $row['url'] ?? '';
    
    // Extract service type from slug or primary keyword
    $serviceType = strtolower($primaryKeyword ?? '');
    $slugLower = strtolower($slug);
    
    // Map matrix pages to parent service pages
    if (strpos($slugLower, 'siding-replacement') !== false || 
        strpos($serviceType, 'siding replacement') !== false ||
        strpos($serviceType, 'replacement') !== false) {
        $parentUrl = '/house-siding-replacement';
        $parentAnchor = 'house siding replacement';
    } elseif (strpos($slugLower, 'vinyl-siding') !== false || 
              strpos($serviceType, 'vinyl') !== false) {
        $parentUrl = '/vinyl-siding-michiana-south-bend';
        $parentAnchor = 'vinyl siding installation';
    } elseif (strpos($slugLower, 'storm-damage') !== false || 
              strpos($slugLower, 'hail-wind-damage') !== false ||
              strpos($slugLower, 'insurance-claim') !== false ||
              strpos($serviceType, 'storm') !== false ||
              strpos($serviceType, 'hail') !== false ||
              strpos($serviceType, 'wind') !== false) {
        $parentUrl = '/storm-damage-siding-repair';
        $parentAnchor = 'storm damage siding repair in Northern Indiana';
    }
    
    // Only show parent link if we have a valid parent
    if ($parentUrl && $parentAnchor):
    ?>
    <section class="py-16 bg-gray-50 border-t border-gray-200">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white border border-gray-200 rounded-xl p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Professional <?= htmlspecialchars($primaryKeyword, ENT_QUOTES) ?> Services</h2>
                <p class="text-gray-700 mb-6">
                    For comprehensive <?= htmlspecialchars(strtolower($primaryKeyword), ENT_QUOTES) ?> services across Northern Indiana, visit our main service page:
                </p>
                <a href="<?= htmlspecialchars($parentUrl, ENT_QUOTES) ?>" 
                   class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold text-lg">
                    <span><?= htmlspecialchars($parentAnchor, ENT_QUOTES) ?></span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    <?php endif; ?>
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

