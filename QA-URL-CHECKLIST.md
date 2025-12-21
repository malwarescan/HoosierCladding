# QA URL Checklist

**Date:** 2025-01-XX
**Purpose:** Comprehensive QA checklist for all pages after blog content standards and SEO improvements

---

## PRIORITY 1: Blog Pages (Recent Changes)

### Blog Hub
- [ ] `https://www.hoosiercladding.com/home-siding-blog`
  - Title: "Home Siding Blog | South Bend Siding Contractors & Installers"
  - Description: "Expert siding insights from licensed South Bend siding contractors..."
  - H1: "Home Siding Advice from South Bend Contractors"
  - Intent declaration paragraph present
  - No sales CTAs, no phone numbers
  - Canonical: `https://www.hoosiercladding.com/home-siding-blog`
  - Internal links use contractor language

### Blog Posts
- [ ] `https://www.hoosiercladding.com/home-siding-blog/install-a-metal-roof-ridge-cap`
  - Title: "When Do You Need to Replace Your Roof Ridge Cap?"
  - Description: "Licensed contractors explain roof ridge cap replacement signs..."
  - Has at least one internal link with contractor anchor text
  - No phone numbers in body
  - No sales CTAs

- [ ] `https://www.hoosiercladding.com/home-siding-blog/siding-replacement-costs-indiana-2025`
  - Title: "How Much Does Siding Replacement Cost in Indiana Homes?"
  - Description: "Licensed South Bend siding contractors break down siding replacement costs..."
  - Has at least one internal link with contractor anchor text (should link to replacement service)
  - No phone numbers in body
  - No sales CTAs

- [ ] `https://www.hoosiercladding.com/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know`
  - Title: "Does Home Insurance Cover Broken Windows in Indiana?"
  - Description: "Licensed contractors explain home insurance coverage for broken windows..."
  - Has at least one internal link with contractor anchor text
  - No phone numbers in body
  - No sales CTAs

---

## PRIORITY 2: Service Pages (Critical for Conversions)

### Primary Service Pages
- [ ] `https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend`
  - Title: "Vinyl Siding Installers in South Bend, IN | Free Quote"
  - Has phone number and CTA (service page - commercial)
  - H1 matches commercial intent

- [ ] `https://www.hoosiercladding.com/house-siding-replacement`
  - Title: "House Siding Replacement Contractors South Bend"
  - Has phone number and CTA
  - First paragraph confirms service, location, business identity

- [ ] `https://www.hoosiercladding.com/residential-siding-contractor`
  - Title: "Residential Siding Contractor South Bend, IN"
  - Has phone number and CTA
  - First paragraph confirms service, location, business identity

- [ ] `https://www.hoosiercladding.com/vinyl-siding-installers`
  - Title: "Vinyl Siding Installers Near Me | South Bend, IN"
  - Has phone number and CTA
  - First paragraph confirms service, location, business identity

### Secondary Service Pages
- [ ] `https://www.hoosiercladding.com/door-replacement-south-bend`
  - Title: "Door Replacement Contractors South Bend, IN"
  - Has phone number and CTA

- [ ] `https://www.hoosiercladding.com/window-replacement-south-bend`
  - Title: "Window Replacement Contractors South Bend, IN"
  - Has phone number and CTA

- [ ] `https://www.hoosiercladding.com/trimwork-south-bend`
  - Title: "Trimwork Contractors South Bend, IN | Licensed"
  - Has phone number and CTA

---

## PRIORITY 3: Core Pages

- [ ] `https://www.hoosiercladding.com/`
  - Title: "Siding Contractors in South Bend, IN | Licensed & Insured"
  - Description: "Licensed siding contractors serving South Bend, Mishawaka, and Northern Indiana..."
  - H1: "Siding Contractors in South Bend, IN"
  - First paragraph confirms service, location, business identity
  - Has phone number (homepage - commercial)

- [ ] `https://www.hoosiercladding.com/service-area`
  - Has LocalBusiness schema with all service areas
  - Lists all cities served

