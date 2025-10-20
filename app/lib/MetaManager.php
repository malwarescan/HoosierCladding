<?php
declare(strict_types=1);

/**
 * MetaManager
 * - Reads GSC-generated snippets for optimized titles and meta descriptions
 * - Falls back to CSV mapping if snippets not available
 * - Provides canonical URL generation
 */
final class MetaManager
{
  private static array $map = [];
  private static bool $loaded = false;

  private static function load(): void {
    if (self::$loaded) return;
    
    // First try GSC-generated snippets
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $slug = trim($path, '/') ?: 'home';
    
    $titleFile = __DIR__ . '/../../outputs/snippets/' . $slug . '/title.txt';
    $metaFile = __DIR__ . '/../../outputs/snippets/' . $slug . '/meta.txt';
    
    if (file_exists($titleFile) && file_exists($metaFile)) {
      self::$map[$path] = [
        'title' => trim(file_get_contents($titleFile)),
        'desc' => trim(file_get_contents($metaFile))
      ];
      self::$loaded = true;
      return;
    }
    
    // Fallback to CSV mapping
    $file = __DIR__ . '/../config/ctr_rewrites.csv';
    if (!file_exists($file)) { self::$loaded = true; return; }
    if (($h = fopen($file, 'r')) !== false) {
      $headers = fgetcsv($h, 0, ',', '"', '');
      $idx = array_flip($headers);
      while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
        $url  = $row[$idx['Top_pages']] ?? null;
        $tit  = $row[$idx['Suggested_Title']] ?? null;
        $desc = $row[$idx['Suggested_Meta_Description']] ?? null;
        if (!$url) continue;
        $path = parse_url($url, PHP_URL_PATH) ?: '/';
        self::$map[$path] = ['title'=>$tit, 'desc'=>$desc];
      }
      fclose($h);
    }
    self::$loaded = true;
  }

  public static function title(string $path, string $default): string {
    self::load();
    if (isset(self::$map[$path]['title']) && self::$map[$path]['title']) {
      return self::$map[$path]['title'];
    }
    return $default;
  }

  public static function description(string $path, string $default): string {
    self::load();
    if (isset(self::$map[$path]['desc']) && self::$map[$path]['desc']) {
      return self::$map[$path]['desc'];
    }
    return $default;
  }

  public static function canonical(string $path): string {
    $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'] ?? 'www.hoosiercladding.com';
    
    // Remove trailing slash except for root
    if ($path !== '/' && substr($path, -1) === '/') {
      $path = rtrim($path, '/');
    }
    
    return $scheme . '://' . $host . $path;
  }
}

