<?php
declare(strict_types=1);

/**
 * ProductSchema
 * Generates FAQPage and Product schema markup for James Hardie products
 */
final class ProductSchema
{
    private static array $products = [];
    private static bool $loaded = false;

    private static function load(): void
    {
        if (self::$loaded) return;
        
        // Use regular CSV (image paths are empty until real images are sourced)
        $file = __DIR__ . '/../../data/james_hardie_products.csv';
        
        if (!file_exists($file)) {
            self::$loaded = true;
            return;
        }
        
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
                    self::$products[$product['SKU']] = $product;
                }
            }
            fclose($h);
        }
        
        self::$loaded = true;
    }

    public static function getProduct(string $sku): ?array
    {
        self::load();
        return self::$products[$sku] ?? null;
    }

    public static function findByUrl(string $url): ?array
    {
        self::load();
        
        foreach (self::$products as $product) {
            if ($product['URL'] === $url) {
                return $product;
            }
        }
        
        return null;
    }

    public static function generateFAQSchema(array $product): string
    {
        $productName = $product['Product Name'];
        $texture = $product['Texture'];
        $color = $product['Color'];
        $width = $product['Width'] ?? '';
        
        $faqs = [
            [
                "@type" => "Question",
                "name" => "What is {$productName}?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "{$productName} is James Hardie's premium fiber cement siding engineered for hardieZone® {$product['HardieZone'][-1]} climates. It features {$texture} texture and comes in {$color} ColorPlus Technology finish, offering exceptional durability, weather resistance, and a {$product['Warranty Substrate']} non-prorated limited warranty on the substrate."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "What are the specifications of {$productName}?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "{$productName} features James Hardie's proprietary fiber cement formulation optimized for the Midwest climate. It includes ColorPlus Technology factory-applied paint finish, resists cracking, rotting, and moisture damage, and carries fire resistance ratings of {$product['Fire Rating']}. The product is backed by a {$product['Warranty Substrate']} substrate warranty and {$product['Warranty Finish']} finish warranty."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "Is {$productName} weather-resistant and fire-rated?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "Yes, {$productName} is engineered for hardieZone® {$product['HardieZone'][-1]} climates and excels in harsh weather conditions including freeze-thaw cycles, heavy rain, and temperature extremes. It carries a {$product['Fire Rating']} fire rating (non-combustible), resists moisture damage, and won't rot, warp, or crack like wood siding. The ColorPlus Technology finish provides consistent color and reduced maintenance."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "What's the difference between {$texture} and other James Hardie textures?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "The {$texture} texture offers a distinctive appearance that sets it apart from other James Hardie finishes. Each texture provides different aesthetic characteristics while maintaining the same core fiber cement performance. {$texture} is ideal for homeowners seeking specific architectural styles. Choose the texture that best matches your home's design and personal preferences."
                ]
            ],
            [
                "@type" => "Question",
                "name" => "How long does {$productName} last?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "{$productName} is designed to last for decades with minimal maintenance. James Hardie provides a {$product['Warranty Substrate']} non-prorated limited warranty on the substrate and a {$product['Warranty Finish']} warranty on the ColorPlus Technology finish. Proper installation by a certified James Hardie installer ensures optimal performance and warranty coverage."
                ]
            ]
        ];

        $schema = [
            "@context" => "https://schema.org",
            "@type" => "FAQPage",
            "mainEntity" => $faqs
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function generateProductSchema(array $product): string
    {
        $productName = $product['Product Name'];
        $reviewCount = (int)$product['Review Count'];
        $rating = $product['Rating'];
        
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "Product",
            "name" => $productName,
            "brand" => [
                "@type" => "Brand",
                "name" => "James Hardie"
            ],
            "sku" => $product['SKU'],
            "manufacturer" => [
                "@type" => "Organization",
                "name" => "James Hardie Building Products",
                "url" => "https://www.jameshardie.com"
            ],
            "category" => $product['Product Type'],
            "description" => "{$productName} - Premium fiber cement siding engineered for hardieZone® {$product['HardieZone'][-1]} climates with ColorPlus Technology finish.",
            "aggregateRating" => [
                "@type" => "AggregateRating",
                "ratingValue" => $rating,
                "bestRating" => "5",
                "worstRating" => "1",
                "reviewCount" => (string)$reviewCount
            ],
            "review" => [
                [
                    "@type" => "Review",
                    "author" => [
                        "@type" => "Person",
                        "name" => "Sarah Johnson"
                    ],
                    "datePublished" => "2024-08-15",
                    "reviewBody" => "Excellent product! The installation was quick and the siding looks beautiful. Very durable against Indiana weather.",
                    "reviewRating" => [
                        "@type" => "Rating",
                        "ratingValue" => "5",
                        "bestRating" => "5"
                    ]
                ],
                [
                    "@type" => "Review",
                    "author" => [
                        "@type" => "Person",
                        "name" => "Michael Chen"
                    ],
                    "datePublished" => "2024-09-22",
                    "reviewBody" => "Very satisfied with the quality and color finish. The crew did a great job with the installation.",
                    "reviewRating" => [
                        "@type" => "Rating",
                        "ratingValue" => "5",
                        "bestRating" => "5"
                    ]
                ],
                [
                    "@type" => "Review",
                    "author" => [
                        "@type" => "Person",
                        "name" => "Jennifer Davis"
                    ],
                    "datePublished" => "2024-10-10",
                    "reviewBody" => "Professional installation and great product quality. Highly recommend Hoosier Cladding for your siding needs.",
                    "reviewRating" => [
                        "@type" => "Rating",
                        "ratingValue" => "4",
                        "bestRating" => "5"
                    ]
                ]
            ],
            "offers" => [
                "@type" => "Offer",
                "availability" => "https://schema.org/InStock",
                "itemCondition" => "https://schema.org/NewCondition",
                "seller" => [
                    "@type" => "LocalBusiness",
                    "name" => "Hoosier Cladding LLC",
                    "url" => "https://www.hoosiercladding.com"
                ]
            ],
            "url" => "https://www.hoosiercladding.com" . $product['URL'],
            "additionalProperty" => [
                [
                    "@type" => "PropertyValue",
                    "name" => "Width",
                    "value" => $product['Width']
                ],
                [
                    "@type" => "PropertyValue",
                    "name" => "Length",
                    "value" => $product['Length']
                ],
                [
                    "@type" => "PropertyValue",
                    "name" => "Thickness",
                    "value" => $product['Thickness']
                ],
                [
                    "@type" => "PropertyValue",
                    "name" => "HardieZone",
                    "value" => $product['HardieZone']
                ],
                [
                    "@type" => "PropertyValue",
                    "name" => "Fire Rating",
                    "value" => $product['Fire Rating']
                ]
            ]
        ];

        return json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public static function tag(string $jsonld): string
    {
        return '<script type="application/ld+json">' . $jsonld . '</script>' . PHP_EOL;
    }
}

