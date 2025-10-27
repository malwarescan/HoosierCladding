<?php
/**
 * Generate NDJSON Product Schema Feed
 * Creates a newline-delimited JSON file optimized for LLM/RAG indexing and structured data ingestion
 */

require_once __DIR__ . '/../app/lib/ProductSchema.php';

header('Content-Type: application/x-ndjson; charset=UTF-8');

// Load all products
$products = [];
$file = __DIR__ . '/../data/james_hardie_products.csv';

if (($h = fopen($file, 'r')) !== false) {
    $headers = fgetcsv($h, 0, ',', '"', '');
    $idx = array_flip($headers);
    
    while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
        $product = [];
        foreach ($headers as $i => $header) {
            $product[$header] = $row[$i] ?? '';
        }
        $products[] = $product;
    }
    fclose($h);
}

// Generate NDJSON feed
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
    
    // Output as NDJSON (each line is a complete JSON object)
    echo json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . "\n";
}

