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
  // Blog hub page - metadata comes from CSV (optimized) or AdvancedMetaManager (fallback)
  // CSV entry explicitly sets: "Home Siding Blog | South Bend Siding Contractors"
  try {
    http_response_code(200);
    $pageType = 'blog';
    include __DIR__.'/../../partials/header.php';
    ?>
    <section class="hero">
      <div class="container">
        <h1 class="h1">Home Siding Advice from South Bend Contractors</h1>
        <p class="lead text-lg mb-8">
          This blog is written by licensed siding contractors serving South Bend and surrounding Indiana communities. We share practical guidance on vinyl siding, fiber cement, repairs, replacements, and common homeowner questions based on real installation and project experience. All articles are intended to help homeowners make informed siding decisions.
        </p>
        
        <!-- Blog Post List -->
        <div class="mt-12">
          <h2 class="text-2xl font-bold text-gray-900 mb-6">Recent Articles</h2>
          <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php
            // List known blog posts (excluding the hub itself)
            $postList = array_filter($known, function($post) {
              return $post['loc'] !== '/home-siding-blog' && strpos($post['loc'], '/home-siding-blog/') === 0;
            });
            
            foreach ($postList as $post) {
              $postSlug = str_replace('/home-siding-blog/', '', $post['loc']);
              $postTitle = ucwords(str_replace('-', ' ', $postSlug));
              ?>
              <article class="border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                  <a href="<?= htmlspecialchars($post['loc']) ?>" class="hover:text-blue-600">
                    <?= htmlspecialchars($postTitle) ?>
                  </a>
                </h3>
                <p class="text-gray-600 mb-4">
                  Expert advice from licensed siding contractors on <?= strtolower($postTitle) ?> for Northern Indiana homeowners.
                </p>
                <a href="<?= htmlspecialchars($post['loc']) ?>" class="text-blue-600 font-semibold hover:underline">
                  Read Article →
                </a>
              </article>
              <?php
            }
            ?>
          </div>
        </div>
        
        <!-- Internal Link to Service Page (EXACTLY ONE - Informational Intent Requirement) -->
        <div class="mt-12 pt-8 border-t border-gray-200">
          <p class="text-gray-700 leading-relaxed">
            For professional siding installation and repair services, consult with 
            <a href="/house-siding-replacement" class="text-blue-600 hover:underline font-semibold">siding replacement contractors in South Bend</a> 
            who can assess your home's specific needs and provide expert guidance on materials, costs, and installation best practices.
          </p>
        </div>
      </div>
    </section>
    <?php
    include __DIR__.'/../../partials/footer.php';
    exit;
  } catch (Throwable $e) {
    error_log("Blog router fatal error on hub page: " . $e->getMessage());
    http_response_code(500);
    echo "Error loading blog page. Please try again later.";
    exit;
  }
}

// Handle duplicate blog post redirect (canonical consolidation)
if ($slug === 'does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know-1') {
    header('Location: /home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know', true, 301);
    exit;
}

// Check if this specific post exists
$full = '/home-siding-blog/'.$slug;
if (isset($known[$full])) {
  // ---- RENDER REAL BLOG POST ----
  http_response_code(200);
  
  // Try to load template file if it exists
  $templatePath = __DIR__.'/../../templates/blog/'.$slug.'.php';
  if (file_exists($templatePath)) {
    include $templatePath;
    exit;
  }
  
  // Fallback: use AdvancedMetaManager for unique metadata
  try {
    require_once __DIR__.'/../lib/AdvancedMetaManager.php';
    $pageType = 'blog';
    $pageContext = ['slug' => $slug];
    $pageTitle = AdvancedMetaManager::generateTitle($reqPath, $pageType, $pageContext);
    $pageDescription = AdvancedMetaManager::generateDescription($reqPath, $pageType, $pageContext);
    include __DIR__.'/../../partials/header.php';
    ?>
    <section class="hero">
      <div class="container mx-auto px-6 py-12">
        <h1 class="h1 text-3xl font-bold text-gray-900 mb-6"><?= htmlspecialchars($pageTitle ?? 'Blog Post') ?></h1>
        
        <div class="prose prose-lg max-w-none mt-8 text-gray-700 leading-relaxed">
          <p class="lead text-xl mb-6">
            Blog content for this article is being developed. This page will contain expert guidance on the topic for Northern Indiana homeowners.
          </p>
          
          <p class="mb-6">
            For professional assistance with home improvement projects, homeowners in South Bend and surrounding areas can consult with 
            <a href="/house-siding-replacement" class="text-blue-600 hover:underline font-semibold">siding replacement contractors in South Bend</a> 
            who have experience with various home exterior projects and can provide expert guidance.
          </p>
        </div>
      </div>
    </section>
    <?php
    include __DIR__.'/../../partials/footer.php';
    exit;
  } catch (Throwable $e) {
    error_log("Blog router fatal error on post page '$slug': " . $e->getMessage());
    http_response_code(500);
    echo "Error loading blog post. Please try again later.";
    exit;
  }
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

