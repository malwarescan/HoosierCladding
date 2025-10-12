<?php
declare(strict_types=1);

/**
 * MetaManager
 * - Reads CSV mapping of path -> suggested title + meta description.
 * Place CSV at /app/config/ctr_rewrites.csv with headers:
 * Top_pages,Impressions,Position,Suggested_Title,Suggested_Meta_Description
 */
final class MetaManager
{
  private static array $map = [];
  private static bool $loaded = false;

  private static function load(): void {
    if (self::$loaded) return;
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
}

