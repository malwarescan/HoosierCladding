<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex, nofollow');

$base = 'https://www.hoosiercladding.com';
$today = gmdate('Y-m-d');

// Optional: /app/config/static_urls.php returns an array of items
$cfgFile = __DIR__ . '/app/config/static_urls.php';
$items = [];
if (file_exists($cfgFile)) {
  $items = require $cfgFile;
} else {
  // Fallback defaults
  $items = [
    ['loc' => '/',                                'changefreq' => 'weekly',  'priority' => 0.9],
    ['loc' => '/contact',                         'changefreq' => 'yearly',  'priority' => 0.5],
    ['loc' => '/service-area',                    'changefreq' => 'monthly', 'priority' => 0.7],
    ['loc' => '/siding',                          'changefreq' => 'monthly', 'priority' => 0.7],
    ['loc' => '/home-siding-blog',                'changefreq' => 'weekly',  'priority' => 0.6],
    ['loc' => '/window-replacement-south-bend',   'changefreq' => 'monthly', 'priority' => 0.6],
    ['loc' => '/door-replacement-south-bend',     'changefreq' => 'monthly', 'priority' => 0.6],
    ['loc' => '/trimwork-south-bend',             'changefreq' => 'monthly', 'priority' => 0.6],
    ['loc' => '/vinyl-siding-michiana-south-bend','changefreq' => 'monthly', 'priority' => 0.6],
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

