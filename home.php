<?php
// Homepage - use AdvancedMetaManager for unique metadata
$pageType = 'homepage';
include __DIR__ . '/partials/header.php';
?>

<?php include __DIR__ . '/includes/hero_preline.php'; ?>

<!-- Energy Efficiency Section -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-100">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <!-- Left: Image -->
      <div class="order-2 lg:order-1">
        <img src="/images/branded/misc/energy-efficiency-construction.jpeg" 
             alt="Energy-efficient siding installation in Northern Indiana" 
             class="w-full h-auto rounded-2xl shadow-2xl"
             loading="lazy">
      </div>
      
      <!-- Right: Content -->
      <div class="order-1 lg:order-2">
        <span class="inline-flex items-center gap-x-2 py-2 px-4 rounded-full text-sm font-semibold bg-green-100 text-green-800 mb-6">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
          </svg>
          Energy Efficiency Focus
        </span>
        
        <h2 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 mb-6">
          Cut Your Energy Bills by <span class="text-green-600">30%</span>
        </h2>
        
        <p class="text-xl text-gray-700 leading-relaxed mb-8">
          Our insulated siding systems create a thermal barrier that keeps your Northern Indiana home warm in winter and cool in summer. See immediate savings on your utility bills.
        </p>
        
        <div class="space-y-4 mb-8">
          <div class="flex items-start">
            <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Advanced Insulation</h3>
              <p class="text-gray-600">R-5 to R-7 insulation values reduce heat transfer through your walls</p>
            </div>
          </div>
          
          <div class="flex items-start">
            <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Air Sealing</h3>
              <p class="text-gray-600">Eliminates drafts and cold spots throughout your home</p>
            </div>
          </div>
          
          <div class="flex items-start">
            <svg class="w-6 h-6 text-green-500 mr-3 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
              <h3 class="font-semibold text-gray-900 mb-1">Moisture Protection</h3>
              <p class="text-gray-600">Prevents ice damming and moisture damage in Indiana's freeze-thaw cycles</p>
            </div>
          </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-8 py-4 text-white font-semibold hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Calculate Your Savings
          </a>
          <a href="/service-area" class="inline-flex items-center justify-center rounded-lg border-2 border-gray-900 px-8 py-4 text-gray-900 font-semibold hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2 transition-all duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Learn More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "@id": "https://www.hoosiercladding.com/#localbusiness",
  "name": "Hoosier Cladding LLC",
  "description": "Professional siding installation, repair, and replacement services in Michiana. Serving South Bend, Mishawaka, Elkhart, and surrounding areas with quality craftsmanship and local expertise.",
  "url": "https://www.hoosiercladding.com",
  "telephone": "+15749312119",
  "email": "david@hoosier.works",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "South Bend",
    "addressRegion": "IN",
    "addressCountry": "US"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 41.6764,
    "longitude": -86.2520
  },
  "areaServed": [
    {
      "@type": "City",
      "name": "South Bend"
    },
    {
      "@type": "City", 
      "name": "Mishawaka"
    },
    {
      "@type": "City",
      "name": "Elkhart"
    }
  ],
  "serviceArea": {
    "@type": "GeoCircle",
    "geoMidpoint": {
      "@type": "GeoCoordinates",
      "latitude": 41.6764,
      "longitude": -86.2520
    },
    "geoRadius": "50000"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Siding Services",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Siding Installation",
          "description": "Professional installation of vinyl, fiber cement, and other siding materials"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Siding Repair",
          "description": "Expert repair services for damaged siding"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Siding Replacement",
          "description": "Complete siding replacement services"
        }
      }
    ]
  },
  "priceRange": "$$",
  "openingHours": "Mo-Fr 07:00-18:00",
  "sameAs": [
    "https://www.facebook.com/hoosiercladding",
    "https://www.instagram.com/hoosiercladding"
  ]
}
</script>

