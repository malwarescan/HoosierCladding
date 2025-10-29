#!/bin/bash
# Test script to verify favicon files are served correctly

BASE_URL="${1:-http://localhost:8080}"
echo "Testing favicon files at: $BASE_URL"
echo ""

files=(
    "/favicon.ico"
    "/favicon-16x16.png"
    "/favicon-32x32.png"
    "/favicon.svg"
    "/apple-touch-icon.png"
    "/android-chrome-192x192.png"
    "/android-chrome-512x512.png"
    "/site.webmanifest"
)

for file in "${files[@]}"; do
    echo -n "Testing $file ... "
    response=$(curl -s -o /dev/null -w "%{http_code}" "$BASE_URL$file")
    if [ "$response" = "200" ]; then
        echo "✅ OK ($response)"
    else
        echo "❌ FAILED ($response)"
    fi
done

echo ""
echo "Testing content-type headers:"
curl -sI "$BASE_URL/favicon.ico" | grep -i "content-type" || echo "No content-type header"
curl -sI "$BASE_URL/favicon-32x32.png" | grep -i "content-type" || echo "No content-type header"
curl -sI "$BASE_URL/site.webmanifest" | grep -i "content-type" || echo "No content-type header"
