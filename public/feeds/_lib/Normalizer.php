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
        $images = array_values(array_filter(array_map([self::class,'fqUrl'], $row['image'] ?? [])));
        $offerUrl = self::fqUrl($row['offers']['url'] ?? null);

        $obj = [
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
            "offers" => [
                "@type" => "Offer",
                "price" => (string)($row['offers']['price'] ?? ''),
                "priceCurrency" => strtoupper((string)($row['offers']['priceCurrency'] ?? 'USD')),
                "availability" => self::availability((string)($row['offers']['availability'] ?? 'InStock')),
                "url" => $offerUrl ?? ($row['url'] ?? '')
            ],
        ];

        if (!empty($row['areaServed'])) {
            $obj['areaServed'] = array_values(array_filter(array_map('strval', (array)$row['areaServed'])));
        }
        if (!empty($row['modified'])) {
            $obj['dateModified'] = (string)$row['modified'];
        }
        return $obj;
    }

    private static function truncate(string $s, int $max): string {
        return (strlen($s) <= $max) ? $s : (substr($s, 0, $max-1) . '…');
    }
}

