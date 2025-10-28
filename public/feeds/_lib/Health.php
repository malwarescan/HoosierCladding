<?php
declare(strict_types=1);

namespace Hoosier\Feeds;

final class Health {
    public static function etagFor(string $seed): string {
        return '"' . substr(sha1($seed), 0, 16) . '"';
    }
    public static function notModifiedSince(string $etag): bool {
        $ims = $_SERVER['HTTP_IF_NONE_MATCH'] ?? '';
        return $ims === $etag;
    }
}

