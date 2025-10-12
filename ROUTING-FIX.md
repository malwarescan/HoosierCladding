# Routing Fix - October 12, 2025

## Problem

All pages were redirecting to the homepage instead of loading their content. When accessing URLs like `/contact`, `/service-area`, or `/siding`, the site would only display the homepage.

## Root Cause

The `.htaccess` file was configured to route all requests to `index.php` as a front controller:

```apache
# --- Front controller: everything else to index.php ---
RewriteRule ^ index.php [L]
```

However, `index.php` contained only the homepage HTML with no routing logic. This meant all requests were showing the same homepage content regardless of the URL.

## Solution

### 1. Created Router in `index.php`

Converted `index.php` from a static homepage file to a proper front controller/router that:

- Parses the incoming request URI
- Routes requests to the appropriate PHP file based on the URL path
- Handles 404 errors for non-existent pages
- Supports the matrix landing page routes

**Routing Logic:**

- `/` → `home.php`
- `/contact` → `contact.php`
- `/service-area` → `service-area.php`
- `/siding` → `siding-page.php`
- `/matrix/*` → `matrix-router.php`
- All other URLs → 404 page

### 2. Created `home.php`

Moved the original homepage content from `index.php` to a new `home.php` file. This separates concerns:

- `index.php` = router logic
- `home.php` = homepage content

### 3. Updated `public/index.php`

Updated the public directory's index file to:

- Redirect requests with `/public/` prefix to the root
- Otherwise delegate to the parent router

## Files Changed

1. **`/index.php`** - Converted to router
2. **`/home.php`** - Created with homepage content
3. **`/public/index.php`** - Updated to redirect/delegate to main router
4. **`/router.php`** - Created for PHP built-in development server

## Development Server

### PHP Built-in Server (for local development)

```bash
php -S localhost:8080 router.php
```

The `router.php` file is required for PHP's built-in server since it doesn't process `.htaccess` files. It:
- Serves static files directly
- Routes all other requests through `index.php`

### Apache/Production Server

In production with Apache (or Docker with Apache), the `.htaccess` file handles routing automatically. No additional configuration needed.

## Testing

After this fix, verify that:

- Homepage loads at `/` and `/index.php`
- Contact page loads at `/contact`
- Service area page loads at `/service-area`
- Siding page loads at `/siding` or `/siding-page`
- Matrix pages load at `/matrix/{slug}`
- Non-existent pages show 404 error

**Test Results (October 12, 2025):**
- ✓ Homepage loads correctly
- ✓ Contact page loads correctly
- ✓ Service area page loads correctly
- ✓ 404 handler returns proper status code and page

## Technical Notes

- The router uses a simple `switch` statement for clarity and performance
- Both with and without `.php` extension are supported
- Trailing slashes are normalized
- The router preserves the matrix routing functionality
- 404 pages include helpful navigation options

## Next Steps

If additional pages need to be added to the site:

1. Add the route case to the `switch` statement in `index.php`
2. Create the corresponding PHP file
3. Test the route

Example:
```php
case 'about':
case 'about.php':
    include __DIR__ . '/about.php';
    break;
```

