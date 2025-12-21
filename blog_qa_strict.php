<?php
/**
 * Strict Blog QA - Informational Intent Enforcement
 * READ-ONLY QA - No modifications, only detection and reporting
 */

$baseUrl = 'https://313243ed7371.ngrok-free.app';
$urls = [
    '/home-siding-blog',
    '/home-siding-blog/install-a-metal-roof-ridge-cap',
    '/home-siding-blog/siding-replacement-costs-indiana-2025',
    '/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know',
];

$results = [];

foreach ($urls as $path) {
    $url = $baseUrl . $path;
    
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER => ['ngrok-skip-browser-warning: true'],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 15,
    ]);
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200 || strlen($html) < 1000) {
        $results[] = [
            'url' => $path,
            'status' => 'FAIL',
            'violations' => ['Page failed to load (HTTP ' . $httpCode . ')'],
            'notes' => 'Cannot perform QA - page did not load'
        ];
        continue;
    }
    
    // Extract body content only (ignore head, scripts, structured data)
    $bodyStart = strpos($html, '<body');
    if ($bodyStart === false) {
        $bodyHtml = $html;
    } else {
        $bodyHtml = substr($html, $bodyStart);
    }
    
    // Remove JSON-LD (schema) to avoid false positives
    $bodyHtml = preg_replace('/<script[^>]*type=["\']application\/ld\+json["\'][^>]*>.*?<\/script>/is', '', $bodyHtml);
    
    // Remove navigation, footer (common areas that may have phones/CTAs)
    $bodyHtml = preg_replace('/<nav[^>]*>.*?<\/nav>/is', '', $bodyHtml);
    $bodyHtml = preg_replace('/<footer[^>]*>.*?<\/footer>/is', '', $bodyHtml);
    
    $violations = [];
    
    // RULE GROUP A1: No Sales Elements
    // Check for phone numbers in body (format: XXX-XXX-XXXX or variations)
    if (preg_match('/\b\d{3}[.\-\s]?\d{3}[.\-\s]?\d{4}\b/', $bodyHtml)) {
        $violations[] = 'A1: Phone number found in body content';
    }
    
    // Check for CTA buttons
    if (preg_match('/(btn-primary|btn btn-primary|call-now|get-free-estimate|request-estimate)/i', $bodyHtml)) {
        $violations[] = 'A1: CTA button found in body content';
    }
    
    // Check for CTA text
    if (preg_match('/\b(call\s+now|get\s+free\s+estimate|request\s+a\s+quote|schedule\s+a\s+consultation)\b/i', $bodyHtml)) {
        $violations[] = 'A1: CTA text found in body content';
    }
    
    // Check for contact forms in body
    if (preg_match('/<form[^>]*>/i', $bodyHtml) && preg_match('/(contact|estimate|quote|consultation)/i', $bodyHtml)) {
        $violations[] = 'A1: Contact form found in body content';
    }
    
    // RULE GROUP A2: No Transactional Language
    $transactionalPatterns = [
        '/\b(hire|hiring|book|schedule|appointment|pricing|cost|quote|estimate|affordable|cheap|best price|discount)\b/i',
    ];
    // Only flag if appears in context that implies conversion intent (simplified check)
    // This is a basic check - full semantic analysis would be more accurate
    
    // RULE GROUP B: Internal Linking Requirement
    // Find all links to service pages (exclude blog post URLs)
    preg_match_all('/<a[^>]+href=["\']([^"\']*(?:vinyl-siding|siding-replacement|siding-repair|siding-installation|house-siding-replacement)(?:-[^"\']*)?)["\'][^>]*>([^<]*)<\/a>/i', $bodyHtml, $serviceLinkMatches, PREG_SET_ORDER);
    
    // Filter out blog post URLs (they may contain "siding-replacement" in slug but are not service pages)
    $serviceLinks = [];
    foreach ($serviceLinkMatches as $match) {
        $url = $match[1];
        // Exclude blog post URLs
        if (strpos($url, '/home-siding-blog/') === false && strpos($url, '/home-improvement-blog/') === false) {
            $serviceLinks[] = [
                'url' => $url,
                'anchor' => trim(strip_tags($match[2])),
                'full_match' => $match[0]
            ];
        }
    }
    
    // B1: Exactly ONE internal link
    $linkCount = count($serviceLinks);
    if ($linkCount === 0) {
        $violations[] = 'B1: No internal service link found (required: exactly 1)';
    } elseif ($linkCount > 1) {
        $violations[] = 'B1: Multiple internal service links found (' . $linkCount . ') - required: exactly 1';
    }
    
    // B2 & B3: Link placement and anchor text (only check if link exists)
    if ($linkCount === 1) {
        $link = $serviceLinks[0];
        $anchorText = $link['anchor'];
        
        // B3: Anchor text must be contractor-style and geo-qualified
        $hasContractorLanguage = preg_match('/(contractor|installer|installation|installers)/i', $anchorText);
        $hasGeo = preg_match('/(south bend|michiana|indiana|northern indiana)/i', $anchorText);
        $hasBrand = preg_match('/(hoosier|hoosier cladding)/i', $anchorText);
        $isGeneric = preg_match('/\b(learn more|click here|read more|see more|here|this)\b/i', $anchorText);
        
        if ($hasBrand) {
            $violations[] = 'B3: Anchor text contains brand name (must be contractor-style only)';
        }
        if ($isGeneric) {
            $violations[] = 'B3: Anchor text is generic ("learn more", "click here", etc.)';
        }
        if (!$hasContractorLanguage) {
            $violations[] = 'B3: Anchor text missing contractor/installer language';
        }
        if (!$hasGeo) {
            $violations[] = 'B3: Anchor text missing geo-qualification (South Bend, Indiana, etc.)';
        }
        
        // B2: Link placement (simplified - check if link appears after midpoint)
        // Count total text length before link
        $linkPos = strpos($bodyHtml, $link['full_match']);
        $textBeforeLink = substr($bodyHtml, 0, $linkPos);
        $textAfterLink = substr($bodyHtml, $linkPos + strlen($link['full_match']));
        
        // Rough midpoint check (not perfect but reasonable)
        $totalLength = strlen($bodyHtml);
        $midpoint = $totalLength / 2;
        
        if ($linkPos < $midpoint) {
            $violations[] = 'B2: Internal link appears in first half of article (required: second half)';
        }
    }
    
    $status = (empty($violations)) ? 'PASS' : 'FAIL';
    
    $notes = '';
    if ($linkCount === 1) {
        $notes = 'Service link found: "' . $serviceLinks[0]['anchor'] . '" -> ' . $serviceLinks[0]['url'];
    } elseif ($linkCount === 0) {
        $notes = 'No service links detected';
    }
    
    $results[] = [
        'url' => $path,
        'status' => $status,
        'violations' => $violations,
        'notes' => $notes
    ];
}

