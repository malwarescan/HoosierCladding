#!/usr/bin/env python3
"""
Add image paths to James Hardie product CSV
Quick-start using CDN images until you can download official ones
"""

import csv
import os

# Base URL for James Hardie CDN images (update with actual URLs)
JH_CDN_BASE = "https://www.jameshardie.com/images/products"

def generate_image_path(product_type, texture, color):
    """Generate image path for a product"""
    # Convert texture names for URLs
    texture_map = {
        "Smooth": "smooth",
        "Select Cedarmill": "cedarmill",
        "Beaded": "beaded",
        "Colonial Roughsawn": "roughsawn",
        "Colonial Smooth": "colonial",
        "Rustic Cedar": "rustic",
        "Sierra 8": "sierra8",
        "Stucco": "stucco",
        "Straight Edge": "straight",
        "Staggered Edge": "staggered",
        "Half Rounds": "rounds",
        "Rustic Grain": "rustic",
        "Cedarmill": "cedarmill",
        "Beaded Porch": "porch",
        "V-Groove": "vgroove",
        "Shiplap": "shiplap",
        "Square Channel": "channel",
        "Reveal Panel": "reveal"
    }
    
    # Convert color names for URLs
    color_slug = color.lower().replace(" ", "-")
    texture_slug = texture_map.get(texture, texture.lower().replace(" ", "-"))
    
    # Map product types to directories
    if "HardiePlank" in product_type:
        return f"{JH_CDN_BASE}/hardieplank/{texture_slug}-{color_slug}.jpg"
    elif "HardiePanel" in product_type:
        return f"{JH_CDN_BASE}/hardiepanel/{texture_slug}-{color_slug}.jpg"
    elif "HardieShingle" in product_type:
        return f"{JH_CDN_BASE}/hardieshingle/{texture_slug}-{color_slug}.jpg"
    elif "HardieTrim" in product_type and "Batten" in product_type:
        return f"{JH_CDN_BASE}/batten/{texture_slug}-{color_slug}.jpg"
    elif "HardieTrim" in product_type:
        return f"{JH_CDN_BASE}/hardietrim/{texture_slug}-{color_slug}.jpg"
    elif "Soffit" in product_type:
        return f"{JH_CDN_BASE}/soffit/{texture_slug}-{color_slug}.jpg"
    elif "Artisan" in product_type:
        return f"{JH_CDN_BASE}/artisan/{texture_slug}-{color_slug}.jpg"
    else:
        return f"{JH_CDN_BASE}/generic-siding.jpg"

def main():
    """Add image paths to product CSV"""
    input_file = "data/james_hardie_products.csv"
    output_file = "data/james_hardie_products_with_images.csv"
    
    products = []
    
    # Read existing CSV
    with open(input_file, 'r', encoding='utf-8') as f:
        reader = csv.DictReader(f)
        headers = reader.fieldnames
        
        for row in reader:
            # Generate image path
            image_path = generate_image_path(
                row['Product Type'],
                row['Texture'],
                row['Color']
            )
            row['Image Path'] = image_path
            products.append(row)
    
    # Add Image Path to headers if not present
    if 'Image Path' not in headers:
        headers = list(headers) + ['Image Path']
    
    # Write updated CSV
    with open(output_file, 'w', encoding='utf-8', newline='') as f:
        writer = csv.DictWriter(f, fieldnames=headers)
        writer.writeheader()
        writer.writerows(products)
    
    print(f"✓ Added image paths to {len(products)} products")
    print(f"✓ Output file: {output_file}")
    print(f"\nNext steps:")
    print(f"1. Verify image URLs are correct")
    print(f"2. Update product template to use Image Path")
    print(f"3. Test product pages with images")
    print(f"4. Download official images from James Hardie Pro Portal")

if __name__ == "__main__":
    main()

