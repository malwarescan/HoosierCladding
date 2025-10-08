# Matrix Schema Implementation Guide

## Overview

This implementation provides **optimal structured data** for 10,500+ programmatic landing pages using:
- ✅ **LocalBusiness** (always-on for local SEO)
- ✅ **Service** (page-specific service intent)
- ✅ **FAQPage** (conditional, only when FAQs present)
- ⚠️ **Product** (optional, commented out—use only for actual SKUs)

## Why This Schema Mix?

### LocalBusiness
**Purpose:** Establishes your business in Google's local knowledge graph  
**Benefit:** Enables eligibility in local search results, Google Maps, and Knowledge Panel  
**Frequency:** Every page  
**Reference:** https://developers.google.com/search/docs/appearance/structured-data/local-business

### Service
**Purpose:** Describes the specific service offering on each landing page  
**Benefit:** Signals service intent and helps Google understand page topic  
**Frequency:** Every page  
**Reference:** https://developers.google.com/search/docs/appearance/structured-data/service

### FAQPage
**Purpose:** Rich results eligibility for FAQ content  
**Benefit:** Potential for FAQ rich snippets in SERPs  
**Frequency:** Only when Q&A pairs exist  
**Critical:** FAQs MUST be visible on page (Google requirement)  
**Reference:** https://developers.google.com/search/docs/appearance/structured-data/faqpage

### Product (Optional)
**Purpose:** For selling fixed packages with pricing  
**Benefit:** Shopping integrations, Merchant Center  
**When to Use:** Only if you sell an actual product/package with fixed price  
**When NOT to Use:** Generic services without fixed pricing  
**Reference:** https://developers.google.com/search/docs/appearance/structured-data/product

---

## File Structure

```
includes/
├── schema_renderer.php      # Core schema generation functions
├── html_layout.php           # HTML rendering with visible FAQs
├── matrix_page_example.php   # Example integration
├── test_schema.php           # Validation test script
└── htaccess_snippet.txt      # Apache routing rules

matrix-router.php             # Production router
data_matrix/
└── convex_matrix_expanded.csv  # 10,500 row data matrix
```

---

## Quick Start

### 1. Test Schema Output

```bash
php includes/test_schema.php
```

This validates that schema generation works correctly.

### 2. Add Routing

Add this to your `.htaccess`:

```apache
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^matrix/(.+)$ matrix-router.php [L,QSA]
```

### 3. Access Your Pages

URLs follow this pattern:
```
/matrix/dunlap-in/siding-replacement/rotten-siding
/matrix/cassopolis-mi/house-wrap-weatherproofing/faded-color
/matrix/edwardsburg-mi/james-hardie-siding-installation/drafty-rooms
```

---

## Integration Examples

### Basic Usage

```php
<?php
require_once __DIR__ . '/includes/schema_renderer.php';
require_once __DIR__ . '/includes/html_layout.php';

// Load row from CSV
$row = loadMatrixRowBySlug('dunlap-in/siding-replacement/rotten-siding');

// In <head>
echo SchemaRenderer\render($row);

// In <body>
echo HtmlLayout\breadcrumbs($breadcrumbs);
echo "<h1>" . htmlspecialchars($row['h1']) . "</h1>";
echo HtmlLayout\introBlock($row);
echo HtmlLayout\faqFromRow($row);
?>
```

### Custom Template

```php
<?php
// Your custom page template
$row = loadMatrixRowBySlug($slug);
?>
<!DOCTYPE html>
<html>
<head>
    <title><?= $row['seo_title'] ?></title>
    <meta name="description" content="<?= $row['meta_description'] ?>">
    
    <!-- All schemas in one call -->
    <?= SchemaRenderer\render($row) ?>
</head>
<body>
    <?php include 'partials/header.php'; ?>
    
    <main>
        <h1><?= $row['h1'] ?></h1>
        <?= HtmlLayout\introBlock($row) ?>
        
        <!-- Your content -->
        
        <!-- FAQs (required for FAQPage schema compliance) -->
        <?= HtmlLayout\faqFromRow($row) ?>
    </main>
    
    <?php include 'partials/footer.php'; ?>
</body>
</html>
```

---

## CSV Data Structure

Your `convex_matrix_expanded.csv` must include these columns:

### Required for Schema
- `brand_name` — Business name
- `brand_url` — Website URL
- `brand_sameas` — Social profiles (comma-separated)
- `contact_phone` — Phone number (E.164 format preferred)
- `contact_email` — Email address
- `city` — City name
- `region` — State/region code
- `country` — Country code (default: US)
- `primary_keyword` — Main service name
- `location` — Full location string (e.g., "Dunlap, IN")
- `pain_point` — Problem being solved (optional)

