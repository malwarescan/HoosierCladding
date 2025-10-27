<?php
declare(strict_types=1);

namespace HC\Lib;

final class HtmlFetcher {
  private string $ua = 'HoosierCladdingBot/1.0 (+https://www.hoosiercladding.com)';

  public function get(string $url, int $timeout=15, int $retries=2): string {
    $attempt = 0; $err = null;
    while ($attempt <= $retries) {
      $ch = curl_init($url);
      curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 5,
        CURLOPT_CONNECTTIMEOUT => $timeout,
        CURLOPT_TIMEOUT => $timeout,
        CURLOPT_ENCODING => 'gzip,deflate',
        CURLOPT_USERAGENT => $this->ua,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_HTTPHEADER => ['Accept: text/html,application/xhtml+xml,application/ld+json;q=0.9,*/*;q=0.8']
      ]);
      $body = curl_exec($ch);
      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $cerr = curl_error($ch);
      curl_close($ch);
      if ($body !== false && $code >= 200 && $code < 400) return (string)$body;
      $err = "HTTP $code ".($cerr ?: '');
      $attempt++;
      usleep(200000);
    }
    throw new \RuntimeException("Fetch failed for $url: $err");
  }

  public function headOk(string $url, int $timeout=10): bool {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
      CURLOPT_NOBODY => true,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_MAXREDIRS => 5,
      CURLOPT_CONNECTTIMEOUT => $timeout,
      CURLOPT_TIMEOUT => $timeout,
      CURLOPT_USERAGENT => $this->ua,
    ]);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $code >= 200 && $code < 400;
@end
}

