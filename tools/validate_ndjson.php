<?php
declare(strict_types=1);

/**
 * Simple NDJSON validator: reads stdin, ensures each line is a valid JSON object
 * and contains minimum Product fields.
 *
 * Usage:
 * curl -s https://www.hoosiercladding.com/feeds/products.ndjson | php tools/validate_ndjson.php
 */
$lineNo = 0;
$ok = 0; $bad = 0;
$required = ['@type','name','url','brand','image','description','offers'];

$h = fopen('php://stdin','r');
while (($line = fgets($h)) !== false) {
    $lineNo++;
    $line = trim($line);
    if ($line === '') continue;

    $obj = json_decode($line, true);
    if (!is_array($obj)) {
        fwrite(STDERR, "Line {$lineNo}: not valid JSON\n");
        $bad++; continue;
    }
    foreach ($required as $k) {
        if (!array_key_exists($k, $obj)) {
            fwrite(STDERR, "Line {$lineNo}: missing key {$k}\n");
            $bad++; continue 2;
        }
    }
    if (($obj['@type'] ?? '') !== 'Product') {
        fwrite(STDERR, "Line {$lineNo}: @type must be Product\n");
        $bad++; continue;
    }
    $ok++;
}
fclose($h);

echo "VALID: {$ok}\n";
echo "INVALID: {$bad}\n";
exit($bad > 0 ? 1 : 0);

