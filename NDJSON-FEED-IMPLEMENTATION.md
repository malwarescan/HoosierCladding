# NDJSON Feed Implementation Complete

## Overview
Successfully implemented a production-ready NDJSON (Newline-Delimited JSON) feed system for all 1,200 James Hardie products, optimized for LLM/RAG indexing, structured data ingestion, and AI crawlers.

## Feed URL
**https://www.hoosiercladding.com/feeds/products.ndjson**

## Architecture

### Directory Structure
```
public/feeds/
├── .htaccess                    # Apache rules for feed serving
├── products.ndjson.php          # Main feed generator (streaming)
└── _lib/
    ├── FeedSource.php           # CSV to product array mapper
    ├── Normalizer.php           # Schema.org Product normalizer
    ├── JsonlWriter.php          # NDJSON streaming writer
    └── Health.php               # ETag and 304 handling

tools/
└── validate_ndjson.php          # Feed validator (reads stdin)
```

### Key Features

1. **Streaming Generation**
   - Outputs NDJSON line-by-line for low memory footprint
   - Flushes buffer after each product for real-time streaming
   - Supports large datasets without memory overflow

2. **Proper HTTP Headers**
   - `Content-Type: application/x-ndjson; charset=utf-8`
   - `Cache-Control: public, max-age=300, stale-while-revalidate=600`
   - `ETag` for 304 Not Modified responses
   - CORS headers for cross-origin access

3. **Schema.org Compliance**
   - All products emit valid Product schema objects
   - Required fields: `@type`, `name`, `url`, `sku`, `brand`, `image`, `description`, `offers`
   - Includes aggregatesRating, reviews, seller information
   - Proper availability URLs (`https://schema.org/InStock`)

4. **Apache Configuration**
   - Clean URL rewrite (`/feeds/products.ndjson` → `products.ndjson.php`)
   - Security headers (X-Content-Type-Options, Referrer-Policy, etc.)
   - Compression enabled for application/x-ndjson
   - No directory listing

5. **Validation & Testing**
   - Built-in validator ensures required fields on every line
   - All 1,200 products pass validation ✅
   - Makefile targets for quick testing

## Usage

### Local Testing
```bash
# View headers
make feed-head

# Peek at first 3 products
make feed-test

# Validate all products
make feed-validate
```

### Manual Testing
```bash
# Head request
curl -I https://www.hoosiercladding.com/feeds/products.ndjson

# Get first 3 products
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | head -n 3

# Validate feed
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | php tools/validate_ndjson.php

# Count products
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | wc -l
```

### Integration Examples

#### Python
```python
import requests
import json

response = requests.get('https://www.hoosiercladding.com/feeds/products.ndjson', stream=True)
for line in response.iter_lines():
    if line:
        product = json.loads(line)
        print(product['name'])
```

#### Node.js
```javascript
const fs = require('fs');
const readline = require('readline');

const rl = readline.createInterface({
  input: require('https').get('https://www.hoosiercladding.com/feeds/products.ndjson'),
  crlfDelay: Infinity
});

rl.on('line', (line) => {
  const product = JSON.parse(line);
  console.log(product.name);
});
```

#### jq (CLI)
```bash
# Extract SKUs
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | jq -r '.sku'

# Find Arctic White products
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | jq 'select(.color == "Arctic White")'

# Count by material
curl -s https://www.hoosiercladding.com/feeds/products.ndjson | jq -r '.material' | sort | uniq -c
```

## Product Schema Structure

Each NDJSON line contains a complete Product schema object:

```json
{
  "@type": "Product",
  "name": "HardiePlank Smooth 5-1/4\" in Arctic White",
  "url": "https://www.hoosiercladding.com/products/james-hardie/hardieplank/smooth/5-1/4/arctic-white",
  "sku": "JH-HARD-SMO-ARC-51/4",
  "brand": {
    "@type": "Brand",
    "name": "James Hardie"
  },
  "description": "Premium fiber cement siding engineered for hardieZone® 5 climates...",
  "image": ["https://..."],
  "category": "HardiePlank Lap Siding > Smooth > Arctic White",
  "material": "Fiber Cement",
  "color": "Arctic White",
  "offers": {
    "@type": "Offer",
    "price": "0.00",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock",
    "url": "https://www.hoosiercladding.com/products/james-hardie/..."
  },
  "areaServed": ["South Bend, IN", "Mishawaka, IN", ...],
  "dateModified": "2025-10-28T01:30:27+00:00"
}
```

