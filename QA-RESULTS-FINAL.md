# QA Results - Live URL Verification

**Date:** 2025-01-XX  
**QA Method:** Automated script with live URL loading  
**Base URL:** https://313243ed7371.ngrok-free.app

---

## Results Table

| URL | Loads | Title Correct | Meta Correct | Canonical Correct | Intent Correct | Param Handling | Overall Status | Notes |
|-----|-------|---------------|--------------|-------------------|----------------|----------------|----------------|------|
| https://313243ed7371.ngrok-free.app/home-siding-blog | Y | Y | Y | Y | N | Y | **FAIL** | Blog has phone in body; Blog service link missing contractor anchor |
| https://313243ed7371.ngrok-free.app/home-siding-blog/install-a-metal-roof-ridge-cap | Y | Y | Y | Y | N | Y | **FAIL** | Blog has phone in body; Blog has CTA; Blog missing service link; Blog service link missing contractor anchor |
| https://313243ed7371.ngrok-free.app/home-siding-blog/siding-replacement-costs-indiana-2025 | Y | Y | Y | Y | N | Y | **FAIL** | Blog has phone in body; Blog has CTA; Blog missing service link; Blog service link missing contractor anchor |
| https://313243ed7371.ngrok-free.app/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know | Y | Y | Y | Y | N | Y | **FAIL** | Blog has phone in body; Blog has CTA; Blog missing service link; Blog service link missing contractor anchor |
| https://313243ed7371.ngrok-free.app/ | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/service-area | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/contact | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/vinyl-siding-michiana-south-bend | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/house-siding-replacement | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/residential-siding-contractor | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/vinyl-siding-installers | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/door-replacement-south-bend | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/window-replacement-south-bend | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/trimwork-south-bend | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/siding-replacement-warsaw | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/vinyl-siding-south-bend | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/siding-installation-granger | Y | Y | Y | Y | Y | Y | **PASS** | |
| https://313243ed7371.ngrok-free.app/home-siding-blog?author=test | Y | Y | Y | Y | Y | Y | **PASS** | Redirects 301 to clean URL (correct behavior) |
| https://313243ed7371.ngrok-free.app/home-siding-blog?page=2 | Y | Y | Y | Y | Y | Y | **PASS** | Redirects 301 to clean URL (correct behavior) |
| https://313243ed7371.ngrok-free.app/?test=123 | Y | Y | Y | Y | Y | Y | **PASS** | Redirects 301 to clean URL (correct behavior) |

---

## FAILING URLs & Required Fixes

### 1. Blog Hub: `/home-siding-blog`

**Issues:**
- Blog has phone number in body (violates informational-only rule)
- Blog service link missing contractor anchor text (links exist but anchor doesn't contain "contractor"/"installer" language)

**Required Fix:**
- Remove phone numbers from blog hub body content
- Update service page links to use contractor anchor text (e.g., "vinyl siding contractors in South Bend" instead of generic text)

---

### 2. Blog Posts: All 3 Posts Fail Intent Requirements

**Posts Affected:**
- `/home-siding-blog/install-a-metal-roof-ridge-cap`
- `/home-siding-blog/siding-replacement-costs-indiana-2025`
- `/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know`

**Issues (all posts):**
- Blog has phone number in body content
- Blog has CTA buttons/text ("Get Free Estimate", "Call Now", etc.)
- Blog missing service link (no internal link to service pages)
- Blog service link missing contractor anchor text

**Required Fixes:**
- Remove ALL phone numbers from blog post body content
- Remove ALL CTAs ("Get Free Estimate", "Call Now", contact buttons)
- Add at least ONE internal link to relevant service page
- Link anchor text MUST contain contractor/installer language:
  - Example: "vinyl siding contractors in South Bend"
  - Example: "siding replacement contractors in South Bend"
- Place link in second half of article, in contextual sentence

---

### 3. Parameter URLs: Query Parameter Handling

**Status:** ✅ **PASS** - All parameter URLs correctly redirect (301) to clean URLs

---

## Summary

**Total URLs Tested:** 20  
**PASS:** 16 URLs (80%)  
**FAIL:** 4 URLs (20%)

**Failure Breakdown:**
- Blog pages with intent violations: 4 URLs

---

## FINAL VERDICT

**SITE READY FOR PRODUCTION: NO**

**Blocking Issues:**
1. Blog pages violate informational-only requirement (have phones/CTAs)
2. Blog pages missing required internal service links with contractor anchor text

**All blocking issues must be resolved before production deployment.**

