<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design System Preview | Hoosier Cladding LLC</title>
    <meta name="description" content="Preview of the Hoosier Cladding design system components and tokens.">
    <link rel="stylesheet" href="/styles/output.css">
</head>
<body>
    <div class="container mx-auto px-6 py-12">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold mb-4">Hoosier Cladding Design System</h1>
            <p class="text-lg text-gray-600">Built for Indiana Weather - VSI-Certified - James Hardie Preferred</p>
        </div>

        <!-- Color Palette -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Color Palette</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="w-full h-16 bg-blue-900 rounded mb-2"></div>
                    <p class="text-sm font-semibold">Primary</p>
                    <code class="text-xs text-gray-500">#0E3A5B</code>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="w-full h-16 bg-orange-600 rounded mb-2"></div>
                    <p class="text-sm font-semibold">Accent</p>
                    <code class="text-xs text-gray-500">#C66A19</code>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="w-full h-16 bg-gray-900 rounded mb-2"></div>
                    <p class="text-sm font-semibold">Ink</p>
                    <code class="text-xs text-gray-500">#0B1320</code>
                </div>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="w-full h-16 bg-gray-600 rounded mb-2"></div>
                    <p class="text-sm font-semibold">Slate</p>
                    <code class="text-xs text-gray-500">#445163</code>
                </div>
            </div>
        </section>

        <!-- Typography -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Typography</h2>
            <div class="space-y-6">
                <div>
                    <h1 class="text-4xl font-bold">Heading 1 - Built for Indiana Weather</h1>
                    <code class="text-sm text-gray-500">48px / Plus Jakarta Sans / 700</code>
                </div>
                <div>
                    <h2 class="text-3xl font-bold">Heading 2 - Professional Siding Services</h2>
                    <code class="text-sm text-gray-500">36px / Plus Jakarta Sans / 700</code>
                </div>
                <div>
                    <h3 class="text-2xl font-semibold">Heading 3 - VSI-Certified Vinyl</h3>
                    <code class="text-sm text-gray-500">30px / Plus Jakarta Sans / 600</code>
                </div>
                <div>
                    <p class="text-lg">Lead paragraph text - James Hardie and VSI-Certified Vinyl installs by a local Michiana crew. No subs.</p>
                    <code class="text-sm text-gray-500">18px / Inter / 400</code>
                </div>
                <div>
                    <p class="text-base">Body text - We understand Northern Indiana's unique climate challenges, from harsh winters to humid summers, and select materials that perform.</p>
                    <code class="text-sm text-gray-500">16px / Inter / 400</code>
                </div>
            </div>
        </section>

        <!-- Buttons -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Buttons</h2>
            <div class="flex flex-wrap gap-4">
                <button class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700 transition">Primary Button</button>
                <button class="border-2 border-blue-600 text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition">Secondary Button</button>
                <button class="bg-orange-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-orange-700 transition">Accent Button</button>
            </div>
        </section>

        <!-- Trust Chips -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Trust Chips</h2>
            <div class="flex flex-wrap gap-3">
                <div class="bg-green-100 text-green-800 px-4 py-2 rounded-full text-sm font-semibold">
                    VSI-Certified Vinyl
                </div>
                <div class="bg-orange-100 text-orange-800 px-4 py-2 rounded-full text-sm font-semibold">
                    James Hardie Preferred
                </div>
                <div class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-semibold">
                    Local Michiana Crew
                </div>
                <div class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-semibold">
                    Licensed & Insured
                </div>
            </div>
        </section>

        <!-- Cards -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Cards</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-2">Service Card</h3>
                    <p class="text-gray-600">Professional siding installation with premium materials designed for Indiana's climate.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow border-2 border-blue-200 hover:border-blue-400 transition">
                    <h3 class="text-lg font-semibold">South Bend</h3>
                    <p class="text-sm text-gray-500">View local work</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <span class="text-blue-600 font-bold">Features</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Icon Card</h3>
                    <p class="text-gray-600">Cards with icons for service categories and features.</p>
                </div>
            </div>
        </section>

    </div>
</body>
</html>
