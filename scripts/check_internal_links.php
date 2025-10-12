<?php
declare(strict_types=1);

$homeInc = __DIR__.'/../includes/home_internal_links.html.php';
$servInc = __DIR__.'/../includes/services_internal_links.html.php';
$base    = 'http://localhost:8080'; // Use localhost for testing, change to production URL when needed

function urlsFromInclude(string $file): array {
  ob_start();
  include $file;
  $html = ob_get_clean();
  preg_match_all('#<a\s+[^>]*href=["\']([^"\']+)["\']#i', $html, $m);
  return $m[1] ?? [];
}

function headStatus(string $url): int {
  $ctx = stream_context_create(['http'=>['method'=>'HEAD','timeout'=>20,'ignore_errors'=>true]]);
  @file_get_contents($url, false, $ctx);
  if (isset($http_response_header[0])) {
    if (preg_match('#\s(\d{3})\s#', $http_response_header[0], $m)) {
      return (int)$m[1];
    }
  }
  return 0;
}

echo "Checking internal links...\n\n";

$links = array_values(array_unique(array_merge(
  urlsFromInclude($homeInc),
  urlsFromInclude($servInc)
)));

if (empty($links)) {
  echo "No links found. Make sure the PHP includes are generating output.\n";
  exit(1);
}

$fail = 0;
foreach ($links as $u) {
  $url = (str_starts_with($u,'http')) ? $u : rtrim($base,'/').$u;
  $code = headStatus($url);
  if ($code !== 200 && $code !== 301) {
    echo "[WARN] $code $url\n";
    $fail++;
  } else {
    echo "[OK]   $code $url\n";
  }
}
echo "\nDone. OK=".((count($links)-$fail))." WARN=$fail Total=".count($links)."\n";
exit($fail ? 2 : 0);

