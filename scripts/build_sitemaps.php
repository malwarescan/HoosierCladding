<?php
declare(strict_types=1);
require_once __DIR__.'/../lib/helpers.php';
require_once __DIR__.'/../lib/sitemap.php';
require_once __DIR__.'/../config/site.php';

function rows(string $f): array { return csv_rows($f); }

$servicesRows = rows('matrix.csv');        // service,city,lastmod
$careersRows  = rows('career_matrix.csv'); // role,service,city,lastmod
$insightsRows = rows('insights.csv');      // slug,title,lang,publication_date,lastmod,image_url,video_url,video_thumbnail,video_duration,keywords
$imagesMap    = rows('images_map.csv');    // url,image_url,image_title,image_caption

// Standard
$std = [];
foreach ($servicesRows as $r) $std[] = ['path'=>"/services/{$r['service']}/{$r['city']}/",'lastmod'=>$r['lastmod']??null];
foreach ($careersRows  as $r) $std[] = ['path'=>"/careers/{$r['city']}/{$r['role']}/",'lastmod'=>$r['lastmod']??null];
foreach ($insightsRows as $r) if($slug=trim($r['slug']??'')) $std[]=['path'=>"/insights/{$slug}/",'lastmod'=>$r['lastmod']??($r['publication_date']??null)];

// Images
$imgGroups=[];
foreach($imagesMap as $row){ $u=trim($row['url']??''); if($u==='') continue;
  $imgGroups[$u][]=['loc'=>$row['image_url'],'title'=>$row['image_title']??'','caption'=>$row['image_caption']??''];
}
foreach($insightsRows as $r){ if(!empty($r['image_url'])){ $url="/insights/{$r['slug']}/"; $imgGroups[$url][]=['loc'=>$r['image_url'],'title'=>$r['title']??'','caption'=>'Hero image']; } }

// Videos
$vidGroups=[];
foreach($insightsRows as $r){ if(!empty($r['video_url']) && !empty($r['video_thumbnail'])){
  $url="/insights/{$r['slug']}/";
  $vidGroups[$url][]= ['content'=>$r['video_url'],'thumbnail'=>$r['video_thumbnail'],'title'=>$r['title']??'Video','description'=>($r['title']??'Video').' — Hoosier Cladding','duration'=>intval($r['video_duration']??0),'publication_date'=>$r['publication_date']??null];
}}

// News (48h)
$now=time(); $news=[];
foreach($insightsRows as $r){
  $pub=strtotime($r['publication_date']??''); if(!$pub) continue; if(($now-$pub)>48*3600) continue;
  $news[]=['loc'=>absolute_url('/insights/'.trim($r['slug']).'/'),'title'=>$r['title']??'Article','publication_date'=>gmdate('c',$pub),'language'=>substr(($r['lang']??'en'),0,2),'keywords'=>$r['keywords']??''];
}

// Write shards
$indexUrls=[]; $stdShard=10000; $newsShard=1000;

$writeStd=function(string $section,array $entries) use (&$indexUrls,$stdShard){
  $chunks=array_chunk($entries,$stdShard); $i=1;
  foreach($chunks as $chunk){
    $urls=[]; foreach($chunk as $e){ $urls[]=sitemap_entry($e['path'],$e['lastmod']); }
    $xml=sitemap_render_urlset($urls);
    [, $gz]=sitemap_write_files("{$section}-{$i}",$xml);
    $indexUrls[]=$gz; $i++;
  }
};
$writeImages=function(string $section,array $groups) use (&$indexUrls,$stdShard){
  if(empty($groups)) return;
  $rows=[]; foreach($groups as $url=>$images){ $rows[]=['loc'=>absolute_url($url),'images'=>$images]; }
  $chunks=array_chunk($rows,$stdShard); $i=1;
  foreach($chunks as $chunk){ $xml=sitemap_render_images($chunk); [, $gz]=sitemap_write_files("{$section}-{$i}",$xml); $indexUrls[]=$gz; $i++; }
};
$writeVideos=function(string $section,array $groups) use (&$indexUrls,$stdShard){
  if(empty($groups)) return;
  $rows=[]; foreach($groups as $url=>$videos){ $rows[]=['loc'=>absolute_url($url),'videos'=>$videos]; }
  $chunks=array_chunk($rows,$stdShard); $i=1;
  foreach($chunks as $chunk){ $xml=sitemap_render_videos($chunk); [, $gz]=sitemap_write_files("{$section}-{$i}",$xml); $indexUrls[]=$gz; $i++; }
};
$writeNews=function(string $section,array $news) use (&$indexUrls,$newsShard){
  if(empty($news)) return;
  $chunks=array_chunk($news,$newsShard); $i=1;
  foreach($chunks as $chunk){ $xml=sitemap_render_news($chunk, PUBLICATION_NAME, $chunk[0]['language']??'en'); [, $gz]=sitemap_write_files("news-{$section}-{$i}",$xml); $indexUrls[]=$gz; $i++; }
};

$writeStd('services',$std);
$writeImages('images',$imgGroups);
$writeVideos('videos',$vidGroups);
$writeNews('insights',$news);

$indexXml=sitemap_render_index($indexUrls);
[, $indexGz]=sitemap_write_files('sitemap-index',$indexXml);

// robots.txt
$robots=__DIR__.'/../public/robots.txt';
$lines=[]; if(file_exists($robots)) $lines=file($robots,FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
$lines=array_values(array_filter($lines,fn($l)=>stripos($l,'sitemap:')===false));
$lines[]='User-agent: *'; $lines[]='Allow: /'; $lines[]='Sitemap: '.$indexGz;
file_put_contents($robots,implode("\n",$lines)."\n");

echo "Built ".count($indexUrls)." sitemap shards\n";
echo "Unified index: $indexGz\n";

