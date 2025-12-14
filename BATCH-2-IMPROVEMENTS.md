# Batch 2 Landing Page Improvements
## Date: December 15, 2025

## Pages Optimized/Created

### PAGE 1: `/vinyl-siding-michiana-south-bend`
- **URL**: https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend
- **PageType**: Service
- **PrimaryIntent**: TransactionalLocal
- **QueryCluster**: VinylSiding + SouthBend

**SIGNAL MAP:**
- **Canonical**: ✅ Self-referential to www.hoosiercladding.com/vinyl-siding-michiana-south-bend
- **Render**: ✅ Server-rendered metadata via service-page-router
- **Index**: ✅ Single URL variant, no duplicates
- **Intent**: ✅ Improved - title now matches "vinyl siding south bend" query exactly
- **Trust**: ✅ LocalBusiness schema added with South Bend service area
- **Links**: ✅ Added internal link from service-area hub
- **Schema**: ✅ LocalBusiness + Service schema added

**CHANGE SET:**
- Title: "Vinyl Siding in South Bend, IN – Expert Installation" (was: "Vinyl Siding in Michiana & South Bend, IN")
- Description: Optimized for query match, includes CTA
- H1: "Vinyl Siding in South Bend, Indiana" (was: "Vinyl Siding Services in Michiana")
- Location: Changed from "Michiana, Indiana" to "South Bend, Indiana"
- Added LocalBusiness schema with South Bend service area
- Added internal link from service-area hub

**RISKS AVOIDED:**
- No canonical drift (www enforced)
- No duplicate content (unique title/description)
- Schema matches on-page content

**SUCCESS CRITERIA:**
- Position improves from 59.98 toward query position (27.92)
- CTR increases from 0% to >0.3% within 30-60 days
- Page receives clicks from "vinyl siding south bend" query

---

### PAGE 2: `/vinyl-siding-installers` (NEW)
- **URL**: https://www.hoosiercladding.com/vinyl-siding-installers
- **PageType**: Service
- **PrimaryIntent**: TransactionalLocal
- **QueryCluster**: VinylSidingInstallers + NearMe

**SIGNAL MAP:**
- **Canonical**: ✅ Self-referential to www.hoosiercladding.com/vinyl-siding-installers
- **Render**: ✅ Server-rendered via service-page-router
- **Index**: ✅ New page, no duplicates
- **Intent**: ✅ Matches "vinyl siding installers near me" query (635 impressions)
- **Trust**: ✅ LocalBusiness schema with Northern Indiana service area
- **Links**: ✅ Will link from service-area hub and related service pages
- **Schema**: ✅ LocalBusiness + Service schema

**CHANGE SET:**
- Created new page in service-page-router
- Title: "Vinyl Siding Installers Near Me – South Bend, IN"
- Description: Targets "near me" intent with local focus
- H1: "Vinyl Siding Installers Near Me"
- Added LocalBusiness schema

**RISKS AVOIDED:**
- No intent drift (focused on installer/installation, not general info)
- No duplicate with existing vinyl-siding-michiana-south-bend (different intent)

**SUCCESS CRITERIA:**
- Page ranks for "vinyl siding installers near me" query (currently pos 71.96)
- Position improves to <50 within 60-90 days
- CTR >0.2% within 90 days

---

### PAGE 3: `/house-siding-replacement` (NEW)
- **URL**: https://www.hoosiercladding.com/house-siding-replacement
- **PageType**: Service
- **PrimaryIntent**: TransactionalService
- **QueryCluster**: SidingReplacement + House

**SIGNAL MAP:**
- **Canonical**: ✅ Self-referential to www.hoosiercladding.com/house-siding-replacement
- **Render**: ✅ Server-rendered via service-page-router
- **Index**: ✅ New page, no duplicates
- **Intent**: ✅ Matches "house siding replacement" query (464 impressions, pos 29.75)
- **Trust**: ✅ LocalBusiness schema
- **Links**: ✅ Added internal link from service-area hub
- **Schema**: ✅ LocalBusiness + Service schema

**CHANGE SET:**
- Created new page in service-page-router
- Title: "House Siding Replacement in South Bend, IN"
- Description: Targets general house siding replacement intent
- H1: "House Siding Replacement Services"
- Added LocalBusiness schema
- Added internal link from service-area hub

**RISKS AVOIDED:**
- Differentiates from city-specific pages (general vs. city-specific)
- No duplicate with /siding-replacement-warsaw (different scope)

**SUCCESS CRITERIA:**
- Position improves from query position 29.75 to <25 within 60-90 days
- CTR >0.3% within 90 days
- Page receives clicks from "house siding replacement" query

---

### PAGE 4: `/residential-siding-contractor` (NEW)
- **URL**: https://www.hoosiercladding.com/residential-siding-contractor
- **PageType**: Service
- **PrimaryIntent**: TransactionalLocal
- **QueryCluster**: SidingContractor + Residential

**SIGNAL MAP:**
- **Canonical**: ✅ Self-referential to www.hoosiercladding.com/residential-siding-contractor
- **Render**: ✅ Server-rendered via service-page-router
- **Index**: ✅ New page, no duplicates
- **Intent**: ✅ Matches "residential siding contractor" query (126 impressions, pos 15.51)
- **Trust**: ✅ LocalBusiness schema
- **Links**: ✅ Will link from service-area hub
- **Schema**: ✅ LocalBusiness + Service schema

**CHANGE SET:**
- Created new page in service-page-router
- Title: "Residential Siding Contractor in South Bend, IN"
- Description: Targets contractor search intent
- H1: "Residential Siding Contractor"
- Added LocalBusiness schema

**RISKS AVOIDED:**
- Focuses on contractor/installation, not just service info
- No duplicate with general service pages

**SUCCESS CRITERIA:**
- Position improves from 15.51 to <12 within 60 days
- CTR >0.5% within 60 days (good position already)

---

## Internal Link Architecture Updates

### Service-Area Hub (`/service-area`)
- Added link to `/vinyl-siding-michiana-south-bend` from South Bend card
- Added link to `/house-siding-replacement` from South Bend card
- Maintains curated approach (not spam lists)

---

## Batch Summary

**Pages Optimized**: 1 (`/vinyl-siding-michiana-south-bend`)
**Pages Created**: 3 (`/vinyl-siding-installers`, `/house-siding-replacement`, `/residential-siding-contractor`)
**Total Opportunity**: 1,227 impressions (862 + 635 + 464 + 126 - overlaps)

**Expected Impact:**
- Improved CTR on high-impression queries
- Better query-intent alignment
- Stronger internal link graph
- More indexable pages for top query clusters

**Timeline**: Monitor GSC for 30-90 days to measure improvements

