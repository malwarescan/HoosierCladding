<?php
/**
 * Example Matrix Landing Page Template
 * 
 * This demonstrates how to use the schema_renderer and html_layout
 * modules with your 10,500-row CSV matrix data.
 * 
 * Usage:
 *   1. Load a row from convex_matrix_expanded.csv
 *   2. Pass the row data to SchemaRenderer\render() for JSON-LD
 *   3. Pass the row data to HtmlLayout functions for on-page content
 */

declare(strict_types=1);

// Load the modules
require_once __DIR__ . '/schema_renderer.php';
require_once __DIR__ . '/html_layout.php';

// Example: Load CSV row by URL slug
function loadMatrixRow(string $slug): ?array {
    $csvPath = __DIR__ . '/../data_matrix/convex_matrix_expanded.csv';
    
    if (!file_exists($csvPath)) {
        return null;
    }
    
    $handle = fopen($csvPath, 'r');
    $headers = fgetcsv($handle);
    
    // Trim headers to remove whitespace
    $headers = array_map('trim', $headers);
    
    while (($row = fgetcsv($handle)) !== false) {
        if (count($row) === count($headers)) {
            $data = array_combine($headers, $row);
            
            // Match by slug column
            if (isset($data['slug']) && trim($data['slug']) === $slug) {
                fclose($handle);
                return $data;
            }
        }
    }
    
    fclose($handle);
    return null;
}

// Example: Render a landing page
function renderMatrixPage(string $slug): void {
    $row = loadMatrixRow($slug);
    
    if (!$row) {
        http_response_code(404);
        echo "Page not found";
        return;
    }
    
    // Set meta tags
    $pageTitle = $row['seo_title'] ?? 'Service Page';
    $metaDescription = $row['meta_description'] ?? '';
    
    // Build breadcrumbs array
    $breadcrumbs = [
        ['href' => '/', 'label' => 'Home'],
        ['href' => '#', 'label' => $row['location'] ?? 'Location'],
        ['href' => '#', 'label' => $row['primary_keyword'] ?? 'Service']
    ];
    
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= htmlspecialchars($pageTitle, ENT_QUOTES) ?></title>
        <meta name="description" content="<?= htmlspecialchars($metaDescription, ENT_QUOTES) ?>">
        
        <!-- Schema.org JSON-LD -->
        <?= SchemaRenderer\render($row) ?>
        
        <!-- Your stylesheets -->
        <link rel="stylesheet" href="/public/styles/output.css">
    </head>
    <body>
        <!-- Include your header -->
        <?php include __DIR__ . '/../partials/header.php'; ?>
        
        <main class="container">
            <!-- Breadcrumbs -->
            <?= HtmlLayout\breadcrumbs($breadcrumbs) ?>
            
            <!-- H1 -->
            <h1><?= htmlspecialchars($row['h1'] ?? $pageTitle, ENT_QUOTES) ?></h1>
            
            <!-- Intro block with CTA -->
            <?= HtmlLayout\introBlock($row) ?>
            
            <!-- Main content -->
            <section class="content">
                <h2>About This Service</h2>
                <p><?= htmlspecialchars($metaDescription, ENT_QUOTES) ?></p>
                
                <!-- Pain point messaging -->
                <?php if (!empty($row['pain_point'])): ?>
                <div class="pain-point-block">
                    <h3>Addressing <?= htmlspecialchars($row['pain_point'], ENT_QUOTES) ?></h3>
                    <p>
                        We specialize in solving <?= htmlspecialchars($row['pain_point'], ENT_QUOTES) ?> 
                        issues for homeowners in <?= htmlspecialchars($row['location'] ?? 'your area', ENT_QUOTES) ?>.
                    </p>
                </div>
                <?php endif; ?>
            </section>
            
            <!-- FAQ Section (visible HTML + Schema) -->
            <?= HtmlLayout\faqFromRow($row) ?>
            
            <!-- CTA Strip -->
            <section class="cta-strip">
                <h2>Ready to Get Started?</h2>
                <p>Contact <?= htmlspecialchars($row['brand_name'] ?? 'us', ENT_QUOTES) ?> today for a free consultation.</p>
                <div class="cta-buttons">
                    <a href="tel:<?= str_replace(['+', ' ', '-', '(', ')'], '', $row['contact_phone'] ?? '') ?>" class="btn btn-primary">
                        Call <?= htmlspecialchars($row['contact_phone'] ?? '', ENT_QUOTES) ?>
                    </a>
                    <a href="mailto:<?= htmlspecialchars($row['contact_email'] ?? '', ENT_QUOTES) ?>" class="btn btn-secondary">
                        Email Us
                    </a>
                </div>
            </section>
        </main>
        
        <!-- Include your footer -->
        <?php include __DIR__ . '/../partials/footer.php'; ?>
    </body>
    </html>
    <?php
}

// Example usage:
// If this file is accessed directly, demonstrate rendering
if (basename(__FILE__) === basename($_SERVER['PHP_SELF'])) {
    // Example: render the first row from the CSV
    $exampleSlug = 'dunlap-in/siding-replacement/rotten-siding';
    renderMatrixPage($exampleSlug);
}

