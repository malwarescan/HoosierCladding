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
    <link rel="stylesheet" href="/styles/output.css">
    <script type="application/ld+json">{
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "<?= $SITE ?>",
        "url": "https://www.hoosiercladding.com",
        "telephone": "<?= $PHONE ?>",
        "email": "<?= $EMAIL ?>",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "721 Lincoln Way E",
            "addressLocality": "South Bend",
            "addressRegion": "IN",
            "postalCode": "46601",
            "addressCountry": "US"
        },
        "areaServed": [
            "South Bend, IN",
            "Mishawaka, IN", 
            "Elkhart, IN",
            "Granger, IN"
        ],
        "serviceType": "Siding Installation and Repair",
        "description": "Professional siding services in Northern Indiana"
    }</script>
    <script>
        function toggleNavbar() {
            const navbarCollapse = document.getElementById('navbarSupportedContent');
            navbarCollapse.classList.toggle('show');
        }
    </script>
</head>
<body class="bg-blue-50 text-gray-900">
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp" alt="<?= $SITE ?>" class="navbar-logo">
                <span class="navbar-brand-text"><?= $SITE ?></span>
            </a>
            
            <button class="navbar-toggler" type="button" onclick="toggleNavbar()" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/service-area">Service Area</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Contact</a>
                    </li>
                </ul>
                
                <div class="navbar-contact">
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="navbar-phone">
                        <?= $PHONE ?>
                    </a>
                    <a href="mailto:<?= $EMAIL ?>" class="navbar-email">
                        <?= $EMAIL ?>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    
    <main class="container py-12">