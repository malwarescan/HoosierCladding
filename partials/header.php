<?php
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
$ADDRESS = '721 Lincoln Way E, South Bend, IN 46601';
$SITE = 'Hoosier Cladding LLC';

// Load MetaManager for CTR-optimized titles/descriptions
require_once __DIR__ . '/../app/lib/MetaManager.php';

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
    <link rel="canonical" href="https://www.hoosiercladding.com<?= $pagePath ?? '' ?>">
    
    <!-- Tailwind core (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Preline UI CSS (CDN) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/preline@2.3.0/dist/preline.min.css">
    
    <!-- Construction Blue Theme Overrides -->
    <link rel="stylesheet" href="/public/css/preline-theme-overrides.css">
    
    <!-- Site CSS -->
    <link rel="stylesheet" href="/public/styles/output.css">
    
    <script type="application/ld+json">{
        "@context": "https://schema.org",
        "@graph": [
            {
                "@type": "Organization",
                "@id": "https://www.hoosiercladding.com#org",
                "name": "<?= $SITE ?>",
                "url": "https://www.hoosiercladding.com",
                "logo": "https://www.hoosiercladding.com/public/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp",
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
            }
        ]
    }</script>
    <?php 
    // Inject dynamic JSON-LD schema for matrix pages
    $head_injector_path = __DIR__ . '/../app/bootstrap/head_injector.php';
    if (file_exists($head_injector_path)) {
        require_once $head_injector_path;
    }
    ?>
</head>
<body class="bg-blue-50 text-gray-900">
    <header class="bg-white shadow-md border-b-2 border-blue-100">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <a href="/">
                        <img src="/public/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp" alt="Hoosier Cladding LLC" class="navbar-logo">
                        <span class="navbar-brand-text"><?= $SITE ?></span>
                    </a>
                </div>
                
                <div class="navbar-nav">
                    <ul class="nav-list">
                        <li><a href="/" class="nav-link">Home</a></li>
                        <li><a href="/service-area" class="nav-link">Service Area</a></li>
                        <li><a href="/contact" class="nav-link">Contact</a></li>
                    </ul>
                </div>
                
                <div class="navbar-contact">
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="navbar-phone">
                        <?= $PHONE ?>
                    </a>
                    <a href="mailto:<?= $EMAIL ?>" class="navbar-email">
                        <?= $EMAIL ?>
                    </a>
                </div>
                
                <!-- Mobile menu toggle -->
                <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
            
            <!-- Mobile menu -->
            <div class="mobile-menu" id="mobileMenu">
                <ul class="mobile-nav-list">
                    <li><a href="/" class="mobile-nav-link">Home</a></li>
                    <li><a href="/service-area" class="mobile-nav-link">Service Area</a></li>
                    <li><a href="/contact" class="mobile-nav-link">Contact</a></li>
                </ul>
            </div>
        </nav>
    </header>
    
    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('active');
        }
    </script>
    
    <main class="container mx-auto px-6 py-12">