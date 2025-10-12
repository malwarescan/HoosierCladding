# Schema Validation Guide

## Quick Validation Commands

### Test Matrix Page Schema

```bash
# Start development server
cd /Users/malware/Desktop/hoosiercladdingwebsite
php -S localhost:8080 router.php

# Count total schema types
curl -s http://localhost:8080/matrix/south-bend-in/siding-repair/storm-damage \
  | grep -c '@type'
# Expected: 11+ types

# List all unique schema types
curl -s http://localhost:8080/matrix/south-bend-in/siding-repair/storm-damage \
  | grep -o '@type":"[^"]*"' | sort | uniq
# Expected output includes:
# - HomeAndConstructionBusiness
# - BreadcrumbList
# - Service
# - FAQPage
# - Question
# - Answer
# - etc.

# Verify specific new schemas
curl -s http://localhost:8080/matrix/south-bend-in/siding-repair/storm-damage \
  | grep -E '(HomeAndConstructionBusiness|BreadcrumbList)' | wc -l
# Expected: 2 (one of each)
```

### Extract Full Schema for Validation

```bash
# Save full page HTML
curl -s http://localhost:8080/matrix/south-bend-in/siding-repair/storm-damage \
  > /tmp/matrix-page.html

# Extract just the JSON-LD scripts
curl -s http://localhost:8080/matrix/south-bend-in/siding-repair/storm-damage \
  | grep -o '<script type="application/ld+json">.*</script>' \
  | sed 's/<script type="application\/ld+json">//' \
  | sed 's/<\/script>//' \
  > /tmp/schemas.json
```

## Online Validation Tools

### 1. Google Rich Results Test
**URL**: https://search.google.com/test/rich-results

**Steps**:
1. Start local server or use production URL
2. Enter matrix page URL in the tool
3. Click "Test URL"
4. Look for:
   - ✓ LocalBusiness/HomeAndConstructionBusiness
   - ✓ Service
   - ✓ FAQPage
   - ✓ BreadcrumbList

**Expected Results**:
- No errors
- Multiple eligible rich results
- FAQ eligible for rich results
- LocalBusiness info detected

### 2. Schema.org Validator
**URL**: https://validator.schema.org/

**Steps**:
1. Copy entire page HTML
2. Paste into "Code Snippet" tab
3. Click "Validate"
4. Review results

**Expected Results**:
- All schemas validate
- No errors or warnings
- Proper nesting of types

### 3. Google Search Console
**Tool**: URL Inspection

**Steps**:
1. Open Google Search Console
2. Use "URL Inspection" tool
3. Enter a `/matrix/*` URL
4. Click "Test Live URL"
5. View "Search appearance"

**Monitor**:
- FAQ enhancements
- Breadcrumb detection
- LocalBusiness data
- Any enhancement errors

## Troubleshooting

### Schema Not Showing

```bash
# Check if head_injector is being called
curl -s http://localhost:8080/matrix/test-url \
  | head -100 | grep "application/ld+json" | wc -l
# Should be > 0

# Verify matrix route detection
php -r "
require_once 'app/lib/schema.php';
echo Schema::isMatrixRoute('/matrix/test') ? 'YES' : 'NO';
"
# Should output: YES
```

### Invalid JSON

```bash
# Extract and validate JSON
curl -s http://localhost:8080/matrix/south-bend-in/siding-repair/storm-damage \
  | grep -o '<script type="application/ld+json">{.*}</script>' \
  | sed 's/<[^>]*>//g' \
  | python3 -m json.tool
# Should format valid JSON without errors
```

### Missing Data

```bash
# Check if CSV data is loading
php <<'EOF'
<?php
require_once 'matrix-router.php';
$data = MatrixDataLoader::loadAll();
echo "Total rows: " . count($data) . "\n";
echo "First slug: " . array_key_first($data) . "\n";
EOF
```

## Production Validation

### Pre-Deployment Checklist

- [ ] All matrix URLs return 200 status
- [ ] Schemas validate on validator.schema.org
- [ ] Google Rich Results Test passes
- [ ] No PHP errors in logs
- [ ] Business config has production data
- [ ] Geo-coordinates are accurate
- [ ] Social media URLs are correct
- [ ] Canonical URLs are set

### Post-Deployment Monitoring

**Week 1-2**:
- Check GSC for schema detection
- Monitor for validation errors
- Watch for FAQ rich results appearing

**Week 3-4**:
- Analyze CTR changes
- Check SERP appearance
- Monitor rich result impressions

**Ongoing**:
- Review "Enhancements" in GSC monthly
- Fix any new schema errors promptly
- Update FAQ content based on performance

## Common Issues & Solutions

### Issue: Schemas duplicate
**Solution**: Old SchemaRenderer and new head_injector both active. This is OK - provides redundancy.

### Issue: FAQ not showing in search
**Solution**: FAQs can take 2-4 weeks to appear. Ensure content is high quality and answers clear.

### Issue: LocalBusiness not detected
**Solution**: Verify geo-coordinates, complete address, and phone number in business config.

### Issue: Breadcrumbs not showing
**Solution**: Ensure all breadcrumb items have valid URLs and proper position numbers.

## Testing Different Matrix URLs

```bash
# Test various URL patterns
for url in \
  "south-bend-in/siding-repair/storm-damage" \
  "south-bend-in/siding-repair/hail-damage" \
  "mishawaka-in/siding-installation/energy-efficiency"
do
  echo "Testing: /matrix/$url"
  curl -s "http://localhost:8080/matrix/$url" | grep -c '@type'
done
```

## Schema Quality Checklist

For each schema, verify:

**HomeAndConstructionBusiness**:
- [ ] Name is correct
- [ ] Phone number formatted correctly (+1-xxx-xxx-xxxx)
- [ ] Email is valid
- [ ] Address is complete
- [ ] Geo-coordinates are accurate
- [ ] sameAs URLs work

**BreadcrumbList**:
- [ ] All URLs are absolute and valid
- [ ] Position numbers are sequential
- [ ] Names are descriptive

**Service**:
- [ ] Service type matches page content
- [ ] Provider links to business
- [ ] Area served is specific
- [ ] Offers are relevant

**FAQPage**:
- [ ] Questions are clear
- [ ] Answers are comprehensive
- [ ] Min 3 FAQs present
- [ ] Content matches page topic

## Validation Success Criteria

✓ **Technical**:
- All JSON-LD validates
- No syntax errors
- Proper schema nesting
- All required fields present

✓ **Content**:
- Business data accurate
- Service descriptions clear
- FAQs relevant and helpful
- Breadcrumbs logical

✓ **SEO**:
- Eligible for rich results
- LocalBusiness detected
- FAQ enhancement possible
- Breadcrumbs show correctly

## Support Resources

- Schema.org Documentation: https://schema.org/
- Google Search Central: https://developers.google.com/search/docs/appearance/structured-data
- JSON-LD Playground: https://json-ld.org/playground/
- Rich Results Test: https://search.google.com/test/rich-results

---

**Last Updated**: October 13, 2025  
**Status**: Production Ready

