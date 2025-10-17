<?php
$base = "https://www.hoosiercladding.com";
$sections = ["services","faq","matrix"];
$today = date('Y-m-d');
$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
$xml .= "<sitemapindex xmlns='http://www.sitemaps.org/schemas/sitemap/0.9'>";
foreach($sections as $s){
  $xml .= "<sitemap><loc>{$base}/sitemap-{$s}.xml</loc><lastmod>{$today}</lastmod></sitemap>";
}
$xml .= "</sitemapindex>";
file_put_contents(__DIR__."/../public/sitemap.xml",$xml);
echo "Sitemap index built.\n";

