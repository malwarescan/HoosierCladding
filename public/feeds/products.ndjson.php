<?php
declare(strict_types=1);

// === SAFETY: do not let prior output corrupt the stream ===
@ini_set('display_errors', '0');
@ini_set('zlib.output_compression', '0');
@ini_set('implicit_flush', '1');
while (ob_get_level() > 0) { @ob_end_clean(); }
header('Content-Type: application/x-ndjson; charset=utf-8');
header('Cache-Control: public, max-age=300');
header('X-Accel-Buffering: no');

require_once __DIR__ . '/_lib/FeedSource.php'; // your source of PHP arrays

// --- Helpers ---
function utf8_clean(string $s): string {
  // Remove invalid UTF-8 and control chars that can break JSON
  $s = @iconv('UTF-8','UTF-8//IGNORE',$s);
  return preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F]/u','',$s);
}

function asArrayOfImages($img): array {
  if (is_string($img)) $img = [$img];
  if (!is_array($img)) return [];
  $img = array_values(array_filter($img, fn($u) => is_string($u) && preg_match('~^https?://~i',$u)));
  return $img;
}

function fixAggregateRating(?array $ar): ?array {
  if (!$ar) return null;
  foreach (['ratingValue','bestRating','worstRating','reviewCount'] as $k) {
    if (isset($ar[$k])) $ar[$k] = 0 + $ar[$k];
  }
  return $ar;
}

function fixReviews($reviews) {
  if (!is_array($reviews)) return null;
  foreach ($reviews as &$r) {
    if (isset($r['reviewRating']['ratingValue'])) {
      $r['reviewRating']['ratingValue'] = 0 + $r['reviewRating']['ratingValue'];
    }
    if (isset($r['reviewRating']['bestRating'])) {
      $r['reviewRating']['bestRating'] = 0 + $r['reviewRating']['bestRating'];
    }
    if (isset($r['reviewBody']) && is_string($r['reviewBody'])) {
      $r['reviewBody'] = utf8_clean($r['reviewBody']);
    }
  } unset($r);
  return $reviews;
}

function normAvailability($v): string {
  if (!is_string($v)) return 'https://schema.org/InStock';
  $v = strtolower($v);
  if (str_starts_with($v,'http')) return $v;
  $map = [
    'instock'=>'https://schema.org/InStock',
    'outofstock'=>'https://schema.org/OutOfStock',
    'preorder'=>'https://schema.org/PreOrder',
    'backorder'=>'https://schema.org/BackOrder',
  ];
  return $map[$v] ?? 'https://schema.org/InStock';
}

function cleanOffer(?array $o): ?array {
  if (!$o) return null;

  // Normalize price / priceSpecification; drop zero/blank price to avoid invalid rich results
  if (isset($o['price']) && (string)$o['price'] !== '' && (float)$o['price'] == 0.0) {
    unset($o['price']);
  }
  if (isset($o['priceSpecification']['price']) && (float)$o['priceSpecification']['price'] == 0.0) {
    unset($o['priceSpecification']['price']);
  }

  if (isset($o['availability'])) $o['availability'] = normAvailability($o['availability']);
  if (isset($o['itemCondition']) && !str_starts_with((string)$o['itemCondition'],'http')) {
    $o['itemCondition'] = 'https://schema.org/NewCondition';
  }
  return $o;
}

// --- Transform one product row into schema-clean Product object ---
function toProduct(array $row): array {
  $name = utf8_clean((string)($row['name'] ?? ''));
  $desc = utf8_clean((string)($row['description'] ?? ''));

  $prod = [
    '@context'         => 'https://schema.org',
    '@type'            => 'Product',
    'name'             => $name,
    'brand'            => $row['brand'] ?? null,
    'sku'              => (string)($row['sku'] ?? ''),
    'manufacturer'     => $row['manufacturer'] ?? null,
    'category'         => $row['category'] ?? null,
    'description'      => $desc,
    'image'            => asArrayOfImages($row['image'] ?? []),
    'aggregateRating'  => fixAggregateRating($row['aggregateRating'] ?? null),
    'review'           => fixReviews($row['review'] ?? null),
    'offers'           => cleanOffer($row['offers'] ?? null),
    'url'              => (string)($row['url'] ?? ''),
    'additionalProperty'=> $row['additionalProperty'] ?? null,
    'keywords'         => $row['keywords'] ?? null
  ];

  // Remove nulls
  return array_filter($prod, fn($v) => $v !== null);
}

// --- STREAM OUTPUT: one well-formed JSON object per line ---
$iter = Hoosier\Feeds\FeedSource::streamProducts(); // yields PHP arrays (NOT JSON strings)
foreach ($iter as $row) {
  // Guard against accidental JSON string sources; if so, decode first.
  if (is_string($row)) {
    $tmp = json_decode($row, true);
    if (is_array($tmp)) $row = $tmp;
  }

  $obj = toProduct($row);

  // Final safety: ensure required minimal fields; skip bad rows instead of emitting broken JSON
  $min = isset($obj['name'],$obj['url']) && !empty($obj['image']) && isset($obj['brand']);
  if (!$min) continue;

  echo json_encode($obj, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . "\n";
  @flush();
}
