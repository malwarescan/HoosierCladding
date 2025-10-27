<?php
/**
 * Generate JSON file with all products including FAQ, Product, and Review schemas
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

// Generate JSON for each product with all schemas
$output = [];

foreach ($products as $product) {
    // Get FAQ schema
    $faqJson = ProductSchema::generateFAQSchema($product);
    $faqData = json_decode($faqJson, true);
    
    // Get Product schema
    $productJson = ProductSchema::generateProductSchema($product);
    $productData = json_decode($productJson, true);
    
    // Combine all data
    $output[] = [
        'product' => $product,
        'url' => 'https://www.hoosiercladding.com' . $product['URL'],
        'schemas' => [
            'faq' => $faqData,
            'product' => $productData
        ]
    ];
}

// Output JSON
header('Content-Type: application/json; charset=UTF-8');
echo json_encode([
    'total' => count($output),
    'generated' => date('Y-m-d H:i:s'),
    'products' => $output
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

