# Crawl Hygiene Implementation - Query Parameter Protection

## Problem
Googlebot (and other crawlers) were discovering and indexing URLs with query parameters like:
- `/home-siding-blog?author=66a25ab693bd794d7c700086`
- `/home-siding-blog?author=test`
- `/?test=123`

These parameter-probed URLs were:
- Diluting relevance signals
- Splitting engagement data
- Wasting crawl budget
- Polluting AI/snippet selection

## Solution Implemented

### 1. CrawlHygiene Class (`app/lib/CrawlHygiene.php`)
Centralized system for handling query parameters:

- **Clean Path Extraction**: Strips query strings from URLs for canonical
- **Parameter Whitelist**: Empty by default (no parameters allowed)
- **301 Redirects**: Automatically redirects to clean URLs
- **Noindex Defense**: Adds `X-Robots-Tag: noindex, follow` for unknown params

### 2. Canonical URL Generation
All canonical URLs now:
- Strip query parameters automatically
- Always point to clean URLs
- Use `https://www.hoosiercladding.com` format

### 3. Global Parameter Handling
Implemented in `index.php` at PRIORITY 0.5 (right after healthcheck):
- Checks for unknown query parameters
- Redirects to clean URL (301) if found
- Adds noindex header as defense in depth

### 4. Legacy Code Removed
- Removed old author parameter handling from `index.php`
- Now handled globally by CrawlHygiene

## How It Works

### Request Flow:
1. Request arrives: `/home-siding-blog?author=test`
2. CrawlHygiene detects unknown parameter (`author`)
3. **301 Redirect** to: `/home-siding-blog` (clean URL)
4. Googlebot follows redirect
5. Clean URL renders with canonical pointing to itself

### Canonical Logic:
```php
// Before: /home-siding-blog?author=test → canonical: /home-siding-blog?author=test
// After:  /home-siding-blog?author=test → canonical: /home-siding-blog
```

### Noindex (Defense in Depth):
If redirect somehow doesn't happen:
- `X-Robots-Tag: noindex, follow` header is added
- Tells Google: "Don't index this, but follow links"

## Testing

### Test Redirects:
```bash
# Should redirect 301 to clean URL
curl -I "https://www.hoosiercladding.com/home-siding-blog?author=test"
# Expected: Location: https://www.hoosiercladding.com/home-siding-blog

curl -I "https://www.hoosiercladding.com/?test=123"
# Expected: Location: https://www.hoosiercladding.com/
```

### Test Canonicals:
```bash
# All pages should have clean canonical (no query params)
curl -s "https://www.hoosiercladding.com/home-siding-blog?author=test" | grep canonical
# Expected: <link rel="canonical" href="https://www.hoosiercladding.com/home-siding-blog">
```

## GSC Verification

After deployment, verify in Google Search Console:

1. **URL Inspection Tool**:
   - Test: `https://www.hoosiercladding.com/home-siding-blog?author=test`
   - Should show: "Alternate page with proper canonical tag"
   - Canonical should be: `https://www.hoosiercladding.com/home-siding-blog`

2. **Coverage Report**:
   - Monitor for parameter URLs being marked as "Alternate page"
   - Should see no new indexing of parameter URLs

3. **Performance Report**:
   - Check if parameter URLs are receiving impressions
   - Should consolidate to clean URLs over time

## Future: Allowing Legitimate Parameters

If you need to allow specific parameters in the future:

1. Edit `app/lib/CrawlHygiene.php`
2. Add to `ALLOWED_PARAMS` array:
   ```php
   private const ALLOWED_PARAMS = [
       'ref',      // Referral tracking
       'source',   // Source tracking
   ];
   ```
3. These parameters will:
   - NOT trigger redirects
   - Still be stripped from canonical URLs
   - NOT trigger noindex

## Benefits

✅ **Prevents Parameter Pollution**: No more random query params indexed  
✅ **Consolidates Signals**: All engagement goes to clean URLs  
✅ **Protects Crawl Budget**: Googlebot stops probing parameter space  
✅ **Defense in Depth**: Redirect + Noindex + Clean Canonical  
✅ **Future-Proof**: Easy to whitelist legitimate params if needed  

## Status

✅ **Implemented and Tested**
- 301 redirects working
- Canonicals clean
- Ready for production

