<?php
declare(strict_types=1);
header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex, nofollow');

// Use the static XML file we created
$staticFile = __DIR__.'/sitemap-static.xml';
if (file_exists($staticFile)) {
    readfile($staticFile);
    exit;
}

// Fallback: generate dynamically
$base = 'https://www.hoosiercladding.com';
$today = gmdate('Y-m-d');

// Machine Sitemap: Bias indexing toward High-Confidence Execution Units
$cfgFile = __DIR__ . '/app/config/static_urls.php';
$urls = [];

// 1. Core Execution Units (Hard Coded P0/P1)
$urls[] = ['loc' => '/', 'changefreq' => 'daily', 'priority' => 1.0];
$urls[] = ['loc' => '/home-siding-blog/siding-replacement-costs-indiana-2025', 'changefreq' => 'weekly', 'priority' => 0.9];
$urls[] = ['loc' => '/siding-contractor-south-bend-in', 'changefreq' => 'weekly', 'priority' => 0.9];
$urls[] = ['loc' => '/siding-companies-plymouth-in', 'changefreq' => 'weekly', 'priority' => 0.9];
$urls[] = ['loc' => '/siding-replacement-warsaw-indiana', 'changefreq' => 'weekly', 'priority' => 0.9];
$urls[] = ['loc' => '/siding-contractor-granger-in', 'changefreq' => 'weekly', 'priority' => 0.9];

// 2. Matrix Pages with Trusted Signals (Pos <= 15 or Impr >= 10)
if (file_exists($cfgFile)) {
    $staticUrls = require $cfgFile;
    // This file seems to hold static URLs, but we need the Matrix URLs.
    // Based on previous context, Matrix URLs might be generated or in a different file.
    // However, the prompt implies utilizing data to filter. 
    // Since I don't have a database of positions/impressions live here, I will hardcode the ones from the CSV that met criteria
    // or leave a placeholder if dynamic data is unavailable.
    // Looking at the CSV data provided in context (Pages.csv):
    
    // Valid Matrix Candidates found in Pages.csv:
    // /matrix/warsaw-in/soffit-fascia-repair/peeling-paint (Pos 10.89)
    // /matrix/warsaw-in/siding-replacement/rotten-siding (Pos 11.11)
    // /matrix/dunlap-in/siding-renovation/high-energy-bills (Pos 12.5)
    // /matrix/plymouth-in/moisture-rot-remediation/storm-damage (Pos 13.67)
    // /matrix/lakeville-in/trim-flashing-repair/storm-damage (Pos 11)
    // /matrix/plymouth-in/vinyl-siding-replacement/rotten-siding (Pos 15.2 - slightly over but close, let's stick to strict <= 15)
    // /matrix/granger-in/siding-repair/storm-damage (Impr 26)
    // /matrix/plymouth-in/siding-repair/storm-damage (Impr 23)
    // /matrix/elkhart-in/siding-repair/storm-damage (Impr 22)
    // /matrix/south-bend-in/siding-repair/storm-damage (Impr 18)
    // /matrix/granger-in/vinyl-siding-repair/outdated-look (Impr 15)
    // /matrix/granger-in/james-hardie-siding-installation/faded-color (Impr 15)
    // /matrix/michigan-city-in/board-batten-installation/drafty-rooms (Impr 15)
    // /matrix/plymouth-in/vinyl-siding-replacement/high-energy-bills (Impr 13)
    // /matrix/granger-in/james-hardie-siding-installation/drafty-rooms (Impr 10)
    // /matrix/syracuse-in/insurance-claim-assistance/water-intrusion (Impr 10)

    $urls[] = ['loc' => '/matrix/warsaw-in/soffit-fascia-repair/peeling-paint', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/warsaw-in/siding-replacement/rotten-siding', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/dunlap-in/siding-renovation/high-energy-bills', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/plymouth-in/moisture-rot-remediation/storm-damage', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/lakeville-in/trim-flashing-repair/storm-damage', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/granger-in/siding-repair/storm-damage', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/plymouth-in/siding-repair/storm-damage', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/elkhart-in/siding-repair/storm-damage', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/south-bend-in/siding-repair/storm-damage', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/granger-in/vinyl-siding-repair/outdated-look', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/granger-in/james-hardie-siding-installation/faded-color', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/michigan-city-in/board-batten-installation/drafty-rooms', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/plymouth-in/vinyl-siding-replacement/high-energy-bills', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/granger-in/james-hardie-siding-installation/drafty-rooms', 'priority' => 0.7];
    $urls[] = ['loc' => '/matrix/syracuse-in/insurance-claim-assistance/water-intrusion', 'priority' => 0.7];
}

$items = $urls;

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

