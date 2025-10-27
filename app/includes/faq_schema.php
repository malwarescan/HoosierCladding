<?php
declare(strict_types=1);

function hc_sanitize_faq(string $s): string {
  $s = html_entity_decode($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  $s = preg_replace('/<br\s*\/?>(\r?\n)?/i', "\n", $s ?? '');
  $s = strip_tags($s);
  $s = strtr($s, [
    "\u{201C}" => '"',
    "\u{201D}" => '"',
    "\u{2018}" => "'",
    "\u{2019}" => "'",
  ]);
  $s = preg_replace('/\s+/', ' ', $s ?? '');
  return trim($s);
}

/**
 * @param array<int, array{name:string, answer:string, id?:string}> $faqs
 */
function hc_render_faq_schema(array $faqs): void {
  $clean = [];
  foreach ($faqs as $qa) {
    $q = isset($qa['name']) ? hc_sanitize_faq((string)$qa['name']) : '';
    $a = isset($qa['answer']) ? hc_sanitize_faq((string)$qa['answer']) : '';
    if ($q === '' || $a === '') continue;
    if (mb_strlen($a) > 2000) $a = mb_substr($a, 0, 2000) . '…';
    $item = [
      '@type' => 'Question',
      'name'  => $q,
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => $a,
      ],
    ];
    if (!empty($qa['id'])) $item['@id'] = (string)$qa['id'];
    $clean[] = $item;
  }
  if (!$clean) return;
  $json = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => $clean,
  ];
  echo '<script type="application/ld+json">'.json_encode($json, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>';
}




