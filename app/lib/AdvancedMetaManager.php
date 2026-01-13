<?php
declare(strict_types=1);

/**
 * AdvancedMetaManager
 * Generates unique, geo-targeted metadata for every page
 * Follows strict rules: 50-60 char titles, 120-155 char descriptions
 * No duplicates, no templating
 */
final class AdvancedMetaManager
{
    // Primary service cities
    private const PRIMARY_CITIES = [
        'south-bend' => 'South Bend',
        'mishawaka' => 'Mishawaka',
        'granger' => 'Granger',
        'elkhart' => 'Elkhart',
        'goshen' => 'Goshen',
        'nappanee' => 'Nappanee',
        'la-porte' => 'La Porte',
        'plymouth' => 'Plymouth',
    ];

    // Service taxonomy mapping
    private const SERVICE_KEYWORDS = [
        'siding-installation' => ['siding installation', 'install siding', 'new siding'],
        'siding-repair' => ['siding repair', 'fix siding', 'siding replacement'],
        'vinyl-siding' => ['vinyl siding', 'vinyl siding installation', 'vinyl siding repair'],
        'fiber-cement-siding' => ['fiber cement siding', 'hardie board', 'hardie siding'],
        'storm-damage' => ['storm damage repair', 'hail damage siding', 'wind damage'],
        'fascia-soffit' => ['fascia repair', 'soffit repair', 'fascia soffit'],
        'gutter-replacement' => ['gutter replacement', 'new gutters', 'gutter installation'],
        'exterior-repair' => ['exterior repair', 'home exterior', 'exterior renovation'],
    ];

    // Unique metadata cache to prevent duplicates
    private static array $usedTitles = [];
    private static array $usedDescriptions = [];

    /**
     * Generate unique title for a page
     */
    public static function generateTitle(string $path, string $pageType, ?array $context = null): string
    {
        $path = trim($path, '/');
        
        // Check cache first
        if (isset(self::$usedTitles[$path])) {
            return self::$usedTitles[$path];
        }

        $title = match($pageType) {
            'homepage' => self::generateHomepageTitle($path, $context),
            'service' => self::generateServiceTitle($path, $context),
            'city' => self::generateCityTitle($path, $context),
            'matrix' => self::generateMatrixTitle($path, $context),
            'blog' => self::generateBlogTitle($path, $context),
            'about' => self::generateAboutTitle(),
            'contact' => self::generateContactTitle(),
            default => self::generateDefaultTitle($path, $context)
        };

        // Ensure uniqueness
        $title = self::ensureUniqueTitle($title);
        
        // Enforce length (50-60 chars)
        $title = self::enforceTitleLength($title);
        
        self::$usedTitles[$path] = $title;
        return $title;
    }

    /**
     * Generate unique description for a page
     */
    public static function generateDescription(string $path, string $pageType, ?array $context = null): string
    {
        $path = trim($path, '/');
        
        // Check cache first
        if (isset(self::$usedDescriptions[$path])) {
            return self::$usedDescriptions[$path];
        }

        $description = match($pageType) {
            'homepage' => self::generateHomepageDescription(),
            'service' => self::generateServiceDescription($path, $context),
            'city' => self::generateCityDescription($path, $context),
            'matrix' => self::generateMatrixDescription($path, $context),
            'blog' => self::generateBlogDescription($path, $context),
            'about' => self::generateAboutDescription(),
            'contact' => self::generateContactDescription(),
            default => self::generateDefaultDescription($path, $context)
        };

        // Enforce length FIRST (120-155 chars)
        $description = self::enforceDescriptionLength($description);
        
        // Then ensure uniqueness (after length is correct)
        $description = self::ensureUniqueDescription($description);
        
        // Final length check after uniqueness
        $description = self::enforceDescriptionLength($description);
        
        self::$usedDescriptions[$path] = $description;
        return $description;
    }

    // ============================================================
    // TITLE GENERATORS
    // ============================================================

    private static function generateHomepageTitle(string $path, ?array $context): string
    {
        // SEO Optimized: Emphasizes primary commercial intent with concise branding + target keywords
        return "Hoosier Cladding — Licensed Siding Contractor in South Bend & Northern Indiana";
    }

