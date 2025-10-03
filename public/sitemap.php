<?php
// Serve sitemap.xml with proper headers
header('Content-Type: application/xml; charset=utf-8');
header('Cache-Control: public, max-age=86400'); // Cache for 24 hours

// Read and output the sitemap.xml file
$sitemapPath = __DIR__ . '/sitemap.xml';
if (file_exists($sitemapPath)) {
    readfile($sitemapPath);
} else {
    // Fallback sitemap if file doesn't exist
    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://hoosiercladding.com/</loc>
    <lastmod>' . date('Y-m-d') . '</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
</urlset>';
}
?>
