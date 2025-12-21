# Blog Content Standards & Publishing Checklist

**Lock-tight implementation package for blog posts**
This document must be followed for ALL blog posts. No interpretation, no exceptions.

---

## 1. INTERNAL ANCHOR TEXT RULES

### Core Rule (Non-Negotiable)

Every blog post MUST link to at least ONE relevant service page using contractor-intent anchor text.

❌ **DO NOT USE:**
- "learn more"
- "our services"
- "click here"
- "our team"
- Phone numbers as anchors
- Generic fluff

✅ **MUST USE:** Exact or near-exact commercial language (see patterns below)

---

### Approved Anchor Text Patterns

**Vinyl siding posts:**
- "vinyl siding contractors in South Bend"
- "vinyl siding installation in South Bend"
- "local vinyl siding installers"

**Fiber cement / Hardie posts:**
- "fiber cement siding contractors in South Bend"
- "James Hardie siding installers in South Bend"
- "fiber cement siding installation"

**Repair-related posts:**
- "siding repair contractors in South Bend"
- "siding repair services in Indiana"

**Replacement posts:**
- "siding replacement contractors in South Bend"
- "full siding replacement services"

---

### Anchor Text Rules (Hard Limits)

❌ **DO NOT:**
- Use generic anchors ("click here", "learn more", "our team")
- Use phone numbers as anchors
- Link to homepage unless contextually required
- Over-link (1-2 service links per post max)

✅ **MUST:**
- Place anchor in second half of article
- Place anchor inside contextual sentence
- Never place in author bio, footer, or navigation widgets

---

### Why This Matters

This creates:
- Clear topical authority flow
- Strong entity association (contractor + location)
- Cleaner AI summarization paths
- Better service page ranking stability

---

## 2. BLOG POST TITLE REWRITE PASS

### Title Structure Rule

Every blog title MUST follow one of these three allowed formats:

**Format 1 — Question (best for AI citation):**
- "How Long Does [Siding Type] Last in Indiana?"

**Format 2 — Practical guidance:**
- "[Number] Things South Bend Homeowners Should Know About [Siding Topic]"

**Format 3 — Problem/solution:**
- "Common [Siding Problem] Issues in Indiana Homes (And How to Fix Them)"

---

### What to REMOVE from Titles

❌ **Remove:**
- Marketing language ("Ultimate", "Best", "Complete guide")
- Brand mentions
- Emojis or punctuation gimmicks
- Year stuffing unless truly necessary

---

### Example Rewrites

**Before:** "Everything You Need to Know About Vinyl Siding"
**After:** "How Long Does Vinyl Siding Last in Indiana Homes?"

**Before:** "James Hardie Siding Benefits Explained"
**After:** "Is James Hardie Siding Worth It for South Bend Homes?"

**Before:** "Siding Repair Tips"
**After:** "When Does Siding Damage Require Professional Repair?"

---

### Why These Titles Win

- They are answerable
- They are location-aware
- They are experience-based
- AI systems prefer citing clear questions and claims

---

## 3. BLOG PUBLISHING CHECKLIST

**A post is NOT allowed to publish unless every box is checked.**

---

### A. Pre-Publish (SEO + Crawl)

- [ ] Clean URL (no params)
- [ ] Self-referential canonical
- [ ] Title follows approved formats (Format 1, 2, or 3)
- [ ] Meta description is factual, not salesy
- [ ] No phone number in blog body

---

### B. Authority Declaration

- [ ] Written in contractor voice (experience-based)
- [ ] No speculative or generic advice
- [ ] Mentions real homeowner scenarios

---

### C. Internal Linking (MANDATORY)

- [ ] At least 1 blog → service link
- [ ] Uses approved contractor anchor text (see Section 1)
- [ ] Links are contextual, not forced
- [ ] Links appear in second half of article
- [ ] No links in footer/navigation/author bio

---

### D. Content Hygiene

- [ ] No marketing CTAs ("Get Free Estimate", "Call Now")
- [ ] No exaggerated claims
- [ ] No keyword stuffing
- [ ] No brand-first framing

---

### E. Final QA (Before Publish)

- [ ] Page renders with content
- [ ] Title + H1 align
- [ ] Intro clearly states topic
- [ ] No broken links
- [ ] No author/profile query URLs generated

---

### F. Post-Publish Check (24-48 hrs)

- [ ] URL inspection passes in GSC
- [ ] Canonical correct
- [ ] No parameter variants indexed
- [ ] Page visible to crawlers

---

## FINAL RESULT IF YOU ENFORCE THIS

- Blog becomes a clean authority layer
- Service pages gain reinforced relevance
- Crawl space stays tight
- AI systems can confidently cite your content
- No future regression from new posts

**This is exactly how you prevent the "content decay" that kills most contractor blogs.**

---

## Service Page URLs Reference

Use these URLs when creating internal links:

- **Vinyl Siding:** `/vinyl-siding-michiana-south-bend`
- **Siding Repair:** `/siding-repair`
- **Siding Replacement:** `/house-siding-replacement`
- **Fiber Cement/James Hardie:** `/fiber-cement-siding` (or relevant James Hardie page)
- **Service Area:** `/service-area`

---

## Template Example

```php
<?php
// Set metadata (should match CSV in ctr_rewrites.csv)
$pageTitle = "How Long Does Vinyl Siding Last in Indiana?";
$pageDescription = "Licensed South Bend siding contractors explain vinyl siding lifespan in Indiana's climate, common factors that affect durability, and when replacement makes sense.";

include __DIR__ . '/../../partials/header.php';
?>

<section class="hero">
  <div class="container mx-auto px-6 py-12">
    <h1><?= htmlspecialchars($pageTitle) ?></h1>
    
    <div class="prose max-w-none mt-8">
      <!-- Article content here -->
      
      <!-- Example internal link in second half of article: -->
      <p>
        When your siding shows signs of significant wear, it's time to consult with 
        <a href="/vinyl-siding-michiana-south-bend">vinyl siding contractors in South Bend</a> 
        who can assess whether repair or replacement is the better option for your home.
      </p>
    </div>
  </div>
</section>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
```

---

**Last Updated:** 2025-01-XX
**Enforced By:** SEO/Content Team
**Review Date:** Quarterly

