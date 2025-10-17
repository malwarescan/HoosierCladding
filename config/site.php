<?php
declare(strict_types=1);
// Single-locale site (no hreflang)
const SITE_HOST = 'www.hoosiercladding.com';
const SITE_SCHEME = 'https';
const PUBLICATION_NAME = 'Hoosier Cladding';
function absolute_url(string $path): string {
  $path = '/' . ltrim($path, '/');
  return SITE_SCHEME . '://' . SITE_HOST . $path;
}