### Required for SEO
- `seo_title` — Page title tag
- `meta_description` — Meta description
- `h1` — Primary heading
- `slug` — URL slug (e.g., "city-state/service/pain")
- `page_url` — Full canonical URL

### Required for FAQPage
- `faq_q1` to `faq_q6` — Question text
- `faq_a1` to `faq_a6` — Answer text

### Optional
- `price` — Product price (only if using Product schema)
- `currency` — Currency code (default: USD)

---

## Schema Output Examples

### LocalBusiness (Always Present)

```json
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Hoosier Cladding",
  "url": "https://www.hoosiercladding.com/",
  "telephone": "+1 574-555-0123",
  "email": "info@hoosiercladding.com",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "South Bend",
    "addressRegion": "IN",
    "addressCountry": "US"
  },
  "areaServed": "Dunlap, IN"
}
```

### Service (Page-Specific)

```json
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "Siding Replacement – Rotten Siding",
  "description": "Hoosier Cladding provides siding replacement in Dunlap, IN to fix rotten siding.",
  "provider": {
    "@type": "Organization",
    "name": "Hoosier Cladding",
    "url": "https://www.hoosiercladding.com/",
    "sameAs": [
      "https://www.facebook.com/hoosiercladding",
      "https://www.instagram.com/hoosiercladding"
    ]
  },
  "areaServed": "Dunlap, IN"
}
```

### FAQPage (Conditional)

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "How fast can you repair storm-damaged siding?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Most minor repairs are completed within 48–72 hours after inspection."
      }
    }
  ]
}
```

---

## Validation & Testing

### 1. Schema Validator
https://validator.schema.org/

Paste your page's JSON-LD to verify structure.

### 2. Rich Results Test
https://search.google.com/test/rich-results

Check eligibility for rich results (FAQs, etc.)

### 3. Search Console
https://search.google.com/search-console

Monitor structured data coverage and issues.

---

## Best Practices

### ✅ DO
- Keep FAQs visible on the page (Google requirement)
- Use E.164 format for phone numbers (`+1 574-555-0123`)
- Include `areaServed` for local targeting
- Validate schema before deploying
- Monitor Search Console for errors

### ❌ DON'T
- Use Product schema for non-purchasable services
- Hide FAQ content (must be visible to users)
- Mix multiple LocalBusiness schemas on one page
- Include promotional content in FAQ answers
- Use fake reviews or ratings

---

## Performance Notes

### Caching
The `MatrixDataLoader` class caches CSV data in memory during a request to avoid repeated file reads.

### Optimization
- CSV is loaded once per request
- Indexed by slug for O(1) lookups
- No database queries required

### Scaling
For 10,500+ pages:
- Consider converting CSV to SQLite for faster lookups
- Implement page-level caching (Redis, Memcached)
- Use static HTML generation for fastest performance

---

## Troubleshooting

### Schema Not Appearing
1. Check browser source—should see `<script type="application/ld+json">`
2. Verify CSV row has required columns
3. Check PHP error logs

### FAQPage Not Eligible
1. Ensure FAQs are visible on page (use `HtmlLayout\faqFromRow()`)
2. Must have at least 2 Q&A pairs
3. Questions must be genuine user questions
4. Answers must be concise (no promotional content)

### 404 Errors
1. Check .htaccess rewrite rules
2. Verify slug matches CSV exactly
3. Check file permissions on matrix-router.php

### Invalid JSON
1. Run test: `php includes/test_schema.php`
2. Validate at https://validator.schema.org/
3. Check for special characters in CSV (escape quotes)

---

## Support & References

### Google Documentation
- [Local Business](https://developers.google.com/search/docs/appearance/structured-data/local-business)
- [Service](https://developers.google.com/search/docs/appearance/structured-data/service)
- [FAQ](https://developers.google.com/search/docs/appearance/structured-data/faqpage)
- [Product](https://developers.google.com/search/docs/appearance/structured-data/product)

### Tools
- [Schema.org](https://schema.org/)
- [Structured Data Testing Tool](https://validator.schema.org/)
- [Rich Results Test](https://search.google.com/test/rich-results)

---

## Next Steps

1. ✅ Test schema output: `php includes/test_schema.php`
2. ✅ Add .htaccess routing rules
3. ✅ Test a few URLs manually
4. ⬜ Generate sitemap (see `src/generate-matrix-sitemap.php`)
5. ⬜ Submit sitemap to Google Search Console
6. ⬜ Monitor structured data reports

---

**Last Updated:** October 8, 2025  
**Version:** 1.0  
**Author:** Matrix Schema Implementation Team

