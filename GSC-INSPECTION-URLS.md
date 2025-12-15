# Google Search Console - URLs to Inspect
## Date: December 15, 2025

## PRIORITY 1: Newly Created High-Opportunity Pages

### Service Pages (Created for High-Impression Queries)
1. **`/vinyl-siding-installers`**
   - Query: "vinyl siding installers near me" (635 impressions)
   - Status: NEW PAGE
   - Check: Indexing status, canonical, title/description in GSC

2. **`/house-siding-replacement`**
   - Query: "house siding replacement" (464 impressions)
   - Status: NEW PAGE
   - Check: Indexing status, canonical, title/description in GSC

3. **`/residential-siding-contractor`**
   - Query: "residential siding contractor" (126 impressions, pos 15.51)
   - Status: NEW PAGE
   - Check: Indexing status, canonical, title/description in GSC

### City-Service Pages (Created for Local Queries)
4. **`/siding-replacement-warsaw`**
   - Query: "siding replacement warsaw indiana" (76 impressions, pos 9.91)
   - Status: NEW PAGE - HIGH PRIORITY (striking distance)
   - Check: Indexing status, canonical, position tracking

5. **`/vinyl-siding-south-bend`**
   - Query: "vinyl siding south bend" (117 impressions, pos 27.92)
   - Status: NEW PAGE
   - Check: Indexing status, canonical, title/description

6. **`/siding-installation-granger`**
   - Query: "siding installation granger, indiana" (100 impressions, pos 23.68)
   - Status: NEW PAGE
   - Check: Indexing status, canonical, title/description

---

## PRIORITY 2: Optimized Existing Pages

### High-Impression Pages (Optimized)
7. **`/vinyl-siding-michiana-south-bend`**
   - Query: "vinyl siding south bend" (862 impressions, pos 59.98)
   - Status: OPTIMIZED (content aligned to South Bend, metadata updated)
   - Check: 
     - Canonical: `https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend`
     - Title/description changes reflected
     - Position improvement tracking
     - CTR improvement

---

## PRIORITY 3: Canonical Consolidation (Critical)

### Homepage Variants (Should Consolidate to www)
8. **`https://www.hoosiercladding.com/`** (Canonical)
   - Status: PRIMARY VARIANT
   - Check: Impressions consolidating from non-www variant

9. **`https://hoosiercladding.com/`** (Non-www)
   - Status: SHOULD REDIRECT TO WWW
   - Check: 
     - 301 redirect working
     - Impressions dropping (consolidating to www)
     - No longer receiving impressions after 2-4 weeks

---

## PRIORITY 4: Striking Distance Matrix Pages (0 Clicks)

### Matrix Pages Needing Optimization
10. **`/matrix/granger-in/vinyl-siding-repair/outdated-look`**
    - Position: 11.4
    - Impressions: 35
    - Clicks: 0
    - Check: Snippet clarity, internal links, schema

11. **`/matrix/warsaw-in/soffit-fascia-repair/peeling-paint`**
    - Position: 7.14
    - Impressions: 22
    - Clicks: 0
    - Check: Snippet clarity, internal links

---

## Inspection Checklist for Each URL

### For NEW Pages (1-6):
- [ ] **URL Inspection Tool**: Request indexing
- [ ] **Coverage Report**: Verify "Valid" status (not "Discovered - currently not indexed")
- [ ] **Page Indexing**: Check "Page is indexed" = Yes
- [ ] **Canonical**: Verify self-referential canonical (www.hoosiercladding.com)
- [ ] **HTML Improvements**: Check title/description match our metadata
- [ ] **Performance**: Monitor impressions/clicks after 7-14 days

### For OPTIMIZED Pages (7):
- [ ] **URL Inspection Tool**: Request re-indexing
- [ ] **HTML Improvements**: Verify new title/description live
- [ ] **Performance**: Track position and CTR changes
- [ ] **Coverage**: Ensure no indexing errors

### For CANONICAL Pages (8-9):
- [ ] **URL Inspection Tool**: Test redirect (non-www → www)
- [ ] **Performance Report**: Monitor impression consolidation
- [ ] **Coverage**: Check for duplicate content warnings

---

## Expected Timeline

### Week 1-2:
- New pages should be discovered and indexed
- Canonical redirects should be recognized
- Request indexing for all new pages

### Week 2-4:
- Homepage variants should consolidate (non-www → www)
- New pages should start receiving impressions
- Optimized pages should show position/CTR improvements

### Week 4-8:
- Full indexing of all new pages
- Canonical consolidation complete
- Performance metrics stabilize

---

## GSC Reports to Monitor

1. **Coverage Report**
   - Filter: "Valid" pages
   - Check: All new pages show as "Valid" (not "Discovered")

2. **Performance Report**
   - Filter by URL: Check each new page's impressions/clicks
   - Compare: Before/after for optimized pages

3. **Page Indexing Report**
   - Check: "Page is indexed" = Yes for all new pages
   - Monitor: Any "Why pages aren't indexed" issues

4. **HTML Improvements**
   - Verify: Title/description changes live
   - Check: No duplicate title/description warnings

5. **Core Web Vitals**
   - Ensure: No performance regressions from changes

---

## Quick Inspection Commands

```bash
# Test canonical redirects
curl -I http://hoosiercladding.com/
curl -I https://hoosiercladding.com/
curl -I https://www.hoosiercladding.com/

# Test new pages
curl -I https://www.hoosiercladding.com/vinyl-siding-installers
curl -I https://www.hoosiercladding.com/house-siding-replacement
curl -I https://www.hoosiercladding.com/residential-siding-contractor
curl -I https://www.hoosiercladding.com/siding-replacement-warsaw
curl -I https://www.hoosiercladding.com/vinyl-siding-south-bend
curl -I https://www.hoosiercladding.com/siding-installation-granger
curl -I https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend
```

---

## Success Metrics

### New Pages (1-6):
- ✅ Indexed within 7-14 days
- ✅ Receiving impressions within 30 days
- ✅ Canonical self-referential
- ✅ No indexing errors

### Optimized Page (7):
- ✅ Position improves from 59.98
- ✅ CTR increases from 0%
- ✅ Title/description match query intent

### Canonical (8-9):
- ✅ Non-www redirects to www (301)
- ✅ Non-www impressions drop to 0 within 4 weeks
- ✅ All impressions consolidated to www variant