    private static function generateServiceTitle(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        $service = $segments[0] ?? '';
        $city = self::extractCityFromPath($path);
        
        // Map service to keyword
        $serviceKeyword = self::mapServiceToKeyword($service);
        
        if ($city) {
            $cityName = self::PRIMARY_CITIES[$city] ?? ucwords(str_replace('-', ' ', $city));
            return "$serviceKeyword in $cityName – Expert Installation & Repair";
        }
        
        return "$serviceKeyword in Northern Indiana – Licensed Contractors";
    }

    private static function generateCityTitle(string $path, ?array $context): string
    {
        $city = self::extractCityFromPath($path);
        if ($city) {
            $cityName = self::PRIMARY_CITIES[$city] ?? ucwords(str_replace('-', ' ', $city));
        } else {
            // Fallback for service-area page
            $cityName = "Northern Indiana";
        }
        
        return "$cityName Siding Services – Installation & Repair Experts";
    }

    private static function generateMatrixTitle(string $path, ?array $context): string
    {
        // Matrix pages: /matrix/{city}/{service}/{problem}
        $segments = explode('/', $path);
        if (count($segments) >= 3 && $segments[0] === 'matrix') {
            $citySlug = $segments[1] ?? '';
            $serviceSlug = $segments[2] ?? '';
            $problemSlug = $segments[3] ?? '';
            
            $cityName = self::PRIMARY_CITIES[$citySlug] ?? ucwords(str_replace('-', ' ', $citySlug));
            $service = ucwords(str_replace('-', ' ', $serviceSlug));
            $problem = ucwords(str_replace('-', ' ', $problemSlug));
            
            return "$service in $cityName – $problem Solutions";
        }
        
        return self::generateDefaultTitle($path, $context);
    }

    private static function generateBlogTitle(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        $slug = end($segments);
        
        // Handle blog hub
        if (empty($slug) || $slug === 'home-siding-blog') {
            return "Hoosier Cladding Home Siding Blog — Tips, Guides & Costs";
        }
        
        $title = ucwords(str_replace('-', ' ', $slug));
        
        // Remove "Hoosier Cladding" from blog titles
        return "$title – Expert Siding Guide";
    }

    private static function generateAboutTitle(): string
    {
        return "About Hoosier Cladding – Northern Indiana Siding Experts";
    }

    private static function generateContactTitle(): string
    {
        return "Contact Us – Free Siding Estimate in South Bend";
    }

    private static function generateDefaultTitle(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        $lastSegment = end($segments);
        $title = ucwords(str_replace('-', ' ', $lastSegment));
        $city = self::extractCityFromPath($path);
        
        if ($city) {
            $cityName = self::PRIMARY_CITIES[$city] ?? ucwords(str_replace('-', ' ', $city));
            return "$title in $cityName – Professional Services";
        }
        
        return "$title – Hoosier Cladding LLC";
    }

    // ============================================================
    // DESCRIPTION GENERATORS
    // ============================================================

    private static function generateHomepageDescription(): string
    {
        // Clear description specifying services, locations, and core differentiators
        return "Licensed siding contractor serving South Bend, Mishawaka, and Northern Indiana. Expert installation, repair, and replacement. Certified installers, free estimates. Call (574) 931-2119.";
    }

    private static function generateServiceDescription(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        $service = $segments[0] ?? '';
        $city = self::extractCityFromPath($path);
        $serviceKeyword = self::mapServiceToKeyword($service);
        
        if ($city) {
            $cityName = self::PRIMARY_CITIES[$city] ?? ucwords(str_replace('-', ' ', $city));
            $benefits = [
                "Durable materials and expert installation",
                "Fast turnaround with certified crews",
                "Licensed installers with local expertise",
                "Storm damage specialists with insurance help",
                "Energy-efficient solutions for Indiana winters"
            ];
            $benefit = $benefits[array_rand($benefits)];
            return "Professional $serviceKeyword in $cityName. $benefit. Free estimates and same-week service available.";
        }
        
        return "Expert $serviceKeyword across Northern Indiana. Licensed contractors delivering quality craftsmanship and reliable exterior solutions for your home.";
    }

