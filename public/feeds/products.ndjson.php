<?php
declare(strict_types=1);

use Hoosier\Feeds\FeedSource;
use Hoosier\Feeds\Normalizer;
use Hoosier\Feeds\JsonlWriter;
use Hoosier\Feeds\Health;

require __DIR__ . '/_lib/FeedSource.php';
require __DIR__ . '/_lib/Normalizer.php';
require __DIR__ . '/_lib/JsonlWriter.php';
require __DIR__ . '/_lib/Health.php';

$seed = 'products-v1|' . gmdate('Y-m-d-H'); // rotate hourly for cache-busting if content unchanged
$etag = Health::etagFor($seed);

if (!headers_sent()) {
    header('Content-Type: application/x-ndjson; charset=utf-8');
    header('Cache-Control: public, max-age=300, stale-while-revalidate=600');
    header('ETag: ' . $etag);
}

if (Health::notModifiedSince($etag)) {
    http_response_code(304);
    exit;
}

// Build normalized objects generator
$gen = (function (): \Generator {
    foreach (FeedSource::streamProducts() as $row) {
        // Validate minimum fields; skip if missing
        $minFieldsOk = !empty($row['name']) && !empty($row['url']) &&
                       (!empty($row['sku']) || !empty($row['mpn']) || !empty($row['gtin13'])) &&
                       !empty($row['brand']) && !empty($row['image']) && !empty($row['description']) &&
                       !empty($row['offers']['price']) && !empty($row['offers']['priceCurrency']) &&
                       !empty($row['offers']['availability']);

        if (!$minFieldsOk) {
            // You could log to file/syslog here
            continue;
        }

        yield Normalizer::toProduct($row);
    }
})();

JsonlWriter::stream($gen);
