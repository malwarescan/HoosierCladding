# Railway Redirect Loop Fix

## Problem
The site was experiencing `ERR_TOO_MANY_REDIRECTS` errors on Railway. This was caused by the application forcing HTTPS redirects when Railway already handles SSL termination at the edge.

## Root Cause
Railway handles SSL termination at the edge (Railway Edge). When a user makes an HTTPS request:
1. Railway Edge receives the HTTPS request
2. Railway Edge forwards it to the application as **HTTP** (since SSL is terminated at the edge)
3. The `.htaccess` file had a rule: `RewriteCond %{HTTPS} !=on` → redirect to HTTPS
4. This created an infinite loop: HTTP → HTTPS → HTTP → HTTPS...

## Solution
**Removed the HTTPS force redirect from `.htaccess`**

Railway handles SSL termination, so the application should:
- ✅ Accept HTTP traffic from Railway's internal proxy
- ✅ Always use HTTPS in redirect targets (for external URLs)
- ❌ NOT check `%{HTTPS}` and force redirects

## Changes Made

### `.htaccess` (Root)
- **REMOVED**: `RewriteCond %{HTTPS} !=on` → HTTPS redirect rule
- **KEPT**: Non-www → www redirect (always uses HTTPS in target URL)
- **ADDED**: Comments explaining why HTTPS redirect is disabled

### `index.php`
- ✅ Already correct - only redirects non-www to www
- ✅ Uses HTTPS in redirect target
- ✅ Does NOT force HTTPS redirects

## Testing
After deployment, verify:
1. Homepage loads: `https://www.hoosiercladding.com/`
2. No redirect loops
3. Non-www redirects to www: `https://hoosiercladding.com/` → `https://www.hoosiercladding.com/`
4. Service pages load correctly

## Railway Configuration
- Railway Edge handles SSL termination ✅
- Application accepts HTTP from Railway proxy ✅
- No application-level HTTPS enforcement ✅

## Related Issues
This fix addresses the issue described in the Railway support thread where:
- Railway support confirmed the endpoint loads fine on their end
- The issue was identified as an HTTP→HTTPS redirect loop
- Railway Edge was serving HTTPS externally but forwarding HTTP internally

## References
- Railway handles SSL at the edge, so apps should accept HTTP traffic
- Similar to Cloudflare "Flexible" SSL mode issues
- Common pattern: Proxy handles SSL → App should not force HTTPS

