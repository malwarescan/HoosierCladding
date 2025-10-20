<?php
declare(strict_types=1);
namespace SchemaRenderer;

/**
 * Google references:
 * LocalBusiness: https://developers.google.com/search/docs/appearance/structured-data/local-business
 * Product: https://developers.google.com/search/docs/appearance/structured-data/product
 * FAQPage: https://developers.google.com/search/docs/appearance/structured-data/faqpage
 * 
 * Enhanced with modular schema support from includes/schema/
 */

// Load new modular schema functions if available
if (file_exists(__DIR__.'/schema/LocalBusiness.php')) require_once __DIR__.'/schema/LocalBusiness.php';
if (file_exists(__DIR__.'/schema/Service.php')) require_once __DIR__.'/schema/Service.php';
if (file_exists(__DIR__.'/schema/FAQPage.php')) require_once __DIR__.'/schema/FAQPage.php';
if (file_exists(__DIR__.'/schema/JobPosting.php')) require_once __DIR__.'/schema/JobPosting.php';
if (file_exists(__DIR__.'/seo/canonical.php')) require_once __DIR__.'/seo/canonical.php';
if (file_exists(__DIR__.'/seo/robots.php')) require_once __DIR__.'/seo/robots.php';

function wrap($p){ return '<script type="application/ld+json">'.json_encode($p, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE).'</script>'; }

function org($r){
  $o = [
    "@type" => "Organization",
    "name"  => $r['brand_name'] ?? 'Brand',
    "url"   => $r['brand_url']  ?? 'https://example.com'
  ];
  if (!empty($r['brand_sameas'])) $o["sameAs"] = array_values(array_filter(array_map('trim', explode(',', (string)$r['brand_sameas']))));
  return $o;
}

function addr($r){
  return [
    "@type"=>"PostalAddress",
    "streetAddress"=>$r['street']??'',
    "addressLocality"=>$r['city']??'',
    "addressRegion"=>$r['region']??'',
    "postalCode"=>$r['postal']??'',
    "addressCountry"=>$r['country']??'US'
  ];
}

/** Always include LocalBusiness for eligibility in local surfaces (Search/Maps) */
function localbusiness($r){
  $lb = [
    "@context"=>"https://schema.org",
    "@type"=>"LocalBusiness",
    "name"=>$r['brand_name']??'Brand',
    "url"=>$r['brand_url']??'',
    "telephone"=>$r['contact_phone']??'',
    "email"=>$r['contact_email']??'',
    "address"=>addr($r),
  ];
  // Optional: areaServed string for clarity
  if (!empty($r['location'])) $lb["areaServed"] = $r['location'];
  return wrap($lb);
}

/** Service schema for each landing page */
function service($r){
  $name = trim(($r['primary_keyword']??'Service').' '.(!empty($r['pain_point']) ? "– ".$r['pain_point'] : ''));
  $svc = [
    "@context"=>"https://schema.org",
    "@type"=>"Service",
    "name"=>$name,
    "description"=>$r['meta_description']??'',
    "provider"=>org($r),
  ];
  if (!empty($r['location'])) $svc["areaServed"] = $r['location'];
  if (!empty($r['price'])){
    $svc["offers"] = [
      "@type"=>"Offer",
      "price" => (float)$r['price'],
      "priceCurrency" => $r['currency'] ?? "USD",
      "url" => $r['page_url'] ?? null
    ];
  }
  return wrap($svc);
}

/** Optional Product schema (use only when you truly sell a fixed package with price/availability) */
function product($r){
  if (empty($r['price'])) return ''; // do not emit Product without an actual offer
  $prod = [
    "@context"=>"https://schema.org",
    "@type"=>"Product",
    "name"=>$r['primary_keyword'] ?? 'Service Package',
    "description"=>$r['meta_description'] ?? '',
    "brand"=>["@type"=>"Brand","name"=>$r['brand_name'] ?? 'Brand'],
    "offers"=>[
      "@type"=>"Offer",
      "price" => (float)$r['price'],
      "priceCurrency" => $r['currency'] ?? 'USD',
      "url" => $r['page_url'] ?? null,
      "availability" => "https://schema.org/InStock"
    ]
  ];
  return wrap($prod);
}

/** FAQPage schema (only if you have Q/A content present on the page) */
function faq($r){
  $pairs = [];
  $sanitize = function(string $s): string {
    $s = html_entity_decode($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $s = strip_tags($s);
    $s = strtr($s, ["\u{201C}"=>'"',"\u{201D}"=>'"',"\u{2018}"=>"'","\u{2019}"=>"'"]);
    $s = preg_replace('/\s+/', ' ', $s);
    return trim((string)$s);
  };
  for ($i=1;$i<=6;$i++){
    $q = $sanitize((string)($r["faq_q$i"] ?? ''));
    $a = $sanitize((string)($r["faq_a$i"] ?? ''));
    if ($q && $a){
      if (mb_strlen($a) > 2000) $a = mb_substr($a, 0, 2000) . '…';
      $pairs[] = [
        "@type"=>"Question",
        "name"=>$q,
        "acceptedAnswer"=>["@type"=>"Answer","text"=>$a]
      ];
    }
  }
  if (!$pairs) return '';
  $faq = [
    "@context"=>"https://schema.org",
    "@type"=>"FAQPage",
    "mainEntity"=>$pairs
  ];
  return wrap($faq);
}

/** Render all applicable JSON-LD blocks */
function render($r): string {
  $out  = localbusiness($r);       // always include
  $out .= service($r);             // page-specific
  $out .= faq($r);                 // conditional
  // Emit Product only for true package SKUs with price:
  // $out .= product($r);
  return $out;
}

