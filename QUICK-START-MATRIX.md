# Matrix Schema - 5 Minute Quick Start

## What You Have

✅ **10,501 landing pages** ready to go  
✅ **LocalBusiness + Service + FAQPage** schema on every page  
✅ **Sitemap generated** (2.2MB, ready for Google)  
✅ **Router ready** (just add .htaccess rule)

---

## 🚀 Deploy in 5 Steps

### Step 1: Add Routing (30 seconds)

Edit your `.htaccess` file in site root and add:

```apache
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^matrix/(.+)$ matrix-router.php [L,QSA]
```

### Step 2: Test a URL (30 seconds)

Visit: `https://www.hoosiercladding.com/matrix/dunlap-in/siding-replacement/rotten-siding`

**Verify:**
- ✅ Page loads (no 404)
- ✅ H1 shows: "Siding Replacement for Rotten Siding in Dunlap, IN"
- ✅ FAQ section is visible

### Step 3: Validate Schema (1 minute)

1. Go to: https://search.google.com/test/rich-results
2. Paste your test URL
3. Click "Test URL"

**Expected:**
- ✅ LocalBusiness found
- ✅ Service found
- ✅ FAQPage eligible

### Step 4: Submit Sitemap (2 minutes)

1. Add to `robots.txt`:
   ```
   Sitemap: https://www.hoosiercladding.com/sitemap-matrix.xml
   ```

2. Go to: https://search.google.com/search-console
3. Navigate to: Sitemaps
4. Submit: `https://www.hoosiercladding.com/sitemap-matrix.xml`

### Step 5: Monitor (1 minute)

1. Search Console → **Coverage**
2. Search Console → **Enhancements** → FAQ
3. Check back in 7 days

---

## ✅ You're Done!

Google will now:
1. **Discover** your 10,501 URLs (Week 1)
2. **Crawl** and index them (Weeks 2-4)
3. **Show** FAQ rich results (Weeks 4-8)
4. **Rank** them for local + service queries (ongoing)

---

## 🧪 Quick Tests

### Test Schema Output
```bash
php includes/test_schema.php
```

### Verify Sitemap
```bash
ls -lh sitemap-matrix.xml
# Should show: 2.2M file
```

### Check First 5 URLs
```bash
head -n 20 sitemap-matrix.xml
```

---

## 📊 Key Files

| File | Purpose |
|------|---------|
| `includes/schema_renderer.php` | Generates JSON-LD schema |
| `includes/html_layout.php` | Renders HTML with FAQs |
| `matrix-router.php` | Routes /matrix/ URLs to pages |
| `sitemap-matrix.xml` | 10,501 URLs for Google |
| `data_matrix/convex_matrix_expanded.csv` | All page data |

---

## 🆘 Quick Fixes

### "404 Not Found"
**Cause:** Routing not active  
**Fix:** Check .htaccess rule syntax, ensure mod_rewrite enabled

### "Schema Not Detected"
**Cause:** View source, check for `<script type="application/ld+json">`  
**Fix:** Ensure `includes/schema_renderer.php` is being loaded

### "FAQPage Not Eligible"
**Cause:** FAQs not visible on page  
**Fix:** Verify `HtmlLayout\faqFromRow()` renders HTML output

---

## 🎯 URLs to Test

Try these live:

1. `/matrix/dunlap-in/siding-replacement/rotten-siding`
2. `/matrix/south-bend-in/siding-repair/storm-damage`
3. `/matrix/elkhart-in/vinyl-siding-replacement/wind-damage`
4. `/matrix/cassopolis-mi/house-wrap-weatherproofing/faded-color`
5. `/matrix/edwardsburg-mi/james-hardie-siding-installation/drafty-rooms`

---

## 📈 Expected Timeline

**Week 1:** Google discovers sitemap  
**Week 2-3:** Crawling begins  
**Week 4-6:** Indexing completes  
**Week 6-8:** FAQ rich results appear  
**Month 3+:** Full SEO impact

---

## 💡 Pro Tip

Link to 5-10 matrix pages from your homepage/footer to accelerate Google discovery.

**Example:**
- South Bend Siding Repair → `/matrix/south-bend-in/siding-repair/storm-damage`
- Elkhart Siding Replacement → `/matrix/elkhart-in/siding-replacement/rotten-siding`

---

**Need Help?** See `MATRIX-SCHEMA-IMPLEMENTATION.md` for full documentation.

