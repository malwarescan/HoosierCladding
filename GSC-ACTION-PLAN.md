# GSC Performance Analysis - Action Plan
## Based on Dec 12-18, 2025 Data

## Critical Diagnosis
- **2 clicks from 1,079 impressions** = 0.19% CTR (catastrophically low)
- **Average position: 26.13** = Below the fold, not competitive
- **Zero mobile clicks** = Mobile SERP messaging failing
- **Pages ranking position 3-4 with zero clicks** = Title/description mismatch

---

## P1: SERP Snippet Rewrites (Immediate Impact)

### Top Priority Pages (High Impressions, Zero Clicks)

#### 1. Homepage (518 impressions, 0 clicks, pos 29.93)
**Current Title:** "Home Siding & Exterior Repair – South Bend's Trusted Installers"  
**Current Description:** "Professional siding installation and exterior repair in South Bend, Mishawaka, and Granger. Licensed contractors with expert crews for vinyl, fiber cement, and storm damage repairs. Free estimates available."

**Query Intent:** "siding contractor", "house siding contractors", "residential siding contractor"

**REWRITE:**
- **Title:** "Siding Contractors in South Bend, IN | Licensed & Insured" (55 chars)
- **Description:** "Licensed siding contractors serving South Bend, Mishawaka, and Northern Indiana. Expert installation, repair, and replacement. Free estimates. Call (574) 931-2119 today." (152 chars)

**Why:** Adds "Contractors" (matches query), includes phone (local trust), explicit service confirmation.

---

#### 2. Vinyl Siding Michiana South Bend (31 impressions, 0 clicks, pos 27.9)
**Current Title:** "Vinyl Siding Michiana South Bend | Hoosier Cladding"  
**Current Description:** "Expert siding services across Northern Indiana. Repairs, full replacements, and insulation upgrades done right. Get a same‑week estimate from Hoosier Cladding."

**Query Intent:** "vinyl siding south bend", "siding south bend"

**REWRITE:**
- **Title:** "Vinyl Siding Installers in South Bend, IN | Free Quote" (54 chars)
- **Description:** "Professional vinyl siding installation in South Bend, IN. Licensed installers with 15+ years experience. Same-day quotes. Call (574) 931-2119 for free estimate." (149 chars)

**Why:** "Installers" matches "vinyl siding installers near me" query. Adds experience signal. Phone number for trust.

---

#### 3. Door Replacement South Bend (12 impressions, 0 clicks, pos 44.25)
**Current Title:** "Door Replacement in South Bend, IN | Hoosier Cladding LLC"  
**Current Description:** "Professional door replacement services in South Bend, Indiana. Energy-efficient entry doors, storm doors, and custom solutions. Call 574-931-2119."

**Query Intent:** "door replacement south bend in"

**REWRITE:**
- **Title:** "Door Replacement Contractors South Bend, IN" (48 chars)
- **Description:** "Licensed door replacement contractors in South Bend, IN. Entry doors, storm doors, energy-efficient options. Free estimates. Call (574) 931-2119." (144 chars)

**Why:** "Contractors" matches commercial intent. Removes generic "custom solutions" language.

---

#### 4. Trimwork South Bend (1 impression, 0 clicks, pos 5)
**Current Title:** "Trimwork in South Bend, IN | Hoosier Cladding LLC"  
**Current Description:** "Professional trimwork installation and repair in South Bend, Indiana. Expert craftsmanship for fascia, soffits, corner boards, and window trim. Call 574-931-2119."

**Query Intent:** Unknown (low volume)

**REWRITE:**
- **Title:** "Trimwork Contractors South Bend, IN | Licensed" (47 chars)
- **Description:** "Professional trimwork contractors in South Bend, IN. Fascia, soffits, corner boards, window trim. Licensed & insured. Free estimates. (574) 931-2119." (147 chars)

**Why:** "Contractors" adds commercial authority. Explicit service list.

---

#### 5. Residential Siding Contractor (2 impressions, 0 clicks, pos 55)
**Current Title:** "Residential Siding Contractor in South Bend, IN"  
**Current Description:** "Licensed residential siding contractor serving South Bend, Mishawaka, and Northern Indiana. Expert installation, repair, and replacement. Call 574-931-2119."

**Query Intent:** "residential siding contractor" (62 impressions, 0 clicks, pos 17.87)

**REWRITE:**
- **Title:** "Residential Siding Contractor South Bend, IN" (50 chars)
- **Description:** "Licensed residential siding contractor in South Bend, IN. Expert installation, repair, replacement. 15+ years experience. Free estimates. (574) 931-2119." (150 chars)

**Why:** Exact query match. Adds experience signal. Phone number.

---

#### 6. House Siding Replacement (2 impressions, 0 clicks, pos 8)
**Current Title:** "House Siding Replacement Services"  
**Current Description:** "Complete house siding replacement services in South Bend and Northern Indiana. Expert installation, quality materials, and professional service. Free estimates."

**Query Intent:** "house siding contractors" (58 impressions, 0 clicks, pos 16.24)

**REWRITE:**
- **Title:** "House Siding Replacement Contractors South Bend" (52 chars)
- **Description:** "House siding replacement contractors in South Bend, IN. Complete installation, quality materials, licensed & insured. Free estimates. Call (574) 931-2119." (151 chars)

**Why:** Adds "Contractors" to match query intent. Explicit trust signals.

---

#### 7. Vinyl Siding Installers (4 impressions, 0 clicks, pos 16)
**Current Title:** "Vinyl Siding Installers Near Me – South Bend, IN"  
**Current Description:** "Professional vinyl siding installers serving South Bend, Mishawaka, and Northern Indiana. Licensed, insured contractors with expert installation. Free estimates."

