<?php
/**
 * Product sitemap - shows all James Hardie product pages
 */

require_once __DIR__ . '/app/lib/ProductSchema.php';

$products = [];
$file = __DIR__ . '/data/james_hardie_products.csv';

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

// Output XML
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex, nofollow');
echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
foreach ($products as $product) {
    echo '  <url>' . PHP_EOL;
    echo '    <loc>https://www.hoosiercladding.com' . htmlspecialchars($product['URL']) . '</loc>' . PHP_EOL;
    echo '    <lastmod>' . date('Y-m-d') . '</lastmod>' . PHP_EOL;
    echo '    <changefreq>monthly</changefreq>' . PHP_EOL;
    echo '    <priority>0.8</priority>' . PHP_EOL;
    echo '  </url>' . PHP_EOL;
}
echo '</urlset>' . PHP_EOL;

