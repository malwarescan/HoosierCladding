<?php
require_once __DIR__.'/schema/LocalBusiness.php';
require_once __DIR__.'/schema/Service.php';
require_once __DIR__.'/schema/FAQPage.php';
require_once __DIR__.'/schema/JobPosting.php';

function printAllSchema($data){
  $schemas=[];
  $schemas[]=schemaLocalBusiness();
  if(!empty($data['service'])){
    $schemas[]=schemaService($data['service'],$data['description'] ?? '');
  }
  if(!empty($data['faqs'])){
    $schemas[]=schemaFAQ($data['faqs']);
  }
  if(!empty($data['job'])){
    $schemas[]=schemaJobPosting($data);
  }
  echo "<script type='application/ld+json'>".json_encode($schemas,JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE)."</script>";
}

