<?php
// Footer partial
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
$ADDRESS = '721 Lincoln Way E, South Bend, IN 46601';
$SITE = 'Hoosier Cladding LLC';
?>
<footer class="bg-gray-900">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
      <!-- Company Info -->
      <div class="lg:col-span-2">
        <div class="flex items-center gap-x-3 mb-6">
          <div class="flex-shrink-0">
            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg>
            </div>
          </div>
          <div class="grow">
            <h3 class="text-xl font-bold text-white"><?= $SITE ?></h3>
          </div>
        </div>
        
        <p class="text-gray-300 mb-6 leading-relaxed">
          Professional siding installation, repair, and replacement services in Northern Indiana. 
          Serving South Bend, Mishawaka, Elkhart, and surrounding areas with quality craftsmanship and local expertise.
        </p>
        
        <div class="space-y-3">
          <div class="flex items-center gap-x-3">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
            </div>
            <p class="text-gray-300"><?= $ADDRESS ?></p>
          </div>
          
          <div class="flex items-center gap-x-3">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
              </svg>
            </div>
            <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><?= $PHONE ?></a>
          </div>
          
          <div class="flex items-center gap-x-3">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
              </svg>
            </div>
            <a href="mailto:<?= $EMAIL ?>" class="text-blue-400 hover:text-blue-300 transition-colors duration-200"><?= $EMAIL ?></a>
          </div>
        </div>
      </div>
      
      <!-- Services -->
      <div>
        <h4 class="text-lg font-semibold text-white mb-6">Services</h4>
        <ul class="space-y-3">
          <li>
            <a href="/siding" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-x-2">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              Siding Installation
            </a>
          </li>
          <li>
            <a href="/siding" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-x-2">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              Siding Repair
            </a>
          </li>
          <li>
            <a href="/house-siding-replacement" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-x-2">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
              </svg>
              Siding Replacement
            </a>
          </li>
        </ul>
      </div>
      
      <!-- Quick Links -->
      <div>
        <h4 class="text-lg font-semibold text-white mb-6">Quick Links</h4>
        <ul class="space-y-3">
          <li>
            <a href="/" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-x-2">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
              </svg>
              Home
            </a>
          </li>
          <li>
            <a href="/service-area" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-x-2">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
              </svg>
              Service Area
            </a>
          </li>
          <li>
            <a href="/contact" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center gap-x-2">
              <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
              </svg>
              Contact
            </a>
          </li>
        </ul>
      </div>
    </div>
    
    <!-- Bottom Bar -->
    <div class="border-t border-gray-800 mt-12 pt-8">
      <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
        <p class="text-gray-400 text-sm">
          &copy; <?= date('Y') ?> <?= $SITE ?>. All rights reserved.
        </p>
        
        <div class="flex items-center gap-x-6">
          <a href="/privacy" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy Policy</a>
          <a href="/terms" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms of Service</a>
        </div>
      </div>
    </div>
  </div>
</footer>

<!-- Contact Modal -->
<?php include __DIR__ . '/contact-modal.php'; ?>

<!-- Preline UI JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/preline@2.3.0/dist/preline.min.js"></script>