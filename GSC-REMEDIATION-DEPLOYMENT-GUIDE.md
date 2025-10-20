# GSC "Impressions but No Clicks" Remediation — Deployment Guide

## Overview
This toolkit analyzes your Google Search Console data and generates targeted SEO improvements for pages with high impressions but low click-through rates.

## Generated Files

### 1. Analysis Results
- **`outputs/recommendations.csv`** — Page-by-page fixes with optimized titles, meta descriptions, and query mappings
- **`outputs/canonical_map.csv`** — Canonical URL mappings for duplicate content resolution
- **`outputs/htaccess_redirects.txt`** — Apache 301 redirect rules (currently empty - no duplicates found)

### 2. Drop-in Snippets
- **`outputs/snippets/<slug>/title.txt`** — Optimized page titles
- **`outputs/snippets/<slug>/meta.txt`** — Optimized meta descriptions  
- **`outputs/snippets/<slug>/faq.jsonld`** — FAQPage structured data

### 3. PHP Includes
- **`php/canonical_guard.php`** — Automatic canonical tag generation
- **`php/schema_service.php`** — LocalBusiness + FAQPage schema injection

## Key Findings

### High-Impact Pages Identified
1. **Homepage** (509 impressions, 0% CTR, position 43.7)
2. **Blog: Siding Replacement Costs** (563 impressions, 0% CTR, position 25.77)
3. **Blog: Metal Roof Ridge Cap** (539 impressions, 0% CTR, position 40.39)
4. **Vinyl Siding South Bend** (405 impressions, 0% CTR, position 58.68)
5. **Blog: Home Insurance Windows** (340 impressions, 0% CTR, position 73.09)

### Top Queries Driving Impressions
- `house siding replacement` (386 impressions)
- `vinyl siding installers near me` (335 impressions)
- `hardie board siding installers` (61 impressions)
- `does home warranty cover broken windows` (51 impressions)
- `roof ridge cap` (49 impressions)

## Deployment Instructions

### Step 1: Implement Canonical Tags
Add to your base layout `<head>` section:

```php
<?php 
// Set canonical URL based on request path
$canonicalUrl = null; // Will auto-generate if not set
include __DIR__ . '/php/canonical_guard.php'; 
?>
```

### Step 2: Update Page Titles and Meta Descriptions
For each target page, load optimized snippets:

```php
<?php
$slug = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),'/') ?: 'home';
$tfile = __DIR__ . "/outputs/snippets/$slug/title.txt";
$mfile = __DIR__ . "/outputs/snippets/$slug/meta.txt";
$title = file_exists($tfile) ? trim(file_get_contents($tfile)) : "Hoosier Cladding";
$meta  = file_exists($mfile) ? trim(file_get_contents($mfile)) : "Siding done right in Indiana.";
?>
<title><?= htmlspecialchars($title, ENT_QUOTES) ?></title>
<meta name="description" content="<?= htmlspecialchars($meta, ENT_QUOTES) ?>">
```

### Step 3: Add Structured Data
At the bottom of page templates:

```php
<?php
$serviceName = $serviceName ?? 'Home Siding';
$cityName = $cityName ?? null; // e.g., 'South Bend'
include __DIR__ . '/php/schema_service.php';
?>
```

### Step 4: Apply Redirects (if needed)
The analysis found no duplicate URL variants requiring redirects. If you add redirects later, copy the contents of `outputs/htaccess_redirects.txt` into your Apache vhost or `.htaccess` file below `RewriteEngine On`.

## Expected Impact

### Immediate Improvements
- **Better CTR**: Optimized titles that match user search intent
- **Improved Rankings**: Enhanced meta descriptions with local keywords
- **Rich Snippets**: FAQ structured data for enhanced SERP appearance

### Long-term Benefits
- **Higher Click-Through Rates**: Titles aligned with top-performing queries
- **Better User Experience**: Clear, compelling meta descriptions
- **Local SEO Boost**: City-specific optimization for South Bend and surrounding areas

## Monitoring

### Track These Metrics
1. **Click-Through Rate (CTR)** — Should improve within 2-4 weeks
2. **Average Position** — Monitor ranking improvements
3. **Impressions** — Should remain stable or increase
4. **Rich Snippet Appearance** — Check for FAQ snippets in search results

### Re-run Analysis
- Monthly to identify new underperforming pages
- After major content updates
- When adding new service areas or pages

## Implementation Priority

### Phase 1 (Immediate - High Impact)
1. Homepage title and meta description
2. Top blog posts (siding costs, ridge cap, insurance)
3. Vinyl siding South Bend page

### Phase 2 (Within 1 week)
1. All remaining target pages
2. Canonical tag implementation
3. Structured data deployment

### Phase 3 (Ongoing)
1. Monitor performance improvements
2. A/B test different title variations
3. Expand to additional service areas

## Technical Notes

### File Structure
```
outputs/
├── recommendations.csv          # Main analysis results
├── canonical_map.csv           # URL canonicalization map
├── htaccess_redirects.txt      # Apache redirect rules
└── snippets/                   # Drop-in content files
    ├── home/
    ├── vinyl-siding-michiana-south-bend/
    └── home-siding-blog/
        ├── siding-replacement-costs-indiana-2025/
        ├── install-a-metal-roof-ridge-cap/
        └── does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know/

php/
├── canonical_guard.php         # Canonical tag generator
└── schema_service.php          # Schema markup injector
```

### Dependencies
- PHP 7.4+ for includes
- Apache mod_rewrite (for redirects)
- No external libraries required

## Success Metrics

### Target Improvements
- **CTR**: Increase from 0% to 2-4% on target pages
- **Position**: Improve average position by 5-10 spots
- **Rich Snippets**: FAQ snippets appearing in search results
- **Local Rankings**: Better visibility for "South Bend siding" queries

### Timeline
- **Week 1**: Implementation complete
- **Week 2-4**: Initial ranking improvements
- **Month 2-3**: CTR improvements visible
- **Month 3+**: Rich snippets and enhanced SERP features

---

*Generated by GSC Remediation Toolkit v1.0*
*Analysis Date: $(date)*
*Target Domain: https://www.hoosiercladding.com*
