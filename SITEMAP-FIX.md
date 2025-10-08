# Sitemap Fix - Google Search Console 404 Error

## Problem
Google Search Console was reporting a 404 error when trying to access the sitemap because:
1. `robots.txt` pointed to `sitemap.php` instead of a `.xml` file
2. The large matrix sitemap (10,500+ URLs) wasn't referenced anywhere
3. Conflicting `.htaccess` rules for sitemap routing

## Solution Applied

### 1. Created Sitemap Index
Created `/sitemap-index.xml` that references both sitemaps:
- `sitemap.xml` - Main sitemap (200 URLs for core pages)
- `sitemap-matrix.xml` - Matrix sitemap (10,500+ programmatic pages)

### 2. Updated robots.txt
Changed from:
```
Sitemap: https://hoosiercladding.com/sitemap.php
```

To:
```
Sitemap: https://hoosiercladding.com/sitemap-index.xml
```

### 3. Fixed .htaccess Routing
Updated the whitelist pattern to handle all sitemap files:
```apache
RewriteRule ^(sitemap.*\.xml|robots\.txt|favicon\.ico)$ - [L]
```

### 4. Synchronized Files
- Copied all sitemap files to both root and `/public` directories
- Ensured consistent configuration across both locations

## Files Changed

### New Files:
- `/sitemap-index.xml`
- `/public/sitemap-index.xml`
- `/public/sitemap-matrix.xml` (copied from root)

### Modified Files:
- `/robots.txt`
- `/public/robots.txt`
- `/.htaccess`
- `/public/.htaccess`

## Sitemap URLs

After deployment, these URLs will be accessible:

1. **Sitemap Index** (submit this to Google Search Console):
   - https://hoosiercladding.com/sitemap-index.xml

2. **Individual Sitemaps**:
   - https://hoosiercladding.com/sitemap.xml (200 URLs)
   - https://hoosiercladding.com/sitemap-matrix.xml (10,500+ URLs)

3. **Robots.txt**:
   - https://hoosiercladding.com/robots.txt

## Testing Locally

1. Start your Docker container:
   ```bash
   docker-compose up
   ```

2. Test the URLs:
   ```bash
   curl -I http://localhost:8080/sitemap-index.xml
   curl -I http://localhost:8080/sitemap.xml
   curl -I http://localhost:8080/sitemap-matrix.xml
   curl http://localhost:8080/robots.txt
   ```

All should return `200 OK` with proper `Content-Type: application/xml` headers.

## Deployment Steps

1. **Commit and push these changes**:
   ```bash
   git add .
   git commit -m "Fix sitemap 404 error - add sitemap index and update routing"
   git push
   ```

2. **After deployment, verify on production**:
   ```bash
   curl -I https://hoosiercladding.com/sitemap-index.xml
   curl -I https://hoosiercladding.com/robots.txt
   ```

3. **Update Google Search Console**:
   - Go to: https://search.google.com/search-console
   - Navigate to: Sitemaps
   - Remove the old `sitemap.php` entry (if present)
   - Add new sitemap: `https://hoosiercladding.com/sitemap-index.xml`
   - Click "Submit"

4. **Wait for Google to crawl** (can take 1-7 days):
   - Google will fetch the sitemap index
   - Then fetch both individual sitemaps
   - You should see "Success" status and URL counts

## Sitemap Statistics

- **sitemap.xml**: ~200 URLs (core pages, services, locations)
- **sitemap-matrix.xml**: ~10,500 URLs (programmatic matrix pages)
- **Total**: ~10,700 URLs indexed

## Notes

- The matrix sitemap is 2.2MB with 63,002 lines
- Google's limits: 50MB max size, 50,000 URLs max per sitemap
- Your sitemap is well within limits ✓
- Using a sitemap index is SEO best practice for large sites

## Troubleshooting

If you still see 404 errors after deployment:

1. **Check file permissions**:
   ```bash
   ls -la sitemap*.xml robots.txt
   ```
   Should be readable (644 or similar)

2. **Check Apache configuration**:
   - Verify mod_rewrite is enabled: `a2enmod rewrite`
   - Verify .htaccess is being read: check AllowOverride setting

3. **Check Railway logs**:
   - Look for 404 errors in deployment logs
   - Verify files were copied during build

4. **Test with curl**:
   ```bash
   curl -v https://hoosiercladding.com/sitemap-index.xml
   ```
   Should return XML content, not HTML or 404 page

## Expected Google Search Console Result

Within 1-7 days, you should see:
- ✅ Sitemap status: "Success"  
- ✅ Discovered URLs: ~10,700
- ✅ Indexed pages: (will grow over time)
- ✅ No HTTP errors

