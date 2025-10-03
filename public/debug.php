<?php
// Debug endpoint to check server configuration
header('Content-Type: text/plain');

echo "=== Hoosier Cladding Debug Info ===\n\n";

echo "PHP Version: " . phpversion() . "\n";
echo "Server Software: " . ($_SERVER['SERVER_SOFTWARE'] ?? 'Unknown') . "\n";
echo "Document Root: " . ($_SERVER['DOCUMENT_ROOT'] ?? 'Unknown') . "\n";
echo "Script Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'Unknown') . "\n\n";

echo "=== File Checks ===\n";
$files = ['sitemap.xml', 'sitemap.php', 'robots.txt', 'test-sitemap.xml'];
foreach ($files as $file) {
    $path = __DIR__ . '/' . $file;
    echo "$file: " . (file_exists($path) ? "EXISTS" : "MISSING") . "\n";
    if (file_exists($path)) {
        echo "  Size: " . filesize($path) . " bytes\n";
        echo "  Readable: " . (is_readable($path) ? "YES" : "NO") . "\n";
    }
}

echo "\n=== Apache Modules ===\n";
if (function_exists('apache_get_modules')) {
    $modules = apache_get_modules();
    $important = ['rewrite', 'headers'];
    foreach ($important as $module) {
        echo "$module: " . (in_array($module, $modules) ? "LOADED" : "NOT LOADED") . "\n";
    }
}

echo "\n=== Environment ===\n";
echo "REQUEST_METHOD: " . ($_SERVER['REQUEST_METHOD'] ?? 'Unknown') . "\n";
echo "REQUEST_URI: " . ($_SERVER['REQUEST_URI'] ?? 'Unknown') . "\n";
echo "HTTP_HOST: " . ($_SERVER['HTTP_HOST'] ?? 'Unknown') . "\n";
?>
