# Blog Content Standards - Implementation Summary

**Status:** ✅ Complete
**Date:** 2025-01-XX

---

## What Was Implemented

### 1. Documentation Created

✅ **BLOG-CONTENT-STANDARDS.md** - Complete standards document with:
- Internal anchor text rules and approved patterns
- Blog title structure requirements (3 approved formats)
- Publishing checklist (pre-publish, authority, linking, hygiene, QA)
- Service page URL reference
- Template example

✅ **BLOG-TITLE-REWRITES.md** - Analysis and recommendations for existing titles

✅ **templates/blog/_template-example.php** - Working template showing correct structure

---

### 2. CSV Titles Updated

All blog post titles in `app/config/ctr_rewrites.csv` now follow Format 1 (Question format - best for AI citation):

**Updated Titles:**
- "When Do You Need to Replace Your Roof Ridge Cap?"
- "How Much Does Siding Replacement Cost in Indiana Homes?"
- "Does Home Insurance Cover Broken Windows in Indiana?"

**Changes Made:**
- Removed brand mentions
- Converted to question format
- Made location-specific
- Removed year stuffing where possible
- Made descriptive, not salesy

---

### 3. Blog Hub Standards (Previously Implemented)

✅ Authoritative title: "Home Siding Blog | South Bend Siding Contractors & Installers"
✅ Informational description (no sales language)
✅ Intent declaration paragraph (verbatim match)
✅ No sales CTAs or phone numbers in blog hub
✅ Canonical enforcement for all query params
✅ Noindex meta tag when params exist

---

## Next Steps (For Content Team)

### Immediate Actions Required

1. **Review Existing Blog Templates**
   - `templates/blog/siding-replacement-costs-indiana-2025.php` has sales CTAs and phone numbers
   - `templates/blog/install-a-metal-roof-ridge-cap.php` needs review
   - Remove all marketing language, CTAs, and phone numbers from blog body content
   - Add at least one internal link using approved contractor anchor text

2. **Update Blog Post Metadata**
   - Ensure `$pageTitle` and `$pageDescription` in templates match CSV entries
   - Update descriptions to be factual, not salesy

3. **Add Internal Links**
   - Every blog post must link to at least one service page
   - Use approved anchor text patterns (see BLOG-CONTENT-STANDARDS.md Section 1)
   - Place links in second half of article, in contextual sentences

4. **Use Template for New Posts**
   - Copy `templates/blog/_template-example.php` for new posts
   - Follow checklist in BLOG-CONTENT-STANDARDS.md Section 3

---

## Approval Workflow

**Before Publishing ANY Blog Post:**

1. Review against BLOG-CONTENT-STANDARDS.md checklist
2. Verify title follows Format 1, 2, or 3
3. Confirm internal link uses approved anchor text
4. Remove all CTAs, phone numbers, sales language
5. Verify canonical URL is clean (no params)
6. Test page renders correctly

**Post-Publish (24-48 hours):**

1. Check GSC URL inspection
2. Verify canonical correct
3. Confirm no parameter variants indexed
4. Check page is crawlable

---

## Files Modified

- `app/config/ctr_rewrites.csv` - Updated blog titles
- `BLOG-CONTENT-STANDARDS.md` - New documentation
- `BLOG-TITLE-REWRITES.md` - New analysis document
- `templates/blog/_template-example.php` - New template

---

## Files That Need Content Updates

- `templates/blog/siding-replacement-costs-indiana-2025.php` - Remove CTAs, add internal links
- `templates/blog/install-a-metal-roof-ridge-cap.php` - Review and update per standards

---

## Enforcement

**This is a hard requirement, not a suggestion.**

All new blog posts MUST follow BLOG-CONTENT-STANDARDS.md.

Existing posts should be updated to comply when revised.

---

**Questions?** Refer to BLOG-CONTENT-STANDARDS.md
**Template?** Use templates/blog/_template-example.php
**Service URLs?** See BLOG-CONTENT-STANDARDS.md Service Page URLs Reference

