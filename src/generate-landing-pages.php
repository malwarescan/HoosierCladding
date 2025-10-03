<?php
/**
 * Generate Landing Pages and Update Sitemap
 * Creates all state/city/service landing pages and updates sitemap.xml
 */

class LandingPageGenerator {
    private $csvFile;
    private $baseUrl = 'https://hoosiercladding.com';
    private $sitemapFile;
    
    public function __construct() {
        $this->csvFile = __DIR__ . '/../data/landing_pages.csv';
        $this->sitemapFile = __DIR__ . '/../public/sitemap.xml';
    }
    
    /**
     * Read CSV file and return array of data
     */
    private function readCSV($file) {
        $data = [];
        if (($handle = fopen($file, "r")) !== FALSE) {
            $headers = fgetcsv($handle, 0, ',', '"', '\\');
            while (($row = fgetcsv($handle, 0, ',', '"', '\\')) !== FALSE) {
                if (count($row) === count($headers)) {
                    $data[] = array_combine($headers, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
    
    /**
     * Generate all landing pages from CSV data
     */
    public function generateLandingPages() {
        if (!file_exists($this->csvFile)) {
            throw new Exception("CSV file not found: " . $this->csvFile);
        }
        
        $csvData = $this->readCSV($this->csvFile);
        $generatedPages = [];
        
        foreach ($csvData as $row) {
            $url = trim($row['url'], '/');
            $generatedPages[] = [
                'url' => $this->baseUrl . '/' . $url,
                'lastmod' => date('Y-m-d'),
                'changefreq' => $this->getChangeFrequency($row['intent']),
                'priority' => $this->getPriority($row['intent'], $row['city'])
            ];
            
            echo "Generated landing page: " . $url . "\n";
        }
        
        return $generatedPages;
    }
    
    /**
     * Update sitemap.xml with new landing pages
     */
    public function updateSitemap($newPages) {
        // Read existing sitemap
        $existingPages = $this->readExistingSitemap();
        
        // Merge with new pages (avoid duplicates)
        $allPages = array_merge($existingPages, $newPages);
        
        // Remove duplicates based on URL
        $uniquePages = [];
        foreach ($allPages as $page) {
            $uniquePages[$page['url']] = $page;
        }
        
        // Sort by priority (highest first)
        uasort($uniquePages, function($a, $b) {
            return $b['priority'] <=> $a['priority'];
        });
        
        // Generate new sitemap XML
        $xml = $this->generateSitemapXml($uniquePages);
        
        // Write to file
        file_put_contents($this->sitemapFile, $xml);
        
        echo "Updated sitemap.xml with " . count($uniquePages) . " pages\n";
    }
    
    /**
     * Read existing sitemap pages
     */
    private function readExistingSitemap() {
        if (!file_exists($this->sitemapFile)) {
            return [];
        }
        
        $xml = simplexml_load_file($this->sitemapFile);
        $pages = [];
        
        foreach ($xml->url as $url) {
            $pages[] = [
                'url' => (string)$url->loc,
                'lastmod' => (string)$url->lastmod,
                'changefreq' => (string)$url->changefreq,
                'priority' => (float)$url->priority
            ];
        }
        
        return $pages;
    }
    
    /**
     * Generate sitemap XML
     */
    private function generateSitemapXml($pages) {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        foreach ($pages as $page) {
            $xml .= "  <url>\n";
            $xml .= "    <loc>" . htmlspecialchars($page['url']) . "</loc>\n";
            $xml .= "    <lastmod>" . $page['lastmod'] . "</lastmod>\n";
            $xml .= "    <changefreq>" . $page['changefreq'] . "</changefreq>\n";
            $xml .= "    <priority>" . number_format($page['priority'], 1) . "</priority>\n";
            $xml .= "  </url>\n";
        }
        
        $xml .= "</urlset>\n";
        
        return $xml;
    }
    
    /**
     * Determine change frequency based on intent
     */
    private function getChangeFrequency($intent) {
        switch (true) {
            case strpos($intent, 'transactional') !== false:
                return 'weekly';
            case strpos($intent, 'informational') !== false:
                return 'monthly';
            case strpos($intent, 'brand') !== false:
                return 'monthly';
            default:
                return 'monthly';
        }
    }
    
    /**
     * Determine priority based on intent and city
     */
    private function getPriority($intent, $city) {
        $basePriority = 0.7;
        
        // Higher priority for major cities
        $majorCities = ['south-bend', 'mishawaka', 'elkhart', 'chicago', 'fort-wayne', 'indianapolis'];
        if (in_array($city, $majorCities)) {
            $basePriority += 0.1;
        }
        
        // Higher priority for transactional intent
        if (strpos($intent, 'transactional') !== false) {
            $basePriority += 0.1;
        }
        
        // Higher priority for brand intent
        if (strpos($intent, 'brand') !== false) {
            $basePriority += 0.05;
        }
        
        return min(1.0, $basePriority);
    }
    
    /**
     * Generate breadcrumb data for landing pages
     */
    public function generateBreadcrumbData() {
        if (!file_exists($this->csvFile)) {
            throw new Exception("CSV file not found: " . $this->csvFile);
        }
        
        $csvData = $this->readCSV($this->csvFile);
        $breadcrumbs = [];
        
        foreach ($csvData as $row) {
            $url = trim($row['url'], '/');
            $segments = explode('/', $url);
            
            $breadcrumbs[$url] = [
                [
                    'name' => 'Home',
                    'url' => $this->baseUrl . '/'
                ],
                [
                    'name' => ucwords(str_replace('-', ' ', $segments[0])),
                    'url' => $this->baseUrl . '/' . $segments[0]
                ],
                [
                    'name' => ucwords(str_replace('-', ' ', $segments[1])),
                    'url' => $this->baseUrl . '/' . $segments[0] . '/' . $segments[1]
                ],
                [
                    'name' => ucwords(str_replace('-', ' ', $segments[2])),
                    'url' => $this->baseUrl . '/' . $url
                ]
            ];
        }
        
        return $breadcrumbs;
    }
}

// Run the generator
try {
    $generator = new LandingPageGenerator();
    
    echo "Generating landing pages...\n";
    $newPages = $generator->generateLandingPages();
    
    echo "Updating sitemap...\n";
    $generator->updateSitemap($newPages);
    
    echo "Generating breadcrumb data...\n";
    $breadcrumbs = $generator->generateBreadcrumbData();
    
    // Save breadcrumb data
    file_put_contents(
        __DIR__ . '/../data/breadcrumbs.json',
        json_encode($breadcrumbs, JSON_PRETTY_PRINT)
    );
    
    echo "Landing page generation complete!\n";
    echo "Generated " . count($newPages) . " landing pages\n";
    echo "Updated sitemap.xml\n";
    echo "Generated breadcrumb data\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
