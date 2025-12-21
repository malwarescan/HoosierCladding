<?php
/**
 * Comprehensive QA - Loads and verifies each URL against all requirements
 */

$urls = [
    'https://313243ed7371.ngrok-free.app/home-siding-blog',
    'https://313243ed7371.ngrok-free.app/home-siding-blog/install-a-metal-roof-ridge-cap',
    'https://313243ed7371.ngrok-free.app/home-siding-blog/siding-replacement-costs-indiana-2025',
    'https://313243ed7371.ngrok-free.app/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know',
    'https://313243ed7371.ngrok-free.app/',
    'https://313243ed7371.ngrok-free.app/service-area',
    'https://313243ed7371.ngrok-free.app/contact',
    'https://313243ed7371.ngrok-free.app/vinyl-siding-michiana-south-bend',
    'https://313243ed7371.ngrok-free.app/house-siding-replacement',
    'https://313243ed7371.ngrok-free.app/residential-siding-contractor',
    'https://313243ed7371.ngrok-free.app/vinyl-siding-installers',
    'https://313243ed7371.ngrok-free.app/door-replacement-south-bend',
    'https://313243ed7371.ngrok-free.app/window-replacement-south-bend',
    'https://313243ed7371.ngrok-free.app/trimwork-south-bend',
    'https://313243ed7371.ngrok-free.app/siding-replacement-warsaw',
    'https://313243ed7371.ngrok-free.app/vinyl-siding-south-bend',
    'https://313243ed7371.ngrok-free.app/siding-installation-granger',
    'https://313243ed7371.ngrok-free.app/home-siding-blog?author=test',
    'https://313243ed7371.ngrok-free.app/home-siding-blog?page=2',
    'https://313243ed7371.ngrok-free.app/?test=123',
];

$results = [];