<!-- Our Siding Services Section -->
<section class="py-16 sm:py-20 lg:py-24">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        Our Siding Services
      </h2>
      <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
      Comprehensive siding solutions for residential and commercial properties across Northern Indiana.
    </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Installation Card -->
      <div class="hs-card group bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-3 mb-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
              </div>
            </div>
            <div class="grow">
              <h3 class="text-xl font-semibold text-gray-900">Installation</h3>
            </div>
          </div>
          
          <p class="text-gray-600 mb-6 leading-relaxed">
          Premium materials selected for Indiana's climate. Precision flashing, house wrap integration, 
          and clean lines backed by strong warranties.
        </p>
          
          <a href="/service-area.php" class="inline-flex items-center gap-x-2 text-sm font-semibold text-blue-600 hover:text-blue-700 group-hover:gap-x-3 transition-all duration-200">
            Learn More
            <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Repair Card -->
      <div class="hs-card group bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-3 mb-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
              </div>
            </div>
            <div class="grow">
              <h3 class="text-xl font-semibold text-gray-900">Repair</h3>
            </div>
          </div>
          
          <p class="text-gray-600 mb-6 leading-relaxed">
          Storm, moisture, or age—targeted repairs to protect the envelope. We color-match and restore performance.
        </p>
          
          <a href="/service-area.php" class="inline-flex items-center gap-x-2 text-sm font-semibold text-blue-600 hover:text-blue-700 group-hover:gap-x-3 transition-all duration-200">
            Learn More
            <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </a>
        </div>
      </div>

      <!-- Replacement Card -->
      <div class="hs-card group bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300">
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-3 mb-4">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
              </div>
            </div>
            <div class="grow">
              <h3 class="text-xl font-semibold text-gray-900">Replacement</h3>
            </div>
          </div>
          
          <p class="text-gray-600 mb-6 leading-relaxed">
          Full tear-offs done right. Code-compliant details, improved energy performance, 
          and modern curb appeal built for Midwest weather.
        </p>
          
          <a href="/service-area.php" class="inline-flex items-center gap-x-2 text-sm font-semibold text-blue-600 hover:text-blue-700 group-hover:gap-x-3 transition-all duration-200">
            Learn More
            <svg class="flex-shrink-0 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Choose Hoosier Cladding Section -->
<section class="py-16 sm:py-20 lg:py-24 bg-gray-50">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        Why Choose Hoosier Cladding?
      </h2>
      <p class="text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
      Trusted by homeowners across Michiana for quality workmanship and reliable service.
    </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Local Expertise -->
      <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6">
          <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Local Expertise</h3>
        <p class="text-gray-600 leading-relaxed">
          We understand Northern Indiana's unique climate challenges—harsh winters, freeze-thaw cycles, 
          and lake-effect weather patterns.
        </p>
      </div>
      
      <!-- Premium Materials -->
      <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-6">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Premium Materials</h3>
        <p class="text-gray-600 leading-relaxed">
          We use only high-quality siding materials from trusted manufacturers, 
          designed for durability and long-term performance.
        </p>
      </div>
      
      <!-- Professional Installation -->
      <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-6">
          <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Professional Installation</h3>
        <p class="text-gray-600 leading-relaxed">
          Our experienced craftsmen ensure proper installation techniques that protect your investment 
          and maintain your home's integrity.
        </p>
      </div>
      
      <!-- Licensed & Insured -->
      <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-6">
          <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-4">Licensed & Insured</h3>
        <p class="text-gray-600 leading-relaxed">
          Fully licensed contractor with comprehensive insurance coverage for your protection and peace of mind.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- What Our Customers Say Section -->
