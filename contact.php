<?php
$pageTitle = "Contact Us - Professional Siding Services | Hoosier Cladding LLC";
$pageDescription = "Contact Hoosier Cladding LLC for professional siding installation, repair, and replacement services. Call 574-931-2119 or email David@Hoosier.works for a free estimate.";
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
    <div class="container">
        <div class="hero-content">
            <h1 class="h1">Contact Hoosier Cladding LLC</h1>
            <p class="hero-description">Get your free estimate for professional siding services in Northern Indiana</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div>
                <h2 class="h2 mb-6">Get Your Free Estimate</h2>
                
                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($message): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                        <input type="text" id="name" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" id="email" name="email" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    </div>
                    
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="tel" id="phone" name="phone" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                    </div>
                    
                    <div>
                        <label for="service" class="block text-sm font-medium text-gray-700 mb-2">Service Needed</label>
                        <select id="service" name="service" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select a service</option>
                            <option value="installation" <?= ($_POST['service'] ?? '') === 'installation' ? 'selected' : '' ?>>New Siding Installation</option>
                            <option value="repair" <?= ($_POST['service'] ?? '') === 'repair' ? 'selected' : '' ?>>Siding Repair</option>
                            <option value="replacement" <?= ($_POST['service'] ?? '') === 'replacement' ? 'selected' : '' ?>>Siding Replacement</option>
                            <option value="estimate" <?= ($_POST['service'] ?? '') === 'estimate' ? 'selected' : '' ?>>Free Estimate</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea id="message" name="message" rows="4" required 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        Send Message
                    </button>
                </form>
            </div>
            
            <div>
                <h2 class="h2 mb-6">Contact Information</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="icon">P</div>
                        <div>
                            <h3 class="font-semibold text-lg">Phone</h3>
                            <p><a href="tel:574-931-2119" class="text-blue-600 hover:text-blue-800">574-931-2119</a></p>
                            <p class="text-sm text-gray-600">Call for immediate assistance</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="icon">E</div>
                        <div>
                            <h3 class="font-semibold text-lg">Email</h3>
                            <p><a href="mailto:David@Hoosier.works" class="text-blue-600 hover:text-blue-800">David@Hoosier.works</a></p>
                            <p class="text-sm text-gray-600">We respond within 24 hours</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start space-x-4">
                        <div class="icon">A</div>
                        <div>
                            <h3 class="font-semibold text-lg">Address</h3>
                            <p>721 Lincoln Way E<br>South Bend, IN 46601</p>
                            <p class="text-sm text-gray-600">Serving all of Northern Indiana</p>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 p-6 bg-blue-50 rounded-lg">
                    <h3 class="font-semibold text-lg mb-2">Why Choose Us?</h3>
                    <ul class="space-y-2 text-sm">
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
</section>

<?php include __DIR__ . '/partials/cta-strip.php'; ?>
<?php include __DIR__ . '/partials/footer.php'; ?>