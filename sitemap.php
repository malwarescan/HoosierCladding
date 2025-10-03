<?php
// Serve sitemap.xml with proper XML headers
header('Content-Type: application/xml; charset=utf-8');
header('Cache-Control: public, max-age=86400'); // Cache for 24 hours

// Prevent any output buffering issues
if (ob_get_level()) {
    ob_clean();
}

// Read and output the sitemap.xml file
$sitemapPath = __DIR__ . '/sitemap.xml';
if (file_exists($sitemapPath)) {
    echo file_get_contents($sitemapPath);
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
exit; // Prevent any additional output
?>