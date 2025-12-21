<?php
/**
 * QA Script - Loads and verifies each URL
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
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['ngrok-skip-browser-warning: true']);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $html = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $finalUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    curl_close($ch);
    
    // Extract data
    preg_match('/<title>(.*?)<\/title>/is', $html, $titleMatch);
    preg_match_all('/<meta\s+name=["\']description["\']\s+content=["\']([^"\']*)["\']/i', $html, $descMatches);
    preg_match('/<link\s+rel=["\']canonical["\']\s+href=["\']([^"\']*)["\']/i', $html, $canonicalMatch);
    preg_match('/<meta\s+name=["\']robots["\']\s+content=["\']([^"\']*)["\']/i', $html, $robotsMatch);
    
    $title = $titleMatch[1] ?? '';
    $descriptions = $descMatches[1] ?? [];
    $canonical = $canonicalMatch[1] ?? '';
    $robots = $robotsMatch[1] ?? '';
    
    // Check for phone numbers in body (simple check)
    $hasPhoneInBody = preg_match('/\d{3}[.\-\s]?\d{3}[.\-\s]?\d{4}/', $html) && strpos($html, '<body') !== false;
    
    // Check for CTAs
    $hasCTA = preg_match('/(call\s+now|free\s+estimate|get\s+a\s+quote|request\s+a\s+quote)/i', $html) && strpos($html, '<body') !== false;
    
    // Check for internal service links with contractor language
    $hasServiceLink = preg_match('/<a[^>]+href=["\'][^"\']*(vinyl-siding|siding-replacement|siding-repair|siding-installation)[^"\']*["\'][^>]*>(.*?)<\/a>/i', $html, $linkMatch);
    $linkAnchor = $linkMatch[2] ?? '';
    $hasContractorAnchor = preg_match('/(contractor|installer)/i', $linkAnchor);
    
    // Determine if blog or service page
    $isBlog = strpos($url, '/home-siding-blog') !== false && strpos($url, '?') === false;
    $hasParams = strpos($url, '?') !== false;
    
    $results[] = [
        'url' => $url,
        'http_code' => $httpCode,
        'final_url' => $finalUrl,
        'title' => trim($title),
        'title_count' => substr_count($html, '<title>'),
        'desc_count' => count($descriptions),
        'description' => $descriptions[0] ?? '',
        'canonical' => $canonical,
        'robots' => $robots,
        'is_redirect' => $finalUrl !== $url,
        'has_phone' => $hasPhoneInBody,
        'has_cta' => $hasCTA,
        'has_service_link' => $hasServiceLink,
        'has_contractor_anchor' => $hasContractorAnchor,
        'is_blog' => $isBlog,
        'has_params' => $hasParams,
        'html_length' => strlen($html),
    ];
}

// Output results
echo "URL,HTTP Code,Final URL,Title,Title Count,Desc Count,Canonical,Robots,Has Phone,Has CTA,Has Service Link,Has Contractor Anchor,Is Blog,Has Params\n";
foreach ($results as $r) {
    echo sprintf(
        "%s,%d,%s,\"%s\",%d,%d,%s,%s,%s,%s,%s,%s,%s,%s\n",
        $r['url'],
        $r['http_code'],
        $r['final_url'],
        addslashes($r['title']),
        $r['title_count'],
        $r['desc_count'],
        $r['canonical'],
        $r['robots'],
        $r['has_phone'] ? 'Y' : 'N',
        $r['has_cta'] ? 'Y' : 'N',
        $r['has_service_link'] ? 'Y' : 'N',
        $r['has_contractor_anchor'] ? 'Y' : 'N',
        $r['is_blog'] ? 'Y' : 'N',
        $r['has_params'] ? 'Y' : 'N'
    );
}

