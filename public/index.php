<?php
/**
 * Public Front Controller / Router
 * Redirects to parent directory router
 */

// If accessed via /public/, redirect to the main router
$request_uri = $_SERVER['REQUEST_URI'];

// Remove /public/ prefix if present
if (strpos($request_uri, '/public/') === 0) {
    $new_uri = substr($request_uri, 7); // Remove '/public'
    header('Location: /' . ltrim($new_uri, '/'), true, 301);
    exit;
}

// Otherwise, use the parent router
require_once dirname(__DIR__) . '/index.php';
