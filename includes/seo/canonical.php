<?php
function canonicalTag($url){
  $canon = strtok($url,'?');
  echo "<link rel='canonical' href='".htmlspecialchars($canon,ENT_QUOTES)."' />";
}

