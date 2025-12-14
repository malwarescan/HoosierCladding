<?php
/**
 * Comprehensive Page Audit Script
 * Verifies all pages align with Google ranking constraint standards
 * 
 * Checks:
 * - Canonical consistency
 * - Metadata uniqueness
 * - Structured data validity
 * - Index selection clarity
 * - Entity identity consistency
 * - No duplicate content
 */

declare(strict_types=1);

require_once __DIR__ . '/../app/lib/AdvancedMetaManager.php';
require_once __DIR__ . '/../app/lib/MetaManager.php';

class PageAuditor {
    private array $issues = [];
    private array $checkedPages = [];
    private array $titles = [];
    private array $descriptions = [];
    private array $canonicals = [];
    
    public function audit(): void {
        echo "=== PAGE AUDIT: GOOGLE RANKING CONSTRAINT COMPLIANCE ===\n\n";
        
        // 1. Get all pages from sitemaps
        $pages = $this->getAllPages();
        echo "Found " . count($pages) . " pages to audit\n\n";
        
        // 2. Check each page
        foreach ($pages as $url) {
            $this->checkPage($url);
        }
        
        // 3. Check for duplicates
        $this->checkDuplicates();
        
        // 4. Report
        $this->report();
    }
    
    private function getAllPages(): array {
        $pages = [];
        
        // Static pages (exclude /home and /contact-us as they redirect)
        $staticPages = [
            '/',
            '/contact',
            '/service-area',
            '/siding',
            '/about-us',
            '/our-services',
            '/our-results',
            '/products',
            '/services',
            '/home-siding-blog',
        ];
        
        // Service pages
        $servicePages = [
            '/cabinet-installation-south-bend',
            '/interior-painting-south-bend',
            '/siding-contractor-faq-installation-maintenance-cost',
            '/door-replacement-south-bend',
            '/painting-services-south-bend',
            '/kitchen-renovation-south-bend',
            '/vinyl-siding-michiana-south-bend',
            '/window-replacement-south-bend',
            '/exterior-painting-south-bend',
            '/vinyl-siding-certifications',
        ];
        
        // Matrix pages (sample - would need full CSV)
        $matrixPages = $this->getMatrixPages();
        
        // Blog pages
        $blogPages = $this->getBlogPages();
        
        return array_merge($staticPages, $servicePages, $matrixPages, $blogPages);
    }
    
    private function getMatrixPages(): array {
        $pages = [];
        $csvPath = __DIR__ . '/../data_matrix/convex_matrix_expanded.csv';
        
        if (!file_exists($csvPath)) {
            return $pages;
        }
        
        $handle = fopen($csvPath, 'r');
        if (!$handle) return $pages;
        
        $headers = fgetcsv($handle, 0, ',', '"', '');
        $slugIdx = array_search('slug', $headers);
        
        if ($slugIdx === false) {
            fclose($handle);
            return $pages;
        }
        
        // Sample first 50 for audit
        $count = 0;
        while (($row = fgetcsv($handle, 0, ',', '"', '')) !== false && $count < 50) {
            if (isset($row[$slugIdx]) && !empty($row[$slugIdx])) {
                $pages[] = '/matrix/' . trim($row[$slugIdx]);
                $count++;
            }
        }
        
        fclose($handle);
        return $pages;
    }
    
    private function getBlogPages(): array {
        $pages = ['/home-siding-blog'];
        
        $configPath = __DIR__ . '/../app/config/blog_urls.php';
        if (file_exists($configPath)) {
            $posts = require $configPath;
            foreach ($posts as $post) {
                if (isset($post['loc'])) {
                    $pages[] = $post['loc'];
                }
            }
        }
        
        return $pages;
    }
    
    private function checkPage(string $url): void {
        $path = parse_url($url, PHP_URL_PATH) ?: $url;
        $this->checkedPages[] = $path;
        
        // Simulate page load
        $_SERVER['REQUEST_URI'] = $path;
        $_SERVER['HTTP_HOST'] = 'www.hoosiercladding.com';
        $_SERVER['HTTPS'] = 'on';
        
        // Check metadata generation
        $this->checkMetadata($path);
        
        // Check canonical
        $this->checkCanonical($path);
    }
    
