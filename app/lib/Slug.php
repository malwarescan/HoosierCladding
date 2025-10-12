<?php
declare(strict_types=1);

final class Slug
{
  public static function slugify(string $s): string {
    $s = mb_strtolower(trim($s), 'UTF-8');
    $s = preg_replace('/[^\p{L}\p{N}]+/u', '-', $s);
    return trim($s, '-');
  }

  public static function normState(string $s): string {
    return strtoupper(substr(preg_replace('/[^A-Za-z]/','',$s),0,2));
  }

  public static function buildLoc(string $city, string $state='', string $zip=''): string {
    $citySlug = self::slugify($city);
    $loc = $citySlug;
    if ($state) $loc .= '-'.strtolower(self::normState($state));
    if ($zip)   $loc .= '-'.preg_replace('/[^0-9]/','',$zip);
    return $loc;
  }
}

