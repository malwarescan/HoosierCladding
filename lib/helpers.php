<?php
declare(strict_types=1);
require_once __DIR__.'/../config/site.php';
function xml(string $s): string { return htmlspecialchars($s, ENT_XML1|ENT_COMPAT, 'UTF-8'); }
function csv_rows_path(string $absPath): array {
  if (!file_exists($absPath)) return [];
  $fh = fopen($absPath,'r'); 
  $hdr = fgetcsv($fh, 0, ',', '"', '\\'); 
  if(!$hdr) { fclose($fh); return []; }
  $rows=[];
  while (($r=fgetcsv($fh, 0, ',', '"', '\\')) !== false) {
    if(count($hdr) !== count($r)) continue; // Skip malformed rows
    $rows[] = array_combine($hdr,$r);
  }
  fclose($fh); 
  return $rows;
}
function csv_rows(string $fileUnderData): array {
  return csv_rows_path(__DIR__ . '/../data/' . ltrim($fileUnderData,'/'));
}

