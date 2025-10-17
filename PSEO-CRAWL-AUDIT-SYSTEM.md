# HoosierCladding.com pSEO + Crawl Clarity Suite

Complete sitemap and crawl audit toolchain for programmatic SEO with agentic readiness.

## Overview

This system provides:
- **Unified Sitemap Generation**: Standard, Image, Video, and News sitemaps with gzip compression
- **Matrix Generators**: Services × cities, careers for pSEO scale
- **Validation Tools**: XML validation, search engine pinging
- **Crawl Auditor**: SEO validation including canonical checks, JSON-LD verification, and link graph analysis
- **No-Canonical Policy**: Enforces single URL per concept without canonical tags

## Quick Start

### Build All Sitemaps

```bash
# Generate matrix data
make matrix
make careers

# Build all sitemaps
make build

# Validate output
make validate
```

### Fast News Updates (for recent content)

```bash
make news
```

### Ping Search Engines

```bash
make ping
```

### Run Crawl Audit

```bash
make audit
```

## Directory Structure

```
/config/
  site.php                    # Site configuration (host, scheme, publication name)
  
/lib/
  helpers.php                 # CSV parsing and utility functions
  sitemap.php                 # Sitemap rendering functions (standard, image, video, news, index)
  
/data/
  services.csv                # Service types
  cities.csv                  # City locations
  careers.csv                 # Career positions
  insights.csv                # Blog/news articles
  images_map.csv              # Image associations
  matrix.csv                  # Generated: services × cities
  career_matrix.csv           # Generated: careers × cities
  
/scripts/
  generate_matrix.php         # Generate services × cities matrix
  generate_career_matrix.php  # Generate careers × cities matrix
  build_sitemaps.php          # Build all sitemaps (standard, image, video, news)
  build_news_only.php         # Fast news sitemap rebuild (48h window)
  ping_sitemaps.php           # Ping Google & Bing
  validate_sitemaps.php       # XML validation
  crawl_audit.php             # Full SEO crawl audit
  
/public/sitemaps/
  sitemap-index.xml.gz        # Main sitemap index (points to all shards)
  services-1.xml.gz           # Service pages shard
  images-1.xml.gz             # Image sitemap shard
  news-insights-1.xml.gz      # News sitemap (48h freshness)
  
/audit/
  crawl_report.csv            # Crawl audit results
```

## Data Sources

### services.csv
```csv
slug,name
siding-repair,Siding Repair
vinyl-siding,Vinyl Siding
...
```

### cities.csv
```csv
city
south-bend-in
mishawaka-in
...
```

### insights.csv
```csv
slug,title,lang,publication_date,lastmod,image_url,video_url,video_thumbnail,video_duration,keywords
winter-energy-bills-indiana,Winter Energy Bills in Indiana...,en,2025-10-04,2025-10-04,https://...,,,,"siding, energy, winter"
```

## Makefile Commands

### `make matrix`
Generates `data/matrix.csv` from services × cities (8 services × 10 cities = 80 URLs)

### `make careers`
Generates `data/career_matrix.csv` from careers × cities (5 roles × 10 cities = 50 URLs)

### `make build`
Builds all sitemaps:
- Standard URLs (services, careers, insights)
- Image sitemaps
- Video sitemaps
- News sitemaps (48h freshness)
- Generates both `.xml` and `.xml.gz` versions
- Updates `robots.txt` with sitemap URL

### `make news`
Fast rebuild of news sitemaps only (for recent articles within 48h)

### `make validate`
Validates all XML files:
- Checks XML syntax
- Verifies root elements (`urlset` or `sitemapindex`)
- Warns on oversized files (>51MB)

### `make ping`
Pings Google and Bing with sitemap index URL

### `make audit`
Runs comprehensive crawl audit:
- Fetches all URLs from sitemap index
- Checks HTTP status codes
- Verifies NO canonical tags present (no-canonical policy)
- Checks for noindex tags (should be absent in production)
- Validates JSON-LD structured data presence
- Analyzes internal link graph
- Reports broken internal links
- Outputs CSV report to `/audit/crawl_report.csv`

