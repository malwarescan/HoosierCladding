<?php
declare(strict_types=1);
header('Content-Type: application/x-ndjson; charset=utf-8');
header('Cache-Control: public, max-age=300');
echo "{\"@type\":\"Product\",\"name\":\"NDJSON Smoke Test\",\"url\":\"https://www.hoosiercladding.com/test\",\"sku\":\"SMOKE-TEST-1\",\"brand\":{\"@type\":\"Brand\",\"name\":\"Hoosier Cladding\"},\"description\":\"Smoke test\",\"image\":[\"https://www.hoosiercladding.com/media/test.jpg\"],\"offers\":{\"@type\":\"Offer\",\"price\":\"0.00\",\"priceCurrency\":\"USD\",\"availability\":\"https://schema.org/InStock\"}}\n";
