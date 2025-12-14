# GSC Priority Analysis - Next Batch
## Date: December 15, 2025

## OpportunityScore Calculation

### Formula:
OpportunityScore = Impressions × PositionFactor × CTRGapFactor × IntentMatchFactor × CanonicalConfidenceFactor

### Factors:
- PositionFactor: 1.2 (1–12), 1.0 (13–25), 0.7 (26–40), 0.4 (>40)
- CTRGapFactor: 1.2 (<0.3%), 1.0 (0.3–1%), 0.6 (>1%)
- IntentMatchFactor: 1.0 (single intent), 0.5 (mixed), 0.2 (unclear)
- CanonicalConfidenceFactor: 1.2 (clean), 0.4 (duplicates/variants)

---

## PRIORITY 1: Striking Distance Pages (Position 1-12, 0 clicks)

### 1. `/vinyl-siding-michiana-south-bend`
- **Impressions**: 862
- **Position**: 59.98
- **Clicks**: 0
- **CTR**: 0%
- **Query Cluster**: "vinyl siding south bend" (117 impressions, pos 27.92)
- **OpportunityScore**: 862 × 0.4 × 1.2 × 1.0 × 1.2 = **496.5** ⭐ TOP PRIORITY
- **Issue**: Page exists but ranking poorly (pos 59.98) despite high impressions
- **Action**: Optimize existing page for query intent match

### 2. `/matrix/granger-in/vinyl-siding-repair/outdated-look`
- **Impressions**: 35
- **Position**: 11.4
- **Clicks**: 0
- **CTR**: 0%
- **OpportunityScore**: 35 × 1.2 × 1.2 × 1.0 × 1.2 = **60.5**
- **Action**: Improve snippet clarity, add internal links

### 3. `/matrix/warsaw-in/soffit-fascia-repair/peeling-paint`
- **Impressions**: 22
- **Position**: 7.14
- **Clicks**: 0
- **CTR**: 0%
- **OpportunityScore**: 22 × 1.2 × 1.2 × 1.0 × 1.2 = **38.0**
- **Action**: Improve snippet, add internal links from service-area hub

### 4. `/about-us`
- **Impressions**: 27
- **Position**: 9.19
- **Clicks**: 0
- **CTR**: 0%
- **OpportunityScore**: 27 × 1.2 × 1.2 × 0.5 × 1.2 = **23.3**
- **Action**: Improve title/description for brand queries

---

## PRIORITY 2: Top Query Clusters (High Impressions, Need Dedicated Pages)

### 1. "vinyl siding installers near me" (635 impressions, pos 71.96)
- **Intent**: TransactionalLocal
- **Current State**: No dedicated page
- **Action**: Create `/vinyl-siding-installers` or `/vinyl-siding-installation-near-me`
- **Expected Impact**: High - this is the #1 query by impressions

### 2. "house siding replacement" (464 impressions, pos 29.75)
- **Intent**: TransactionalService
- **Current State**: No dedicated general page
- **Action**: Create `/house-siding-replacement` or improve `/siding-replacement`
- **Expected Impact**: High - second highest impressions

### 3. "residential siding contractor" (126 impressions, pos 15.51)
- **Intent**: TransactionalLocal
- **Current State**: No dedicated page
- **Action**: Create `/residential-siding-contractor` or improve existing contractor page
- **Expected Impact**: Medium-High - good position (15.51)

---

## PRIORITY 3: Existing Pages Needing Optimization

### 1. `/vinyl-siding-michiana-south-bend` (862 impressions, pos 59.98)
- **Issue**: Ranking poorly despite high impressions
- **Query Match**: "vinyl siding south bend" (117 impressions, pos 27.92)
- **Action**: 
  - Optimize title to match query exactly
  - Improve meta description for CTR
  - Add internal links from service-area hub
  - Ensure LocalBusiness schema includes South Bend

### 2. `/siding-contractor-faq-installation-maintenance-cost` (11 impressions, pos 22.55)
- **Issue**: Low impressions but good position
- **Action**: Add internal links, improve snippet

---

## Recommended Batch (Top 5 Pages)

1. **`/vinyl-siding-michiana-south-bend`** - 862 impressions, optimize for query match
2. **Create `/vinyl-siding-installers`** - 635 impressions query
3. **Create `/house-siding-replacement`** - 464 impressions query
4. **`/matrix/granger-in/vinyl-siding-repair/outdated-look`** - Position 11.4, 0 clicks
5. **Create `/residential-siding-contractor`** - 126 impressions, position 15.51

