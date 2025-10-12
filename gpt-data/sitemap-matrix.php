<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');

$base = 'https://www.hoosiercladding.com';
$csv  = __DIR__ . '/matrix_data/convex_matrix.csv'; // columns: service,city,state,zip (headers required)

function slugify($s) {
  $s = strtolower(trim($s));
  $s = preg_replace('/[^a-z0-9]+/','-', $s);
  return trim($s, '-');
}

$urls = [];
if (file_exists($csv)) {
  if (($h = fopen($csv, 'r')) !== false) {
    $headers = fgetcsv($h);
    $map = array_flip($headers);
    while (($row = fgetcsv($h)) !== false) {
      $service = $row[$map['service']] ?? null;
      $city    = $row[$map['city']] ?? null;
      $state   = $row[$map['state']] ?? '';
      $zip     = $row[$map['zip']] ?? '';
      if (!$service || !$city) continue;
      $serviceSlug = slugify($service);
      $loc = slugify($city) . ($state ? '-' . strtolower($state) : '') . ($zip ? '-' . $zip : '');
      $urls[] = $base . '/matrix/' . $serviceSlug . '/' . $loc;
    }
    fclose($h);
  }
}

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
