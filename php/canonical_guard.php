<?php
// Usage: include_once __DIR__ . '/canonical_guard.php';
// Ensure $canonicalUrl is set to the chosen canonical for this request path.
// Example: set it from a lookup map prebuilt from /outputs/canonical_map.csv, or
// compute by removing trailing slash and mapping to preferred variant.
if (!isset($canonicalUrl)) {
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
  $host = $_SERVER['HTTP_HOST'] ?? 'www.hoosiercladding.com';
  $uri  = $_SERVER['REQUEST_URI'] ?? '/';
  $current = $scheme . '://' . $host . $uri;
  // Default canonical: drop trailing slash except for root
  if ($uri !== '/' && substr($uri,-1)==='/') {
    $canonicalUrl = $scheme . '://' . $host . rtrim($uri,'/');
  } else {
    $canonicalUrl = $current;
  }
}
// Emit link rel=canonical
echo '<link rel="canonical" href="'. htmlspecialchars($canonicalUrl, ENT_QUOTES) .'">' . PHP_EOL;
?>