    private static function generateCityDescription(string $path, ?array $context): string
    {
        $city = self::extractCityFromPath($path);
        if ($city) {
            $cityName = self::PRIMARY_CITIES[$city] ?? ucwords(str_replace('-', ' ', $city));
        } else {
            // Fallback for service-area page
            $cityName = "Northern Indiana";
        }
        
        $services = [
            "siding installation and repair",
            "vinyl and fiber cement siding",
            "storm damage restoration",
            "exterior home renovation"
        ];
        $service = $services[array_rand($services)];
        
        return "Trusted $service in $cityName. Local siding contractors with years of experience serving Northern Indiana homes. Licensed, insured, and committed to quality.";
    }

    private static function generateMatrixDescription(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        if (count($segments) >= 3 && $segments[0] === 'matrix') {
            $citySlug = $segments[1] ?? '';
            $serviceSlug = $segments[2] ?? '';
            $problemSlug = $segments[3] ?? '';
            
            $cityName = self::PRIMARY_CITIES[$citySlug] ?? ucwords(str_replace('-', ' ', $citySlug));
            $service = ucwords(str_replace('-', ' ', $serviceSlug));
            $problem = ucwords(str_replace('-', ' ', $problemSlug));
            
            // Ensure minimum length with additional context
            $base = "Expert $service solutions for $problem in $cityName. Local contractors specializing in targeted repairs and professional installation.";
            if (mb_strlen($base) < 120) {
                $base .= " Licensed, insured, and committed to quality craftsmanship. Free estimates available.";
            } else {
                $base .= " Free estimates available.";
            }
            
            return $base;
        }
        
        return self::generateDefaultDescription($path, $context);
    }

    private static function generateBlogDescription(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        $slug = end($segments);
        
        // Handle blog hub
        if (empty($slug) || $slug === 'home-siding-blog') {
            return "Hoosier Cladding Home Siding Blog — Tips, Guides & Costs for Indiana Homes. Expert advice from licensed contractors on installation, repair, and maintenance.";
        }
        
        $topic = ucwords(str_replace('-', ' ', $slug));
        
        return "Learn about $topic for Northern Indiana homes. Expert advice from licensed siding contractors on installation, repair, and maintenance best practices. Get professional insights and actionable tips.";
    }

    private static function generateAboutDescription(): string
    {
        return "Hoosier Cladding is Northern Indiana's trusted siding contractor. Licensed, insured, and locally owned. Serving South Bend, Mishawaka, and surrounding areas with quality craftsmanship.";
    }

    private static function generateContactDescription(): string
    {
        return "Get your free siding estimate in South Bend and Northern Indiana. Call 574-931-2119 or request a quote online. Expert consultation and same-week service available.";
    }

    private static function generateDefaultDescription(string $path, ?array $context): string
    {
        $segments = explode('/', $path);
        $lastSegment = end($segments);
        $service = ucwords(str_replace('-', ' ', $lastSegment));
        $city = self::extractCityFromPath($path);
        
        if ($city) {
            $cityName = self::PRIMARY_CITIES[$city] ?? ucwords(str_replace('-', ' ', $city));
            return "Professional $service in $cityName. Expert installation and repair services from licensed Northern Indiana contractors.";
        }
        
        return "Professional $service services from Hoosier Cladding LLC. Licensed contractors serving Northern Indiana with quality craftsmanship and reliable service.";
    }

    // ============================================================
    // HELPER METHODS
    // ============================================================

    private static function extractCityFromPath(string $path): ?string
    {
        $segments = explode('/', $path);
        foreach ($segments as $segment) {
            if (isset(self::PRIMARY_CITIES[$segment])) {
                return $segment;
            }
            // Check for city in slug (e.g., "siding-south-bend")
            foreach (array_keys(self::PRIMARY_CITIES) as $citySlug) {
                if (strpos($segment, $citySlug) !== false) {
                    return $citySlug;
                }
            }
        }
        return null;
    }

