<?php
declare(strict_types=1);

// Extract slug from /home-siding-blog/<slug>
$reqPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$parts = array_values(array_filter(explode('/', trim($reqPath, '/'))));
$slug = $parts[1] ?? ''; // index 0 = 'home-siding-blog', index 1 = '<slug>'

// Load known posts
$posts = require __DIR__.'/../config/blog_urls.php';
$known = [];
foreach ($posts as $p) {
  $known[trim($p['loc'])] = $p;
}

// Check if this is the blog hub (no slug)
if ($slug === '' && isset($known['/home-siding-blog'])) {
  // Blog hub page
  http_response_code(200);
  $pageTitle = "Home Siding Blog | Hoosier Cladding LLC";
  $pageDescription = "Expert advice on siding installation, repair, and maintenance for Northern Indiana homes.";
  include __DIR__.'/../../partials/header.php';
  ?>
  <section class="hero">
    <div class="container">
      <h1 class="h1">Home Siding Blog</h1>
      <p class="lead">Expert advice and guides for Northern Indiana homeowners.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="/">Go Home</a>
        <a class="btn btn-outline" href="/contact">Contact Us</a>
      </div>
    </div>
  </section>
  <?php
  include __DIR__.'/../../partials/footer.php';
  exit;
}

// Check if this specific post exists
$full = '/home-siding-blog/'.$slug;
if (isset($known[$full])) {
  // ---- RENDER REAL BLOG POST ----
  http_response_code(200);
  $title = ucwords(str_replace('-', ' ', $slug));
  $pageTitle = $title . ' | Hoosier Cladding';
  $pageDescription = "Expert siding services across Northern Indiana. Repairs, full replacements, and insulation upgrades done right. Get a same‑week estimate from Hoosier Cladding.";
  include __DIR__.'/../../partials/header.php';
  ?>
  <section class="hero">
    <div class="container">
      <h1 class="h1"><?= htmlspecialchars($title) ?></h1>
      <p class="lead">Blog content for this article is being developed. For immediate assistance, please contact us.</p>
      <div class="hero-cta">
        <a class="btn btn-primary" href="/contact">Get Free Estimate</a>
        <a class="btn btn-outline" href="/">Go Home</a>
      </div>
    </div>
  </section>
  <?php
  include __DIR__.'/../../partials/footer.php';
  exit;
}

// ---- HARD 404 (never render homepage) ----
http_response_code(404);
$pageTitle = "Page Not Found | Hoosier Cladding LLC";
$pageDescription = "The page you're looking for could not be found.";
include __DIR__.'/../../partials/header.php';
?>
<section class="hero">
  <div class="container">
    <h1 class="h1">Page Not Found</h1>
    <p class="lead">Sorry, this blog post doesn't exist.</p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="/">Go Home</a>
      <a class="btn btn-outline" href="/home-siding-blog">View Blog</a>
    </div>
  </div>
</section>
<?php
include __DIR__.'/../../partials/footer.php';
exit;

