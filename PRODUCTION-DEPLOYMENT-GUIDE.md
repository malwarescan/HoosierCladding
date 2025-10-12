# Production Deployment Guide

## Pre-Deployment Checklist

- [x] QA completed (see POST-DEPLOY-QA-REPORT.md)
- [x] All sitemaps tested
- [x] Schema validated on 40 pages
- [x] CTR optimizations verified
- [ ] Internal links verified against CSV data

## Deployment Steps

### 1. Push to Production

```bash
# Ensure you're on the correct branch
git status

# Add all new files
git add .

# Commit
git commit -m "SEO: Sitemap system + CTR rewrites + Internal links"

# Push to production
git push origin main
```

### 2. Verify Files on Server

Ensure these files exist:
- `/sitemap-index.php`
- `/sitemap-static.php`
- `/sitemap-matrix.php`
- `/sitemap-blog.php`
- `/robots.txt`
- `/app/lib/MetaManager.php`
- `/app/config/ctr_rewrites.csv`
- `/includes/home_internal_links.html`
- `/includes/services_internal_links.html`
- `/scripts/validate_schema.php`

### 3. Test Production URLs

```bash
# Test sitemap index
curl -I https://www.hoosiercladding.com/sitemap.xml

# Test robots.txt
curl https://www.hoosiercladding.com/robots.txt

# Test homepage title
curl -s https://www.hoosiercladding.com/ | grep '<title>'
```

### 4. Submit to Google Search Console

1. Go to: https://search.google.com/search-console
2. Select property: www.hoosiercladding.com
3. Click "Sitemaps" in left menu
4. Enter: `sitemap.xml`
5. Click "Submit"
6. Wait for "Success" confirmation

### 5. Test Matrix Page in GSC

1. Click "URL Inspection" in GSC
2. Enter: `https://www.hoosiercladding.com/matrix/south-bend-in/siding-repair/storm-damage`
3. Click "Test Live URL"
4. Verify "Page is indexable"
5. Check for JSON-LD in "View crawled page"

## Monitoring Schedule

### Day 1
- ✅ Sitemap submitted to GSC
- ✅ Initial URL inspection test

### Week 1
- Monitor "Index Coverage" in GSC
- Check for sitemap processing errors
- Verify matrix pages begin indexing

### Week 2
- Check "Performance" tab
- Look for CTR changes on optimized pages
- Monitor impression increases

### Week 3-4
- Analyze CTR lift on top 10 pages
- Track internal link traffic (via GSC "Links" report)
- Monitor "Search appearance" for FAQ/Breadcrumb counts

### Month 2
- Full SEO impact assessment
- Compare before/after metrics
- Identify next optimization opportunities

## Quick Health Checks

### Sitemaps
```bash
# Should return 200 and valid XML
curl -I https://www.hoosiercladding.com/sitemap.xml
```

### CTR Optimization
```bash
# Should show new title
curl -s https://www.hoosiercladding.com/ | grep '<title>'
# Expected: "Siding Contractors in South Bend | Hoosier Cladding"
```

### Schema
```bash
# Should return 8 (number of JSON-LD blocks)
curl -s https://www.hoosiercladding.com/matrix/south-bend-in/siding-repair/storm-damage | grep -c 'application/ld+json'
```

### Internal Links
```bash
# Should return 8 (number of matrix links)
curl -s https://www.hoosiercladding.com/ | grep -c 'href="/matrix/'
```

## Troubleshooting

### Sitemap Returns 404
- Check .htaccess rules deployed
- Verify PHP files in root directory
- Test with: `curl -v https://www.hoosiercladding.com/sitemap.xml`

### Title Not Changing
- Verify ctr_rewrites.csv uploaded to /app/config/
- Check CSV has full URLs (not just paths)
- Test MetaManager: `php -r "require 'app/lib/MetaManager.php'; echo MetaManager::title('/', 'default');"`

### Schema Missing
- Verify app/bootstrap/head_injector.php exists
- Check partials/header.php includes it
- Test: `curl -s URL | grep HomeAndConstructionBusiness`

### Internal Links Not Showing
- Verify includes/*.html files exist
- Check include paths in home.php, service-area.php, siding-page.php
- Test: `curl -s https://www.hoosiercladding.com/ | grep "Popular Service Areas"`

## Expected Results Timeline

### Week 1-2
- GSC shows sitemap processed
- Index coverage begins increasing
- Matrix pages start appearing in index

### Week 3-4
- CTR improvements visible on optimized pages
- FAQ/Breadcrumb enhancements appear
- Internal link traffic shows in "Links" report

### Week 5-8
- 20-30% more matrix pages indexed
- 15-25% CTR improvement on top 10 pages
- 10-20% ranking boost for linked matrix pages

### Month 3+
- Full SEO impact realized
- Consistent traffic increases
- Rich results regularly appearing

## Key Metrics to Track

### Google Search Console
1. **Performance → Queries**
   - Total clicks (should increase)
   - Total impressions (should increase)
   - Average CTR (should increase on optimized pages)

2. **Performance → Pages**
   - Top 10 pages from ctr_rewrites.csv
   - Track CTR changes week-over-week

3. **Index → Coverage**
   - Valid pages (should increase)
   - Excluded pages (should decrease)

4. **Enhancements**
   - FAQ rich results
   - Breadcrumb enhancements

5. **Sitemaps**
   - Discovered URLs (should be 2300+)
   - Error count (should be 0)

### Analytics
- Organic traffic trend
- Pages per session
- Bounce rate on matrix pages

## Rollback Plan

If issues arise:

```bash
# Restore previous .htaccess
git checkout HEAD~1 -- .htaccess

# Remove new PHP files
rm sitemap-*.php
rm app/lib/MetaManager.php
rm app/config/ctr_rewrites.csv

# Restore header.php
git checkout HEAD~1 -- partials/header.php

# Restart web server
sudo service apache2 restart  # or appropriate command
```

## Support

**Documentation:**
- SEO-IMPROVEMENTS-COMPLETE.md (full technical docs)
- POST-DEPLOY-QA-REPORT.md (QA results)
- SEO-QUICK-REFERENCE.md (quick reference)

**Validator Script:**
```bash
php scripts/validate_schema.php
```

**Test Server:**
```bash
php -S localhost:8080 router.php
```

---

**Deployment Date:** _____________  
**Deployed By:** _____________  
**GSC Submission Date:** _____________  
**Next Review Date:** _____________