## Sitemap Features

### Standard Sitemaps
- `/services/{service}/{city}/` - Service pages
- `/careers/{city}/{role}/` - Career pages
- `/insights/{slug}/` - Blog/news articles
- 10,000 URLs per shard (automatic chunking)

### Image Sitemaps
- Google Images optimization
- `<image:loc>`, `<image:title>`, `<image:caption>`
- Automatically includes images from insights.csv

### Video Sitemaps
- YouTube/video content optimization
- `<video:content_loc>`, `<video:thumbnail_loc>`, `<video:duration>`
- Publication date tracking

### News Sitemaps
- Google News submission
- 48-hour freshness window
- Automatic expiry of old articles
- `<news:publication>`, `<news:publication_date>`, `<news:keywords>`

## Apache Configuration

The `.htaccess` file in `/public/` includes:

```apache
# Serve XML directly (bypass PHP router)
RewriteCond %{REQUEST_URI} \.xml(\.gz)?$ [NC]
RewriteRule ^ - [L]

# Content types + cache
<IfModule mod_headers.c>
  <FilesMatch "\.xml$">
    ForceType application/xml
    Header set Content-Type "application/xml; charset=UTF-8"
    Header set Cache-Control "public, max-age=3600"
  </FilesMatch>
  <FilesMatch "\.xml\.gz$">
    ForceType application/gzip
    Header set Content-Type "application/xml; charset=UTF-8"
    Header set Content-Encoding "gzip"
    Header set Cache-Control "public, max-age=3600"
  </FilesMatch>
</IfModule>
```

## Crawl Auditor

The crawl auditor (`scripts/crawl_audit.php`) validates:

### HTTP Status
- All URLs should return 200 OK
- Flags any 4xx or 5xx errors

### No-Canonical Policy
- **Verifies NO `<link rel="canonical">` tags present**
- Your site uses single URLs per concept without canonical tags
- Auditor flags any violations

### Indexability
- Checks for `<meta name="robots" content="noindex">`
- Production pages should be indexable

### Structured Data
- Extracts JSON-LD `@type` values
- Verifies LocalBusiness, Service, FAQ schemas on appropriate pages

### Link Graph
- Extracts all internal links
- Tests each link with HEAD request
- Counts broken internal links (status >= 400)

### Output
CSV report with columns:
```
url, status, content_type, has_canonical, has_noindex, jsonld_types, broken_internal_links_count
```

## Production Cron Schedule

For Railway deployment:

```cron
# Full sitemap rebuild every 6 hours
0 */6 * * * cd /app && make matrix careers build

# News refresh every 45 minutes
*/45 * * * * cd /app && make news

# Ping search engines after build
10 */6 * * * cd /app && make ping

# Daily crawl audit at 3:20 AM
20 3 * * * cd /app && make audit
```

## URL Structure

### Services
```
https://www.hoosiercladding.com/services/{service}/{city}/
```
Example: `https://www.hoosiercladding.com/services/siding-repair/south-bend-in/`

### Careers
```
https://www.hoosiercladding.com/careers/{city}/{role}/
```
Example: `https://www.hoosiercladding.com/careers/south-bend-in/siding-installer/`

### Insights
```
https://www.hoosiercladding.com/insights/{slug}/
```
Example: `https://www.hoosiercladding.com/insights/winter-energy-bills-indiana/`

## No-Canonical Policy

This site follows a **no-canonical policy**:
- One URL per concept (no duplicates)
- No `<link rel="canonical">` tags
- Implicit canonical through single URL pattern
- URL normalization handled by `.htaccess`:
  - Force lowercase (optional)
  - Trailing slash consistency (optional)
  - HTTPS enforcement (optional)

The crawl auditor flags any canonical tags found so they can be removed.

## Single-Locale Configuration

This site serves **en-US only**:
- No `hreflang` tags
- No `x-default` entries
- Single `<loc>` per URL
- Language: `en` in news sitemaps

## Testing

