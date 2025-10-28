<?php
declare(strict_types=1);

namespace Hoosier\Feeds;

final class Normalizer {
    /** Normalize availability to schema URL */
    public static function availability(string $raw): string {
        $map = [
            'instock' => 'https://schema.org/InStock',
            'outofstock' => 'https://schema.org/OutOfStock',
            'preorder' => 'https://schema.org/PreOrder',
            'backorder' => 'https://schema.org/BackOrder',
        ];
        $k = strtolower(trim($raw));
        return $map[$k] ?? 'https://schema.org/InStock';
    }

    /** Ensure fully-qualified URL, else drop */
    public static function fqUrl(?string $u): ?string {
        if (!$u) return null;
        if (preg_match('~^https?://~i', $u)) return $u;
        return null;
    }

    /** Coerce product row to schema.org Product NDJSON object */
    public static function toProduct(array $row): array {
        // Ensure array of image URLs
        $images = $row['image'] ?? [];
        if (is_string($images)) $images = [$images];
        $images = array_values(array_filter(array_map([self::class,'fqUrl'], $images)));
        
        $offerUrl = self::fqUrl($row['offers']['url'] ?? null);

        $obj = [
            "@context" => "https://schema.org",
            "@type" => "Product",
            "name" => (string)($row['name'] ?? ''),
            "url" => self::fqUrl($row['url'] ?? '') ?? '',
            "sku" => (string)($row['sku'] ?? ''),
            "brand" => is_array($row['brand'] ?? null)
                ? $row['brand']
                : ["@type"=>"Brand","name" => (string)($row['brand'] ?? '')],
            "description" => self::truncate((string)($row['description'] ?? ''), 10000),
            "image" => $images,
            "category" => (string)($row['category'] ?? ''),
            "material" => (string)($row['material'] ?? ''),
            "color" => (string)($row['color'] ?? ''),
        ];

        // Add offers WITHOUT zero price (Google rejects zero prices)
        $offers = [
            "@type" => "Offer",
            "priceCurrency" => strtoupper((string)($row['offers']['priceCurrency'] ?? 'USD')),
            "availability" => self::availability((string)($row['offers']['availability'] ?? 'InStock')),
            "url" => $offerUrl ?? ($row['url'] ?? '')
        ];
        
        // Only add price if it's > 0
        $price = (float)($row['offers']['price'] ?? 0);
        if ($price > 0) {
            $offers['price'] = (string)$price;
        }
        
        $obj['offers'] = $offers;

        // Add aggregateRating with numeric values
        if (!empty($row['aggregateRating'])) {
            $rating = $row['aggregateRating'];
            $obj['aggregateRating'] = [
                "@type" => "AggregateRating",
                "ratingValue" => (float)($rating['ratingValue'] ?? 0),
                "bestRating" => (int)($rating['bestRating'] ?? 5),
                "worstRating" => (int)($rating['worstRating'] ?? 1),
                "reviewCount" => (int)($rating['reviewCount'] ?? 0)
            ];
        }

        // Add reviews with numeric values
        if (!empty($row['review'])) {
            $reviews = [];
            foreach ($row['review'] as $review) {
                $reviews[] = [
                    "@type" => "Review",
                    "author" => $review['author'] ?? null,
                    "datePublished" => $review['datePublished'] ?? null,
                    "reviewBody" => $review['reviewBody'] ?? null,
                    "reviewRating" => [
                        "@type" => "Rating",
                        "ratingValue" => (float)($review['reviewRating']['ratingValue'] ?? 0),
                        "bestRating" => (int)($review['reviewRating']['bestRating'] ?? 5)
                    ]
                ];
            }
            $obj['review'] = $reviews;
        }

        if (!empty($row['areaServed'])) {
            $obj['areaServed'] = array_values(array_filter(array_map('strval', (array)$row['areaServed'])));
        }
        if (!empty($row['modified'])) {
            $obj['dateModified'] = (string)$row['modified'];
        }
        
        // Remove nulls to keep JSON clean
        return array_filter($obj, fn($v) => $v !== null);
    }

    private static function truncate(string $s, int $max): string {
        return (strlen($s) <= $max) ? $s : (substr($s, 0, $max-1) . '…');
    }
}

