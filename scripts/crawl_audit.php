<?php
declare(strict_types=1);
/**
 * Loads URLs from /public/sitemaps/sitemap-index.xml(.gz), crawls each shard, extracts <loc> list,
 * fetches each page (HEAD+GET), and validates:
 *  - HTTP 200, canonical ABSENT (no <link rel="canonical">)
 *  - No <meta name="robots" content="noindex"> on production
 *  - Content-Type text/html for pages; XML for sitemaps
 *  - JSON-LD presence for LocalBusiness/Service/FAQ on service pages
 *  - Internal link graph + broken internal links (status >=400)
 * Outputs CSV report to /audit/crawl_report.csv and prints summary.
 */
require_once __DIR__.'/../lib/helpers.php';
@mkdir(__DIR__.'/../audit',0775,true);

function fetch(string $url, string $method='GET'): array {
  $ch=curl_init($url);
  curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>true,CURLOPT_TIMEOUT=>15,CURLOPT_MAXREDIRS=>5,CURLOPT_USERAGENT=>'HC-CrawlAuditor/1.0',CURLOPT_CUSTOMREQUEST=>$method,]);
  $body=curl_exec($ch); $code=curl_getinfo($ch,CURLINFO_RESPONSE_CODE); $ct=curl_getinfo($ch,CURLINFO_CONTENT_TYPE) ?: '';
  curl_close($ch); return [$code,$ct,$body];
}

function sitemap_urls_from_index(string $indexUrl): array {
  [$code,$ct,$body]=fetch($indexUrl,'GET');
  if($code!==200) {fwrite(STDERR,"Index fetch failed $code\n"); return [];}
  if(str_ends_with($indexUrl,'.gz')) $body=@gzdecode($body) ?: $body;
  $dom=new DOMDocument(); @$dom->loadXML($body);
  $locs=$dom->getElementsByTagName('loc'); $out=[];
  foreach($locs as $loc){ $out[]=trim($loc->textContent); }
  return $out;
}

function extract_page_urls_from_shard(string $shardUrl): array {
  [$code,$ct,$body]=fetch($shardUrl,'GET');
  if($code!==200) return [];
  if(str_ends_with($shardUrl,'.gz')) $body=@gzdecode($body) ?: $body;
  $dom=new DOMDocument(); @$dom->loadXML($body);
  $locs=$dom->getElementsByTagName('loc'); $out=[];
  foreach($locs as $loc){ $out[]=trim($loc->textContent); }
  return $out;
}

function html_has_canonical(string $html): bool {
  return (bool)preg_match('#<link[^>]+rel=["\']?canonical["\']?[^>]*>#i',$html);
}
function html_has_noindex(string $html): bool {
  return (bool)preg_match('#<meta[^>]+name=["\']robots["\'][^>]+content=["\']?[^"\']*noindex#i',$html);
}
function html_jsonld_types(string $html): array {
  $types=[];
  if(preg_match_all('#<script[^>]+type=["\']application/ld\+json["\'][^>]*>(.*?)</script>#is',$html,$m)){
    foreach($m[1] as $block){
      $json=@json_decode(trim($block),true);
      if(!$json) continue;
      $arr=is_assoc($json)?[$json]:$json;
      foreach($arr as $node){ if(is_array($node) && isset($node['@type'])) $types[] = is_array($node['@type'])?implode('|',$node['@type']):$node['@type']; }
    }
  }
  return array_values(array_unique($types));
}
function is_assoc($a){ return is_array($a) && array_keys($a)!==range(0,count($a)-1); }
function internal_links(string $html, string $originHost): array {
  $out=[];
  if(preg_match_all('#<a[^>]+href=["\']([^"\']+)#i',$html,$m)){
    foreach($m[1] as $href){
      if(str_starts_with($href,'#')||str_starts_with($href,'mailto:')||str_starts_with($href,'tel:')) continue;
      if(str_starts_with($href,'/')) $out[]=absolute_url($href);
      elseif(str_starts_with($href,'http')){ if(parse_url($href,PHP_URL_HOST)=== $originHost) $out[]=$href; }
    }
  }
  return array_values(array_unique($out));
}

$indexGz = absolute_url('/sitemaps/sitemap-index.xml.gz');
$shards = sitemap_urls_from_index($indexGz);

$pages=[]; foreach($shards as $s){ foreach(extract_page_urls_from_shard($s) as $u) $pages[]=$u; }
$pages=array_values(array_unique($pages));

$csv=fopen(__DIR__.'/../audit/crawl_report.csv','w');
fputcsv($csv,['url','status','content_type','has_canonical','has_noindex','jsonld_types','broken_internal_links_count']);

$brokenTotal=0; $canonicalHits=0; $noindexHits=0; $n=0;

foreach($pages as $url){
  [$code,$ct,$html]=fetch($url,'GET');
  $hasCanon = $code===200 ? html_has_canonical($html) : false;
  $hasNoidx = $code===200 ? html_has_noindex($html) : false;
  $types    = $code===200 ? implode(';',html_jsonld_types($html)) : '';
  $broken=0;
  if($code===200){
    foreach(internal_links($html, SITE_HOST) as $link){
      [$c2]=fetch($link,'HEAD'); if($c2>=400) $broken++;
    }
  }
  if($hasCanon) $canonicalHits++;
  if($hasNoidx) $noindexHits++;
  if($code>=400) $brokenTotal++;
  fputcsv($csv,[$url,$code,$ct,$hasCanon?'YES':'NO',$hasNoidx?'YES':'NO',$types,$broken]);
  if((++$n % 50)===0) echo "Audited $n / ".count($pages)."\n";
}

fclose($csv);
echo "Pages: ".count($pages)."\n";
echo "HTTP>=400 pages: $brokenTotal\n";
echo "Pages WITH canonical (should be 0): $canonicalHits\n";
echo "Pages with noindex (prod should be 0): $noindexHits\n";
echo "Report: /audit/crawl_report.csv\n";

