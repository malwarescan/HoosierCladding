#!/bin/bash

echo "=== DEPLOYMENT DEBUG INFO ==="
echo "Current directory: $(pwd)"
echo "PHP version: $(php --version 2>/dev/null || echo 'PHP not found')"
echo "Node version: $(node --version 2>/dev/null || echo 'Node not found')"
echo "Files in directory:"
ls -la
echo "=== END DEBUG INFO ==="

# This is a PHP application, not Node.js
echo "This is a PHP website. Starting Apache..."
apache2-foreground
