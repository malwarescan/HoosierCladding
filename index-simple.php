<?php
// Simple fallback index.php for deployment testing
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoosier Cladding LLC - PHP Working!</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 40px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .success { color: #28a745; font-size: 24px; font-weight: bold; }
        .info { background: #e3f2fd; padding: 20px; border-radius: 5px; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hoosier Cladding LLC</h1>
        <p class="success">✅ PHP Deployment Successful!</p>
        
        <div class="info">
            <h3>PHP Information:</h3>
            <p><strong>PHP Version:</strong> <?= phpversion() ?></p>
            <p><strong>Server:</strong> <?= $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown' ?></p>
            <p><strong>Document Root:</strong> <?= $_SERVER['DOCUMENT_ROOT'] ?? 'Unknown' ?></p>
        </div>
        
        <h2>Professional Siding Services</h2>
        <p>Expert installation, repair, and replacement in South Bend, Mishawaka, Elkhart, and throughout Michiana.</p>
        
        <h3>Contact Information:</h3>
        <ul>
            <li><strong>Phone:</strong> (574) 931-2119</li>
            <li><strong>Email:</strong> david@hoosier.works</li>
            <li><strong>Service Areas:</strong> Northern Indiana, Michigan, Illinois</li>
        </ul>
        
        <h3>Services:</h3>
        <ul>
            <li>Siding Installation</li>
            <li>Siding Repair</li>
            <li>Siding Replacement</li>
            <li>Vinyl Siding</li>
            <li>Hardie Board Siding</li>
            <li>Fiber Cement Siding</li>
        </ul>
        
        <p><em>Licensed & Insured • Winter-Ready Installations • Local Crews Only</em></p>
    </div>
</body>
</html>
