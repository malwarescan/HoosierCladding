<?php
declare(strict_types=1);
require_once __DIR__.'/../app/lib/MatrixIndex.php';
$mx = new MatrixIndex(__DIR__.'/../data_matrix/convex_matrix_expanded.csv');

/** Choose your strategy:
 *  A) Curated cities (stable UX) — one link per city
 *  B) First N rows (fastest)
 */
$cities = ['South Bend','Mishawaka','Elkhart','Granger','Plymouth','Niles'];
$links  = $mx->topByCity($cities, 1);
if (!$links) $links = $mx->firstN(8);
?>
<!-- Popular Service Areas Section -->
<section class="py-16 sm:py-20 lg:py-24 bg-gray-50">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        Popular Service Areas
      </h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Professional siding services throughout Northern Indiana and Southwest Michigan
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach ($links as $r): ?>
        <a href="<?= htmlspecialchars($r['url'], ENT_QUOTES) ?>" class="group hs-card bg-white border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 rounded-xl overflow-hidden">
          <div class="hs-card-body p-6">
            <div class="flex items-start gap-4">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                  </svg>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                  <?= htmlspecialchars($r['label'], ENT_QUOTES) ?>
                </h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                  Expert siding repair and installation services for storm damage and general maintenance.
                </p>
                <div class="mt-3 flex items-center text-sm text-blue-600 group-hover:text-blue-700">
                  <span>Learn More</span>
                  <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

