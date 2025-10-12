<?php
declare(strict_types=1);

final class Schema
{
  public static function isMatrixRoute(string $path): bool {
    return (bool)preg_match('#^/?matrix/[^/]+#', $path);
  }

  public static function parseMatrix(string $path): array {
    // Expected: /matrix/{slug}
    // The slug format from convex_matrix_expanded.csv is: city-state/service-type/pain-point
    // e.g., dunlap-in/siding-replacement/rotten-siding
    $parts = explode('/', trim($path, '/'));
    
    // Skip 'matrix' prefix
    if ($parts[0] === 'matrix') {
        array_shift($parts);
    }
    
    // Join remaining parts as the full slug
    $slug = implode('/', $parts);
    
    // Try to parse from slug structure
    $slugParts = explode('/', $slug);
    
    // Extract location (first part)
    $locationSlug = $slugParts[0] ?? '';
    $locTokens = explode('-', $locationSlug);
    
    // Last token is usually state
    $state = '';
    $cityTokens = $locTokens;
    if (count($locTokens) > 1) {
        $possibleState = strtoupper(end($locTokens));
        if (strlen($possibleState) === 2) {
            $state = $possibleState;
            array_pop($cityTokens);
        }
    }
    
    $city = implode(' ', array_map('ucfirst', $cityTokens));
    
    // Extract service (second part)
    $serviceSlug = $slugParts[1] ?? '';
    $service = ucwords(str_replace(['-', '_'], [' ', ' '], $serviceSlug));
    
    // Extract pain point (third part)
    $painSlug = $slugParts[2] ?? '';
    $painPoint = ucwords(str_replace(['-', '_'], [' ', ' '], $painSlug));
    
    return compact('service', 'city', 'state', 'painPoint', 'slug');
  }

  public static function encode(array $data): string {
    return json_encode($data, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
  }

  public static function tag(string $json): string {
    return "\n<script type=\"application/ld+json\">".$json."</script>\n";
  }
}

