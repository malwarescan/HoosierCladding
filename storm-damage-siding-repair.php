<?php
// Storm Damage Siding Repair Hub - Cluster D Authority Page
// This is the central authority page for all storm damage, insurance, and repair intent
$pageTitle = "Storm Damage Siding Repair in Northern Indiana | Insurance Claims";
$pageDescription = "Expert storm damage siding repair in Northern Indiana. Hail, wind, and weather damage restoration. Insurance claim assistance. Licensed contractors. Free inspections. Call (574) 931-2119.";
$pageType = 'service';
include __DIR__ . '/partials/header.php';
?>

<section class="py-12 bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900 mb-6">
            Storm Damage Siding Repair in Northern Indiana
        </h1>
        <p class="text-xl text-gray-700 mb-8 max-w-3xl">
            Expert storm damage siding repair and restoration services for Northern Indiana homes. We handle hail damage, wind damage, and insurance claims with licensed contractors and free inspections.
        </p>
        <div class="flex flex-wrap gap-4">
            <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-8 py-4 text-white font-semibold hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                Call (574) 931-2119
            </button>
            <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center rounded-lg border-2 border-blue-600 px-8 py-4 text-blue-600 font-semibold hover:bg-blue-50 transition-all duration-200">
                Free Inspection
            </button>
        </div>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Storm Damage Siding Repair Services</h2>
                <p class="text-lg text-gray-700 mb-6">
                    Northern Indiana experiences severe weather including hail, high winds, and freeze-thaw cycles that can damage your home's siding. Our licensed contractors specialize in storm damage assessment, insurance claim assistance, and professional siding repair.
                </p>
                
                <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Insurance Claim Assistance</h3>
                    <p class="text-gray-700">
                        We work directly with your insurance company to document damage, provide detailed estimates, and ensure your claim is processed correctly. Our experience with insurance claims helps maximize your coverage.
                    </p>
                </div>
                
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Types of Storm Damage We Repair</h3>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-gray-700"><strong>Hail Damage:</strong> Dents, cracks, and punctures in vinyl and fiber cement siding</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-gray-700"><strong>Wind Damage:</strong> Loose panels, missing sections, and structural damage</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-gray-700"><strong>Water Damage:</strong> Moisture infiltration, rot, and mold behind damaged siding</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-gray-700"><strong>Freeze-Thaw Damage:</strong> Cracking and warping from Indiana's harsh winters</span>
                    </li>
                </ul>
            </div>
            
            <div>
                <div class="bg-white border-2 border-gray-200 rounded-2xl p-8 shadow-lg mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Get Your Free Storm Damage Inspection</h3>
                    <p class="text-gray-700 mb-6">We'll assess your damage, document it for insurance, and provide a detailed repair estimate.</p>
                    <div class="space-y-3 mb-6">
                        <p class="text-gray-700">
                            <strong>Phone:</strong> 
                            <a href="tel:5749312119" class="text-blue-600 hover:text-blue-800">(574) 931-2119</a>
                        </p>
                        <p class="text-gray-700">
                            <strong>Email:</strong> 
                            <a href="mailto:David@Hoosier.works" class="text-blue-600 hover:text-blue-800">David@Hoosier.works</a>
                        </p>
                    </div>
                    <button type="button" onclick="openContactModal()" class="inline-flex items-center justify-center w-full rounded-lg bg-blue-600 px-8 py-4 text-white font-semibold hover:bg-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                        Request Free Inspection
                    </button>
                </div>
                
                <div class="flex flex-wrap gap-3">
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Licensed & Insured
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        Insurance Claims
                    </span>
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        Fast Response
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-16 bg-gray-50">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Why Choose Us for Storm Damage Repair?</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Insurance Expertise</h3>
                <p class="text-gray-700">We understand insurance claim processes and work with all major insurance companies to ensure your claim is handled correctly.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Fast Response</h3>
                <p class="text-gray-700">Storm damage requires quick action to prevent further issues. We provide same-day inspections and emergency repairs when needed.</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">Complete Restoration</h3>
                <p class="text-gray-700">From damage assessment to final installation, we handle the entire repair process with quality materials and expert craftsmanship.</p>
            </div>
        </div>
    </div>
</section>

<!-- Internal Link to Related Services (Authority Hierarchy) -->
<section class="py-16 bg-white border-t border-gray-200">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Related Services</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="/house-siding-replacement" class="text-blue-600 hover:text-blue-800">House Siding Replacement</a>
                </h3>
                <p class="text-gray-700 mb-4">Complete siding replacement services for Northern Indiana homes. Professional installation with quality materials.</p>
                <a href="/house-siding-replacement" class="text-blue-600 font-semibold hover:underline">Learn More →</a>
            </div>
            <div class="border border-gray-200 rounded-lg p-6 hover:shadow-md transition-shadow">
                <h3 class="text-xl font-semibold text-gray-900 mb-3">
                    <a href="/vinyl-siding-michiana-south-bend" class="text-blue-600 hover:text-blue-800">Vinyl Siding Installation</a>
                </h3>
                <p class="text-gray-700 mb-4">Expert vinyl siding installation and repair services in South Bend and Michiana. Energy-efficient options available.</p>
                <a href="/vinyl-siding-michiana-south-bend" class="text-blue-600 font-semibold hover:underline">Learn More →</a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/cta-strip.php'; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>
