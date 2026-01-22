<?php
// Contact Modal Component
// All contact buttons should trigger this modal
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
?>
<!-- Contact Modal -->
<div id="contactModal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm">
            <!-- Header -->
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200">
                <h3 class="font-bold text-gray-800">Contact Us</h3>
                <button type="button" class="flex justify-center items-center size-7 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" onclick="closeContactModal()">
                    <span class="sr-only">Close</span>
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m18 6-12 12"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Body -->
            <div class="p-4 sm:p-6">
                <p class="text-gray-600 mb-6 text-center">Choose how you'd like to contact us:</p>
                
                <div class="space-y-4">
                    <!-- Phone Option -->
                    <a href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>" 
                       class="flex items-center gap-x-4 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-600 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-200">
                                <svg class="w-6 h-6 text-blue-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">Contact by Phone</h4>
                            <p class="text-sm text-gray-600 mt-1"><?= $PHONE ?></p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    
                    <!-- Email Option -->
                    <a href="mailto:<?= $EMAIL ?>" 
                       class="flex items-center gap-x-4 p-4 border-2 border-gray-200 rounded-lg hover:border-blue-600 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-blue-600 transition-colors duration-200">
                                <svg class="w-6 h-6 text-green-600 group-hover:text-white transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200">Contact by Email</h4>
                            <p class="text-sm text-gray-600 mt-1"><?= $EMAIL ?></p>
                        </div>
                        <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Contact Modal Functions
function openContactModal() {
    const modal = document.getElementById('contactModal');
    if (modal) {
        modal.classList.remove('hidden');
        // Add backdrop
        const backdrop = document.createElement('div');
        backdrop.id = 'contactModalBackdrop';
        backdrop.className = 'fixed top-0 start-0 w-full h-full bg-gray-900 bg-opacity-50 z-[79]';
        backdrop.onclick = closeContactModal;
        document.body.appendChild(backdrop);
        document.body.style.overflow = 'hidden';
    }
}

function closeContactModal() {
    const modal = document.getElementById('contactModal');
    const backdrop = document.getElementById('contactModalBackdrop');
    if (modal) {
        modal.classList.add('hidden');
    }
    if (backdrop) {
        backdrop.remove();
    }
    document.body.style.overflow = '';
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeContactModal();
    }
});
</script>
