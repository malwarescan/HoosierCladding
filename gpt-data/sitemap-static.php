<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');

$base = 'https://www.hoosiercladding.com';
$today = gmdate('Y-m-d');

// Preferred: define static URLs in /app/config/static_urls.php returning an array of items:
// [ ['loc' => '/about-us', 'changefreq' => 'monthly', 'priority' => 0.6, 'lastmod' => '2025-10-10'], ... ]
$cfgFile = __DIR__ . '/app/config/static_urls.php';
$items = [];
if (file_exists($cfgFile)) {
  $items = require $cfgFile;
} else {
  // Fallback sensible defaults; update as needed
  $items = [
    ['loc' => '/',                       'changefreq' => 'weekly',  'priority' => 0.9],
    ['loc' => '/our-services',           'changefreq' => 'weekly',  'priority' => 0.8],
    ['loc' => '/service-area',           'changefreq' => 'monthly', 'priority' => 0.6],
    ['loc' => '/about-us',               'changefreq' => 'yearly',  'priority' => 0.3],
    ['loc' => '/contact',                'changefreq' => 'yearly',  'priority' => 0.3],
    ['loc' => '/home-siding-blog',       'changefreq' => 'weekly',  'priority' => 0.5],
    ['loc' => '/window-replacement-south-bend', 'changefreq' => 'monthly', 'priority' => 0.5],
    ['loc' => '/door-replacement-south-bend',   'changefreq' => 'monthly', 'priority' => 0.5],
    ['loc' => '/trimwork-south-bend',           'changefreq' => 'monthly', 'priority' => 0.5],
    ['loc' => '/vinyl-siding-mishawaka',        'changefreq' => 'monthly', 'priority' => 0.5],
  ];
}

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($items as $it):
  $loc = rtrim($base, '/') . (isset($it['loc']) ? $it['loc'] : '/');
  $lm  = $it['lastmod'] ?? $today;
  $cf  = $it['changefreq'] ?? 'monthly';
  $pr  = $it['priority'] ?? 0.5;
?>
  <url>
    <loc><?= htmlspecialchars($loc, ENT_XML1) ?></loc>
    <lastmod><?= $lm ?></lastmod>
    <changefreq><?= $cf ?></changefreq>
    <priority><?= number_format((float)$pr, 1) ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
