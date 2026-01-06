<?php
/**
 * City-Service Router (Locked Template System)
 * Handles dedicated city+service pages for high-opportunity queries.
 * 
 * DIRECTIVE P1: Query-Driven Landing Pages
 * Template: Locked, Deterministic, Retrieval-Anchored
 */

// Normalize path
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$path = rtrim($path, '/');

// Configuration: P1 Priority Cities
$cityServicePages = [
    'siding-contractor-south-bend-in' => [
        'city' => 'South Bend',
        'state' => 'Indiana',
        'service' => 'Siding Contractor', // Primary Entity
        'h1' => 'Siding Contractor in South Bend, IN',
        'query' => 'siding contractors south bend in',
        'intent' => 'transactional-local',
        'adjacencies' => [
            ['url' => '/siding-contractor-granger-in', 'anchor' => 'Granger Siding Services'],
            ['url' => '/home-siding-blog/siding-replacement-costs-indiana-2025', 'anchor' => 'Indiana Siding Cost Guide']
        ]
    ],
    'siding-companies-plymouth-in' => [
        'city' => 'Plymouth',
        'state' => 'Indiana',
        'service' => 'Siding Company',
        'h1' => 'Siding Companies in Plymouth, IN',
        'query' => 'siding companies plymouth in',
        'intent' => 'transactional-local',
        'adjacencies' => [
            ['url' => '/siding-replacement-warsaw-indiana', 'anchor' => 'Warsaw Siding Replacement'],
            ['url' => '/siding-contractor-south-bend-in', 'anchor' => 'South Bend Contractors']
        ]
    ],
    'siding-replacement-warsaw-indiana' => [
        'city' => 'Warsaw',
        'state' => 'Indiana',
        'service' => 'Siding Replacement',
        'h1' => 'Siding Replacement in Warsaw, Indiana',
        'query' => 'siding replacement warsaw indiana',
        'intent' => 'transactional-local',
        'adjacencies' => [
            ['url' => '/siding-companies-plymouth-in', 'anchor' => 'Plymouth Siding Companies'],
            ['url' => '/contact', 'anchor' => 'Get a Quote']
        ]
    ],
    'siding-contractor-granger-in' => [
        'city' => 'Granger',
        'state' => 'Indiana',
        'service' => 'Siding Contractor',
        'h1' => 'Siding Contractor in Granger, IN',
        'query' => 'granger in siding contractor',
        'intent' => 'transactional-local',
        'adjacencies' => [
            ['url' => '/siding-contractor-south-bend-in', 'anchor' => 'South Bend Siding'],
            ['url' => '/home-siding-blog/siding-replacement-costs-indiana-2025', 'anchor' => '2025 Cost Guide']
        ]
    ]
];

// Check match
$pageData = $cityServicePages[$path] ?? null;

if (!$pageData) {
    return false;
}

// Headers
http_response_code(200);
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0'); // Prevent Edge caching during dev

// Metadata
require_once __DIR__ . '/../lib/AdvancedMetaManager.php';
$pageTitle = "{$pageData['h1']} | Licensed & Insured";
$pageDescription = "Top-rated {$pageData['service']} serving {$pageData['city']}, {$pageData['state']}. Expert installation of vinyl and James Hardie siding. Request a free estimate today.";

include __DIR__ . '/../../partials/header.php';
?>

<!-- Locked Template: Hero -->
<section class="hero bg-white pt-12 pb-8">
    <div class="container mx-auto px-4 max-w-4xl">
        <h1 class="text-4xl font-bold text-gray-900 mb-6"><?= htmlspecialchars($pageData['h1']) ?></h1>
        <div class="prose prose-lg text-gray-700 mb-8">
            <p class="lead">
                Hoosier Cladding LLC is a dedicated <strong><?= htmlspecialchars(strtolower($pageData['service'])) ?></strong> serving homeowners in <strong><?= htmlspecialchars($pageData['city']) ?>, <?= htmlspecialchars($pageData['state']) ?></strong>. We provide complete exterior envelope solutions, specializing in the removal of failing siding and the precision installation of modern, weather-resistant materials designed for Northern Indiana winters.
            </p>
                <div class="mt-8">
                    <a href="/contact" class="btn btn-primary">Contact Us Today</a>
                    <a href="/home-siding-blog/siding-replacement-costs-indiana-2025" class="btn btn-outline">Check Indiana Siding Costs</a>
                    <div class="mt-4 text-sm">
                        <a href="/service-area" class="text-gray-600 hover:text-blue-600 underline">View all service areas</a>
                    </div>
                </div>
        </div>
    </div>
</section>

