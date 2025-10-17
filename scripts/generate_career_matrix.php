<?php
declare(strict_types=1);
require_once __DIR__.'/../lib/helpers.php';
$roles = csv_rows('careers.csv'); $cities = csv_rows('cities.csv');
if(!$roles||!$cities){fwrite(STDERR,"Missing data/careers.csv or data/cities.csv\n");exit(1);}
$today=gmdate('Y-m-d'); $out=fopen(__DIR__.'/../data/career_matrix.csv','w'); fputcsv($out,['role','service','city','lastmod'], ',', '"', '\\'); $n=0;
foreach($roles as $r){ $role=trim($r['slug']??''); if($role==='') continue;
  foreach($cities as $c){ $city=trim($c['city']??''); if($city==='') continue;
    fputcsv($out,[$role,'',$city,$today], ',', '"', '\\'); $n++;
}}
fclose($out); echo "Wrote data/career_matrix.csv ($n rows)\n";

