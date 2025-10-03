<?php
/**
 * Style Preview Page - Hoosier Cladding Design System
 * Showcases all design tokens and components
 */

require_once __DIR__ . '/../bootstrap.php';

use HoosierCladding\Strings;
use HoosierCladding\Schema;

// Page variables
$pageTitle = 'Design System Preview | ' . Strings::COMPANY_NAME;
$pageDescription = 'Preview of the Hoosier Cladding design system components and tokens.';
$pagePath = '/style-preview';

// Build schemas
$schemas = [
    Schema::buildLocalBusiness(),
    Schema::buildWebSite()
];

// Include header
require __DIR__ . '/header.php';
?>

<div class="section">
    <div class="container">
        <div class="text-center mb-8">
            <h1 class="h1 mb-4">Hoosier Cladding Design System</h1>
            <p class="lead">Built for Indiana Weather - VSI-Certified - James Hardie Preferred</p>
        </div>

        <!-- Color Palette -->
        <section class="mb-12">
            <h2 class="h2 mb-6">Color Palette</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="card">
                    <div class="w-full h-16 bg-primary rounded mb-2"></div>
                    <p class="small font-semibold">Primary</p>
                    <code class="small text-text-muted">#0E3A5B</code>
                </div>
                <div class="card">
                    <div class="w-full h-16 bg-accent rounded mb-2"></div>
                    <p class="small font-semibold">Accent</p>
                    <code class="small text-text-muted">#C66A19</code>
                </div>
                <div class="card">
                    <div class="w-full h-16 bg-text-primary rounded mb-2"></div>
                    <p class="small font-semibold">Ink</p>
                    <code class="small text-text-muted">#0B1320</code>
                </div>
                <div class="card">
                    <div class="w-full h-16 bg-text-secondary rounded mb-2"></div>
                    <p class="small font-semibold">Slate</p>
                    <code class="small text-text-muted">#445163</code>
                </div>
            </div>
        </section>

        <!-- Typography -->
        <section class="mb-12">
            <h2 class="h2 mb-6">Typography</h2>
            <div class="space-y-6">
                <div>
                    <h1 class="h1">Heading 1 - Built for Indiana Weather</h1>
                    <code class="small text-text-muted">48px / Plus Jakarta Sans / 700</code>
                </div>
                <div>
                    <h2 class="h2">Heading 2 - Professional Siding Services</h2>
                    <code class="small text-text-muted">36px / Plus Jakarta Sans / 700</code>
                </div>
                <div>
                    <h3 class="h3">Heading 3 - VSI-Certified Vinyl</h3>
                    <code class="small text-text-muted">30px / Plus Jakarta Sans / 600</code>
                </div>
                <div>
                    <p class="lead">Lead paragraph text - James Hardie and VSI-Certified Vinyl installs by a local Michiana crew. No subs.</p>
                    <code class="small text-text-muted">18px / Inter / 400</code>
                </div>
                <div>
                    <p class="body">Body text - We understand Northern Indiana's unique climate challenges, from harsh winters to humid summers, and select materials that perform.</p>
                    <code class="small text-text-muted">16px / Inter / 400</code>
                </div>
            </div>
        </section>

        <!-- Buttons -->
        <section class="mb-12">
            <h2 class="h2 mb-6">Buttons</h2>
            <div class="flex flex-wrap gap-4">
                <button class="btn btn-primary">Primary Button</button>
                <button class="btn btn-secondary">Secondary Button</button>
                <button class="btn btn-accent">Accent Button</button>
            </div>
        </section>

        <!-- Trust Chips -->
        <section class="mb-12">
            <h2 class="h2 mb-6">Trust Chips</h2>
            <div class="flex flex-wrap gap-3">
                <div class="chip chip-success">
                    <span>VSI-Certified Vinyl</span>
                </div>
                <div class="chip chip-accent">
                    <span>James Hardie Preferred</span>
                </div>
                <div class="chip">
                    <span>Local Michiana Crew</span>
                </div>
                <div class="chip">
                    <span>Licensed & Insured</span>
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section class="mb-12">
            <h2 class="h2 mb-6">Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="card">
                    <h3 class="h3 mb-2">Service Card</h3>
                    <p class="body">Professional siding installation with premium materials designed for Indiana's climate.</p>
                </div>
                <div class="city-card">
                    <div class="h5">South Bend</div>
                    <div class="small">View local work</div>
                </div>
                <div class="card">
                    <div class="icon">Features</div>
                    <h3 class="h3 mb-2">Icon Card</h3>
                    <p class="body">Cards with icons for service categories and features.</p>
                </div>
            </div>
        </section>

    </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>