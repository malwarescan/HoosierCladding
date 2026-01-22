<?php
declare(strict_types=1);
namespace HtmlLayout;

function page($p):string{
  return "<!doctype html><html><head>".$p['head']."</head><body><div class='container'>"
       . $p['breadcrumbs']
       . "<h1>".$p['title_h1']."</h1>"
       . "<div>".$p['intro']."</div>"
       . "<div>".$p['body']."</div>"
       . "</div></body></html>";
}

function breadcrumbs($a){$h='<nav>';foreach($a as$i=>$x)$h.="<a href='{$x['href']}'>".$x['label']."</a>".($i<count($a)-1?' › ':'');return$h.'</nav>'; }

function introBlock($r){
  $b=$r['brand_name']??'Brand'; $l=$r['location']??''; $k=$r['primary_keyword']??''; $p=$r['pain_point']??'';
  $pain = $p ? " to address <strong>".htmlspecialchars($p,ENT_QUOTES)."</strong>" : "";
  return "<p>$b – ".htmlspecialchars($k,ENT_QUOTES)." in ".htmlspecialchars($l,ENT_QUOTES)."$pain.</p><p><button type='button' onclick='openContactModal()' class='btn'>Get Started</button></p>";
}

function faqFromRow($r){
  $h=''; $has=false;
  for($i=1;$i<=6;$i++){
    $q=trim($r["faq_q$i"]??''); $a=trim($r["faq_a$i"]??'');
    if($q && $a){
      $has=true;
      $h.="<details><summary>".htmlspecialchars($q,ENT_QUOTES)."</summary><p>".htmlspecialchars($a,ENT_QUOTES)."</p></details>";
    }
  }
  return $has ? "<section aria-label='FAQ'>$h</section>" : "";
}

function relatedLinks($l){ if(!$l)return''; $h='<ul>'; foreach($l as$x)$h.="<li><a href='{$x['href']}'>".$x['label']."</a></li>"; return $h.'</ul>'; }

