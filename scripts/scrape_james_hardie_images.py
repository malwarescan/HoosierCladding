#!/usr/bin/env python3
"""
Scrape James Hardie product images from their website
Attempts to find product images by searching their site structure
"""

import csv
import requests
from bs4 import BeautifulSoup
import re
import time

def generate_search_urls(product_type, texture, color):
    """Generate potential image URLs based on product characteristics"""
    urls = []
    
    # Base URL patterns
    base_urls = [
        f"https://www.jameshardie.com/siding-products/{product_type.lower().replace(' ', '-')}",
        f"https://www.jameshardie.com/products/{product_type.lower().replace(' ', '-')}",
        f"https://www.jameshardie.com/residential-siding/{product_type.lower().replace(' ', '-')}",
    ]
    
    # Image URL patterns
    color_slug = color.lower().replace(" ", "-")
    texture_slug = texture.lower().replace(" ", "-")
    
    image_patterns = [
        f"https://www.jameshardie.com/media/images/products/{product_type.lower().replace(' ', '-')}-{texture_slug}-{color_slug}.jpg",
        f"https://www.jameshardie.com/images/products/{product_type.lower().replace(' ', '-')}/{texture_slug}-{color_slug}.jpg",
        f"https://www.jameshardie.com/content/dam/jameshardie/us/en/products/{product_type.lower().replace(' ', '-')}-{texture_slug}-{color_slug}.jpg",
    ]
    
    return base_urls + image_patterns

def check_image_exists(url):
    """Check if an image URL exists"""
    try:
        response = requests.head(url, timeout=5, allow_redirects=True)
        if response.status_code == 200:
            content_type = response.headers.get('content-type', '')
            if 'image' in content_type:
                return True
    except:
        pass
    return False

def main():
    """Main scraping function"""
    input_file = "data/james_hardie_products.csv"
    output_file = "data/james_hardie_products_scraped.csv"
    
    products = []
    found_images = 0
    
    # Read products
    with open(input_file, 'r', encoding='utf-8') as f:
        reader = csv.DictReader(f)
        headers = reader.fieldnames
        
        for i, row in enumerate(reader):
            product_type = row['Product Type']
            texture = row['Texture']
            color = row['Color']
            
            print(f"Processing {i+1}: {color} {texture} {product_type}")
            
            # Try to find image
            potential_urls = generate_search_urls(product_type, texture, color)
            image_found = False
            
            for url in potential_urls:
                if check_image_exists(url):
                    row['Image Path'] = url
                    found_images += 1
                    image_found = True
                    print(f"  ✓ Found: {url}")
                    break
            
            if not image_found:
                row['Image Path'] = ''
                print(f"  ✗ No image found")
            
            products.append(row)
            
            # Rate limiting
            time.sleep(0.5)
    
    # Write results
    with open(output_file, 'w', encoding='utf-8', newline='') as f:
        writer = csv.DictWriter(f, fieldnames=headers)
        writer.writeheader()
        writer.writerows(products)
    
    print(f"\n✓ Scraping complete!")
    print(f"✓ Found {found_images} images out of {len(products)} products")
    print(f"✓ Output: {output_file}")

if __name__ == "__main__":
    main()

