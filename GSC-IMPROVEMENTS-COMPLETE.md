# GSC-Driven Landing Page Improvements - Implementation Summary
## Date: December 15, 2025

## Signal Map: What Was Improved

### PRIORITY 0: Canonical Authority & Drift Control ✅
**Signal**: Canonical consolidation
**Action**: Enforced `www.hoosiercladding.com` as single canonical host
**Changes**:
1. Added sitewide 301 redirect: `non-www → www` in `.htaccess`
2. Updated `MetaManager::canonical()` to always return `www` host (hardcoded)
3. Enabled HTTPS enforcement in `.htaccess`

**Expected Impact**:
- Consolidates homepage signals (currently split: 600 + 1,290 impressions)
- Eliminates canonical ambiguity
- Improves index selection clarity

**Risk Mitigation**:
- Redirect is permanent (301) to preserve link equity
- Canonical tag generation is deterministic (no host detection)

---

### PRIORITY 1: Striking Distance Page - Warsaw ✅
**Signal**: Query-Intent Alignment, Snippet Optimization, Internal Link Integrity
**Action**: Created dedicated `/siding-replacement-warsaw` page matching query intent

**Query Data**:
- Query: "siding replacement warsaw indiana"
- Impressions: 76
- Position: 9.91 (striking distance!)
- Clicks: 0 (CTR gap = opportunity)

**Changes**:
1. Created `app/routes/city-service-router.php` for high-opportunity city+service pages
2. Added Warsaw page with:
   - Title: "Siding Replacement in Warsaw, Indiana – Expert Installation" (matches query)
   - Description: Geo-targeted, service-specific, includes CTA
   - H1: Matches query intent exactly
   - LocalBusiness schema with Warsaw service area
   - Above-fold service + location + CTA clarity
3. Added internal links from `/service-area` page to Warsaw page
4. Integrated router into `index.php` routing sequence

**Expected Impact**:
- Improved CTR from 0% to target 1-2% (position 9.91 is strong)
- Better snippet match (title aligns with query)
- Stronger local signals (schema + on-page evidence)

**Success Criteria**:
- Position maintains or improves (currently 9.91)
- CTR increases to >0.5% within 30 days
- Page receives clicks from query

---

### PRIORITY 2: Top Query Cluster Pages ✅
**Signal**: Query-Intent Alignment, Internal Link Architecture

**Created Pages**:
1. `/siding-replacement-warsaw` (Warsaw, IN) - Position 9.91
2. `/vinyl-siding-south-bend` (South Bend, IN) - Position 27.92, 117 impressions
3. `/siding-installation-granger` (Granger, IN) - Position 23.68, 100 impressions

**Each Page Includes**:
- Query-matched title and description
- Service + city + state H1
- LocalBusiness schema with city-specific service area
- Internal links from service-area hub
- Above-fold trust elements (licensed, insured, local)

**Expected Impact**:
- Better intent alignment for top queries
- Improved CTR on high-impression queries
- Stronger internal link graph

---

## Change Set Summary

### Files Created
1. `app/routes/city-service-router.php` - Router for high-opportunity city+service pages
2. `GSC-IMPROVEMENT-PLAN.md` - Implementation plan
3. `GSC-IMPROVEMENTS-COMPLETE.md` - This document

### Files Modified
1. `.htaccess` - Added www redirect + HTTPS enforcement
2. `app/lib/MetaManager.php` - Hardcoded www in canonical generation
3. `index.php` - Added city-service-router to routing sequence
4. `service-area.php` - Added Warsaw and Granger with internal links

---

## Success Criteria & Monitoring

### Canonical Consolidation
- **Metric**: Only `www.hoosiercladding.com` homepage variant in GSC
- **Timeline**: 2-4 weeks for Google to consolidate
- **Falsification**: If non-www variant still receives impressions after 30 days

### Warsaw Page Performance
- **Metric**: CTR >0.5% for "siding replacement warsaw indiana" query
- **Timeline**: 30-60 days
- **Falsification**: If CTR remains 0% after 60 days, investigate snippet/competition

### Top Query Pages
- **Metric**: Improved CTR on target queries
- **Timeline**: 30-90 days
- **Falsification**: If impressions drop or CTR doesn't improve

---

## Risk Flags & Mitigation

### Risk 1: Canonical Redirect Loop
**Mitigation**: Redirect only applies to non-www host, exempts static files

### Risk 2: Duplicate Content (City-Service vs Matrix Pages)
**Mitigation**: 
- City-service pages are general intent (e.g., "siding replacement")
- Matrix pages are specific pain-point (e.g., "siding replacement + rotten siding")
- Different URLs, different content focus
- Both can coexist if they serve different query intents

### Risk 3: Thin Content on City-Service Pages
**Mitigation**:
- Pages include service details, process, benefits
- Schema provides structured context
- Internal links provide depth
- Content is truthful and service-specific

---

## Next Steps (Future Phases)

### Phase 3: Additional High-Opportunity Pages
- "house siding replacement" (464 impressions, pos 29.75)
- "residential siding contractor" (126 impressions, pos 15.51)
- "vinyl siding installers near me" (635 impressions, pos 71.96) - needs broader page

### Phase 4: Matrix Page Optimization
- Improve Warsaw matrix pages with better snippets
- Add internal links from city-service pages to relevant matrix pages
- Optimize for "storm damage repair warsaw indiana" (72 impressions, pos 69.19)

### Phase 5: Internal Link Architecture Audit
- Ensure all high-opportunity pages receive internal links
- Audit link graph for crawl efficiency
- Remove or consolidate thin/duplicate pages

---

## Constraint Compliance Check

✅ **Canonical Stability**: Single canonical host enforced
✅ **Render Determinism**: All metadata server-rendered
✅ **Index Clarity**: No duplicate homepage variants
✅ **Intent Alignment**: Pages match query intent
✅ **Truthful Schema**: LocalBusiness schema matches on-page content
✅ **Internal Links**: Strategic links from service-area hub
✅ **Temporal Stability**: Changes are minimal and targeted

**No violations detected.**

