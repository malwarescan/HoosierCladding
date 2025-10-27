<?php
/**
 * Generate static NDJSON Product Schema Feed file
 * Outputs to /feeds/products.ndjson
 */

require_once __DIR__ . '/../app/lib/ProductSchema.php';

// Load all products
$products = [];
$file = __DIR__ . '/../data/james_hardie_products.csv';

if (($h = fopen($file, 'r')) !== false) {
    $headers = fgetcsv($h, 0, ',', '"', '');
    
    while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
        $product = [];
        foreach ($headers as $i => $header) {
            $product[$header] = $row[$i] ?? '';
        }
        $products[] = $product;
    }
    fclose($h);
}

// Create feeds directory
$feedsDir = __DIR__ . '/../feeds';
if (!is_dir($feedsDir)) {
    mkdir($feedsDir, 0755, true);
}

// Generate NDJSON feed
$outputFile = $feedsDir . '/products.ndjson';
$fp = fopen($outputFile, 'w');

foreach ($products as $product) {
    $schema = json_decode(ProductSchema::generateProductSchema($product), true);
    
    // Add intent mapping fields
    $keywords = [
        strtolower($product['Product Name']),
        $product['Texture'] . ' siding',
        $product['Color'] . ' fiber cement',
        'James Hardie ' . $product['Color'],
        $product['Product Type']
    ];
    
    $schema['keywords'] = array_unique($keywords);
    $schema['searchIntent'] = [
        'buy ' . strtolower($product['Product Type']),
        'install ' . strtolower($product['Product Type']),
        $product['Color'] . ' exterior siding',
        'fiber cement siding ' . $product['Color']
    ];
    
    $schema['relatedSearches'] = [
        'hardieplank vs vinyl siding',
        'fiber cement siding cost',
        'James Hardie siding colors',
        'HardieZone ' . $product['HardieZone'] . ' installation'
    ];
    
    // Write as NDJSON (each line is a complete JSON object)
    fwrite($fp, json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n");
}

fclose($fp);

echo "✓ Generated NDJSON feed: $outputFile\n";
echo "✓ Products: " . count($products) . "\n";
echo "✓ File size: " . number_format(filesize($outputFile)) . " bytes\n";

