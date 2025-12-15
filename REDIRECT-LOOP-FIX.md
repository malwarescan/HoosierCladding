# Redirect Loop Fix - Service Pages
## Date: December 15, 2025

## Issue
Service pages like `/vinyl-siding-installers` and `/house-siding-replacement` are showing redirect loops in Google Search Console:
- **Error**: "Redirect error" 
- **Symptom**: Page redirects to itself (301 → same URL)
- **Impact**: Pages cannot be indexed by Google

## Root Cause
Railway Edge is likely caching a redirect response or doing URL normalization that creates a loop. The pages are correctly configured in the service router, but Railway Edge is intercepting the request.

## Fix Applied

### 1. Path Normalization
Updated `service-page-router.php` to properly normalize paths:
```php
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$path = rtrim($path, '/'); // Remove trailing slash for matching
```

### 2. Safety Check
Added check to prevent accidental redirects:
```php
if (headers_sent()) {
    return false; // Can't redirect if headers already sent
}
```

## Action Required

### Immediate Steps:
1. **Clear Railway Edge Cache**
   - Railway Edge may be caching old redirect responses
   - Deploy a new version to force cache invalidation
   - Or contact Railway support to clear edge cache

2. **Verify Pages Are Accessible**
   After deployment, test:
   ```bash
   curl -I https://www.hoosiercladding.com/vinyl-siding-installers
   curl -I https://www.hoosiercladding.com/house-siding-replacement
   curl -I https://www.hoosiercladding.com/residential-siding-contractor
   ```
   Should return `200 OK`, not `301` redirect

3. **Re-request Indexing in GSC**
   - After confirming pages return 200 OK
   - Use URL Inspection Tool to request indexing
   - Wait 24-48 hours for Google to re-crawl

## Affected Pages
- `/vinyl-siding-installers`
- `/house-siding-replacement`
- `/residential-siding-contractor`
- `/siding-replacement-warsaw`
- `/vinyl-siding-south-bend`
- `/siding-installation-granger`

## Verification
After fix is deployed:
1. All pages should return `200 OK` (not `301`)
2. Pages should render HTML content (not redirect)
3. GSC URL Inspection should show "Page is indexed" = Yes
4. No redirect errors in GSC

## If Issue Persists
If redirect loop continues after deployment:
1. Check Railway Edge logs for redirect rules
2. Verify no Railway-level redirect configuration
3. Check if Railway is doing trailing slash normalization
4. Consider disabling Railway Edge caching temporarily

