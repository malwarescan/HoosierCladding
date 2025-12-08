<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex, nofollow');

$base = 'https://www.hoosiercladding.com';
$csv  = __DIR__ . '/data_matrix/convex_matrix_expanded.csv';

function slugify($s) {
  $s = strtolower(trim($s));
  $s = preg_replace('/[^a-z0-9]+','-', $s);
  return trim($s, '-');
}

$urls = [];
if (file_exists($csv)) {
  if (($h = fopen($csv, 'r')) !== false) {
    $headers = fgetcsv($h, 0, ',', '"', '');
    $map = array_flip(array_map('trim', $headers));
    
    while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
      // Try to get slug directly from CSV first
      if (isset($map['slug']) && !empty($row[$map['slug']])) {
        $slug = trim($row[$map['slug']]);
        $urls[] = $base . '/matrix/' . $slug;
        continue;
      }
      
      // Fallback: build slug from components
      $service = isset($map['primary_keyword']) ? ($row[$map['primary_keyword']] ?? null) : null;
      $city    = isset($map['location']) ? ($row[$map['location']] ?? null) : null;
      
      if (!$service || !$city) continue;
      
      $serviceSlug = slugify($service);
      $citySlug = slugify($city);
      $urls[] = $base . '/matrix/' . $serviceSlug . '/' . $citySlug;
    }
    fclose($h);
  }
}

// Remove duplicates
$urls = array_unique($urls);

$today = gmdate('Y-m-d');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($urls as $u): ?>
  <url>
    <loc><?= htmlspecialchars($u, ENT_XML1) ?></loc>
    <lastmod><?= $today ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
<?php endforeach; ?>
</urlset>

