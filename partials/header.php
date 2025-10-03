<?php
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
$ADDRESS = '721 Lincoln Way E, South Bend, IN 46601';
$SITE = 'Hoosier Cladding LLC';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Professional Siding Services in Northern Indiana | ' . $SITE ?></title>
    <meta name="description" content="<?= $pageDescription ?? 'Expert siding installation, repair, and replacement in South Bend, Mishawaka, Elkhart, and throughout Michiana. Licensed & insured. Winter-ready installations. Call 574-931-2119 for a free estimate.' ?>">
    <link rel="canonical" href="https://www.hoosiercladding.com<?= $pagePath ?? '' ?>">
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
</head>
<body class="bg-blue-50 text-gray-900">
    <header class="bg-white shadow-md border-b-2 border-blue-100">
        <div class="container mx-auto px-6 py-3">
            <div class="flex flex-col lg:flex-row justify-between items-center">
                <div class="mb-4 lg:mb-0">
                    <a href="/" class="navbar-brand">
                        <img src="/public/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp" alt="Hoosier Cladding LLC" class="navbar-logo">
                        <span class="navbar-brand-text"><?= $SITE ?></span>
                    </a>
                </div>
                <div class="navbar-contact">
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="navbar-phone">
                        <?= $PHONE ?>
                    </a>
                    <a href="mailto:<?= $EMAIL ?>" class="navbar-email">
                        <?= $EMAIL ?>
                    </a>
                </div>
            </div>
            
            <nav class="navbar-nav">
                <ul class="flex flex-wrap justify-center lg:justify-start gap-8">
                    <li><a href="/" class="nav-link">Home</a></li>
                    <li><a href="/service-area" class="nav-link">Service Area</a></li>
                    <li><a href="/contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main class="container mx-auto px-6 py-12">