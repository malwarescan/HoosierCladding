<?php
function schemaJobPosting($data) {
  // Safe coercion for invalid enum "experienceRequirements"
  $allowedExp = ['ENTRY_LEVEL','MID_SENIOR_LEVEL','SENIOR_LEVEL','NO_EXPERIENCE_REQUIRED'];
  $exp = strtoupper(trim($data['experienceRequirements'] ?? ''));
  if (!in_array($exp, $allowedExp)) $exp = 'NO_EXPERIENCE_REQUIRED';

  // Ensure offers are valid
  $offers = [
    "@type" => "Offer",
    "priceCurrency" => "USD",
    "price" => $data['price'] ?? "0",
    "priceValidUntil" => date('Y-m-d', strtotime('+6 months')),
    "availability" => "https://schema.org/InStock"
  ];

  return [
    "@context" => "https://schema.org",
    "@type" => "JobPosting",
    "title" => $data['title'] ?? "Construction Professional",
    "description" => strip_tags($data['description'] ?? ""),
    "employmentType" => $data['employmentType'] ?? "FULL_TIME",
    "experienceRequirements" => ucfirst(strtolower(str_replace('_',' ',$exp))),
    "datePosted" => $data['datePosted'] ?? date('Y-m-d'),
    "validThrough" => $data['validThrough'] ?? date('Y-m-d', strtotime('+90 days')),
    "hiringOrganization" => [
      "@type" => "Organization",
      "name" => "Hoosier Cladding",
      "sameAs" => "https://www.hoosiercladding.com"
    ],
    "jobLocation" => [
      "@type" => "Place",
      "address" => [
        "@type" => "PostalAddress",
        "addressLocality" => $data['city'] ?? "South Bend",
        "addressRegion" => "IN",
        "postalCode" => "46601",
        "addressCountry" => "US"
      ]
    ],
    "offers" => $offers
  ];
}