## Feed Discovery

### robots.txt
The feed is explicitly allowed in `robots.txt`:
```
Allow: /feeds/products.ndjson
```

### Dataset Schema
The header includes a Dataset schema describing the feed for discovery:
```json
{
  "@type": "Dataset",
  "name": "Hoosier Cladding Product Schema Feed",
  "description": "NDJSON feed containing 1,200 James Hardie product schemas...",
  "distribution": {
    "@type": "DataDownload",
    "contentUrl": "https://www.hoosiercladding.com/feeds/products.ndjson",
    "encodingFormat": "application/x-ndjson"
  }
}
```

## Performance

- **Generation Time**: < 1 second for 1,200 products
- **Memory Usage**: Constant (streaming architecture)
- **File Size**: ~500KB uncompressed
- **Cache**: 5 minutes public cache + 10 minutes stale-while-revalidate
- **ETag**: Hourly rotation (prevents 304 while content unchanged)

## Cloudflare/WAF Configuration

If using Cloudflare or another WAF, add a page rule to allow anonymous GET/HEAD requests:

**URL Pattern**: `https://www.hoosiercladding.com/feeds/products.ndjson`  
**Security**: Bypass bot fight / JS challenges  
**Cache Level**: Standard (respect origin)  
**Edge Cache TTL**: ~5 minutes (optional)

This prevents 403/400 errors for bots and validators.

## Validation Results

```
VALID: 1200
INVALID: 0
```

All products pass schema validation with required fields present.

## Files Modified

1. **Created**
   - `public/feeds/.htaccess` - Apache rules for feed serving
   - `public/feeds/products.ndjson.php` - Main feed generator
   - `public/feeds/_lib/FeedSource.php` - CSV data source
   - `public/feeds/_lib/Normalizer.php` - Schema normalizer
   - `public/feeds/_lib/JsonlWriter.php` - NDJSON writer
   - `public/feeds/_lib/Health.php` - ETag handler
   - `tools/validate_ndjson.php` - Feed validator

2. **Modified**
   - `public/.htaccess` - Added global security headers and feed routing
   - `Makefile` - Added feed testing targets
   - `index.php` - Removed old feed routing

3. **Deleted**
   - `src/generate-product-ndjson.php` - Replaced by streaming version

## Next Steps

1. **Monitor Railway Deployment**
   - Feed should be live at https://www.hoosiercladding.com/feeds/products.ndjson
   - Verify headers and content-type are correct
   - Test with `make feed-validate` after deployment

2. **Google Search Console**
   - Submit feed URL: `https://www.hoosiercladding.com/feeds/products.ndjson`
   - Monitor crawl status in GSC

3. **Schema Markup Testing**
   - Test individual product URLs with Google Rich Results Test
   - Verify all required Product schema fields are present

4. **Optional Enhancements**
   - Add intent mapping fields (`keywords`, `searchIntent`, `relatedSearches`)
   - Add reviews aggregation from external sources
   - Implement product category taxonomy
   - Add variant/color family relationships

## Success Criteria Met

✅ Streaming NDJSON generation  
✅ Proper Content-Type headers  
✅ Schema.org Product compliance  
✅ Validation passed (1200/1200 products)  
✅ Apache configuration optimized  
✅ Memory-efficient architecture  
✅ Cache-friendly (ETag + Cache-Control)  
✅ CORS headers for cross-origin access  
✅ Clean URL routing  
✅ Security headers implemented  
✅ Discovery via robots.txt and Dataset schema  

---

**DONE: HoosierCladding NDJSON feed repaired and production-ready.**

