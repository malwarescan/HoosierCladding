<?php
declare(strict_types=1);

/**
 * Try to pull on-page FAQs if your template marks them up with
 * .faq-item > .faq-q and .faq-a classes. Otherwise fall back to defaults.
 */
final class FaqExtractor
{
  public static function fromPage(array $defaultFaqs): array {
    // If you already have structured FAQs in your template variables,
    // replace this stub with that source. Leaving as defaults now.
    return $defaultFaqs;
  }
  
  /**
   * Extract FAQs from CSV row if available
   */
  public static function fromMatrixRow(?array $row, array $defaultFaqs): array {
    if (!$row) {
      return $defaultFaqs;
    }
    
    $faqs = [];
    
    // Check for FAQ columns in CSV (faq_q1, faq_a1, etc.)
    for ($i = 1; $i <= 5; $i++) {
      $qKey = "faq_q{$i}";
      $aKey = "faq_a{$i}";
      
      if (!empty($row[$qKey]) && !empty($row[$aKey])) {
        $faqs[] = [
          'q' => $row[$qKey],
          'a' => $row[$aKey]
        ];
      }
    }
    
    // Fall back to defaults if no FAQs found
    return !empty($faqs) ? $faqs : $defaultFaqs;
  }
}

