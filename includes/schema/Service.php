<?php
function schemaService($serviceName,$description,$price=null){
  return [
    "@context"=>"https://schema.org",
    "@type"=>"Service",
    "name"=>$serviceName,
    "description"=>$description,
    "provider"=>["@type"=>"LocalBusiness","name"=>"Hoosier Cladding"],
    "areaServed"=>["@type"=>"AdministrativeArea","name"=>"Indiana"],
    "offers"=>[
      "@type"=>"Offer",
      "priceCurrency"=>"USD",
      "price"=>$price ?? "0",
      "availability"=>"https://schema.org/InStock"
    ]
  ];
}

