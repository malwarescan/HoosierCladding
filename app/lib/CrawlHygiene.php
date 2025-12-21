<?php
declare(strict_types=1);

/**
 * CrawlHygiene
 * Prevents query parameter pollution and parameter probe indexing
 * 
 * Strategy:
 * 1. Strip all query parameters from canonical URLs
 * 2. Add noindex for unknown query parameters
 * 3. Optionally redirect to clean URLs (301)
 */
final class CrawlHygiene
{
    /**
     * Whitelist of allowed query parameters that should NOT trigger noindex
     * Empty array = no parameters allowed
     */
    private const ALLOWED_PARAMS = [
        // Add legitimate parameters here if needed in future
        // Example: 'ref', 'source' for tracking (but still canonical to clean URL)
    ];
    
    /**
     * Get clean URL path without query string for canonical
     */
    public static function getCleanPath(string $requestUri): string
    {
        // Extract just the path, strip query string
        $path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
        
        // Normalize: ensure leading slash, remove trailing slash except root
        $path = '/' . ltrim($path, '/');
        if ($path !== '/' && substr($path, -1) === '/') {
            $path = rtrim($path, '/');
        }
        
        return $path;
    }
    
    /**
     * Check if URL has unknown query parameters
     */
    public static function hasUnknownParams(): bool
    {
        if (empty($_GET)) {
            return false; // No query params = clean
        }
        
        // Check if any params are NOT in whitelist
        foreach (array_keys($_GET) as $param) {
            if (!in_array($param, self::ALLOWED_PARAMS, true)) {
                return true; // Unknown parameter found
            }
        }
        
        return false; // All params are whitelisted
    }
    
    /**
     * Should redirect to clean URL? (301)
     * Returns clean URL if redirect needed, null if not
     */
    public static function shouldRedirect(): ?string
    {
        // Only redirect if there are unknown query parameters
        if (!self::hasUnknownParams()) {
            return null;
        }
        
        // Get clean path
        $cleanPath = self::getCleanPath($_SERVER['REQUEST_URI'] ?? '/');
        
        // Build full clean URL
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'www.hoosiercladding.com';
        
        // Always use https and www for canonical
        $cleanUrl = 'https://www.hoosiercladding.com' . $cleanPath;
        
        return $cleanUrl;
    }
    
    /**
     * Add noindex header if unknown parameters present
     */
    public static function addNoindexIfNeeded(): void
    {
        if (self::hasUnknownParams()) {
            header('X-Robots-Tag: noindex, follow');
        }
    }
    
    /**
     * Get canonical URL (always clean, no query params)
     */
    public static function getCanonicalUrl(string $path): string
    {
        // Ensure path is clean (no query string)
        $cleanPath = self::getCleanPath($path);
        
        // Always use https and www
        return 'https://www.hoosiercladding.com' . $cleanPath;
    }
}

