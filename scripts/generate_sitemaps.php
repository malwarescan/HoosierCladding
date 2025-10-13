<?php
declare(strict_types=1);

$base    = 'https://www.hoosiercladding.com';
$csv     = __DIR__.'/../data_matrix/convex_matrix_expanded.csv';
$outDir  = __DIR__.'/../public';
$chunk   = 10000;
$today   = gmdate('Y-m-d');

function slugify($s){ $s=strtolower(trim($s)); $s=preg_replace('/[^a-z0-9]+/','-',$s); return trim($s,'-'); }

function writeSitemap($path,$urls,$today){
  $fh=fopen($path,'w'); 
  fwrite($fh,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n");
  foreach($urls as $u){ 
    fwrite($fh,"  <url>\n");
    fwrite($fh,"    <loc>".htmlspecialchars($u,ENT_XML1)."</loc>\n");
    fwrite($fh,"    <lastmod>$today</lastmod>\n");
    fwrite($fh,"    <changefreq>weekly</changefreq>\n");
    fwrite($fh,"    <priority>0.8</priority>\n");
    fwrite($fh,"  </url>\n");
  }
  fwrite($fh,"</urlset>\n"); 
  fclose($fh);
}

if(!is_dir($outDir)) mkdir($outDir,0775,true);

// Load matrix URLs from CSV
$urls=[];
if(file_exists($csv) && ($h=@fopen($csv,'r'))){
  $headers=fgetcsv($h, 0, ',', '"', '');
  $headers = array_map('trim', $headers);
  $map=array_flip($headers);
  
  while(($r=fgetcsv($h, 0, ',', '"', ''))!==false){
    // Use slug column if available
    if(isset($map['slug']) && !empty($r[$map['slug']])){
      $slug = trim($r[$map['slug']]);
      $urls[]="$base/matrix/$slug";
      continue;
    }
    
    // Fallback to building from components
    $service=$r[$map['service']] ?? $r[$map['primary_keyword']] ?? '';
    $city=$r[$map['city']] ?? $r[$map['location']] ?? '';
    $state=$r[$map['state']] ?? $r[$map['region']] ?? '';
    $zip=$r[$map['zip']] ?? $r[$map['postal']] ?? '';
    
    if(!$service||!$city)continue;
    
    $serviceSlug = slugify($service);
    $locParts = explode('-', slugify($city));
    if($state) $locParts[] = strtolower(substr(preg_replace('/[^a-z]/i','',$state),0,2));
    $locSlug = implode('-', $locParts);
    
    $urls[]="$base/matrix/$serviceSlug/$locSlug";
  } 
  fclose($h);
}

// Remove duplicates
$urls = array_unique($urls);
sort($urls);

// Split into chunks (Google limit: 50k URLs per sitemap)
$parts=array_chunk($urls,$chunk);
$childFiles=[];
foreach($parts as $i=>$set){
  $file="$outDir/sitemap-matrix-".($i+1).".xml";
  writeSitemap($file,$set,$today);
  $childFiles[]=basename($file);
  echo "✅ Generated ".basename($file)." (".count($set)." URLs)\n";
}

// Generate sitemap index
$idx="$outDir/sitemap.xml";
$static='sitemap-static.xml';
$blog='sitemap-blog.xml';
$fh=fopen($idx,'w');
fwrite($fh,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<sitemapindex xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n");
fwrite($fh,"  <sitemap>\n    <loc>$base/$static</loc>\n    <lastmod>$today</lastmod>\n  </sitemap>\n");
foreach($childFiles as $b){
  fwrite($fh,"  <sitemap>\n    <loc>$base/$b</loc>\n    <lastmod>$today</lastmod>\n  </sitemap>\n");
}
fwrite($fh,"  <sitemap>\n    <loc>$base/$blog</loc>\n    <lastmod>$today</lastmod>\n  </sitemap>\n");
fwrite($fh,"</sitemapindex>\n");
fclose($fh);

echo "✅ Generated sitemap.xml (index with ".count($childFiles)." matrix sitemaps)\n";
echo "✅ Total matrix URLs: ".count($urls)."\n";

