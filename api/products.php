<?php
/**
 * API endpoint for James Hardie product schemas
 * GET /api/products.php?sku=JH-HARD-SMO-ARC-51/4
 * GET /api/products.php?url=/products/james-hardie/hardieplank/smooth/5-1/4/arctic-white
 */

require_once __DIR__ . '/../app/lib/ProductSchema.php';

header('Content-Type: application/json; charset=UTF-8');

$sku = $_GET['sku'] ?? null;
$url = $_GET['url'] ?? null;

if ($sku) {
    $product = ProductSchema::getProduct($sku);
} elseif ($url) {
    $product = ProductSchema::findByUrl($url);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required parameter: sku or url']);
    exit;
}

if (!$product) {
    http_response_code(404);
    echo json_encode(['error' => 'Product not found']);
    exit;
}

// Generate schemas
$faqJson = ProductSchema::generateFAQSchema($product);
$productJson = ProductSchema::generateProductSchema($product);

$faqData = json_decode($faqJson, true);
$productData = json_decode($productJson, true);

echo json_encode([
    'product' => $product,
    'url' => 'https://www.hoosiercladding.com' . $product['URL'],
    'schemas' => [
        'faq' => $faqData,
        'product' => $productData
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

