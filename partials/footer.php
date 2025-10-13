<?php
// Footer partial
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
$ADDRESS = '721 Lincoln Way E, South Bend, IN 46601';
$SITE = 'Hoosier Cladding LLC';
?>
<footer class="footer">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4"><?= $SITE ?></h3>
                <p class="text-gray-600 mb-4"><?= $ADDRESS ?></p>
                <div class="space-y-2">
                    <p><a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" class="text-blue-600 hover:text-blue-800"><?= $PHONE ?></a></p>
                    <p><a href="mailto:<?= $EMAIL ?>" class="text-blue-600 hover:text-blue-800"><?= $EMAIL ?></a></p>
                </div>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Services</h4>
                <ul class="space-y-2">
                    <li><a href="/siding/installation" class="text-gray-600 hover:text-blue-600">Siding Installation</a></li>
                    <li><a href="/siding/repair" class="text-gray-600 hover:text-blue-600">Siding Repair</a></li>
                    <li><a href="/siding/replacement" class="text-gray-600 hover:text-blue-600">Siding Replacement</a></li>
                </ul>
            </div>
            
            <div>
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-600 hover:text-blue-600">Home</a></li>
                    <li><a href="/service-area" class="text-gray-600 hover:text-blue-600">Service Area</a></li>
                    <li><a href="/contact" class="text-gray-600 hover:text-blue-600">Contact</a></li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-200 mt-8 pt-8 text-center">
            <p>&copy; <?= date('Y') ?> <?= $SITE ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- Preline UI JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/preline@2.3.0/dist/preline.min.js"></script>