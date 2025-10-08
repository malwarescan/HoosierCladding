<?php
/**
 * Schema Renderer Test
 * 
 * Validates that schema output is correct for sample CSV rows
 * 
 * Run this: php includes/test_schema.php
 */

declare(strict_types=1);

require_once __DIR__ . '/schema_renderer.php';

// Test data row (matches CSV structure)
$testRow = [
    'brand_name' => 'Hoosier Cladding',
    'brand_url' => 'https://www.hoosiercladding.com/',
    'brand_sameas' => 'https://www.facebook.com/hoosiercladding,https://www.instagram.com/hoosiercladding',
    'contact_phone' => '+1 574-555-0123',
    'contact_email' => 'info@hoosiercladding.com',
    'street' => '',
    'city' => 'South Bend',
    'region' => 'IN',
    'postal' => '',
    'country' => 'US',
    'entity_type' => 'service',
    'primary_keyword' => 'Siding Replacement',
    'secondary_keyword' => '',
    'location' => 'Dunlap, IN',
    'pain_point' => 'Rotten Siding',
    'price' => '',
    'currency' => 'USD',
    'seo_title' => 'Siding Replacement for Rotten Siding in Dunlap, IN | Hoosier Cladding',
    'meta_description' => 'Hoosier Cladding provides siding replacement in Dunlap, IN to fix rotten siding. Free inspections, fast turnarounds, and durable materials.',
    'h1' => 'Siding Replacement for Rotten Siding in Dunlap, IN',
    'slug' => 'dunlap-in/siding-replacement/rotten-siding',
    'page_url' => 'https://www.hoosiercladding.com/matrix/dunlap-in/siding-replacement/rotten-siding/',
    'faq_q1' => 'How fast can you repair storm-damaged siding?',
    'faq_a1' => 'Most minor repairs are completed within 48–72 hours after inspection. Timelines depend on material availability and damage severity.',
    'faq_q2' => 'Do you work with insurance for hail or wind claims?',
    'faq_a2' => 'Yes. We document damage, provide estimates, and coordinate directly with your insurer to streamline your claim.',
    'faq_q3' => 'Can you color-match existing vinyl or fiber cement siding?',
    'faq_a3' => 'We offer professional color-matching and can source compatible profiles to blend repairs with your current exterior.',
    'faq_q4' => 'What are signs my siding needs replacement instead of repair?',
    'faq_a4' => 'Widespread warping, water intrusion, soft spots, and repeated repairs are indicators a full replacement may be more cost-effective.',
    'faq_q5' => 'Do you install James Hardie fiber cement siding?',
    'faq_a5' => 'Yes. We\'re experienced with James Hardie installations and follow manufacturer specifications for warranty compliance.',
    'faq_q6' => 'How can siding upgrades reduce energy bills?',
    'faq_a6' => 'Properly installed siding with air and moisture barriers can reduce drafts and help maintain indoor temperatures year-round.',
];

echo "=== Schema Renderer Test ===\n\n";

echo "Testing individual components:\n\n";

echo "1. LocalBusiness Schema:\n";
echo SchemaRenderer\localbusiness($testRow) . "\n\n";

echo "2. Service Schema:\n";
echo SchemaRenderer\service($testRow) . "\n\n";

echo "3. FAQPage Schema:\n";
echo SchemaRenderer\faq($testRow) . "\n\n";

echo "4. Product Schema (should be empty if no price):\n";
echo SchemaRenderer\product($testRow) . "\n\n";

echo "=== Complete Render (All Schemas) ===\n";
echo SchemaRenderer\render($testRow) . "\n\n";

echo "✓ Test complete. Verify JSON structure above is valid.\n";
echo "✓ Validate at: https://validator.schema.org/\n";
echo "✓ Test in Rich Results: https://search.google.com/test/rich-results\n";

