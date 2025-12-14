# GSC-Driven Landing Page Improvement Plan
## Date: December 15, 2025

## Data Analysis Summary

**Critical Findings:**
- Total impressions: 7,916 (last 3 months)
- Total clicks: 16 (0.2% CTR)
- Average position: ~37
- **Canonical violation**: Both www and non-www homepage variants receiving impressions
- **Best opportunity**: "siding replacement warsaw indiana" query at position 9.91 with 0 clicks

## Priority 0: Canonical Consolidation (MANDATORY)

### Issue
- `https://hoosiercladding.com/`: 600 impressions, 0.5% CTR, pos 28.75
- `https://www.hoosiercladding.com/`: 1,290 impressions, 0.08% CTR, pos 37.07
- **Signal split**: Both variants competing for index selection

### Solution
Enforce `www.hoosiercladding.com` as canonical (already configured in `config/site.php`)

### Required Actions
1. Add sitewide 301 redirect: non-www → www
2. Ensure all canonical tags use www
3. Update sitemaps to use www only
4. Verify internal links use www

## Priority 1: Striking Distance Pages (HIGH OPPORTUNITY)

### Target: Warsaw Siding Replacement
**Query**: "siding replacement warsaw indiana"
- Impressions: 76
- Position: 9.91 (striking distance!)
- Clicks: 0 (CTR gap = opportunity)

**Current Page**: `/matrix/warsaw-in/siding-replacement/rotten-siding`
- Position: 10.08
- Impressions: 78
- Clicks: 0

**Issues Identified:**
1. Query intent: "siding replacement" (general)
2. Page targets: "siding replacement + rotten siding" (too specific)
3. Mismatch between query and page specificity

**Required Fixes:**
1. Create/improve dedicated `/siding-replacement-warsaw` page
2. Ensure title matches query: "Siding Replacement in Warsaw, IN"
3. Add strong internal links from service-area hub
4. Add truthful LocalBusiness schema with Warsaw service area
5. Above-fold clarity: service + location + CTA

## Priority 2: Top Query Cluster Pages

### Cluster 1: "vinyl siding installers near me" (635 impressions, pos 71.96)
**Intent**: Transactional local service
**Target Page**: `/vinyl-siding-installation-south-bend` or create `/vinyl-siding-installers`
**Required**: Geo-targeted, service-specific, strong local signals

### Cluster 2: "house siding replacement" (464 impressions, pos 29.75)
**Intent**: Transactional service
**Target Page**: `/siding-replacement` or `/siding-replacement-south-bend`
**Required**: Clear service definition, process, pricing context

### Cluster 3: "vinyl siding south bend" (117 impressions, pos 27.92)
**Intent**: Transactional local
**Target Page**: `/vinyl-siding-michiana-south-bend` (exists but 0 clicks, pos 59.98)
**Required**: Improve snippet, add local proof, strengthen internal links

## Implementation Queue

### Phase 1: Canonical Fix (Immediate)
- [ ] Add www redirect in .htaccess
- [ ] Verify canonical tags
- [ ] Update sitemaps
- [ ] Audit internal links

### Phase 2: Warsaw Page (High ROI)
- [ ] Create/improve Warsaw siding replacement page
- [ ] Optimize metadata for query match
- [ ] Add internal links
- [ ] Add LocalBusiness schema

### Phase 3: Top Query Pages (Batch 1)
- [ ] Improve vinyl siding installers page
- [ ] Improve house siding replacement page
- [ ] Optimize vinyl siding south bend page

