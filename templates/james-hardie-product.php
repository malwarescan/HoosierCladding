<?php
require_once __DIR__ . '/../app/lib/ProductSchema.php';

// Get product from URL
$reqPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$product = ProductSchema::findByUrl($reqPath);

if (!$product) {
    header("HTTP/1.0 404 Not Found");
    include __DIR__ . '/../templates/404.php';
    exit;
}

$pageTitle = $product['Product Name'] . " | Hoosier Cladding";
$pageDescription = "Certified James Hardie installer offering {$product['Product Name']} with professional installation in Northern Indiana. Get a free quote.";
$pagePath = $product['URL'];

include __DIR__ . '/../partials/header.php';
?>

<!-- Product Hero Section -->
<section class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Product Image Placeholder -->
            <div class="order-2 lg:order-1">
                <div class="w-full h-96 bg-gray-200 rounded-2xl shadow-xl flex items-center justify-center">
                    <div class="text-center">
                        <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-gray-500">Product Image</p>
                    </div>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="order-1 lg:order-2">
                <div class="inline-flex items-center gap-x-2 py-2 px-4 rounded-full text-sm font-semibold bg-green-100 text-green-800 mb-6">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Certified James Hardie Installer
                </div>
                
                <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 mb-6">
                    <?= htmlspecialchars($product['Product Name']) ?>
                </h1>
                
                <p class="text-xl text-gray-700 leading-relaxed mb-8">
                    Premium fiber cement siding engineered for hardieZone® <?= htmlspecialchars($product['HardieZone'][-1]) ?> climates. 
                    Professional installation by certified James Hardie installers in Northern Indiana.
                </p>
                
                <!-- Star Rating -->
                <div class="flex items-center gap-x-3 mb-8">
                    <div class="flex items-center">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                    <span class="text-lg font-semibold text-gray-900"><?= htmlspecialchars($product['Rating']) ?>/5</span>
                    <span class="text-gray-600">(<?= htmlspecialchars($product['Review Count']) ?> reviews)</span>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-4 text-white font-semibold hover:bg-blue-800 hover:text-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Get Free Quote
                    </a>
                    <a href="tel:5749312119" class="inline-flex items-center justify-center rounded-lg border-2 border-gray-900 px-8 py-4 text-gray-900 font-semibold hover:bg-gray-900 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        Call Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Specifications Section -->
<section class="py-16 bg-white">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Product Specifications</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Dimensions</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Width</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Width']) ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Length</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Length']) ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Thickness</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Thickness']) ?></dd>
                    </div>
                    <?php if (isset($product['Exposure']) && $product['Exposure'] !== 'Trim' && $product['Exposure'] !== 'Shingle'): ?>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Exposure</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Exposure']) ?></dd>
                    </div>
                    <?php endif; ?>
                </dl>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Performance</h3>
                <dl class="space-y-3">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">HardieZone</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['HardieZone']) ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Fire Rating</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Fire Rating']) ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Texture</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Texture']) ?></dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Color</dt>
                        <dd class="font-semibold text-gray-900"><?= htmlspecialchars($product['Color']) ?></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</section>

<!-- Warranty Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Warranty Information</h2>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <div class="flex items-center gap-x-3 mb-4">
                    <svg class="w-8 h-8 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Substrate Warranty</h3>
                </div>
                <p class="text-gray-700"><?= htmlspecialchars($product['Warranty Substrate']) ?> non-prorated limited warranty</p>
            </div>
            
            <div class="bg-white rounded-lg p-6 shadow-sm">
                <div class="flex items-center gap-x-3 mb-4">
                    <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900">Finish Warranty</h3>
                </div>
                <p class="text-gray-700"><?= htmlspecialchars($product['Warranty Finish']) ?> ColorPlus Technology warranty</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Frequently Asked Questions</h2>
        
        <div class="max-w-4xl mx-auto">
            <?php
            // Generate FAQ schema
            $faqSchema = ProductSchema::generateFAQSchema($product);
            echo ProductSchema::tag($faqSchema);
            
            // Parse FAQ data for display
            $faqData = json_decode($faqSchema, true);
            ?>
            
            <div class="hs-accordion-group space-y-4">
                <?php foreach ($faqData['mainEntity'] as $index => $faq): ?>
                <div class="hs-accordion bg-white border border-gray-200 rounded-lg <?= $index === 0 ? 'hs-accordion-active:is-active' : '' ?>" id="faq-<?= $index ?>">
                    <button class="hs-accordion-toggle group py-4 px-6 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:ring-1 focus:ring-gray-200" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>">
                        <svg class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                        <svg class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6"/>
                        </svg>
                        <?= htmlspecialchars($faq['name']) ?>
                    </button>
                    <div class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 <?= $index === 0 ? '' : 'hidden' ?>" aria-labelledby="faq-<?= $index ?>">
                        <div class="px-6 pb-4">
                            <p class="text-gray-600 leading-relaxed">
                                <?= htmlspecialchars($faq['acceptedAnswer']['text']) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-blue-600">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
            Ready to Install <?= htmlspecialchars($product['Product Name']) ?>?
        </h2>
        <p class="text-xl text-blue-100 mb-8">
            Get a free quote from certified James Hardie installers in Northern Indiana
        </p>
        <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-4 text-blue-600 font-semibold hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-blue-600 transition-all duration-200 shadow-lg hover:shadow-xl">
            Request Free Estimate
        </a>
    </div>
</section>

<?php
// Generate Product schema with reviews at the end
$productSchema = ProductSchema::generateProductSchema($product);
echo ProductSchema::tag($productSchema);
?>

<?php include __DIR__ . '/../partials/footer.php'; ?>

