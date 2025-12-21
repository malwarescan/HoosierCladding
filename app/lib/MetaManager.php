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
    
    // CSV mapping takes precedence (GSC-optimized snippets)
    // Snippet files are deprecated in favor of CSV for easier updates
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

  public static function title(string $path, ?string $default = null): ?string {
    self::load();
    if (isset(self::$map[$path]['title']) && self::$map[$path]['title']) {
      return self::$map[$path]['title'];
    }
    return $default;
  }

  public static function description(string $path, ?string $default = null): ?string {
    self::load();
    if (isset(self::$map[$path]['desc']) && self::$map[$path]['desc']) {
      return self::$map[$path]['desc'];
    }
    return $default;
  }

  public static function canonical(string $path): string {
    // Use CrawlHygiene to get clean canonical (strips query params)
    require_once __DIR__ . '/CrawlHygiene.php';
    return CrawlHygiene::getCanonicalUrl($path);
  }
}

