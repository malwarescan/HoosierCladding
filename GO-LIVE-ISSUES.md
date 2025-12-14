# Go-Live Issues Identified
## Date: December 15, 2025

## 🚨 CRITICAL BLOCKER

### Issue: Non-WWW HTTPS Not Redirecting to WWW

**Problem:**
- `https://hoosiercladding.com/` returns 200 OK
- Should redirect to `https://www.hoosiercladding.com/`
- Creates canonical ambiguity (both www and non-www indexable)

**Root Cause:**
The `.htaccess` redirect rule is correct:
```apache
RewriteCond %{HTTP_HOST} ^hoosiercladding\.com$ [NC]
RewriteRule ^(.*)$ https://www.hoosiercladding.com/$1 [R=301,L]
```

However, the live server is not executing this redirect for HTTPS non-www requests.

**Possible Causes:**
1. Server-level configuration overrides .htaccess
2. CDN/Proxy (Railway Edge) handling redirects before .htaccess
3. SSL certificate configuration issue
4. .htaccess not being processed for HTTPS requests

**Solutions to Try:**

### Option 1: Server-Level Redirect (Recommended)
If using Railway, Cloudflare, or similar:
- Configure redirect at CDN/proxy level
- Redirect: `hoosiercladding.com/*` → `www.hoosiercladding.com/*` (301)

### Option 2: PHP-Level Redirect
Add to `index.php` before any output:
```php
// Force www canonical
$host = $_SERVER['HTTP_HOST'] ?? '';
if ($host === 'hoosiercladding.com') {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    header("Location: https://www.hoosiercladding.com{$uri}", true, 301);
    exit;
}
```

### Option 3: Verify .htaccess Processing
- Ensure `.htaccess` is in document root
- Verify Apache mod_rewrite is enabled
- Check server logs for rewrite rule execution

**Priority:** 🔴 **CRITICAL** - Must fix before go-live

---

## ✅ All Other Checks Pass

All other go-live readiness checks pass:
- ✅ Page routing works
- ✅ Canonical tags correct
- ✅ Metadata server-rendered
- ✅ Schema valid
- ✅ Internal links correct
- ✅ Content aligned with guidelines

---

## Action Items

1. **IMMEDIATE**: Fix non-www HTTPS redirect
2. **POST-FIX**: Re-test all redirect scenarios
3. **POST-DEPLOY**: Verify in GSC that only www variant is indexed

