<?php
/**
 * CTA Strip Component
 * Shows contact information and call-to-action
 */
?>
<section class="cta-band">
  <div class="container">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
      <div>
        <h3 class="h3 text-white mb-2">Ready to Get Started?</h3>
        <p class="text-white opacity-90">Get your free estimate today. We call within 1 business day.</p>
      </div>
      <div class="flex flex-col sm:flex-row gap-4 justify-end">
        <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="btn btn-secondary bg-white text-blue-600 hover:bg-gray-50">
          Call <?= $PHONE ?>
        </a>
        <a href="/contact.php" class="btn btn-outline border-white text-white hover:bg-white hover:text-blue-600">
          Get Free Estimate
        </a>
      </div>
    </div>
  </div>
</section>