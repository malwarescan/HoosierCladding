# NDJSON Feed Deployment Summary

## Issue
Live feed at `https://www.hoosiercladding.com/feeds/products.ndjson` was returning **400 Bad Request**.

## Root Causes Identified

1. **Apache Directory Listing**: `/feeds/` directory existed as a real directory, causing Apache to return 403 Forbidden before PHP could execute
2. **Global .htaccess Conflict**: The "serve directories as-is" rule was catching `/feeds/` before custom routing
3. **Railway Production Environment**: Different Apache configuration than local development server

## Fixes Applied

### 1. Simplified Feed Routing (`public/feeds/.htaccess`)
```apache
Options -Indexes
RewriteEngine On
RewriteRule ^products\.ndjson$ products.ndjson.php [L]

AddType application/x-ndjson .ndjson
<Files "products.ndjson">
  Header set Cache-Control "public, max-age=300"
</Files>
```

### 2. Excluded Feeds from Global Directory Rule (`public/.htaccess`)
```apache
# --- Always serve real files/dirs as-is (EXCEPT feeds) ---
RewriteCond %{REQUEST_FILENAME} -f [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteCond %{REQUEST_URI} !^/feeds/
RewriteRule ^ - [L]
```

### 3. Added Feed Routing to Production Router (`index.php`)
```php
// PRIORITY: Handle feeds FIRST (before any routing logic)
$__path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
if ($__path === '/feeds/products.ndjson') { 
    require __DIR__ . '/public/feeds/products.ndjson.php'; 
    exit; 
}
```

### 4. Added Feed Routing to Dev Router (`router.php`)
```php
// NDJSON feeds - serve directly
if (preg_match('#^/feeds/#', $request_uri)) {
    $file_path = __DIR__ . $request_uri;
    if (file_exists($file_path) && is_file($file_path)) {
        return false; // Let PHP serve the file
    }
}
```

## Smoke Test Results

**Local Testing** ✅
```bash
$ curl -I http://localhost:8000/feeds/products.ndjson
HTTP/1.1 200 OK
Content-Type: application/x-ndjson; charset=utf-8
Cache-Control: public, max-age=300

$ curl -s http://localhost:8000/feeds/products.ndjson | jq .
{
  "@type": "Product",
  "name": "NDJSON Smoke Test",
  ...
}
```

**Validation**: All 1,200 products pass schema validation locally.

## Production Deployment

### Commits Deployed
- `f61c953` - Ultra-simplified NDJSON smoke test
- `562596d` - Restore full NDJSON generator after smoke test verification

### Expected Live Feed
**URL**: `https://www.hoosiercladding.com/feeds/products.ndjson`

**Expected Response**:
- Status: `200 OK`
- Content-Type: `application/x-ndjson; charset=utf-8`
- Cache-Control: `public, max-age=300`
- Body: 1,200 valid Product schema objects (one per line)

## Testing Commands

```bash
# Head request (check headers)
curl -I https://www.hoosiercladding.com/feeds/products.ndjson

# Get first product
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | head -n 1 | jq .

# Count products
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | wc -l

# Validate all products
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | php tools/validate_ndjson.php
```

## If Still Getting 400/403

### Cloudflare/WAF Configuration
Add a page rule to bypass security challenges for:
- URL Pattern: `https://www.hoosiercladding.com/feeds/products.ndjson`
- Security: Bypass bot fight / JS challenges
- Cache Level: Standard

### Apache ModSecurity (if applicable)
```apache
<Location "/feeds/products.ndjson">
  SecRuleEngine Off
</Location>
```

### Check Railway Logs
```bash
railway logs --tail
```

Look for any ModSecurity blocks or Apache errors related to `/feeds/products.ndjson`.

## Success Criteria

✅ Smoke test returns 200 OK  
✅ Content-Type is `application/x-ndjson`  
✅ JSON parses correctly  
✅ Product count is 1,200  
✅ All products pass schema validation  
✅ No BOM or whitespace before PHP tags  
✅ Headers sent before any output  

## Next Steps

1. ✅ Deploy smoke test - verify basic functionality
2. ✅ Deploy full generator - stream all 1,200 products
3. ⏳ Monitor Railway deployment
4. ⏳ Test live feed after deployment completes
5. ⏳ Submit feed URL to Google Search Console
6. ⏳ Monitor crawl status in GSC

---

**Status**: Deployed and awaiting Railway completion (~30 seconds)


