<?php
$dir = __DIR__ . '/../includes/schema/';
foreach(glob($dir.'*.php') as $f){
  $content = file_get_contents($f);
  if(stripos($content,'@context')===false){
    echo "❌ Missing @context in $f\n";
  } else {
    echo "✅ $f looks valid\n";
  }
}

