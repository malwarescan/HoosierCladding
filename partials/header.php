<?php
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
$ADDRESS = '721 Lincoln Way E, South Bend, IN 46601';
$SITE = 'Hoosier Cladding LLC';

// Load MetaManager for CTR-optimized titles/descriptions
require_once __DIR__ . '/../app/lib/MetaManager.php';
require_once __DIR__ . '/../app/lib/schema.php';

$reqPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$defaultTitle = isset($pageTitle) ? $pageTitle : 'Professional Siding Services in Northern Indiana | ' . $SITE;
$defaultDesc  = isset($pageDescription) ? $pageDescription : 'Expert siding installation, repair, and replacement in South Bend, Mishawaka, Elkhart, and throughout Michiana. Licensed & insured. Winter-ready installations. Call 574-931-2119 for a free estimate.';
$finalTitle = MetaManager::title($reqPath, $defaultTitle);
$finalDesc  = MetaManager::description($reqPath, $defaultDesc);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($finalTitle, ENT_QUOTES) ?></title>
    <meta name="description" content="<?= htmlspecialchars($finalDesc, ENT_QUOTES) ?>">
    <meta name="robots" content="index,follow">
    <link rel="canonical" href="<?= MetaManager::canonical($reqPath) ?>">
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#111111">
    
    <!-- Tailwind core (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Preline UI CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline@2.3.0/dist/preline.min.css">
    
    <!-- Construction Blue Theme Overrides -->
    <link rel="stylesheet" href="/css/preline-theme-overrides.css">
    
    <!-- Site CSS -->
    <link rel="stylesheet" href="/styles/output.css">
    
    <script type="application/ld+json">{
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "https://www.hoosiercladding.com#org",
                "name": "<?= $SITE ?>",
                "url": "https://www.hoosiercladding.com",
                "logo": "https://www.hoosiercladding.com/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp",
                "email": "<?= $EMAIL ?>",
                "telephone": "<?= $PHONE ?>",
                "contactPoint": [{
                    "@type": "ContactPoint",
                    "contactType": "sales",
                    "telephone": "<?= $PHONE ?>",
                    "email": "<?= $EMAIL ?>",
                    "availableLanguage": ["en"]
                }],
                "location": [{"@id": "https://www.hoosiercladding.com#office"}]
            },
            {
                "@type": "LocalBusiness",
                "@id": "https://www.hoosiercladding.com#business",
                "name": "<?= $SITE ?>",
                "url": "https://www.hoosiercladding.com",
                "telephone": "<?= $PHONE ?>",
                "email": "<?= $EMAIL ?>",
                "address": {
                    "@type": "PostalAddress",
                    "@id": "https://www.hoosiercladding.com#office",
                    "streetAddress": "721 Lincoln Way E",
                    "addressLocality": "South Bend",
                    "addressRegion": "IN",
                    "postalCode": "46601",
                    "addressCountry": "US"
                },
                "areaServed": [
                    {"@type": "City", "name": "South Bend", "containedInPlace": {"@type": "State", "name": "Indiana"}},
                    {"@type": "City", "name": "Mishawaka", "containedInPlace": {"@type": "State", "name": "Indiana"}},
                    {"@type": "City", "name": "Elkhart", "containedInPlace": {"@type": "State", "name": "Indiana"}},
                    {"@type": "City", "name": "Granger", "containedInPlace": {"@type": "State", "name": "Indiana"}},
                    {"@type": "City", "name": "Niles", "containedInPlace": {"@type": "State", "name": "Michigan"}},
                    {"@type": "City", "name": "Osceola", "containedInPlace": {"@type": "State", "name": "Indiana"}}
                ],
                "hasOfferCatalog": {
                    "@type": "OfferCatalog",
                    "name": "Siding Installation and Repair Services",
                    "itemListElement": [
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Siding Installation",
                                "description": "Professional siding installation for residential and commercial properties"
                            }
                        },
                        {
                            "@type": "Offer", 
                            "itemOffered": {
                                "@type": "Service",
                                "name": "Siding Repair",
                                "description": "Expert siding repair services for storm damage and wear"
                            }
                        },
                        {
                            "@type": "Offer",
                            "itemOffered": {
                                "@type": "Service", 
                                "name": "Siding Replacement",
                                "description": "Complete siding replacement with premium materials"
                            }
                        }
                    ]
                },
                "serviceType": "Siding Installation and Repair",
                "description": "Professional siding services in Northern Indiana, specializing in energy-efficient installations for harsh winter climates"
            },
            {
                "@type": "Dataset",
                "name": "Hoosier Cladding Product Schema Feed",
                "description": "NDJSON feed containing 1,200 James Hardie product schemas optimized for LLM indexing, AI retrieval, and structured data ingestion",
                "distribution": {
                    "@type": "DataDownload",
                    "contentUrl": "https://www.hoosiercladding.com/feeds/products.ndjson",
                    "encodingFormat": "application/x-ndjson",
                    "schemaVersion": "https://schema.org",
                    "about": "https://www.hoosiercladding.com/products/"
                },
                "keywords": ["James Hardie", "fiber cement siding", "product schema", "NDJSON", "structured data"],
                "provider": {
                    "@type": "Organization",
                    "name": "Hoosier Cladding LLC",
                    "url": "https://www.hoosiercladding.com"
                }
            }
        ]
    }</script>
    
    <!-- WebSite JSON-LD with favicon image hint -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "url": "https://www.hoosiercladding.com/",
        "name": "Hoosier Cladding",
        "image": "https://www.hoosiercladding.com/favicon-32x32.png",
        "inLanguage": "en"
    }
    </script>
    
    <?php 
    // Inject dynamic JSON-LD schema for matrix pages
    $head_injector_path = __DIR__ . '/../app/bootstrap/head_injector.php';
    if (file_exists($head_injector_path)) {
        require_once $head_injector_path;
    }
    
    // Inject FAQ structured data from GSC snippets ONLY for non-matrix pages without existing FAQ
    // Skip if we're on a matrix page (head_injector already handles FAQ) or homepage (has inline FAQ)
    if (!Schema::isMatrixRoute($reqPath) && $reqPath !== '/') {
        $slug = trim($reqPath, '/') ?: 'home';
        $faqPath = __DIR__ . '/../outputs/snippets/' . $slug . '/faq.jsonld';
        if (file_exists($faqPath)) {
            $faqJson = file_get_contents($faqPath);
            echo '<script type="application/ld+json">' . $faqJson . '</script>' . PHP_EOL;
        }
    }
    ?>