**Query Intent:** "vinyl siding installers near me" (35 impressions, 1 click, pos 72.83)

**REWRITE:**
- **Title:** "Vinyl Siding Installers Near Me | South Bend, IN" (50 chars)
- **Description:** "Licensed vinyl siding installers serving South Bend, IN and Northern Indiana. Expert installation, same-day quotes. Free estimates. Call (574) 931-2119." (148 chars)

**Why:** Keeps "Near Me" (matches query). Adds "same-day quotes" (competitive differentiator).

---

## P2: Query-to-Page Intent Mismatch Analysis

### High-Volume Queries → Current Pages → Gap

| Query | Impressions | Position | Current Page | Intent Gap |
|-------|------------|----------|--------------|------------|
| "residential siding contractor" | 62 | 17.87 | `/residential-siding-contractor` | ✅ Page exists but title needs "Contractor" emphasis |
| "house siding contractors" | 58 | 16.24 | `/house-siding-replacement` | ❌ Missing "contractors" in title |
| "siding contractor" | 58 | 30.81 | Homepage | ❌ Title says "Installers" not "Contractor" |
| "siding company" | 45 | 25.71 | Homepage | ❌ No "Company" in title |
| "siding companies" | 35 | 24.49 | Homepage | ❌ No "Companies" in title |
| "vinyl siding installers near me" | 35 | 72.83 | `/vinyl-siding-installers` | ✅ Page exists, needs better positioning |
| "siding south bend" | 15 | 14.4 | `/vinyl-siding-michiana-south-bend` | ⚠️ Close but "Michiana" dilutes local signal |
| "vinyl siding south bend" | 15 | 31.8 | `/vinyl-siding-michiana-south-bend` | ⚠️ Same issue |
| "siding replacement warsaw indiana" | 12 | 10.75 | `/siding-replacement-warsaw` | ✅ Page exists, good position |
| "siding installation granger, indiana" | 10 | 11.4 | `/siding-installation-granger` | ✅ Page exists, good position |

### Action Items:
1. **Create missing pages:**
   - `/siding-company-south-bend` (for "siding company" queries)
   - `/siding-contractors-south-bend` (for "siding contractor" queries)

2. **Fix existing pages:**
   - Homepage: Add "Contractors" and "Company" to title variations
   - `/vinyl-siding-michiana-south-bend`: Consider redirecting to `/vinyl-siding-south-bend` for cleaner local signal

---

## P3: Mobile Optimization Priority

**Data:** 158 mobile impressions, 0 clicks, pos 27.58

### Mobile-Specific Issues:
1. **Title truncation** - Mobile shows ~50-55 chars, desktop ~60
2. **Description truncation** - Mobile shows ~120 chars, desktop ~155
3. **Above-fold content** - First 2 sentences must confirm service + location

### Mobile Rewrite Rules:
- **Titles:** Front-load service + location (first 40 chars critical)
- **Descriptions:** Lead with phone number or "Free Estimate" (first 20 chars)
- **H1:** Must match title intent exactly

---

## P4: Local Trust Signal Reinforcement

### Missing Trust Elements (Based on Zero Clicks):

1. **Phone number in description** ✅ (Add to all service pages)
2. **"Licensed & Insured" in title** ✅ (Add to homepage)
3. **Years of experience** ⚠️ (Add "15+ years" to key pages)
4. **Same-day quotes** ⚠️ (Competitive differentiator)
5. **City-specific case studies** ❌ (Missing - add to service pages)
6. **Real project photos with geo context** ❌ (Missing - add to service pages)

---

## P5: Page Promotion vs Prune Decision Matrix

### PROMOTE (Strengthen):
- `/siding-replacement-warsaw` (12 impressions, pos 10.75) - **Striking distance**
- `/siding-installation-granger` (10 impressions, pos 11.4) - **Striking distance**
- `/trimwork-south-bend` (1 impression, pos 5) - **Excellent position, needs traffic**
- Homepage (518 impressions, pos 29.93) - **Volume opportunity**

### PRUNE (De-emphasize):
- Blog posts with 0 clicks and position >50
- Matrix pages with position >60 and 0 clicks (keep but don't prioritize)
- Product pages ranking well but zero commercial intent (keep for informational)

### KEEP AS-IS:
- Matrix pages with position <20 (early relevance signals working)
- Service pages with position <30 (need better snippets, not removal)

---

## Implementation Priority

### Week 1: Immediate Snippet Fixes
1. Update homepage title/description
2. Update top 5 service pages (vinyl-siding-michiana-south-bend, door-replacement-south-bend, etc.)
3. Add phone numbers to all service page descriptions
4. Add "Contractors" / "Company" language to match query intent

### Week 2: Content Enhancement
1. Add "15+ years experience" to key pages
2. Add "same-day quotes" to competitive differentiators
3. Add city-specific trust signals (case studies, project photos)

### Week 3: New Page Creation
1. Create `/siding-contractors-south-bend` if query volume justifies
2. Create `/siding-company-south-bend` if query volume justifies
3. Consider redirecting `/vinyl-siding-michiana-south-bend` → `/vinyl-siding-south-bend`

### Week 4: Monitoring
1. Track CTR improvements in GSC
2. Monitor position changes
3. Identify new query opportunities

---

## Success Metrics

### Target Improvements (30 days):
- **CTR:** 0.19% → 1.5% (8x improvement)
- **Clicks:** 2 → 15+ per week
- **Average Position:** 26.13 → 18 (move into page 2)
- **Mobile Clicks:** 0 → 5+ per week

### Validation:
- GSC Performance report (weekly)
- Rich Results Test (verify schema)
- Mobile-Friendly Test (verify mobile UX)