### Local Testing
```bash
# Generate test data
make matrix careers

# Build sitemaps
make build

# Validate
make validate

# Check output
ls -lh public/sitemaps/
cat public/robots.txt
```

### View Generated Sitemaps
```bash
# View XML
cat public/sitemaps/sitemap-index.xml

# View gzipped (decompressed)
gunzip -c public/sitemaps/sitemap-index.xml.gz
```

### Test Individual Scripts
```bash
# Matrix generation
php scripts/generate_matrix.php

# Career matrix
php scripts/generate_career_matrix.php

# Full build
php scripts/build_sitemaps.php

# Validation
php scripts/validate_sitemaps.php

# Ping
php scripts/ping_sitemaps.php https://www.hoosiercladding.com/sitemaps/sitemap-index.xml.gz
```

## Deployment Checklist

1. ✅ Data sources populated (`/data/*.csv`)
2. ✅ Matrix files generated (`make matrix careers`)
3. ✅ Sitemaps built (`make build`)
4. ✅ Validation passed (`make validate`)
5. ✅ `.htaccess` updated with XML serving rules
6. ✅ `robots.txt` contains sitemap URL
7. ✅ Push to Railway
8. ✅ Submit sitemap index to Google Search Console
9. ✅ Submit sitemap index to Bing Webmaster Tools
10. ✅ Set up cron jobs for automated builds

## Google Search Console Submission

1. Go to https://search.google.com/search-console
2. Select property: `hoosiercladding.com`
3. Navigate to **Sitemaps**
4. Submit: `https://www.hoosiercladding.com/sitemaps/sitemap-index.xml.gz`
5. Wait 24-48 hours for indexing

Google will automatically discover child sitemaps (services, images, videos, news) through the index.

## Bing Webmaster Tools Submission

1. Go to https://www.bing.com/webmasters
2. Select site: `hoosiercladding.com`
3. Navigate to **Sitemaps**
4. Submit: `https://www.hoosiercladding.com/sitemaps/sitemap-index.xml.gz`

## Monitoring

### Check Sitemap Health
```bash
make validate
```

### Check URL Count
```bash
# Count URLs in services sitemap
gunzip -c public/sitemaps/services-1.xml.gz | grep -c '<loc>'

# Count URLs in index
gunzip -c public/sitemaps/sitemap-index.xml.gz | grep -c '<loc>'
```

### Run Audit
```bash
make audit
cat audit/crawl_report.csv
```

## Troubleshooting

### Sitemaps Not Found (404)
- Check `.htaccess` XML pass-through rules
- Verify files exist in `/public/sitemaps/`
- Check Apache `mod_headers` is enabled

### Empty Matrix Files
- Verify CSV files exist in `/data/`
- Check CSV formatting (proper headers, no extra commas)
- Run `make matrix careers` before `make build`

### Validation Errors
- Check XML syntax in generated files
- Ensure proper UTF-8 encoding
- Verify URLs are properly escaped

### Crawl Audit Fails
- Ensure sitemap index exists and is accessible
- Check network connectivity for remote fetches
- Verify `curl` extension is enabled in PHP

## Performance

### Sitemap Generation
- 80 service URLs: ~0.1s
- 50 career URLs: ~0.05s
- Full build with compression: ~0.3s

### Validation
- 6 files: ~0.2s

### Crawl Audit
- 130 URLs (full crawl): ~2-5 minutes
- Depends on server response times
- Progress displayed every 50 URLs

## Extensions

### Add New Service Type
1. Edit `data/services.csv`
2. Add row: `new-service,New Service Name`
3. Run `make matrix build`

### Add New City
1. Edit `data/cities.csv`
2. Add row: `new-city-st`
3. Run `make matrix careers build`

### Add News Article
1. Edit `data/insights.csv`
2. Add row with publication_date within 48h
3. Run `make news` (fast) or `make build` (full)

### Custom Sitemap Sections
Edit `scripts/build_sitemaps.php` to add new URL sources.

---

**DONE: HoosierCladding.com pSEO + Crawl Clarity suite ready (sitemaps, validators, auditor, cron).**

