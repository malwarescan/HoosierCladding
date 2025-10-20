<?php
// Usage in page template, after setting $serviceName and $cityName (optional):
//   $serviceName = $serviceName ?? 'Home Siding';
//   $cityName = $cityName ?? null;
//   include __DIR__ . '/schema_service.php';

$serviceName = $serviceName ?? 'Home Siding';
$cityName = $cityName ?? null;

$faqPath = __DIR__ . '/../outputs/snippets/' . (isset($slug) ? $slug : 'home') . '/faq.jsonld';
$faqJson = null;
if (file_exists($faqPath)) {
  $faqJson = file_get_contents($faqPath);
}

$schema = [
  "@context" => "https://schema.org",
  "@type" => "LocalBusiness",
  "name" => "Hoosier Cladding",
  "url" => "https://www.hoosiercladding.com",
  "areaServed" => $cityName ? [$cityName . ", IN"] : ["Indiana"],
  "serviceType" => $serviceName
];

echo '<script type="application/ld+json">'. json_encode($schema, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) .'</script>' . PHP_EOL;

if ($faqJson) {
  echo '<script type="application/ld+json">'. $faqJson .'</script>' . PHP_EOL;
}
?>
