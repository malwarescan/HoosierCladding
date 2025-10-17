<?php
function schemaLocalBusiness() {
  return [
    "@context" => "https://schema.org",
    "@type" => "LocalBusiness",
    "@id" => "https://www.hoosiercladding.com/#localbusiness",
    "name" => "Hoosier Cladding",
    "image" => "https://www.hoosiercladding.com/images/logo.png",
    "url" => "https://www.hoosiercladding.com",
    "telephone" => "+1-574-555-0123",
    "address" => [
      "@type" => "PostalAddress",
      "streetAddress" => "123 Main St",
      "addressLocality" => "South Bend",
      "addressRegion" => "IN",
      "postalCode" => "46601",
      "addressCountry" => "US"
    ],
    "openingHoursSpecification" => [
      "@type" => "OpeningHoursSpecification",
      "dayOfWeek" => ["Monday","Tuesday","Wednesday","Thursday","Friday"],
      "opens" => "08:00",
      "closes" => "17:00"
    ]
  ];
}