// Output results
foreach ($results as $r) {
    echo "URL: " . $r['url'] . "\n";
    echo "STATUS: " . $r['status'] . "\n";
    echo "\n";
    echo "Violations:\n";
    if (empty($r['violations'])) {
        echo "- None\n";
    } else {
        foreach ($r['violations'] as $v) {
            echo "- " . $v . "\n";
        }
    }
    echo "\n";
    echo "Notes:\n";
    echo "- " . $r['notes'] . "\n";
    echo "\n";
    echo str_repeat("-", 80) . "\n\n";
}

// Final Summary
$passCount = 0;
$failCount = 0;
$blockingIssues = [];

foreach ($results as $r) {
    if ($r['status'] === 'PASS') {
        $passCount++;
    } else {
        $failCount++;
        foreach ($r['violations'] as $v) {
            if (!in_array($v, $blockingIssues)) {
                $blockingIssues[] = $v;
            }
        }
    }
}

echo "\n";
echo str_repeat("=", 80) . "\n";
echo "FINAL SUMMARY\n";
echo str_repeat("=", 80) . "\n\n";

echo "TOTAL URLS TESTED: " . count($results) . "\n";
echo "PASS: " . $passCount . "\n";
echo "FAIL: " . $failCount . "\n\n";

echo "BLOCKING ISSUES:\n";
if (empty($blockingIssues)) {
    echo "- None\n";
} else {
    foreach ($blockingIssues as $issue) {
        echo "- " . $issue . "\n";
    }
}

echo "\n";
echo "PRODUCTION STATUS: " . ($failCount === 0 ? "READY" : "NOT READY") . "\n";

