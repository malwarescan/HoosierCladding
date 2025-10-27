# James Hardie Product Image Sourcing Guide

## Overview
As a certified James Hardie installer, you have legal rights to use James Hardie product images for marketing and sales purposes on your website.

## Official Image Sources

### 1. James Hardie Pro Portal
**Access**: https://www.jameshardie.com/for-pros/
- Login with your distributor credentials
- Access high-resolution product images
- Download official product photography
- Get texture samples and color swatches

### 2. James Hardie Media Library
**Access**: Contact your James Hardie representative
- High-resolution product images
- Installation photos
- Lifestyle photography
- Texture detail shots

### 3. James Hardie Website (Public Use)
**Access**: https://www.jameshardie.com
- Product images on public pages
- Color visualizers
- Texture examples
- Can be used with attribution

## Image Types Needed

### Product Images (Required)
- **HardiePlank** - Texture samples (Smooth, Cedarmill, Beaded, etc.)
- **HardiePanel** - Vertical panel samples
- **HardieShingle** - Shingle variations
- **HardieTrim** - Board samples
- **HardieSoffit** - Soffit styles
- **Artisan Collection** - Premium product images

### Color Variations
- Arctic White
- Cobble Stone
- Navajo Beige
- Monterey Taupe
- Khaki Brown
- Timber Bark
- Pearl Gray
- Light Mist
- Gray Slate
- Night Gray
- Boothbay Blue
- Evening Blue
- Aged Pewter
- Iron Gray
- Mountain Sage

## Legal Usage Rights

### ✅ Allowed as Certified Installer
- Using product images on your website
- Marketing materials
- Social media posts
- Email campaigns
- Local advertising

### ⚠️ Attribution Required
- Include "James Hardie" brand name
- Proper product name attribution
- Don't alter product colors significantly

### ❌ Not Allowed
- Claiming James Hardie endorsement (unless approved)
- Altering product specifications
- Using competitor product images

## Recommended Image Strategy

### Option 1: Use CDN Images (Fastest)
James Hardie hosts images on their CDN. You can reference them directly:

```html
<img src="https://www.jameshardie.com/images/products/hardieplank-smooth-arctic-white.jpg" 
     alt="HardiePlank Smooth Arctic White"
     loading="lazy">
```

**Pros**: 
- No storage costs
- Always up-to-date
- Fast delivery

**Cons**:
- Dependency on their CDN
- No control over changes

### Option 2: Download and Host Yourself (Recommended)
1. Download images from Pro Portal
2. Optimize for web (WebP format)
3. Host on your server
4. Update product CSV with image paths

**Pros**:
- Full control
- Faster loading
- Can optimize images
- No external dependencies

**Cons**:
- Storage space needed
- You maintain updates

### Option 3: Hybrid Approach
- Use CDN for texture samples
- Host color variations yourself
- Combine for best performance

## Image Specifications

### Recommended Dimensions
- **Product Hero**: 1200×800px (16:9 ratio)
- **Thumbnail**: 400×300px (4:3 ratio)
- **Product Detail**: 800×600px

### File Formats
- **Primary**: WebP (best compression)
- **Fallback**: JPG (for older browsers)
- **SVG**: For icons and logos

### Optimization
- Compress images to 80-85% quality
- Use lazy loading
- Implement responsive images (srcset)
- Leverage browser caching

## Implementation Steps

### 1. Contact James Hardie Representative
Request access to:
- Pro Portal login
- Media library access
- High-resolution images
- Usage guidelines document

### 2. Download Product Images
For each product type:
- HardiePlank (6 textures × 15 colors = 90 images)
- HardiePanel (4 textures × 15 colors = 60 images)
- HardieShingle (3 types × 15 colors = 45 images)
- HardieTrim (2 textures × 15 colors = 30 images)
- Batten Boards (2 textures × 15 colors = 30 images)
- Soffit (4 styles × 15 colors = 60 images)
- Artisan (4 styles × 15 colors = 60 images)

**Total**: ~375 product images needed

### 3. Organize Image Files
Create directory structure:
```
public/images/products/
├── hardieplank/
│   ├── smooth/
│   │   ├── arctic-white.webp
│   │   ├── cobble-stone.webp
│   │   └── ...
│   ├── cedarmill/
│   └── ...
├── hardiepanel/
├── hardieshingle/
├── hardietrim/
├── batten/
├── soffit/
└── artisan/
```

### 4. Update Product CSV
Add image path column to `data/james_hardie_products.csv`:
```csv
Product Type,Product Name,...,Image Path
HardiePlank Lap Siding,HardiePlank Smooth 5-1/4" in Arctic White,...,/public/images/products/hardieplank/smooth/arctic-white.webp
```

### 5. Update Product Template
Modify `templates/james-hardie-product.php` to display product images:
```php
<img src="<?= htmlspecialchars($product['Image Path']) ?>" 
     alt="<?= htmlspecialchars($product['Product Name']) ?>"
     class="w-full h-auto rounded-lg"
     loading="lazy">
```

## Quick Start (CDN Method)

If you need images immediately, use James Hardie's CDN:

### Example Image URLs
```
https://www.jameshardie.com/images/products/hardieplank/smooth-arctic-white.jpg
https://www.jameshardie.com/images/products/hardieplank/cedarmill-cobble-stone.jpg
https://www.jameshardie.com/images/products/hardiepanel/smooth-navy-beige.jpg
```

### Update Product Schema
Add image URLs to Product schema markup:
```json
{
  "@type": "Product",
  "name": "HardiePlank Smooth Arctic White",
  "image": "https://www.jameshardie.com/images/products/hardieplank/smooth-arctic-white.jpg"
}
```

## Next Steps

1. **Contact James Hardie**: Get Pro Portal access
2. **Download Images**: Start with top 50 products
3. **Optimize Images**: Convert to WebP format
4. **Update CSV**: Add image paths
5. **Update Template**: Display product images
6. **Test**: Verify images load correctly
7. **Scale**: Add remaining products

## Image Optimization Tools

- **Squoosh**: https://squoosh.app (online image optimizer)
- **ImageMagick**: Command-line tool
- **WebP Converter**: Browser extension or tool
- **Railway**: Can run image optimization scripts

## Estimated Timeline

- **Week 1**: Get Pro Portal access, download initial images
- **Week 2**: Optimize and organize images
- **Week 3**: Update CSV and product templates
- **Week 4**: Test and deploy

---

**Note**: Always follow James Hardie's brand guidelines and trademark usage policies. As a certified installer, you have broad usage rights, but proper attribution is required.

