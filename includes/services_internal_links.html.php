<?php
declare(strict_types=1);
require_once __DIR__.'/../app/lib/MatrixIndex.php';
$mx = new MatrixIndex(__DIR__.'/../data_matrix/convex_matrix_expanded.csv');
$cities = ['South Bend','Mishawaka','Elkhart','Granger','Plymouth','Niles'];
$links  = $mx->topByCity($cities, 1);
if (!$links) $links = $mx->firstN(8);
?>
<section class="py-16 sm:py-20 lg:py-24 bg-gray-50 border-t border-gray-200">
  <div class="container w-full">
    <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-10 sm:mb-12">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900">Top Services Near You</h2>
      </div>

      <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 list-none p-0 m-0">
        <?php foreach ($links as $r): ?>
          <li>
            <a href="<?= htmlspecialchars($r['url'], ENT_QUOTES) ?>"
               class="group block p-5 sm:p-6 bg-white border border-gray-200 rounded-xl text-blue-600 hover:text-blue-700 hover:shadow-md transition-all duration-200">
              <div class="flex items-center justify-between gap-3">
                <span class="font-semibold text-base sm:text-lg leading-snug line-clamp-2">
                  <?= htmlspecialchars($r['label'], ENT_QUOTES) ?>
                </span>
                <span class="flex-shrink-0 inline-flex items-center justify-center w-9 h-9 rounded-full bg-blue-50 text-blue-600 group-hover:bg-blue-100 transition">
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 11-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
                </span>
              </div>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

