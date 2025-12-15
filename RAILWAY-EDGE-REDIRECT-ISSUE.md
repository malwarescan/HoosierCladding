# Railway Edge Redirect Loop - All New Service Pages
## Date: December 15, 2025

## Issue Summary
All newly created service pages are showing redirect loops in Google Search Console:
- `/vinyl-siding-installers` ❌ Redirect error
- `/house-siding-replacement` ❌ Redirect error  
- `/residential-siding-contractor` ❌ Redirect error
- `/siding-replacement-warsaw` (likely affected)
- `/vinyl-siding-south-bend` (likely affected)
- `/siding-installation-granger` (likely affected)

**Error**: "Redirect error" - Page redirects to itself (301 → same URL)

## Root Cause
**Railway Edge is caching redirect responses** for these pages. The pages are correctly configured in the service router, but Railway Edge is intercepting requests and serving cached 301 redirects to the same URL, creating a loop.

## Code Fixes Applied ✅

### 1. Path Normalization
```php
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$path = rtrim($path, '/'); // Remove trailing slash for matching
```

### 2. Explicit 200 Response Code
```php
http_response_code(200); // Force 200 to prevent redirect caching
```

### 3. Safety Checks
Added checks to prevent accidental redirects in the service router.

## Deployment Status
- ✅ Code fixes pushed to `main` branch
- ⏳ Waiting for Railway deployment to complete
- ⏳ Waiting for Railway Edge cache to clear

## Verification Steps

### 1. Check Deployment Status
Go to Railway dashboard and verify:
- Latest commit is deployed
- Build completed successfully
- Service is running

### 2. Test Pages After Deployment
```bash
# These should return 200 OK, not 301
curl -I https://www.hoosiercladding.com/vinyl-siding-installers
curl -I https://www.hoosiercladding.com/house-siding-replacement
curl -I https://www.hoosiercladding.com/residential-siding-contractor
curl -I https://www.hoosiercladding.com/siding-replacement-warsaw
curl -I https://www.hoosiercladding.com/vinyl-siding-south-bend
curl -I https://www.hoosiercladding.com/siding-installation-granger
```

**Expected**: `HTTP/2 200`  
**Current (before fix)**: `HTTP/2 301` with `location: [same URL]`

### 3. If Redirect Loop Persists

#### Option A: Force Cache Clear (Recommended)
1. Make a small change to trigger new deployment:
   ```bash
   # Add a comment or whitespace to any file
   git commit --allow-empty -m "Force Railway Edge cache clear"
   git push origin main
   ```

2. Wait for deployment to complete (5-10 minutes)

3. Test pages again

#### Option B: Contact Railway Support
If redirect loop persists after deployment:
1. Open Railway support ticket
2. Request manual edge cache clear for:
   - `/vinyl-siding-installers`
   - `/house-siding-replacement`
   - `/residential-siding-contractor`
   - `/siding-replacement-warsaw`
   - `/vinyl-siding-south-bend`
   - `/siding-installation-granger`

3. Explain: "Railway Edge is caching 301 redirects to same URL, creating redirect loops"

#### Option C: Check Railway Configuration
1. Go to Railway project settings
2. Check if there are any redirect rules configured
3. Check if Railway Edge has any caching rules for these paths
4. Disable edge caching temporarily if possible

## Once Pages Return 200 OK

### 1. Re-request Indexing in GSC
For each affected page:
1. Go to Google Search Console → URL Inspection Tool
2. Enter the full URL
3. Click "Request Indexing"
4. Wait 24-48 hours for Google to re-crawl

### 2. Monitor GSC Coverage Report
- Check that pages show as "Valid" (not "Discovered")
- Verify "Page is indexed" = Yes
- Monitor for any new errors

### 3. Monitor Performance
- Track impressions/clicks for each page
- Verify canonical tags are correct
- Check that titles/descriptions are live

## Timeline
- **Now**: Code fixes deployed, waiting for Railway Edge cache clear
- **+10 minutes**: Test pages after deployment completes
- **+24 hours**: Re-request indexing in GSC if pages return 200 OK
- **+48 hours**: Verify pages are indexed in GSC

## Affected Pages Checklist
- [ ] `/vinyl-siding-installers` - Returns 200 OK
- [ ] `/house-siding-replacement` - Returns 200 OK
- [ ] `/residential-siding-contractor` - Returns 200 OK
- [ ] `/siding-replacement-warsaw` - Returns 200 OK
- [ ] `/vinyl-siding-south-bend` - Returns 200 OK
- [ ] `/siding-installation-granger` - Returns 200 OK
- [ ] All pages re-requested for indexing in GSC
- [ ] All pages show "Page is indexed" = Yes in GSC

