<?php
function schemaLocalBusiness() {
  return [
    "@context" => "https://schema.org",
    "@type" => "LocalBusiness",
    "@id" => "https://www.hoosiercladding.com/#localbusiness",
    "name" => "Hoosier Cladding",
    "url" => "https://www.hoosiercladding.com",
    "telephone" => "574-931-2119",
    "address" => [
      "@type" => "PostalAddress",
      "streetAddress" => "721 Lincoln Way E",
      "addressLocality" => "South Bend",
      "addressRegion" => "IN",
      "postalCode" => "46601",
      "addressCountry" => "US"
    ],
    "email" => "David@Hoosier.works",
    "image" => "https://www.hoosiercladding.com/images/logos/Hoosie-Cladding-Home-Siding-Indiana.webp",
    "priceRange" => "$$",
    "openingHoursSpecification" => [
      "@type" => "OpeningHoursSpecification",
      "dayOfWeek" => ["Monday","Tuesday","Wednesday","Thursday","Friday"],
      "opens" => "08:00",
      "closes" => "17:00"
    ]
  ];
}

