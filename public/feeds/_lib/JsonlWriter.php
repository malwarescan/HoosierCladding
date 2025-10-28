<?php
declare(strict_types=1);

namespace Hoosier\Feeds;

final class JsonlWriter {
    /** Stream a sequence of objects as NDJSON with flushing */
    public static function stream(iterable $objects): void {
        // Send headers once
        if (!headers_sent()) {
            header('Content-Type: application/x-ndjson; charset=utf-8');
            header('Cache-Control: public, max-age=300');
            header('X-Accel-Buffering: no'); // for Nginx proxies
        }
        // Stream line-by-line
        foreach ($objects as $obj) {
            echo json_encode($obj, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) . "\n";
            if (function_exists('fastcgi_finish_request')) {
                // do nothing here; we want continuous stream
            }
            @ob_flush(); @flush();
        }
    }
}

