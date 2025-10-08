<?php
/**
 * Matrix Sitemap Generator
 * 
 * Generates sitemap entries for all 10,500+ matrix landing pages
 * Output: sitemap-matrix.xml
 * 
 * Run: php src/generate-matrix-sitemap.php
 */

declare(strict_types=1);

class MatrixSitemapGenerator {
    private $csvPath;
    private $baseUrl = 'https://www.hoosiercladding.com';
    private $outputPath;
    
    public function __construct() {
        $this->csvPath = __DIR__ . '/../data_matrix/convex_matrix_expanded.csv';
        $this->outputPath = __DIR__ . '/../sitemap-matrix.xml';
    }
    
    /**
     * Generate sitemap XML from CSV data
     */
    public function generate(): void {
        if (!file_exists($this->csvPath)) {
            throw new Exception("CSV not found: " . $this->csvPath);
        }
        
        echo "Loading CSV data...\n";
        $rows = $this->loadCSV();
        echo "Found " . count($rows) . " rows\n";
        
        echo "Generating sitemap XML...\n";
        $xml = $this->buildSitemapXML($rows);
        
        echo "Writing to " . $this->outputPath . "...\n";
        file_put_contents($this->outputPath, $xml);
        
        echo "✓ Sitemap generated successfully!\n";
        echo "  - " . count($rows) . " URLs\n";
        echo "  - Size: " . $this->formatBytes(filesize($this->outputPath)) . "\n";
        
        // If over 50,000 URLs or 50MB, suggest splitting
        if (count($rows) > 50000) {
            echo "\n⚠ Warning: Sitemap has > 50,000 URLs. Consider creating a sitemap index.\n";
        }
    }
    
    /**
     * Load CSV data
     */
    private function loadCSV(): array {
        $rows = [];
        $handle = fopen($this->csvPath, 'r');
        $headers = fgetcsv($handle, 0, ',', '"', '');
        
        // Clean headers
        $headers = array_map('trim', $headers);
        
        while (($row = fgetcsv($handle, 0, ',', '"', '')) !== false) {
            if (count($row) === count($headers)) {
                $data = array_combine($headers, $row);
                
                // Only include rows with valid slugs
                if (!empty($data['slug'])) {
                    $rows[] = $data;
                }
            }
        }
        
        fclose($handle);
        return $rows;
    }
    
    /**
     * Build sitemap XML
     */
    private function buildSitemapXML(array $rows): string {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        foreach ($rows as $row) {
            $xml .= $this->buildUrlEntry($row);
        }
        
        $xml .= '</urlset>';
        return $xml;
    }
    
    /**
     * Build single URL entry
     */
    private function buildUrlEntry(array $row): string {
        $slug = trim($row['slug']);
        $loc = $this->baseUrl . '/matrix/' . $slug;
        
        // Use datePosted if available, otherwise current date
        $lastmod = !empty($row['datePosted']) ? $row['datePosted'] : date('Y-m-d');
        
        // Priority based on entity type or pain point
        $priority = $this->calculatePriority($row);
        
        // Change frequency
        $changefreq = 'monthly';
        
        $entry = "  <url>\n";
        $entry .= "    <loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc>\n";
        $entry .= "    <lastmod>$lastmod</lastmod>\n";
        $entry .= "    <changefreq>$changefreq</changefreq>\n";
        $entry .= "    <priority>$priority</priority>\n";
        $entry .= "  </url>\n";
        
        return $entry;
    }
    
    /**
     * Calculate priority (0.0 - 1.0)
     */
    private function calculatePriority(array $row): string {
        $priority = 0.5; // Default
        
        // High-intent keywords get higher priority
        $highIntentKeywords = [
            'replacement',
            'repair',
            'installation',
            'emergency',
            'damage'
        ];
        
        $keyword = strtolower($row['primary_keyword'] ?? '');
        foreach ($highIntentKeywords as $high) {
            if (strpos($keyword, $high) !== false) {
                $priority = 0.8;
                break;
            }
        }
        
        // Pain points indicate high-intent
        if (!empty($row['pain_point'])) {
            $priority = max($priority, 0.7);
        }
        
        // Major cities get slight boost
        $majorCities = ['South Bend', 'Mishawaka', 'Elkhart', 'Fort Wayne'];
        $location = $row['location'] ?? '';
        foreach ($majorCities as $city) {
            if (stripos($location, $city) !== false) {
                $priority = min(1.0, $priority + 0.1);
                break;
            }
        }
        
        return number_format($priority, 1);
    }
    
    /**
     * Format bytes to human-readable
     */
    private function formatBytes(int $bytes): string {
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }
        return $bytes . ' bytes';
    }
    
    /**
     * Generate sitemap index (if needed for > 50k URLs)
     */
    public function generateIndex(array $sitemapFiles): void {
        $indexPath = __DIR__ . '/../sitemap-index.xml';
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        foreach ($sitemapFiles as $file) {
            $xml .= "  <sitemap>\n";
            $xml .= "    <loc>" . $this->baseUrl . '/' . $file . "</loc>\n";
            $xml .= "    <lastmod>" . date('Y-m-d') . "</lastmod>\n";
            $xml .= "  </sitemap>\n";
        }
        
        $xml .= '</sitemapindex>';
        
        file_put_contents($indexPath, $xml);
        echo "✓ Sitemap index generated: $indexPath\n";
    }
}

// Run the generator
try {
    $generator = new MatrixSitemapGenerator();
    $generator->generate();
    
    echo "\n";
    echo "Next steps:\n";
    echo "1. Verify sitemap-matrix.xml in your site root\n";
    echo "2. Add to robots.txt: Sitemap: https://www.hoosiercladding.com/sitemap-matrix.xml\n";
    echo "3. Submit to Google Search Console\n";
    echo "4. Test: https://www.xml-sitemaps.com/validate-xml-sitemap.html\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}

