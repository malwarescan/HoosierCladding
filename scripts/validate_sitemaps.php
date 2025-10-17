<?php
declare(strict_types=1);
$dir=__DIR__.'/../public/sitemaps'; if(!is_dir($dir)){fwrite(STDERR,"No sitemaps dir\n");exit(1);}
$ok=true; $files=array_merge(glob($dir.'/*.xml'),glob($dir.'/*.xml.gz'));
foreach($files as $f){
  $content=str_ends_with($f,'.gz')?@gzdecode(file_get_contents($f)):@file_get_contents($f);
  if(!$content){echo "EMPTY: $f\n"; $ok=false; continue;}
  if(strlen($content)>51*1024*1024){echo "WARN oversize: $f\n";}
  $dom=new DOMDocument('1.0','UTF-8'); $dom->preserveWhiteSpace=false;
  if(!@$dom->loadXML($content, LIBXML_NOBLANKS|LIBXML_NOERROR|LIBXML_NOWARNING)){echo "BAD XML: $f\n"; $ok=false; continue;}
  $root=$dom->documentElement->tagName;
  if(!in_array($root,['urlset','sitemapindex'])) echo "WARN root <$root> $f\n";
  echo "OK: $f\n";
}
exit($ok?0:2);