<section class="py-16 sm:py-20 lg:py-24 bg-white">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        What Our Customers Say
      </h2>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
      <!-- Lisa Greene Review -->
      <div class="hs-card bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300" itemscope itemtype="https://schema.org/Review">
        <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
          <meta itemprop="name" content="Hoosier Cladding LLC">
          <meta itemprop="url" content="https://www.hoosiercladding.com">
        </div>
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-1 mb-4">
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
          <blockquote class="text-gray-600 italic mb-6 leading-relaxed" itemprop="reviewBody">
            "Our heating bills dropped right after replacing our old siding. The crew was fast, professional, and cleaned up everything."
          </blockquote>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                <span class="text-blue-600 font-semibold text-sm">LG</span>
              </div>
            </div>
            <div class="ml-3">
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
                <p class="text-sm font-semibold text-gray-900" itemprop="name">Lisa Greene</p>
              </div>
              <p class="text-xs text-gray-500">South Bend, IN</p>
            </div>
          </div>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-09-12">
        </div>
      </div>

      <!-- Mark Jensen Review -->
      <div class="hs-card bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300" itemscope itemtype="https://schema.org/Review">
        <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
          <meta itemprop="name" content="Hoosier Cladding LLC">
          <meta itemprop="url" content="https://www.hoosiercladding.com">
        </div>
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-1 mb-4">
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
          <blockquote class="text-gray-600 italic mb-6 leading-relaxed" itemprop="reviewBody">
            "Winters in South Bend destroyed our last siding—this install already feels tighter and warmer."
          </blockquote>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                <span class="text-green-600 font-semibold text-sm">MJ</span>
              </div>
            </div>
            <div class="ml-3">
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
                <p class="text-sm font-semibold text-gray-900" itemprop="name">Mark Jensen</p>
              </div>
              <p class="text-xs text-gray-500">Mishawaka, IN</p>
            </div>
          </div>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-08-19">
        </div>
      </div>

      <!-- Sarah Williams Review -->
      <div class="hs-card bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300" itemscope itemtype="https://schema.org/Review">
        <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
          <meta itemprop="name" content="Hoosier Cladding LLC">
          <meta itemprop="url" content="https://www.hoosiercladding.com">
        </div>
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-1 mb-4">
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
          <blockquote class="text-gray-600 italic mb-6 leading-relaxed" itemprop="reviewBody">
            "Professional installation and honest pricing. They explained everything and delivered on time."
          </blockquote>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center">
                <span class="text-purple-600 font-semibold text-sm">SW</span>
              </div>
            </div>
            <div class="ml-3">
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
                <p class="text-sm font-semibold text-gray-900" itemprop="name">Sarah Williams</p>
              </div>
              <p class="text-xs text-gray-500">Elkhart, IN</p>
            </div>
          </div>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-10-03">
        </div>
      </div>

      <!-- Michael Rodriguez Review -->
      <div class="hs-card bg-white border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300" itemscope itemtype="https://schema.org/Review">
        <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
          <meta itemprop="name" content="Hoosier Cladding LLC">
          <meta itemprop="url" content="https://www.hoosiercladding.com">
        </div>
        <div class="hs-card-body p-6">
          <div class="flex items-center gap-x-1 mb-4">
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          </div>
          <blockquote class="text-gray-600 italic mb-6 leading-relaxed" itemprop="reviewBody">
            "Excellent communication throughout the project. They kept us informed every step of the way and finished ahead of schedule."
          </blockquote>
          <div class="flex items-center">
            <div class="flex-shrink-0">
              <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                <span class="text-orange-600 font-semibold text-sm">MR</span>
              </div>
            </div>
            <div class="ml-3">
              <div itemprop="author" itemscope itemtype="https://schema.org/Person">
                <p class="text-sm font-semibold text-gray-900" itemprop="name">Michael Rodriguez</p>
              </div>
              <p class="text-xs text-gray-500">Granger, IN</p>
            </div>
          </div>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-11-15">
        </div>
      </div>
    </div>

    <!-- AggregateRating Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "AggregateRating",
      "itemReviewed": {
        "@type": "LocalBusiness",
        "@id": "https://www.hoosiercladding.com/#localbusiness",
        "name": "Hoosier Cladding LLC",
        "url": "https://www.hoosiercladding.com"
      },
      "ratingValue": "5.0",
      "bestRating": "5",
      "worstRating": "1",
      "ratingCount": "47",
      "reviewCount": "43"
    }
    </script>
  </div>
</section>