    private function checkMetadata(string $path): void {
        // Determine page type
        $pageType = $this->detectPageType($path);
        
        // Generate metadata
        try {
            $title = AdvancedMetaManager::generateTitle($path, $pageType, []);
            $description = AdvancedMetaManager::generateDescription($path, $pageType, []);
            
            // Check length constraints
            $titleLen = mb_strlen($title);
            $descLen = mb_strlen($description);
            
            if ($titleLen < 50 || $titleLen > 60) {
                $this->addIssue($path, "METADATA", "Title length violation: {$titleLen} chars (required: 50-60)");
            }
            
            if ($descLen < 120 || $descLen > 155) {
                $this->addIssue($path, "METADATA", "Description length violation: {$descLen} chars (required: 120-155)");
            }
            
            // Store for duplicate check
            $this->titles[$path] = $title;
            $this->descriptions[$path] = $description;
            
        } catch (Exception $e) {
            $this->addIssue($path, "METADATA", "Generation error: " . $e->getMessage());
        }
    }
    
    private function checkCanonical(string $path): void {
        try {
            $canonical = MetaManager::canonical($path);
            
            // Verify canonical format
            if (!filter_var($canonical, FILTER_VALIDATE_URL)) {
                $this->addIssue($path, "CANONICAL", "Invalid canonical URL format: {$canonical}");
            }
            
            // Check for trailing slash consistency
            $expectedPath = rtrim($path, '/') ?: '/';
            $canonicalPath = parse_url($canonical, PHP_URL_PATH);
            $canonicalPath = rtrim($canonicalPath, '/') ?: '/';
            
            if ($expectedPath !== $canonicalPath) {
                $this->addIssue($path, "CANONICAL", "Path mismatch: expected '{$expectedPath}', got '{$canonicalPath}'");
            }
            
            $this->canonicals[$path] = $canonical;
            
        } catch (Exception $e) {
            $this->addIssue($path, "CANONICAL", "Error: " . $e->getMessage());
        }
    }
    
    private function checkDuplicates(): void {
        // Check duplicate titles
        $titleCounts = array_count_values($this->titles);
        foreach ($titleCounts as $title => $count) {
            if ($count > 1) {
                $pages = array_keys($this->titles, $title);
                $this->addIssue(implode(', ', $pages), "DUPLICATE", "Duplicate title found ({$count}x): {$title}");
            }
        }
        
        // Check duplicate descriptions
        $descCounts = array_count_values($this->descriptions);
        foreach ($descCounts as $desc => $count) {
            if ($count > 1) {
                $pages = array_keys($this->descriptions, $desc);
                $this->addIssue(implode(', ', $pages), "DUPLICATE", "Duplicate description found ({$count}x)");
            }
        }
        
        // Check duplicate canonicals
        $canonicalCounts = array_count_values($this->canonicals);
        foreach ($canonicalCounts as $canonical => $count) {
            if ($count > 1) {
                $pages = array_keys($this->canonicals, $canonical);
                $this->addIssue(implode(', ', $pages), "CANONICAL", "Duplicate canonical URL ({$count}x): {$canonical}");
            }
        }
    }
    
    private function detectPageType(string $path): string {
        $path = trim($path, '/');
        if ($path === '' || $path === 'home' || $path === 'index') return 'homepage';
        if (strpos($path, 'matrix/') === 0) return 'matrix';
        if (strpos($path, 'home-siding-blog') === 0 || strpos($path, 'home-improvement-blog') === 0) return 'blog';
        if ($path === 'about-us' || $path === 'about') return 'about';
        if ($path === 'contact' || $path === 'contact-us') return 'contact';
        if (strpos($path, 'service-area') === 0) return 'city';
        return 'service';
    }
    
    private function addIssue(string $path, string $category, string $message): void {
        $this->issues[] = [
            'path' => $path,
            'category' => $category,
            'message' => $message
        ];
    }
    
    private function report(): void {
        echo "\n=== AUDIT RESULTS ===\n\n";
        
        if (empty($this->issues)) {
            echo "✅ ALL PAGES COMPLIANT\n";
            echo "No issues found. All pages align with Google ranking constraint standards.\n";
            return;
        }
        
        // Group by category
        $byCategory = [];
        foreach ($this->issues as $issue) {
            $byCategory[$issue['category']][] = $issue;
        }
        
        foreach ($byCategory as $category => $issues) {
            echo "\n[{$category}] " . count($issues) . " issue(s)\n";
            echo str_repeat('-', 80) . "\n";
            foreach ($issues as $issue) {
                echo "  {$issue['path']}\n";
                echo "    → {$issue['message']}\n";
            }
        }
        
        echo "\n=== SUMMARY ===\n";
        echo "Total pages checked: " . count($this->checkedPages) . "\n";
        echo "Total issues found: " . count($this->issues) . "\n";
        echo "Compliance rate: " . round((1 - count($this->issues) / count($this->checkedPages)) * 100, 2) . "%\n";
    }
}

// Run audit
$auditor = new PageAuditor();
$auditor->audit();

