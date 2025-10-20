<?php
declare(strict_types=1);
/**
 * Include this file from your global <head> template, AFTER <title> and meta tags.
 * It injects JSON-LD for LocalBusiness, BreadcrumbList, Service and FAQPage on /matrix/*.
 */
require_once __DIR__.'/../lib/schema.php';
require_once __DIR__.'/../lib/faq_extractor.php';
require_once __DIR__.'/../includes/faq_schema.php';

$biz = require __DIR__.'/../config/business.php';
$reqPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

if (Schema::isMatrixRoute($reqPath)) {
  $ctx = Schema::parseMatrix($reqPath);
  $service = $ctx['service'] ?: 'Siding Services';
  $city    = $ctx['city']   ?: $biz['locality'];
  $state   = $ctx['state']  ?: $biz['region'];
  $painPoint = $ctx['painPoint'] ?? '';

  // Canonical URL
  $canonical = rtrim($biz['url'], '/').$reqPath;

  // 1) LocalBusiness
  $localBusiness = [
    '@context'=>'https://schema.org',
    '@type'=>'HomeAndConstructionBusiness',
    '@id'=> $biz['url'].'/#org',
    'name'=> $biz['name'],
    'legalName'=> $biz['legalName'],
    'image'=> $biz['logo'],
    'url'=> $biz['url'],
    'logo'=> $biz['logo'],
    'telephone'=> $biz['telephone'],
    'email'=> $biz['email'],
    'priceRange'=> '$$',
    'address'=> [
      '@type'=>'PostalAddress',
      'streetAddress'=> $biz['street'],
      'addressLocality'=> $biz['locality'],
      'addressRegion'=> $biz['region'],
      'postalCode'=> $biz['postalCode'],
      'addressCountry'=> $biz['country']
    ],
    'geo'=> [
      '@type'=>'GeoCoordinates',
      'latitude'=> $biz['geo']['lat'],
      'longitude'=> $biz['geo']['lng']
    ],
    'areaServed'=> [
      '@type'=>'City',
      'name'=> $city,
      'containedInPlace' => [
        '@type' => 'State',
        'name' => $state === 'IN' ? 'Indiana' : $state
      ]
    ],
    'sameAs'=> $biz['sameAs']
  ];

  // 2) Breadcrumbs
  $crumbs = [
    '@context'=>'https://schema.org',
    '@type'=>'BreadcrumbList',
    'itemListElement'=> [
      ['@type'=>'ListItem','position'=>1,'name'=>'Home','item'=>$biz['url'].'/'],
      ['@type'=>'ListItem','position'=>2,'name'=>'Service Area','item'=>$biz['url'].'/service-area'],
      ['@type'=>'ListItem','position'=>3,'name'=>$service.' in '.$city.', '.$state,'item'=>$canonical]
    ]
  ];

  // 3) Service for this matrix page
  $serviceDescription = $service.' in '.$city.', '.$state;
  if ($painPoint) {
    $serviceDescription .= ' - Solving '.$painPoint;
  }
  
  $serviceSchema = [
    '@context'=>'https://schema.org',
    '@type'=>'Service',
    '@id'=> $canonical.'#service',
    'serviceType'=> $service,
    'name'=> $service.' in '.$city,
    'description'=> $serviceDescription,
    'provider'=> ['@id'=>$biz['url'].'/#org'],
    'areaServed'=> [
      '@type'=>'City',
      'name'=> $city,
      'containedInPlace' => [
        '@type' => 'State',
        'name' => $state === 'IN' ? 'Indiana' : $state
      ]
    ],
    'hasOfferCatalog'=> [
      '@type'=>'OfferCatalog',
      'name'=> $service.' Packages',
      'itemListElement'=> [
        [
          '@type'=>'Offer',
          'name'=>$service.' — Standard',
          'description'=>'Professional '.$service.' with quality materials and expert installation'
        ],
        [
          '@type'=>'Offer',
          'name'=>$service.' — Premium',
          'description'=>'Premium '.$service.' with upgraded materials and comprehensive warranty'
        ]
      ]
    ],
    'termsOfService'=> $biz['url'].'/contact'
  ];

  // 4) FAQPage
  // Try to get FAQs from matrix data if available
  $matrixRow = null;
  if (isset($GLOBALS['matrix_row'])) {
    $matrixRow = $GLOBALS['matrix_row'];
  }
  
  $faqs = FaqExtractor::fromMatrixRow($matrixRow, $biz['default_faqs']);
  // Sanitize and filter; only emit if we have at least one valid pair
  $cleanFaqs = [];
  foreach ($faqs as $f) {
    $q = isset($f['q']) ? hc_sanitize_faq((string)$f['q']) : '';
    $a = isset($f['a']) ? hc_sanitize_faq((string)$f['a']) : '';
    if ($q === '' || $a === '') continue;
    if (mb_strlen($a) > 2000) $a = mb_substr($a, 0, 2000) . '…';
    $cleanFaqs[] = ['name'=>$q, 'answer'=>$a];
  }

  // Emit JSON-LD
  echo Schema::tag(Schema::encode($localBusiness));
  echo Schema::tag(Schema::encode($crumbs));
  echo Schema::tag(Schema::encode($serviceSchema));
  if (!empty($cleanFaqs)) {
    // Prefer sanitized renderer to avoid blanks/HTML
    hc_render_faq_schema($cleanFaqs);
  }
}

