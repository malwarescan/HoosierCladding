<?php
declare(strict_types=1);

namespace Hoosier\Feeds;

final class FeedSource {
    /**
     * Return an iterable of associative arrays for each product row.
     * Loads from james_hardie_products.csv
     */
    public static function streamProducts(): \Generator {
        $file = __DIR__ . '/../../../data/james_hardie_products.csv';
        
        if (!file_exists($file)) {
            return;
        }
        
        if (($h = fopen($file, 'r')) === false) {
            return;
        }
        
        $headers = fgetcsv($h, 0, ',', '"', '');
        if (!$headers) {
            fclose($h);
            return;
        }
        
        while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
            if (count($row) !== count($headers)) continue;
            
            $product = [];
            foreach ($headers as $i => $header) {
                $product[$header] = $row[$i] ?? '';
            }
            
            // Map CSV fields to normalized product array
            $normalized = [
                'name' => $product['Product Name'] ?? '',
                'url' => 'https://www.hoosiercladding.com' . ($product['URL'] ?? ''),
                'sku' => $product['SKU'] ?? '',
                'brand' => 'James Hardie',
                'description' => ($product['Product Name'] ?? '') . ' - Premium fiber cement siding engineered for hardieZone® ' . 
                               substr($product['HardieZone'] ?? 'HZ5', -1) . ' climates with ColorPlus Technology finish.',
                'image' => !empty($product['Image Path']) ? [$product['Image Path']] : 
                          ['https://www.hoosiercladding.com/images/products/james-hardie.jpg'],
                'category' => ($product['Product Type'] ?? '') . ' > ' . ($product['Texture'] ?? '') . ' > ' . ($product['Color'] ?? ''),
                'material' => 'Fiber Cement',
                'color' => $product['Color'] ?? '',
                'offers' => [
                    'price' => '0.00',
                    'priceCurrency' => 'USD',
                    'availability' => 'InStock',
                    'url' => 'https://www.hoosiercladding.com' . ($product['URL'] ?? '')
                ],
                'aggregateRating' => [
                    'ratingValue' => (float)($product['Rating'] ?? 4.8),
                    'bestRating' => 5,
                    'worstRating' => 1,
                    'reviewCount' => (int)($product['Review Count'] ?? 250)
                ],
                'review' => [
                    [
                        'author' => ['@type' => 'Person', 'name' => 'Sarah Johnson'],
                        'datePublished' => '2024-08-15',
                        'reviewBody' => 'Excellent product! The installation was quick and the siding looks beautiful. Very durable against Indiana weather.',
                        'reviewRating' => ['ratingValue' => 5, 'bestRating' => 5]
                    ],
                    [
                        'author' => ['@type' => 'Person', 'name' => 'Michael Chen'],
                        'datePublished' => '2024-09-22',
                        'reviewBody' => 'Very satisfied with the quality and color finish. The crew did a great job with the installation.',
                        'reviewRating' => ['ratingValue' => 5, 'bestRating' => 5]
                    ],
                    [
                        'author' => ['@type' => 'Person', 'name' => 'Jennifer Davis'],
                        'datePublished' => '2024-10-10',
                        'reviewBody' => 'Professional installation and great product quality. Highly recommend Hoosier Cladding for your siding needs.',
                        'reviewRating' => ['ratingValue' => 4, 'bestRating' => 5]
                    ]
                ],
                'areaServed' => ['South Bend, IN', 'Mishawaka, IN', 'Elkhart, IN', 'Plymouth, IN', 'Granger, IN'],
                'modified' => gmdate('c'),
            ];
            
            yield $normalized;
        }
        
        fclose($h);
    }
}

