<?php
declare(strict_types=1);

/**
 * Validates that every URL in public/sitemap-matrix.xml contains JSON-LD for:
 *  - LocalBusiness
 *  - Service
 *  - FAQPage  (only required if the page shows FAQs; if you require it on all pages, enforce strictly)
 *
 * Usage:
 *   php scripts/validate_matrix_schema.php
 */

function fetch(string $url, int $timeout=20): array {
  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS => 5,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_TIMEOUT => $timeout,
    CURLOPT_USERAGENT => 'SchemaValidator/1.0',
    CURLOPT_SSL_VERIFYPEER => true,
  ]);
  $body = curl_exec($ch);
  $info = curl_getinfo($ch);
  $err  = curl_error($ch);
  curl_close($ch);
  return [$info['http_code'] ?? 0, $body ?: '', $err];
}

function hasJsonLdType(string $html, string $type): bool {
  // quick check for JSON-LD script and @type value (case-insensitive)
  if (!preg_match_all('#<script[^>]+type=["\']application/ld\+json["\'][^>]*>(.*?)</script>#is', $html, $m)) return false;
  foreach ($m[1] as $blob) {
    // tolerate multiple objects or arrays
    $blob = trim($blob);
    // guard against invalid JSON: try to find `"@type":"Type"` without full decode
    if (preg_match('~"@type"\s*:\s*"'.preg_quote($type, '~').'"~i', $blob)) return true;
    // decode if possible
    $json = json_decode($blob, true);
    if ($json) {
      $nodes = is_assoc($json) ? [$json] : (is_array($json) ? $json : []);
      foreach ($nodes as $n) {
        if (is_assoc($n) && !empty($n['@type'])) {
          $t = is_array($n['@type']) ? $n['@type'] : [$n['@type']];
          foreach ($t as $tt) if (strcasecmp((string)$tt, $type) === 0) return true;
        }
      }
    }
  }
  return false;
}
function is_assoc($arr){ return is_array($arr) && array_keys($arr)!==range(0,count($arr)-1); }

$root = dirname(__DIR__);
$sitemap = $root.'/public/sitemap-matrix.xml';
if (!is_file($sitemap)) {
  fwrite(STDERR, "ERROR: $sitemap not found. Run: php src/generate-matrix-sitemap.php\n");
  exit(1);
}
$xml = simplexml_load_file($sitemap);
if (!$xml) { fwrite(STDERR, "ERROR: could not parse sitemap\n"); exit(1); }

$urls = [];
foreach ($xml->url as $u) {
  $loc = (string)$u->loc;
  if ($loc) $urls[] = $loc;
}

$total = count($urls);
echo "Validating $total URLs...\n";

$failures = [];
foreach ($urls as $i => $u) {
  [$code, $html, $err] = fetch($u);
  $ok200 = ($code>=200 && $code<300) && $html !== '';

  $hasLB  = $ok200 ? hasJsonLdType($html, 'LocalBusiness') : false;
  $hasSvc = $ok200 ? hasJsonLdType($html, 'Service') : false;

  // FAQ is "required" only if the page visually includes FAQs.
  // If you require FAQ on ALL pages, set $requireFaq = true unconditionally.
  $requireFaq = (stripos($html, '<section aria-label=\'FAQ\'') !== false
              || stripos($html, '<section aria-label="FAQ"') !== false
              || preg_match('~<details>\s*<summary>~i', $html));
  $hasFaq = $ok200 ? hasJsonLdType($html, 'FAQPage') : false;

  $row = [
    'url' => $u,
    'http' => $code,
    'ok' => $ok200 && $hasLB && $hasSvc && (!$requireFaq || $hasFaq),
    'LocalBusiness' => $hasLB ? 'OK' : 'MISS',
    'Service'       => $hasSvc ? 'OK' : 'MISS',
    'FAQPage'       => $requireFaq ? ($hasFaq ? 'OK' : 'MISS') : 'N/A'
  ];
  if (!$row['ok']) $failures[] = $row;

  echo sprintf("[%d/%d] %s  HTTP:%d  LB:%s  Service:%s  FAQ:%s%s\n",
    $i+1,$total,$u,$code,$row['LocalBusiness'],$row['Service'],$row['FAQPage'],
    $row['ok'] ? '' : '  <-- FIX'
  );
}

if ($failures) {
  $csv = fopen($root.'/schema_validation_report.csv','w');
  fputcsv($csv, ['url','http','LocalBusiness','Service','FAQPage']);
  foreach ($failures as $f) fputcsv($csv, [$f['url'],$f['http'],$f['LocalBusiness'],$f['Service'],$f['FAQPage']]);
  fclose($csv);
  echo "Wrote failures to schema_validation_report.csv\n";
  exit(2);
}
echo "All URLs passed schema checks.\n";

