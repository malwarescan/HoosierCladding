<?php
declare(strict_types=1);
require_once __DIR__.'/../lib/sitemap.php';
require_once __DIR__.'/../lib/helpers.php';
require_once __DIR__.'/../config/site.php';

$ins = csv_rows('insights.csv'); $now=time(); $news=[];
foreach($ins as $r){
  $slug=trim($r['slug']??''); if($slug==='') continue;
  $pub=strtotime($r['publication_date']??''); if(!$pub) continue; if(($now-$pub)>48*3600) continue;
  $news[]=['loc'=>absolute_url('/insights/'.$slug.'/'),'title'=>$r['title']??'Article','publication_date'=>gmdate('c',$pub),'language'=>substr(($r['lang']??'en'),0,2),'keywords'=>$r['keywords']??''];
}
// Clean old news shards
$dir=__DIR__.'/../public/sitemaps'; @mkdir($dir,0775,true);
foreach(array_merge(glob($dir.'/news-insights-*.xml'),glob($dir.'/news-insights-*.xml.gz')) as $f) @unlink($f);
// Write news shards
$indexUrls=[]; if(!empty($news)){ $chunks=array_chunk($news,1000); $i=1;
  foreach($chunks as $chunk){ $xml=sitemap_render_news($chunk, PUBLICATION_NAME, $chunk[0]['language']??'en'); [, $gz]=sitemap_write_files('news-insights-'.$i,$xml); $indexUrls[]=$gz; $i++; }
}
// Rebuild unified index from all .xml.gz except index itself
$allGz=glob($dir.'/*.xml.gz'); $shards=[];
foreach($allGz as $p){ $b=basename($p); if($b==='sitemap-index.xml.gz') continue; $shards[]=absolute_url('/sitemaps/'.$b); }
$indexXml=sitemap_render_index($shards); [, $indexGz]=sitemap_write_files('sitemap-index',$indexXml);
// robots
$robots=__DIR__.'/../public/robots.txt'; $lines=[]; if(file_exists($robots)) $lines=file($robots,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
$lines=array_values(array_filter($lines,fn($l)=>stripos($l,'sitemap:')===false)); $lines[]='User-agent: *'; $lines[]='Allow: /'; $lines[]='Sitemap: '.$indexGz;
file_put_contents($robots,implode("\n",$lines)."\n");
echo "News shards rebuilt\n";

