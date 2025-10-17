<?php
declare(strict_types=1);
require_once __DIR__.'/../lib/helpers.php';
$services = csv_rows('services.csv'); $cities = csv_rows('cities.csv');
if(!$services||!$cities){fwrite(STDERR,"Missing data/services.csv or data/cities.csv\n");exit(1);}
$today=gmdate('Y-m-d'); $out=fopen(__DIR__.'/../data/matrix.csv','w'); fputcsv($out,['service','city','lastmod'], ',', '"', '\\');
foreach($services as $s){
  $svc=trim($s['slug']??''); if($svc==='') continue;
  foreach($cities as $c){ $city=trim($c['city']??''); if($city==='') continue; fputcsv($out,[$svc,$city,$today], ',', '"', '\\'); }
}
fclose($out); echo "Wrote data/matrix.csv\n";

