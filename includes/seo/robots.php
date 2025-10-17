<?php
function robotsHeader($index=true){
  echo $index ? "<meta name='robots' content='index,follow'>" :
                 "<meta name='robots' content='noindex,nofollow'>";
}

