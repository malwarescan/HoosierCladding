<?php
/**
 * Generate sitemap for James Hardie products
 */

require_once __DIR__ . '/../app/lib/ProductSchema.php';

$products = [];
$file = __DIR__ . '/../data/james_hardie_products.csv';

if (($h = fopen($file, 'r')) !== false) {
    $headers = fgetcsv($h, 0, ',', '"', '');
    $idx = array_flip($headers);
    
    while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
        if (count($row) !== count($headers)) continue;
        
        $product = [];
        foreach ($headers as $i => $header) {
            $product[$header] = $row[$i] ?? '';
        }
        
        if (!empty($product['SKU'])) {
            $products[] = $product;
        }
    }
    fclose($h);
}

// Generate sitemap XML
header('Content-Type: application/xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

foreach ($products as $product) {
    $url = 'https://www.hoosiercladding.com' . $product['URL'];
    $lastmod = date('Y-m-d');
    $priority = 0.8;
    $changefreq = 'monthly';
    
    echo '  <url>' . PHP_EOL;
    echo '    <loc>' . htmlspecialchars($url) . '</loc>' . PHP_EOL;
    echo '    <lastmod>' . $lastmod . '</lastmod>' . PHP_EOL;
    echo '    <changefreq>' . $changefreq . '</changefreq>' . PHP_EOL;
    echo '    <priority>' . $priority . '</priority>' . PHP_EOL;
    echo '  </url>' . PHP_EOL;
}

echo '</urlset>' . PHP_EOL;

