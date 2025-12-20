# QA Checklist Results - Pre-Launch Validation

## ❌ CRITICAL FAILURES FOUND

### GLOBAL QA RULES - FAILURES

#### Homepage (/)
- ❌ **TITLE FAIL**: Current: "Home Siding | Durable • Fast Quotes | Hoosier Cladding"
  - Required: "Siding Contractors in South Bend, IN | Licensed & Insured"
  - Issue: Brand-first, missing "Contractors", missing location
- ❌ **H1 FAIL**: Current: "South Bend's Premier Siding Experts"
  - Required: "Siding Contractors in South Bend, IN"
  - Issue: Marketing fluff, not literal confirmation
- ❌ **DESCRIPTION FAIL**: Missing phone number
- ❌ **FIRST PARAGRAPH**: Need to verify confirmation

#### Vinyl Siding Page (/vinyl-siding-michiana-south-bend)
- ❌ **TITLE FAIL**: Current: "Vinyl Siding in South Bend – Expert Installation & Repair"
  - Required: "Vinyl Siding Installers in South Bend, IN | Free Quote"
  - Issue: Missing "Installers", wrong format
- ❌ **H1**: "Vinyl Siding in South Bend, Indiana" - Close but missing "Installers"
- ⚠️ **DESCRIPTION**: Missing phone number format

#### Door Replacement (/door-replacement-south-bend)
- ❌ **TITLE FAIL**: Current: "Door Replacement South Bend in South Bend – Expert Instal..."
  - Required: "Door Replacement Contractors South Bend, IN"
  - Issue: Malformed, duplicate "South Bend", missing "Contractors"
- ❌ **H1**: "Door Replacement Services in South Bend" - Missing "Contractors"

#### Residential Siding Contractor (/residential-siding-contractor)
- ❌ **TITLE FAIL**: Current: "Siding Services in Northern Indiana – Licensed Contractors"
  - Required: "Residential Siding Contractor South Bend, IN"
  - Issue: Too generic, missing "Residential", wrong location
- ❌ **H1**: "Residential Siding Contractor" - Missing location

#### House Siding Replacement (/house-siding-replacement)
- ❌ **TITLE FAIL**: Current: "Siding Services in Northern Indiana – Licensed Contractors"
  - Required: "House Siding Replacement Contractors South Bend"
  - Issue: Generic, missing "House", missing "Replacement", wrong location
- ❌ **H1**: "House Siding Replacement Services" - Missing "Contractors"

---

## ROOT CAUSE ANALYSIS

**Problem**: CSV overrides from `ctr_rewrites.csv` are NOT being applied.

**Why**: 
1. Header.php checks for `$pageTitle` and `$pageDescription` being set
2. Service page router sets these variables BEFORE including header
3. MetaManager CSV check never runs because variables are already set
4. AdvancedMetaManager generates generic titles instead

**Fix Required**: 
1. Update header.php to check MetaManager BEFORE using page-set variables
2. OR: Remove hardcoded titles from service router, let CSV override
3. OR: Update service router to use CSV values directly

---

## ACTION PLAN

1. Fix header.php priority: CSV → Page Variables → AdvancedMetaManager
2. Update homepage title/description in home.php or CSV
3. Update homepage H1 to match title
4. Verify all service pages use CSV overrides
5. Add phone numbers to all descriptions
6. Fix first paragraph confirmations

