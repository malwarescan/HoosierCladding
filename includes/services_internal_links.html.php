<?php
declare(strict_types=1);
require_once __DIR__.'/../app/lib/MatrixIndex.php';
$mx = new MatrixIndex(__DIR__.'/../data_matrix/convex_matrix_expanded.csv');
$cities = ['South Bend','Mishawaka','Elkhart','Granger','Plymouth','Niles'];
$links  = $mx->topByCity($cities, 1);
if (!$links) $links = $mx->firstN(8);
?>
<section class="section" style="background: var(--surface); border-top: 1px solid var(--border);">
  <div class="container">
    <h2 class="h2" style="text-align:center; margin-bottom:32px;">Top Services Near You</h2>
    <ul class="popular-areas" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 16px; list-style: none; padding: 0;">
      <?php foreach ($links as $r): ?>
        <li><a href="<?= htmlspecialchars($r['url'], ENT_QUOTES) ?>" style="display: block; padding: 16px; background: white; border: 1px solid var(--border); border-radius: 8px; text-decoration: none; color: var(--primary); font-weight: 600; transition: all 0.2s;"><?= htmlspecialchars($r['label'], ENT_QUOTES) ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