<!-- Locked Template: 5 Answer Blocks -->
<section class="py-12 bg-gray-50 border-y border-gray-100">
    <div class="container mx-auto px-4 max-w-4xl space-y-12">
        
        <!-- Block 1: Installation -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Siding Installation in <?= htmlspecialchars($pageData['city']) ?></h2>
            <p class="text-gray-700 leading-relaxed">
                Proper installation is the single most important factor in siding longevity. Our crew adheres to strict manufacturer specifications for fastener placement, flashing integration, and expansion gaps. This attention to detail ensures your home in <?= htmlspecialchars($pageData['city']) ?> remains protected against wind-driven rain and thermal movement.
            </p>
        </div>

        <!-- Block 2: Replacement -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Full Siding Replacement Process</h2>
            <p class="text-gray-700 leading-relaxed">
                We manage the entire replacement lifecycle. This includes the safe removal and disposal of old aluminum, wood, or vinyl cladding; inspection of the underlying sheathing for rot; and the installation of high-performance house wrap before your new siding goes on. We leave your property clean and debris-free daily.
            </p>
        </div>

        <!-- Block 3: Repair -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Siding Repair Service</h2>
            <p class="text-gray-700 leading-relaxed">
                Not every project requires a full tear-off. If your home has isolated storm damage, loose panels, or minor rot, we offer targeted repair services. We match existing textures and colors as closely as possible to restore your home's curb appeal and structural integrity without the cost of a full replacement.
            </p>
        </div>

        <!-- Block 4: Materials -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Vinyl and Fiber Cement Options</h2>
            <p class="text-gray-700 leading-relaxed">
                We install premium vinyl siding (including insulated options for better energy efficiency) and James Hardie fiber cement products. Fiber cement is particularly popular in <?= htmlspecialchars($pageData['city']) ?> for its superior resistance to fire, pests, and the extreme freeze-thaw cycles typical of our region.
            </p>
        </div>

        <!-- Block 5: Insurance/Storm -->
        <div>
            <h2 class="text-2xl font-bold text-gray-900 mb-3">Storm Damage Assistance</h2>
            <p class="text-gray-700 leading-relaxed">
                Northern Indiana weather can be unpredictable. If your home has suffered wind or hail damage, we can provide detailed inspection reports and photographic evidence to assist with your insurance claim, ensuring you receive the coverage necessary to restore your exterior properly.
            </p>
        </div>

    </div>
</section>

<!-- Locked Template: FAQ Block -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b pb-4">Common Questions</h2>
        <div class="space-y-8">
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Do you work in <?= htmlspecialchars($pageData['city']) ?> year-round?</h3>
                <p class="text-gray-700">Yes, we install siding throughout the year, provided weather conditions allow for safe and proper material handling. Vinyl cold-cracking and paint curing limits are strictly observed.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">How much does siding cost in <?= htmlspecialchars($pageData['city']) ?>?</h3>
                <p class="text-gray-700">Costs vary by material and home size. Vinyl projects in <?= htmlspecialchars($pageData['city']) ?> typically range from $12k-$20k, while fiber cement projects often land between $20k-$35k.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Are you licensed in <?= htmlspecialchars($pageData['city']) ?>?</h3>
                <p class="text-gray-700">Absolutely. Hoosier Cladding LLC maintains all necessary state and local licenses to operate compliant job sites in <?= htmlspecialchars($pageData['city']) ?> and surrounding municipalities.</p>
            </div>
        </div>
    </div>
</section>

<!-- Locked Template: Internal Links -->
<section class="py-12 bg-gray-50 text-center">
    <div class="container mx-auto px-4 max-w-4xl">
        <h3 class="text-gray-900 font-bold uppercase tracking-wide mb-6">Related Services</h3>
        <div class="flex flex-wrap justify-center gap-4">
            <?php foreach ($pageData['adjacencies'] as $link): ?>
                <a href="<?= htmlspecialchars($link['url']) ?>" class="bg-white border border-gray-200 px-6 py-3 rounded hover:border-blue-600 hover:text-blue-700 transition font-medium">
                    <?= htmlspecialchars($link['anchor']) ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
// Schema: LocalBusiness + Service + FAQPage
$schema = [
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'LocalBusiness',
            '@id' => 'https://www.hoosiercladding.com/#localbusiness',
            'name' => 'Hoosier Cladding LLC',
            'url' => 'https://www.hoosiercladding.com',
            'telephone' => '+15749312119',
            'areaServed' => [
                '@type' => 'City',
                'name' => $pageData['city']
            ]
        ],
        [
            '@type' => 'Service',
            'serviceType' => $pageData['service'],
            'provider' => ['@id' => 'https://www.hoosiercladding.com/#localbusiness'],
            'areaServed' => [
                '@type' => 'City',
                'name' => $pageData['city']
            ],
            'name' => $pageData['h1']
        ],
        [
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => "Do you work in {$pageData['city']} year-round?",
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Yes, we install siding throughout the year, weather permitting."]
                ],
                [
                    '@type' => 'Question',
                    'name' => "How much does siding cost in {$pageData['city']}?",
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Vinyl projects typically range from $12k-$20k, fiber cement from $20k-$35k."]
                ],
                [
                    '@type' => 'Question',
                    'name' => "Are you licensed in {$pageData['city']}?",
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => "Yes, fully licensed and insured for {$pageData['city']} operations."]
                ]
            ]
        ]
    ]
];
?>
<script type="application/ld+json">
<?= json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>

<?php
include __DIR__ . '/../../partials/footer.php';
return true;
?>
