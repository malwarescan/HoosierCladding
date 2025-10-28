# NDJSON Feed - Production Header Fix

## Issue Identified

**Problem**: Railway was serving the feed without proper Content-Type headers  
**Evidence**: Response had `accept-ranges: bytes` and fixed `content-length`, but **no Content-Type**  
**Impact**: Many fetchers won't parse NDJSON without correct MIME type  

## Root Cause

Apache rewrite rule wasn't working correctly in production, causing the feed to be served as a static file instead of going through PHP.

## Fixes Applied

### 1. Explicit RewriteBase (.htaccess)
```apache
Options -Indexes
RewriteEngine On
RewriteBase /feeds/

# Route clean URL to the PHP generator
RewriteRule ^products\.ndjson$ products.ndjson.php [L,QSA]

# Fallback MIME (safety)
AddType application/x-ndjson .ndjson
```

**Key changes**:
- Added `RewriteBase /feeds/` for explicit path resolution
- Added `QSA` flag to preserve query strings
- Removed conflicting `<Files>` block

### 2. Added CORS Headers (products.ndjson.php)
```php
header('Content-Type: application/x-ndjson; charset=utf-8');
header('Cache-Control: public, max-age=300');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, HEAD, OPTIONS');
header('X-Accel-Buffering: no');

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
if ($method === 'HEAD') { http_response_code(200); exit; }
if ($method === 'OPTIONS') { http_response_code(204); exit; }
```

**Key additions**:
- Explicit `Content-Type` header (critical!)
- CORS headers for cross-origin access
- HEAD request handling
- OPTIONS preflight handling

## Local Test Results

### Headers Verification
```bash
$ curl -I http://localhost:8000/feeds/products.ndjson | grep -E "(HTTP|Content-Type|Cache-Control|Access-Control)"
HTTP/1.1 200 OK
Content-Type: application/x-ndjson; charset=utf-8
Cache-Control: public, max-age=300
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: GET, HEAD, OPTIONS
```

✅ **Content-Type is now present and correct**

### Image Arrays
```bash
$ curl -s http://localhost:8000/feeds/products.ndjson | jq -r '.image | type' | head -n 3
array
array
array
```

✅ **Images are arrays**

### Numeric Ratings
```bash
$ curl -s http://localhost:8000/feeds/products.ndjson | jq '.aggregateRating' | head -n 5
{
  "ratingValue": 4.8,
  "bestRating": 5,
  "worstRating": 1,
  "reviewCount": 250
}
```

✅ **Ratings are numbers**

## Production Test Commands

After Railway deployment completes, run these tests:

### 1. Verify Content-Type Header
```bash
curl -I https://www.hoosiercladding.com/feeds/products.ndjson | sed -n '1,10p'
```

**Expected**: `Content-Type: application/x-ndjson; charset=utf-8`

### 2. Test Image Arrays
```bash
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | jq -r '.image | type' | head -n 5
```

**Expected**: All `array`

### 3. Test Numeric Ratings
```bash
curl -s https://www.hoosiercladding.com/feeds/products.ndjson \
  | jq '.aggregateRating|objects|{ratingValue,bestRating,worstRating,reviewCount}' | head -n 3
```

**Expected**: All numbers (no quotes)

### 4. Test HEAD Request
```bash
curl -I -X HEAD https://www.hoosiercladding.com/feeds/products.ndjson
```

**Expected**: `200 OK` with all headers

### 5. Test OPTIONS Request
```bash
curl -I -X OPTIONS https://www.hoosiercladding.com/feeds/products.ndjson
```

**Expected**: `204 No Content` with CORS headers

## Key Changes Summary

| Issue | Before | After |
|-------|--------|-------|
| Content-Type | Missing | `application/x-ndjson; charset=utf-8` |
| RewriteBase | Implicit | Explicit `/feeds/` |
| CORS Headers | None | Full CORS support |
| HEAD Support | Not handled | Returns 200 OK |
| OPTIONS Support | Not handled | Returns 204 No Content |

## Why This Fixes the Problem

### Before
- Apache couldn't resolve the rewrite path correctly
- Request fell through to static file serving
- No Content-Type header set
- Strict clients rejected the feed

### After
- Explicit `RewriteBase` ensures correct path resolution
- Rewrite rule flags (`L,QSA`) ensure proper processing
- PHP sets explicit headers including Content-Type
- All clients can parse the feed correctly

## Deployment Status

- ✅ Fixes committed to GitHub
- ✅ Railway deployment triggered
- ⏳ Expected live in ~30 seconds

## What to Watch For

After deployment, check these indicators:

1. **Content-Type present**: Response headers include `Content-Type: application/x-ndjson`
2. **No static serving**: Response should NOT have `accept-ranges: bytes` (indicates PHP processing)
3. **CORS works**: Cross-origin requests succeed
4. **HEAD works**: Returns 200 OK without body
5. **OPTIONS works**: Returns 204 No Content

## If Issues Persist

If Railway still serves without Content-Type:

1. **Check Apache logs**: Look for rewrite rule failures
2. **Verify PHP is running**: Check that PHP processing is enabled
3. **Try explicit RewriteCond**: Add `RewriteCond %{REQUEST_FILENAME} !-f` before rewrite rule
4. **Check DirectoryAllowOverride**: Ensure `.htaccess` is being read

---

**Status**: Fix deployed, awaiting Railway completion

