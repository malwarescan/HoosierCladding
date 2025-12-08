<?php
// Contact page - use AdvancedMetaManager for unique metadata
$pageType = 'contact';
include __DIR__ . '/partials/header.php';

// Handle form submission
$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $service = $_POST['service'] ?? '';
    $message_text = $_POST['message'] ?? '';
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message_text)) {
        $error = 'Please fill in all required fields.';
    } else {
        // Here you would typically send an email or save to database
        // For now, we'll just show a success message
        $message = 'Thank you for your inquiry! We will contact you within 24 hours.';
    }
}
?>

<section class="hero">
    <div class="container w-full text-left">
        <div class="hero-content w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="h1">Contact Hoosier Cladding LLC</h1>
            <p class="lead">Get your free estimate for professional siding services in Northern Indiana.</p>
        </div>
    </div>
    
</section>

<section class="section">
    <div class="container w-full text-left">
        <div class="w-full max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sm:p-8">
                    <h2 class="h2 mb-6">Get Your Free Estimate</h2>
                    
                    <?php if ($error): ?>
                        <div class="p-4 rounded-lg border border-red-200 text-red-700 bg-red-50 mb-4">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($message): ?>
                        <div class="p-4 rounded-lg border border-green-200 text-green-700 bg-green-50 mb-4">
                            <?= htmlspecialchars($message) ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                                <input type="text" id="name" name="name" required 
                                       class="block w-full border border-gray-200 rounded-lg py-3 px-4 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" autocomplete="name">
                            </div>
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" id="phone" name="phone" 
                                       class="block w-full border border-gray-200 rounded-lg py-3 px-4 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                       value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>" autocomplete="tel">
                            </div>
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   class="block w-full border border-gray-200 rounded-lg py-3 px-4 text-gray-900 focus:border-blue-500 focus:ring-blue-500"
                                   value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" autocomplete="email">
                        </div>
                        
                        <div>
                            <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service Needed</label>
                            <select id="service" name="service" 
                                    class="block w-full border border-gray-200 rounded-lg py-3 px-4 text-gray-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select a service</option>
                                <option value="installation" <?= ($_POST['service'] ?? '') === 'installation' ? 'selected' : '' ?>>New Siding Installation</option>
                                <option value="repair" <?= ($_POST['service'] ?? '') === 'repair' ? 'selected' : '' ?>>Siding Repair</option>
                                <option value="replacement" <?= ($_POST['service'] ?? '') === 'replacement' ? 'selected' : '' ?>>Siding Replacement</option>
                                <option value="estimate" <?= ($_POST['service'] ?? '') === 'estimate' ? 'selected' : '' ?>>Free Estimate</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea id="message" name="message" rows="5" required 
                                      class="block w-full border border-gray-200 rounded-lg py-3 px-4 text-gray-900 focus:border-blue-500 focus:ring-blue-500"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>
                        
                        <button type="submit" 
                                class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-blue-600 px-6 py-3 text-white font-semibold shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 transition">
                            Send Message
                        </button>
                    </form>
                </div>
                
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6 sm:p-8">
                    <h2 class="h2 mb-6">Contact Information</h2>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.049 3.147a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l3.147 1.049A1 1 0 0119 18.72V21a2 2 0 01-2 2h-1C8.82 23 5 19.18 5 14V6a1 1 0 011-1z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Phone</h3>
                                <p><a href="tel:574-931-2119" class="text-blue-600 hover:text-blue-700">574-931-2119</a></p>
                                <p class="text-sm text-gray-600">Call for immediate assistance</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8-4H8m8 8H8m12 4H4a2 2 0 01-2-2V6a2 2 0 012-2h16a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Email</h3>
                                <p><a href="mailto:David@Hoosier.works" class="text-blue-600 hover:text-blue-700">David@Hoosier.works</a></p>
                                <p class="text-sm text-gray-600">We respond within 24 hours</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">Address</h3>
                                <p>721 Lincoln Way E<br>South Bend, IN 46601</p>
                                <p class="text-sm text-gray-600">Serving all of Northern Indiana</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 p-6 bg-blue-50 rounded-lg border border-blue-100">
                        <h3 class="font-semibold text-lg mb-2">Why Choose Us?</h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li>• Licensed & Insured Contractor</li>
                            <li>• Free Estimates & Consultations</li>
                            <li>• Energy-Efficient Solutions</li>
                            <li>• Strong Warranties on All Work</li>
                            <li>• Local Indiana Business</li>
                            <li>• Experienced with Winter Climate</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/partials/cta-strip.php'; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>