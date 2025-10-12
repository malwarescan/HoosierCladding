# SEO Improvements - Quick Reference

## What Was Done

✅ **Sitemap System** - Proper XML sitemap index with 2300+ pages  
✅ **CTR Optimization** - Data-driven titles/meta from GSC top 10  
✅ **Internal Links** - 8 strategic links to matrix pages  

## URLs to Test

### Sitemaps
- https://www.hoosiercladding.com/sitemap.xml (index)
- https://www.hoosiercladding.com/sitemap-static.xml (9 pages)
- https://www.hoosiercladding.com/sitemap-matrix.xml (2300+ pages)
- https://www.hoosiercladding.com/sitemap-blog.xml (blog posts)
- https://www.hoosiercladding.com/robots.txt

### Optimized Pages
- https://www.hoosiercladding.com/ (new title)
- https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend
- https://www.hoosiercladding.com/door-replacement-south-bend
- https://www.hoosiercladding.com/trimwork-south-bend
- https://www.hoosiercladding.com/window-replacement-south-bend

### Internal Links
- https://www.hoosiercladding.com/ (scroll down)
- https://www.hoosiercladding.com/service-area (scroll down)
- https://www.hoosiercladding.com/siding (scroll down)

## How to Update

### Add New CTR Rewrites

Edit `/app/config/ctr_rewrites.csv`:
```csv
https://www.hoosiercladding.com/your-page,500,15.2,Your New Title,Your new description with CTA
```

### Add Blog Posts

Create `/app/config/blog_urls.php`:
```php
<?php return [
  ['loc' => '/home-siding-blog/post-1', 'lastmod' => '2025-10-13'],
  ['loc' => '/home-siding-blog/post-2', 'lastmod' => '2025-10-12'],
];
```

### Change Internal Links

Edit these files directly:
- `/includes/home_internal_links.html`
- `/includes/services_internal_links.html`

## Submit to Google

1. Go to: https://search.google.com/search-console
2. Select your property
3. Click "Sitemaps" in left menu
4. Enter: `sitemap.xml`
5. Click "Submit"

## Monitor Results

### Week 1
- Check "Index coverage" in GSC
- Look for new matrix pages indexed

### Week 2
- Check "Performance" tab
- Compare CTR before/after for optimized pages

### Week 3
- Monitor matrix page rankings
- Check which internal links drive traffic (via GSC)

## Common Commands

```bash
# Test local server
cd /Users/malware/Desktop/hoosiercladdingwebsite
php -S localhost:8080 router.php

# Test sitemap
curl -s http://localhost:8080/sitemap.xml | head -20

# Test homepage title
curl -s http://localhost:8080/ | grep '<title>'

# Count matrix URLs
curl -s http://localhost:8080/sitemap-matrix.xml | grep -c '<loc>'
```

## Files You Can Edit

### Update Anytime
- `/app/config/ctr_rewrites.csv` - Add more CTR optimizations
- `/includes/home_internal_links.html` - Change homepage links
- `/includes/services_internal_links.html` - Change service page links
- `/app/config/blog_urls.php` - Update blog post list

### Don't Edit Unless Necessary
- `/sitemap-*.php` - Sitemap generators
- `/app/lib/MetaManager.php` - Meta management logic
- `.htaccess` - Sitemap routing rules

## Expected Results

### 2 Weeks
- 20-30% more matrix pages indexed
- CTR starts improving on top pages

### 4 Weeks
- 15-25% CTR increase on optimized pages
- 10-20% ranking boost for linked matrix pages

### 8 Weeks
- Full SEO impact visible
- Traffic increase from improved CTR + rankings

## Troubleshooting

**Sitemap shows old data?**
- Wait 5 minutes, sitemaps cache briefly
- Or restart server: `pkill php && php -S localhost:8080 router.php`

**Title not changing?**
- Check CSV has correct URL format (full URL with https://)
- Verify path extraction in MetaManager

**Internal links not showing?**
- Check file path in include statement
- Verify file exists in `/includes/` directory

## Support Files

- `SEO-IMPROVEMENTS-COMPLETE.md` - Full technical documentation
- `MATRIX-SCHEMA-COMPLETE.md` - JSON-LD schema docs
- `ROUTING-COMPLETE.md` - Routing system docs

---

**Need Help?** Check the full documentation in `SEO-IMPROVEMENTS-COMPLETE.md`

