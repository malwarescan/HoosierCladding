<?php
// /scripts/validate_schema.php
declare(strict_types=1);
$base = 'http://localhost:8080'; // Use localhost for testing
$smap = $base.'/sitemap-matrix.xml';
$required = ['HomeAndConstructionBusiness','BreadcrumbList','Service','FAQPage'];

function get(string $url): string {
  $ctx = stream_context_create(['http' => ['timeout' => 20, 'header' => "User-Agent: SchemaValidator/1.0\r\n"]]);
  $html = @file_get_contents($url, false, $ctx);
  return $html === false ? '' : $html;
}
function urlsFromSitemap(string $xml): array { 
  $sx=@simplexml_load_string($xml); 
  if(!$sx)return []; 
  $urls = [];
  foreach($sx->url as $u) {
    $urls[] = (string)$u->loc;
  }
  return $urls;
}
function jsonld(string $html): array {
  if(!$html) return [];
  if(!preg_match_all('#<script[^>]+type=["\']application/ld\+json["\'][^>]*>(.*?)</script>#is',$html,$m)) return [];
  $out=[]; foreach($m[1] as $b){ $b=html_entity_decode($b,ENT_QUOTES|ENT_HTML5); $j=json_decode($b,true); if($j) $out[]=$j; } return $out;
}
function flatten($n): array {
  $t=[]; if(is_array($n)){ if(isset($n['@type'])) foreach((array)$n['@type'] as $x) $t[]=$x;
  if(isset($n['@graph']) && is_array($n['@graph'])) foreach($n['@graph'] as $g) $t=array_merge($t,flatten($g));
  else foreach($n as $v) if(is_array($v)) $t=array_merge($t,flatten($v)); } return $t;
}
$urls=urlsFromSitemap(get($smap)); if(!$urls){fwrite(STDERR,"No URLs in $smap\n"); exit(1);}
// Convert production URLs to localhost
$urls = array_map(fn($u) => str_replace('https://www.hoosiercladding.com', $base, $u), $urls);
$ok=0;$miss=0;
foreach($urls as $u){
  $types = array_values(array_unique(array_merge(...array_map('flatten', jsonld(get($u))))));
  $missing = array_values(array_diff($required, $types));
  if($missing){$miss++; echo "[MISS] $u\n  Missing: ".implode(', ',$missing)."\n";} else {$ok++; echo "[OK]   $u\n";}
  // break early if needed
  if(($ok+$miss) >= 40) break; // sample first 40 to keep it quick
}
echo "OK=$ok MISS=$miss TotalChecked=".($ok+$miss)."\n";
exit($miss ? 2 : 0);

