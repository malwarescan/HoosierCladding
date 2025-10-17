<?php
function schemaFAQ($faqs){
  $faqItems=[];
  foreach($faqs as $q=>$a){
    $faqItems[]=[
      "@type"=>"Question",
      "name"=>$q,
      "acceptedAnswer"=>["@type"=>"Answer","text"=>$a]
    ];
  }
  return [
    "@context"=>"https://schema.org",
    "@type"=>"FAQPage",
    "mainEntity"=>$faqItems
  ];
}

