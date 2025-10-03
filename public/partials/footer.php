<?php
/**
 * Footer Component
 * Site footer with contact info and links
 */
?>
<footer class="footer">
  <div class="container">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <div>
        <h4 class="h4 text-white mb-4"><?= $SITE ?></h4>
        <p class="text-gray-400 mb-4"><?= $ADDRESS ?></p>
        <div class="space-y-2">
          <p class="text-gray-400">Phone: <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="text-white hover:text-blue-400"><?= $PHONE ?></a></p>
          <p class="text-gray-400">Email: <a href="mailto:<?= $EMAIL ?>" class="text-white hover:text-blue-400"><?= $EMAIL ?></a></p>
        </div>
      </div>
      
      <div>
        <h5 class="h5 text-white mb-4">Service Areas</h5>
        <div class="grid grid-cols-2 gap-2">
          <a href="/south-bend-siding" class="text-gray-400 hover:text-white">South Bend</a>
          <a href="/mishawaka-siding" class="text-gray-400 hover:text-white">Mishawaka</a>
          <a href="/elkhart-siding" class="text-gray-400 hover:text-white">Elkhart</a>
          <a href="/granger-siding" class="text-gray-400 hover:text-white">Granger</a>
          <a href="/niles-siding" class="text-gray-400 hover:text-white">Niles</a>
          <a href="/osceola-siding" class="text-gray-400 hover:text-white">Osceola</a>
        </div>
      </div>
      
      <div>
        <h5 class="h5 text-white mb-4">Services</h5>
        <div class="space-y-2">
          <a href="/siding" class="text-gray-400 hover:text-white block">Siding Installation</a>
          <a href="/siding-repair" class="text-gray-400 hover:text-white block">Siding Repair</a>
          <a href="/siding-replacement" class="text-gray-400 hover:text-white block">Siding Replacement</a>
          <a href="/james-hardie-siding" class="text-gray-400 hover:text-white block">James Hardie Siding</a>
          <a href="/vinyl-siding" class="text-gray-400 hover:text-white block">Vinyl Siding</a>
        </div>
      </div>
    </div>
    
    <div class="border-t border-gray-800 mt-8 pt-8 text-center">
      <p class="text-gray-400 text-sm">
        &copy; <?= date('Y') ?> <?= $SITE ?>. All rights reserved. | 
        <a href="/privacy" class="text-gray-400 hover:text-white">Privacy Policy</a> | 
        <a href="/terms" class="text-gray-400 hover:text-white">Terms of Service</a>
      </p>
    </div>
  </div>
</footer>