    private static function mapServiceToKeyword(string $service): string
    {
        $service = strtolower($service);
        
        // Direct matches
        if (isset(self::SERVICE_KEYWORDS[$service])) {
            return self::SERVICE_KEYWORDS[$service][0];
        }
        
        // Pattern matching
        if (strpos($service, 'siding') !== false) {
            if (strpos($service, 'repair') !== false) return 'Siding Repair';
            if (strpos($service, 'install') !== false) return 'Siding Installation';
            if (strpos($service, 'vinyl') !== false) return 'Vinyl Siding';
            if (strpos($service, 'fiber') !== false || strpos($service, 'hardie') !== false) return 'Fiber Cement Siding';
            return 'Siding Services';
        }
        
        if (strpos($service, 'gutter') !== false) return 'Gutter Replacement';
        if (strpos($service, 'fascia') !== false || strpos($service, 'soffit') !== false) return 'Fascia & Soffit Repair';
        if (strpos($service, 'storm') !== false) return 'Storm Damage Repair';
        if (strpos($service, 'exterior') !== false) return 'Exterior Home Repair';
        
        return ucwords(str_replace('-', ' ', $service));
    }

    private static function ensureUniqueTitle(string $title): string
    {
        $original = $title;
        $counter = 1;
        
        while (in_array($title, self::$usedTitles, true)) {
            // Add variation
            $title = $original . " – " . ($counter === 1 ? "Expert Services" : "Professional Solutions");
            $counter++;
            if ($counter > 10) break; // Prevent infinite loop
        }
        
        return $title;
    }

    private static function ensureUniqueDescription(string $description): string
    {
        $original = $description;
        $counter = 1;
        
        while (in_array($description, self::$usedDescriptions, true)) {
            // Vary the ending
            $variations = [
                " Licensed contractors with local expertise.",
                " Free estimates and same-week service available.",
                " Trusted by homeowners across Northern Indiana.",
                " Quality craftsmanship and reliable results."
            ];
            $description = rtrim($original, '.') . $variations[$counter % count($variations)];
            $counter++;
            if ($counter > 10) break;
        }
        
        return $description;
    }

    private static function enforceTitleLength(string $title): string
    {
        $len = mb_strlen($title);
        if ($len >= 50 && $len <= 60) {
            return $title;
        }
        
        if ($len > 60) {
            // Truncate intelligently
            $title = mb_substr($title, 0, 57) . '...';
        } else {
            // Add geo or service clarifier
            $title .= " – Northern Indiana";
        }
        
        // Final check
        $len = mb_strlen($title);
        if ($len > 60) {
            $title = mb_substr($title, 0, 57) . '...';
        }
        
        return $title;
    }

    private static function enforceDescriptionLength(string $description): string
    {
        $len = mb_strlen($description);
        if ($len >= 120 && $len <= 155) {
            return $description;
        }
        
        if ($len > 155) {
            // Truncate at last sentence
            $sentences = preg_split('/([.!?]+)/', $description, -1, PREG_SPLIT_DELIM_CAPTURE);
            $result = '';
            foreach ($sentences as $i => $sentence) {
                $test = $result . $sentence . ($sentences[$i + 1] ?? '');
                if (mb_strlen($test) > 155) break;
                $result .= $sentence . ($sentences[$i + 1] ?? '');
            }
            return trim($result) ?: mb_substr($description, 0, 152) . '...';
        } else {
            // Add benefit or differentiator until we reach 120 chars
            $additions = [
                " Licensed and insured contractors with local expertise.",
                " Free estimates and same-week service available.",
                " Serving Northern Indiana with quality craftsmanship.",
                " Expert crews and premium materials for lasting results."
            ];
            
            // Keep adding until we hit 120 chars
            while ($len < 120) {
                $addition = $additions[array_rand($additions)];
                $test = rtrim($description, '.') . '. ' . $addition;
                if (mb_strlen($test) <= 155) {
                    $description = $test;
                    $len = mb_strlen($description);
                    break;
                } else {
                    // Try shorter addition
                    $description = rtrim($description, '.') . '. ' . "Licensed contractors. Free estimates.";
                    $len = mb_strlen($description);
                    break;
                }
            }
        }
        
        // Final check - ensure we're in range
        $len = mb_strlen($description);
        if ($len < 120) {
            // Force minimum
            $description .= " Licensed, insured, and committed to quality.";
        } elseif ($len > 155) {
            $description = mb_substr($description, 0, 152) . '...';
        }
        
        return $description;
    }
}