<!-- Frequently Asked Questions Section -->
<section class="py-16 sm:py-20 lg:py-24 bg-gray-50">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-12">
      <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
        Frequently Asked Questions
      </h2>
    </div>
    
    <div class="max-w-4xl mx-auto">
      <div class="hs-accordion-group">
        <!-- FAQ 1 -->
        <div class="hs-accordion hs-accordion-active:is-active bg-white border border-gray-200 rounded-lg mb-4" id="hs-basic-with-title-and-arrow-stretched-heading-one">
          <button class="hs-accordion-toggle group py-4 px-6 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:ring-1 focus:ring-gray-200" aria-expanded="true" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one">
            <svg class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6"/>
            </svg>
            <svg class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m18 15-6-6-6 6"/>
            </svg>
            How much can new siding save on energy bills?
          </button>
          <div id="hs-basic-with-title-and-arrow-stretched-collapse-one" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one">
            <div class="px-6 pb-4">
              <p class="text-gray-600 leading-relaxed">
          Many homeowners see 10-20% lower heating costs with properly insulated siding. Our insulated vinyl and fiber cement options provide significant R-value improvements that directly impact your energy bills, especially during Indiana's harsh winters.
              </p>
            </div>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="hs-accordion bg-white border border-gray-200 rounded-lg mb-4" id="hs-basic-with-title-and-arrow-stretched-heading-two">
          <button class="hs-accordion-toggle group py-4 px-6 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:ring-1 focus:ring-gray-200" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two">
            <svg class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6"/>
            </svg>
            <svg class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m18 15-6-6-6 6"/>
            </svg>
            What are the signs my home siding needs replacement?
          </button>
          <div id="hs-basic-with-title-and-arrow-stretched-collapse-two" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two">
            <div class="px-6 pb-4">
              <p class="text-gray-600 leading-relaxed">
          Visible gaps, rising energy bills, cold spots, ice damming, warped panels, and moisture damage are key indicators. If your siding is over 15-20 years old or showing these signs, it's time for a professional assessment.
              </p>
            </div>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="hs-accordion bg-white border border-gray-200 rounded-lg mb-4" id="hs-basic-with-title-and-arrow-stretched-heading-three">
          <button class="hs-accordion-toggle group py-4 px-6 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:ring-1 focus:ring-gray-200" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three">
            <svg class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6"/>
            </svg>
            <svg class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m18 15-6-6-6 6"/>
            </svg>
            How long does siding installation take?
          </button>
          <div id="hs-basic-with-title-and-arrow-stretched-collapse-three" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three">
            <div class="px-6 pb-4">
              <p class="text-gray-600 leading-relaxed">
          Most residential siding projects take 3-7 days depending on home size and complexity. We provide detailed timelines during your free estimate and always communicate any schedule changes immediately.
              </p>
            </div>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="hs-accordion bg-white border border-gray-200 rounded-lg mb-4" id="hs-basic-with-title-and-arrow-stretched-heading-four">
          <button class="hs-accordion-toggle group py-4 px-6 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:ring-1 focus:ring-gray-200" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four">
            <svg class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6"/>
            </svg>
            <svg class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m18 15-6-6-6 6"/>
            </svg>
            Do you offer financing options?
          </button>
          <div id="hs-basic-with-title-and-arrow-stretched-collapse-four" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four">
            <div class="px-6 pb-4">
              <p class="text-gray-600 leading-relaxed">
          Yes, we work with several financing partners to offer flexible payment options. Our team can help you find a plan that fits your budget during your free consultation.
              </p>
            </div>
          </div>
        </div>

        <!-- FAQ 5 -->
        <div class="hs-accordion bg-white border border-gray-200 rounded-lg mb-4" id="hs-basic-with-title-and-arrow-stretched-heading-five">
          <button class="hs-accordion-toggle group py-4 px-6 inline-flex items-center gap-x-3 w-full font-semibold text-start text-gray-800 rounded-lg transition hover:text-gray-500 focus:outline-none focus:bg-gray-100 focus:ring-1 focus:ring-gray-200" aria-expanded="false" aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-five">
            <svg class="hs-accordion-active:hidden block flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6"/>
            </svg>
            <svg class="hs-accordion-active:block hidden flex-shrink-0 w-5 h-5 text-gray-600 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m18 15-6-6-6 6"/>
            </svg>
            What siding materials do you recommend for Indiana winters?
          </button>
          <div id="hs-basic-with-title-and-arrow-stretched-collapse-five" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden" aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-five">
            <div class="px-6 pb-4">
              <p class="text-gray-600 leading-relaxed">
          We recommend James Hardie fiber cement and insulated vinyl siding for Indiana's freeze-thaw cycles. Both materials resist warping, cracking, and moisture damage while providing excellent insulation against harsh winter weather.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How much can new siding save on energy bills?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Many homeowners see 10-20% lower heating costs with properly insulated siding. Our insulated vinyl and fiber cement options provide significant R-value improvements that directly impact your energy bills, especially during Indiana's harsh winters."
          }
        },
        {
          "@type": "Question", 
          "name": "What are the signs my home siding needs replacement?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Visible gaps, rising energy bills, cold spots, ice damming, warped panels, and moisture damage are key indicators. If your siding is over 15-20 years old or showing these signs, it's time for a professional assessment."
          }
        },
        {
          "@type": "Question",
          "name": "How long does siding installation take?",
          "acceptedAnswer": {
            "@type": "Answer", 
            "text": "Most residential siding projects take 3-7 days depending on home size and complexity. We provide detailed timelines during your free estimate and always communicate any schedule changes immediately."
          }
        },
        {
          "@type": "Question",
          "name": "Do you offer financing options?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, we work with several financing partners to offer flexible payment options. Our team can help you find a plan that fits your budget during your free consultation."
          }
        },
        {
          "@type": "Question",
          "name": "What siding materials do you recommend for Indiana winters?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We recommend James Hardie fiber cement and insulated vinyl siding for Indiana's freeze-thaw cycles. Both materials resist warping, cracking, and moisture damage while providing excellent insulation against harsh winter weather."
          }
        }
      ]
    }
    </script>
  </div>
</section>

<?php include __DIR__ . '/includes/home_internal_links.html.php'; ?>

<?php include __DIR__ . '/partials/cta-strip.php'; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>

