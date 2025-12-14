# Page Alignment: /vinyl-siding-michiana-south-bend
## Date: December 15, 2025

## Current State Analysis

Based on web search results from https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend:

**Issues Found:**
1. H1 shows "Vinyl Siding Services in Michiana" (should be "Vinyl Siding in South Bend, Indiana")
2. Lead paragraph mentions "Michiana, Indiana" (should emphasize "South Bend, Indiana")
3. Body content references "Michiana" instead of "South Bend" as primary location

**Target Query:** "vinyl siding south bend" (117 impressions, position 27.92)

## Guideline Compliance Fixes Applied

### ✅ Fix 1: Title & Metadata
- **Title**: "Vinyl Siding in South Bend, IN – Expert Installation" (58 chars)
- **Description**: "Professional vinyl siding installation and replacement in South Bend, Indiana. Licensed contractors with local expertise. Free estimates. Call 574-931-2119." (155 chars)
- **Status**: ✅ Matches query intent exactly

### ✅ Fix 2: H1 Alignment
- **H1**: "Vinyl Siding in South Bend, Indiana"
- **Status**: ✅ Matches title and query

### ✅ Fix 3: Above-the-Fold Content
- **Lead Paragraph**: Now emphasizes "South Bend, Indiana" with strong tag
- **Content**: "Professional vinyl siding installation, replacement, and repair in **South Bend, Indiana**. Licensed, insured contractors with local expertise. Free estimates available."
- **Status**: ✅ Clear service + location + CTA

### ✅ Fix 4: Body Content Enhancement
- **Why Choose Section**: Enhanced with South Bend-specific language
- **Service Areas Section**: Emphasizes "South Bend, Indiana" as primary, then mentions surrounding areas
- **Status**: ✅ Maintains topical center (no drift)

### ✅ Fix 5: Canonical & Schema
- **Canonical**: `https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend` (www enforced)
- **LocalBusiness Schema**: Includes South Bend as primary service area
- **Status**: ✅ Truthful, matches on-page content

### ✅ Fix 6: Internal Links
- **From Service-Area Hub**: ✅ Link present
- **To Service-Area Hub**: ✅ CTA present
- **To Contact**: ✅ CTA present
- **Status**: ✅ Strategic linking architecture

## Code Changes Summary

### File: `app/routes/service-page-router.php`

1. **Page Data Configuration** (Line 62-68):
   - Title: "Vinyl Siding in South Bend, IN – Expert Installation"
   - Description: Optimized for query match
   - H1: "Vinyl Siding in South Bend, Indiana"
   - Location: "South Bend, Indiana"

2. **Hero Section** (Line 201-202):
   - Conditional lead paragraph emphasizing "South Bend, Indiana"
   - Strong tag on location for emphasis

3. **Body Content** (Line 215-216):
   - Enhanced "Why Choose" section with South Bend-specific language
   - Mentions "Indiana's harsh weather" for local relevance

4. **Service Areas Section** (Line 227-228):
   - Emphasizes "South Bend, Indiana" as primary
   - Mentions surrounding areas without diluting primary focus

5. **Schema** (Line 232-270):
   - LocalBusiness schema with South Bend as primary service area
   - Service catalog includes Vinyl Siding

## Compliance Checklist

- ✅ **Canonical**: www enforced, self-referential
- ✅ **Render**: Server-rendered, deterministic
- ✅ **Index**: Single URL variant
- ✅ **Intent**: Title/description/H1 match "vinyl siding south bend" query
- ✅ **Trust**: LocalBusiness schema with South Bend service area
- ✅ **Links**: Strategic internal links from service-area hub
- ✅ **Above-Fold**: Service + location + CTA clear
- ✅ **Topical Center**: No drift, focused on vinyl siding in South Bend
- ✅ **Uniqueness**: Title/description unique across site
- ✅ **Schema Truth**: Matches on-page content

## Expected Outcomes

1. **Position Improvement**: From current 59.98 toward query position (27.92)
2. **CTR Improvement**: From 0% to >0.3% within 30-60 days
3. **Query Match**: Page receives clicks from "vinyl siding south bend" query
4. **Index Selection**: Page becomes primary result for South Bend vinyl siding queries

## Deployment Notes

After deployment, verify:
1. H1 displays "Vinyl Siding in South Bend, Indiana" (not "Michiana")
2. Lead paragraph emphasizes "South Bend, Indiana"
3. Canonical tag shows www.hoosiercladding.com
4. LocalBusiness schema includes South Bend service area
5. Internal links from service-area hub are present