foreach ($urls as $url) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTPHEADER => ['ngrok-skip-browser-warning: true'],
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_MAXREDIRS => 5,
    ]);
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $redirectUrl = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
    curl_close($ch);
    
    // 1. Loading & Rendering
    $loadsOk = ($httpCode === 200 && strlen($html) > 1000);
    
    // 2. Head QA
    preg_match_all('/<title[^>]*>(.*?)<\/title>/is', $html, $titleMatches);
    preg_match_all('/<meta\s+name=["\']description["\']\s+content=["\']([^"\']*)["\']/i', $html, $descMatches);
    preg_match('/<link\s+rel=["\']canonical["\']\s+href=["\']([^"\']*)["\']/i', $html, $canonicalMatch);
    preg_match('/<meta\s+name=["\']robots["\']\s+content=["\']([^"\']*)["\']/i', $html, $robotsMatch);
    
    $titleCount = count($titleMatches[0]);
    $title = trim(strip_tags($titleMatches[1][0] ?? ''));
    $descCount = count($descMatches[0]);
    $description = trim($descMatches[1][0] ?? '');
    $canonical = trim($canonicalMatch[1] ?? '');
    $robots = trim($robotsMatch[1] ?? '');
    
    $headOk = ($titleCount === 1 && $descCount === 1 && !empty($title) && !empty($description) && !empty($canonical));
    $canonicalClean = (strpos($canonical, '?') === false);
    
    // 3. Intent Alignment
    $isBlog = strpos(parse_url($url, PHP_URL_PATH), '/home-siding-blog') !== false;
    $hasParams = (strpos($url, '?') !== false);
    
    // Check body content (only if we got HTML)
    $bodyStart = strpos($html, '<body');
    $bodyHtml = ($bodyStart !== false) ? substr($html, $bodyStart) : '';
    
    // Phone in body (excluding structured data/JSON-LD)
    $jsonLdMatches = [];
    preg_match_all('/<script[^>]*type=["\']application\/ld\+json["\'][^>]*>.*?<\/script>/is', $html, $jsonLdMatches);
    $htmlWithoutJson = $html;
    foreach ($jsonLdMatches[0] as $json) {
        $htmlWithoutJson = str_replace($json, '', $htmlWithoutJson);
    }
    $hasPhoneInBody = preg_match('/\b\d{3}[.\-\s]?\d{3}[.\-\s]?\d{4}\b/', $bodyHtml) && $loadsOk;
    
    // CTAs in body
    $hasCTA = preg_match('/(call\s+now|free\s+estimate|get\s+a\s+quote|request\s+a\s+quote|btn-primary|btn btn-primary)/i', $bodyHtml) && $loadsOk;
    
    // Service links with contractor language
    $serviceLinkPattern = '/<a[^>]+href=["\'][^"\']*\/(vinyl-siding|siding-replacement|siding-repair|siding-installation|house-siding-replacement)[^"\']*["\'][^>]*>([^<]*)<\/a>/i';
    preg_match_all($serviceLinkPattern, $bodyHtml, $linkMatches);
    $hasServiceLink = !empty($linkMatches[0]);
    $allLinkAnchors = implode(' ', $linkMatches[2] ?? []);
    $hasContractorAnchor = preg_match('/(contractor|installer|installation)/i', $allLinkAnchors);
    
    // For blog pages: should NOT have phone/CTA, SHOULD have service link with contractor anchor
    // For service pages: SHOULD have phone/CTA
    if ($isBlog && !$hasParams) {
        $intentOk = (!$hasPhoneInBody && !$hasCTA && $hasServiceLink && $hasContractorAnchor);
    } elseif (!$isBlog || strpos(parse_url($url, PHP_URL_PATH), '/service-area') !== false || strpos(parse_url($url, PHP_URL_PATH), '/contact') !== false) {
        // Service pages, homepage, service-area, contact
        $intentOk = ($hasPhoneInBody || $hasCTA); // At least one should be present
    } else {
        $intentOk = true; // Parameter URLs - skip intent check
    }
    
    // 4. Parameter Handling
    if ($hasParams) {
        // Should redirect OR return 200 with noindex
        $paramHandlingOk = ($httpCode === 301 || $httpCode === 302 || ($httpCode === 200 && (stripos($robots, 'noindex') !== false)));
        // Canonical should still be clean
        if ($canonical) {
            $paramHandlingOk = $paramHandlingOk && $canonicalClean;
        }
    } else {
        $paramHandlingOk = true; // No params to handle
    }
    
    // Overall Status
    $overallPass = ($loadsOk && $headOk && $canonicalClean && $intentOk && $paramHandlingOk);
    
    $results[] = [
        'url' => $url,
        'loads' => $loadsOk ? 'Y' : 'N',
        'title_correct' => ($titleCount === 1 && !empty($title)) ? 'Y' : 'N',
        'meta_correct' => ($descCount === 1 && !empty($description)) ? 'Y' : 'N',
        'canonical_correct' => ($canonicalClean && !empty($canonical)) ? 'Y' : 'N',
        'intent_correct' => $intentOk ? 'Y' : 'N',
        'param_handling' => $paramHandlingOk ? 'Y' : 'N',
        'overall' => $overallPass ? 'PASS' : 'FAIL',
        'http_code' => $httpCode,
        'title' => substr($title, 0, 60),
        'canonical' => $canonical,
        'notes' => [],
    ];
    
    // Add notes for failures
    if (!$loadsOk) $results[count($results)-1]['notes'][] = "HTTP $httpCode or empty content";
    if ($titleCount !== 1) $results[count($results)-1]['notes'][] = "Title count: $titleCount";
    if ($descCount !== 1) $results[count($results)-1]['notes'][] = "Desc count: $descCount";
    if (!$canonicalClean) $results[count($results)-1]['notes'][] = "Canonical has params";
    if ($isBlog && !$hasParams && $hasPhoneInBody) $results[count($results)-1]['notes'][] = "Blog has phone in body";
    if ($isBlog && !$hasParams && $hasCTA) $results[count($results)-1]['notes'][] = "Blog has CTA";
    if ($isBlog && !$hasParams && !$hasServiceLink) $results[count($results)-1]['notes'][] = "Blog missing service link";
    if ($isBlog && !$hasParams && !$hasContractorAnchor) $results[count($results)-1]['notes'][] = "Blog service link missing contractor anchor";
}

// Output table
echo "URL|Loads|Title Correct|Meta Correct|Canonical Correct|Intent Correct|Param Handling|Overall Status|Notes\n";
foreach ($results as $r) {
    $notes = implode('; ', $r['notes']);
    echo sprintf(
        "%s|%s|%s|%s|%s|%s|%s|%s|%s\n",
        $r['url'],
        $r['loads'],
        $r['title_correct'],
        $r['meta_correct'],
        $r['canonical_correct'],
        $r['intent_correct'],
        $r['param_handling'],
        $r['overall'],
        $notes
    );
}

// List failing URLs
echo "\n\n=== FAILING URLs ===\n";
foreach ($results as $r) {
    if ($r['overall'] === 'FAIL') {
        echo $r['url'] . "\n";
        echo "  Issues: " . implode(', ', $r['notes']) . "\n";
        echo "  Title: " . $r['title'] . "\n";
        echo "  Canonical: " . $r['canonical'] . "\n\n";
    }
}

// Final verdict
$allPass = true;
foreach ($results as $r) {
    if ($r['overall'] === 'FAIL') {
        $allPass = false;
        break;
    }
}
echo "\n=== FINAL VERDICT ===\n";
echo "SITE READY FOR PRODUCTION: " . ($allPass ? "YES" : "NO") . "\n";