</head>
<body class="bg-blue-50 text-gray-900">
    <header class="sticky top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
        <nav class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo/Brand -->
                <div class="flex items-center gap-x-3">
                    <a href="/" class="flex items-center gap-x-3 group">
                        <img src="/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp" alt="Hoosier Cladding LLC" class="h-10 lg:h-12 w-auto">
                        <span class="hidden sm:block text-lg lg:text-xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200"><?= $SITE ?></span>
                    </a>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center gap-x-8">
                    <a href="/" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors duration-200">Home</a>
                    <a href="/service-area" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors duration-200">Service Area</a>
                    <a href="/contact" class="text-sm font-semibold text-gray-700 hover:text-blue-600 transition-colors duration-200">Contact</a>
                </div>
                
                <!-- Desktop Contact -->
                <div class="hidden lg:flex items-center gap-x-4">
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="inline-flex items-center gap-x-2 text-sm font-semibold text-blue-600 hover:text-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <?= $PHONE ?>
                    </a>
                    <a href="mailto:<?= $EMAIL ?>" class="inline-flex items-center gap-x-2 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Email Us
                    </a>
                </div>
                
                <!-- Mobile menu button -->
                <button type="button" class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-600" onclick="toggleMobileMenu()" aria-label="Toggle navigation menu">
                    <svg class="w-6 h-6" id="menuIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="w-6 h-6 hidden" id="closeIcon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Mobile menu -->
            <div class="hidden lg:hidden border-t border-gray-200" id="mobileMenu">
                <div class="py-4 space-y-1">
                    <a href="/" class="block px-4 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">Home</a>
                    <a href="/service-area" class="block px-4 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">Service Area</a>
                    <a href="/contact" class="block px-4 py-3 text-base font-semibold text-gray-700 hover:bg-gray-50 hover:text-blue-600 transition-colors duration-200">Contact</a>
                    
                    <div class="pt-4 pb-2 px-4 space-y-3 border-t border-gray-200 mt-4">
                        <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="flex items-center gap-x-3 text-sm font-semibold text-blue-600 hover:text-blue-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <?= $PHONE ?>
                        </a>
                        <a href="mailto:<?= $EMAIL ?>" class="flex items-center gap-x-3 px-4 py-3 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email Us
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }
    </script>
    
    <main class="container mx-auto px-6 py-12">