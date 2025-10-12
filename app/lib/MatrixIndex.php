<?php
declare(strict_types=1);
require_once __DIR__.'/Slug.php';

final class MatrixIndex
{
  private string $csv;
  private array $rows = [];
  private bool $loaded = false;

  public function __construct(string $csvPath) { $this->csv = $csvPath; }

  public function all(): array {
    $this->load();
    return $this->rows;
  }

  public function findUrl(string $serviceSlug, string $locSlug): ?string {
    $this->load();
    foreach ($this->rows as $r) {
      // Match on service and location slugs only (ignoring pain point)
      if ($r['serviceSlug'] === $serviceSlug && $r['locSlug'] === $locSlug) {
        return $r['url'];
      }
    }
    return null;
  }
  
  public function findByFullSlug(string $fullSlug): ?array {
    $this->load();
    foreach ($this->rows as $r) {
      if (isset($r['fullSlug']) && $r['fullSlug'] === $fullSlug) {
        return $r;
      }
    }
    return null;
  }

  public function nearest(string $serviceSlug, string $locSlug): ?array {
    // fuzzy match within edit distance 3 on both parts
    $this->load();
    $best = null; $bestScore = PHP_INT_MAX;
    foreach ($this->rows as $r) {
      $d1 = levenshtein($serviceSlug, $r['serviceSlug']);
      $d2 = levenshtein($locSlug,     $r['locSlug']);
      $score = $d1 + $d2;
      if ($score < $bestScore) { $bestScore = $score; $best = $r; }
    }
    return ($bestScore <= 3) ? $best : null;
  }

  public function topByCity(array $cities, int $limitPerCity=1): array {
    $this->load();
    $out = [];
    foreach ($cities as $city) {
      $added = 0;
      foreach ($this->rows as $r) {
        if (mb_strtolower($r['city']) === mb_strtolower($city)) {
          $out[] = $r;
          $added++;
          if ($added >= $limitPerCity) break;
        }
      }
    }
    return $out;
  }

  public function firstN(int $n=8): array {
    $this->load();
    return array_slice($this->rows, 0, $n);
  }

  private function load(): void {
    if ($this->loaded) return;
    $this->loaded = true;
    $path = $this->csv;
    if (!is_file($path)) return;

    if (($h = fopen($path, 'r')) !== false) {
      $headers = fgetcsv($h, 0, ',', '"', '');
      if (!$headers) { fclose($h); return; }
      $headers = array_map('trim', $headers);
      $map = array_flip($headers);
      
      while (($row = fgetcsv($h, 0, ',', '"', '')) !== false) {
        // Try to use slug column if available (format: location/service/pain-point)
        if (isset($map['slug']) && !empty($row[$map['slug']])) {
          $slug = trim($row[$map['slug']]);
          $parts = explode('/', $slug);
          if (count($parts) >= 2) {
            $locSlug = $parts[0];
            $serviceSlug = $parts[1];
            $painSlug = $parts[2] ?? '';
            
            // Extract city and state from location slug
            $locParts = explode('-', $locSlug);
            $state = '';
            if (count($locParts) > 1) {
              $possibleState = strtoupper(end($locParts));
              if (strlen($possibleState) === 2) {
                $state = $possibleState;
                array_pop($locParts);
              }
            }
            $city = implode(' ', array_map('ucfirst', $locParts));
            
            $service = ucwords(str_replace('-', ' ', $serviceSlug));
            $painPoint = $painSlug ? ucwords(str_replace('-', ' ', $painSlug)) : '';
            
            // Create label with or without pain point
            $label = $service.' in '.$city.($state ? ', '.$state : '');
            if ($painPoint) {
              $label .= ' - '.$painPoint;
            }
            
            $this->rows[] = [
              'service' => $service,
              'city'    => $city,
              'state'   => $state,
              'zip'     => '',
              'painPoint' => $painPoint,
              'serviceSlug' => $serviceSlug,
              'locSlug'     => $locSlug,
              'painSlug'    => $painSlug,
              'fullSlug'    => $slug,
              'url'         => '/matrix/'.$slug,
              'label'       => $label,
            ];
            continue;
          }
        }
        
        // Fallback: build from individual columns
        $service = trim($row[$map['service']] ?? $row[$map['primary_keyword']] ?? '');
        $city    = trim($row[$map['city']] ?? $row[$map['location']] ?? '');
        $state   = trim($row[$map['state']] ?? $row[$map['region']] ?? '');
        $zip     = trim($row[$map['zip']] ?? $row[$map['postal']] ?? '');
        
        if ($service === '' || $city === '') continue;

        $serviceSlug = Slug::slugify($service);
        $locSlug     = Slug::buildLoc($city, $state, $zip);
        $url         = '/matrix/'.$serviceSlug.'/'.$locSlug;

        $this->rows[] = [
          'service' => $service,
          'city'    => $city,
          'state'   => $state,
          'zip'     => $zip,
          'serviceSlug' => $serviceSlug,
          'locSlug'     => $locSlug,
          'url'         => $url,
          'label'       => $service.' in '.$city.($state ? ', '.Slug::normState($state) : ''),
        ];
      }
      fclose($h);
    }
  }
}

