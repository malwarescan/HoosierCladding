<?php
/**
 * Router script for PHP's built-in development server
 * Usage: php -S localhost:8080 router.php
 */

$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Serve static files directly
$file_path = __DIR__ . $request_uri;

// Check if it's a real file (static asset)
if ($request_uri !== '/' && file_exists($file_path) && is_file($file_path)) {
    // Let PHP serve the static file
    return false;
}

// API routes - serve directly
if (preg_match('#^/api/#', $request_uri)) {
    $file_path = __DIR__ . $request_uri;
    if (file_exists($file_path) && is_file($file_path)) {
        return false; // Let PHP serve the file
    }
}

// NDJSON feeds - serve directly
if (preg_match('#^/feeds/#', $request_uri)) {
    $file_path = __DIR__ . $request_uri;
    if (file_exists($file_path) && is_file($file_path)) {
        return false; // Let PHP serve the file
    }
}

// Special handling for sitemap URLs (including numbered ones)
if (preg_match('/^\/sitemap(-[a-z]+)?(-\d+)?\.xml$/', $request_uri)) {
    // Route to index.php which will handle sitemap routing
    $_SERVER['SCRIPT_NAME'] = '/index.php';
    require __DIR__ . '/index.php';
    return true;
}

// Special handling for certain files
if (preg_match('/\.(css|js|jpg|jpeg|png|gif|svg|webp|woff|woff2|ttf|ico|xml|txt)$/', $request_uri)) {
    // Check if file exists
    if (file_exists($file_path)) {
        return false;
    }
    // File not found
    http_response_code(404);
    echo "404 - File Not Found";
    return true;
}

// Route all other requests through index.php
$_SERVER['SCRIPT_NAME'] = '/index.php';
require __DIR__ . '/index.php';

