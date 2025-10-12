<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');

$base = 'https://www.hoosiercladding.com';
$today = gmdate('Y-m-d');

// Prefer: /app/config/blog_urls.php returns [['loc'=>'/home-siding-blog/slug','lastmod'=>'YYYY-MM-DD']]
$phpCfg = __DIR__ . '/app/config/blog_urls.php';
$csvCfg = __DIR__ . '/app/config/blog_index.csv';

$items = [];

if (file_exists($phpCfg)) {
  $items = require $phpCfg;
} elseif (file_exists($csvCfg)) {
  if (($h = fopen($csvCfg, 'r')) !== false) {
    $headers = fgetcsv($h, 0, ',', '"', '');
    $map = array_flip($headers);
    while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
      $loc = $row[$map['loc']] ?? null;
      $lm  = $row[$map['lastmod']] ?? $today;
      if ($loc) $items[] = ['loc'=>$loc, 'lastmod'=>$lm];
    }
    fclose($h);
  }
} else {
  // Fallback blog posts from ctr_rewrites.csv
  $items = [
    ['loc'=>'/home-siding-blog', 'lastmod'=>$today],
    ['loc'=>'/home-siding-blog/install-a-metal-roof-ridge-cap', 'lastmod'=>'2025-10-01'],
    ['loc'=>'/home-siding-blog/siding-replacement-costs-indiana-2025', 'lastmod'=>'2025-10-01'],
    ['loc'=>'/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know', 'lastmod'=>'2025-09-15'],
  ];
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($items as $it):
  $loc = rtrim($base, '/') . (isset($it['loc']) ? $it['loc'] : '/');
  $lm  = $it['lastmod'] ?? $today;
?>
  <url>
    <loc><?= htmlspecialchars($loc, ENT_XML1) ?></loc>
    <lastmod><?= $lm ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>

