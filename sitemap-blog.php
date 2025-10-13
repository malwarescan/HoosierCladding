<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');

$base  = 'https://www.hoosiercladding.com';
$items = require __DIR__.'/app/config/blog_urls.php';
$today = gmdate('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($items as $it):
  $loc = rtrim($base,'/').($it['loc'] ?? '/');
  $lm  = $it['lastmod'] ?? $today; ?>
  <url>
    <loc><?= htmlspecialchars($loc, ENT_XML1) ?></loc>
    <lastmod><?= $lm ?></lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.6</priority>
  </url>
<?php endforeach; ?>
</urlset>

