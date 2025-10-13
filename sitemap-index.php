<?php
header('Content-Type: application/xml; charset=UTF-8');

// Prefer static file if it exists
$staticFile = __DIR__.'/public/sitemap.xml';
if (file_exists($staticFile)) {
    readfile($staticFile);
    exit;
}

// Fallback: generate dynamically
$base = 'https://www.hoosiercladding.com';
$today = gmdate('Y-m-d');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <sitemap>
    <loc><?= $base ?>/sitemap-static.xml</loc>
    <lastmod><?= $today ?></lastmod>
  </sitemap>
  <sitemap>
    <loc><?= $base ?>/sitemap-matrix.xml</loc>
    <lastmod><?= $today ?></lastmod>
  </sitemap>
  <sitemap>
    <loc><?= $base ?>/sitemap-blog.xml</loc>
    <lastmod><?= $today ?></lastmod>
  </sitemap>
</sitemapindex>

