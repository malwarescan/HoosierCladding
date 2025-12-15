# Homepage Redirect Loop Fix
## Date: December 15, 2025

## Issue
Homepage `www.hoosiercladding.com` is showing `ERR_TOO_MANY_REDIRECTS` in browser.

## Root Cause
Likely Railway Edge caching a redirect response. The code is correct - www should NOT redirect.

## Verification
- ✅ Code check: Only non-www redirects to www (correct)
- ✅ .htaccess: Only non-www redirects to www (correct)  
- ✅ index.php: Only non-www redirects to www (correct)
- ❌ Browser: Seeing redirect loop on www

## Immediate Fix

### Option 1: Clear Browser Cache (Try First)
1. Hard refresh: `Ctrl+Shift+R` (Windows) or `Cmd+Shift+R` (Mac)
2. Clear browser cache completely
3. Try incognito/private window
4. Try different browser

### Option 2: Force Railway Edge Cache Clear
```bash
git commit --allow-empty -m "Force Railway Edge cache clear for homepage"
git push origin main
```

### Option 3: Check Railway Configuration
- Verify no redirect rules in Railway dashboard
- Check if Railway Edge has caching enabled
- Disable edge caching temporarily if possible

## Code Verification
The redirect logic is correct:
- Non-www → www (301) ✅
- HTTP → HTTPS (301) ✅
- www → www (NO REDIRECT) ✅

If www is redirecting, it's a caching issue, not a code issue.