- [ ] `https://www.hoosiercladding.com/contact`
  - Contact form functional
  - Phone number and email visible

---

## PRIORITY 4: Canonical & Query Parameter Tests

### Test Canonical Enforcement
- [ ] `https://www.hoosiercladding.com/home-siding-blog?author=test`
  - Should redirect to: `https://www.hoosiercladding.com/home-siding-blog`
  - OR show noindex meta tag if served

- [ ] `https://www.hoosiercladding.com/home-siding-blog?page=2`
  - Canonical should be: `https://www.hoosiercladding.com/home-siding-blog`
  - Should show noindex meta tag

- [ ] `https://www.hoosiercladding.com/?test=123`
  - Should redirect to: `https://www.hoosiercladding.com/`
  - Canonical should be clean

---

## PRIORITY 5: Technical SEO Checks

### Meta Tags
- [ ] All pages have exactly one `<title>` tag
- [ ] All pages have exactly one `<meta name="description">` tag
- [ ] All titles ≤ 60 characters (no truncation)
- [ ] All descriptions ≤ 155 characters
- [ ] Canonical URLs are self-referential and clean (no query params)

### Structured Data
- [ ] Homepage has Organization + LocalBusiness schema
- [ ] Service pages have LocalBusiness + Service schema (where applicable)
- [ ] Blog hub has appropriate schema
- [ ] Service area page has LocalBusiness schema with all areas

### Content Quality
- [ ] All service pages have H1 that matches title intent
- [ ] All service pages have first paragraph confirming service, location, business identity
- [ ] All blog posts have no phone numbers in body
- [ ] All blog posts have at least one internal link with contractor anchor text
- [ ] No broken links

---

## QA Checklist Per Page Type

### Blog Pages Must Have:
- [ ] Clean title (Format 1, 2, or 3 from standards)
- [ ] Factual meta description (no sales language)
- [ ] H1 matches title (or derived from title)
- [ ] No phone numbers in body
- [ ] No sales CTAs ("Get Free Estimate", "Call Now")
- [ ] At least 1 internal link with contractor anchor text
- [ ] Link appears in second half of article
- [ ] Clean canonical URL (no params)

### Service Pages Must Have:
- [ ] Commercial title (Contractor/Installer/Company)
- [ ] Phone number in description
- [ ] Phone number visible above fold
- [ ] H1 matches commercial intent
- [ ] First paragraph confirms service, location, business identity
- [ ] CTA visible (contact/estimate button)
- [ ] LocalBusiness schema
- [ ] Clean canonical URL

---

## GSC Inspection URLs (After Deployment)

Submit these URLs for Google Search Console inspection:

1. `https://www.hoosiercladding.com/home-siding-blog`
2. `https://www.hoosiercladding.com/home-siding-blog/install-a-metal-roof-ridge-cap`
3. `https://www.hoosiercladding.com/home-siding-blog/siding-replacement-costs-indiana-2025`
4. `https://www.hoosiercladding.com/home-siding-blog/does-home-insurance-cover-broken-windows-what-indiana-homeowners-need-to-know`
5. `https://www.hoosiercladding.com/vinyl-siding-michiana-south-bend`
6. `https://www.hoosiercladding.com/house-siding-replacement`
7. `https://www.hoosiercladding.com/`

---

## Quick Reference: Expected Titles

- Homepage: "Siding Contractors in South Bend, IN | Licensed & Insured"
- Blog Hub: "Home Siding Blog | South Bend Siding Contractors & Installers"
- Vinyl Siding: "Vinyl Siding Installers in South Bend, IN | Free Quote"
- Siding Replacement: "House Siding Replacement Contractors South Bend"
- Roof Ridge Cap: "When Do You Need to Replace Your Roof Ridge Cap?"
- Siding Costs: "How Much Does Siding Replacement Cost in Indiana Homes?"
- Insurance Windows: "Does Home Insurance Cover Broken Windows in Indiana?"

---

**Last Updated:** 2025-01-XX
**Use With:** BLOG-CONTENT-STANDARDS.md
**Check Against:** QA-CHECKLIST-FINAL.md (if available)

