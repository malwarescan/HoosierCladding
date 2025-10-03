<?php
// CTA Strip - Call to Action Section
$PHONE = '574-931-2119';
$EMAIL = 'David@Hoosier.works';
$ADDRESS = '721 Lincoln Way E, South Bend, IN 46601';
?>
<section class="cta-band">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
            <div class="flex flex-col items-center">
                <div class="icon">P</div>
                <div class="font-semibold text-lg"><?= $PHONE ?></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="icon">E</div>
                <div class="font-semibold text-lg"><?= $EMAIL ?></div>
            </div>
            <div class="flex flex-col items-center">
                <div class="icon">A</div>
                <div class="font-semibold text-lg"><?= $ADDRESS ?></div>
            </div>
        </div>
        
        <div class="text-center mt-8">
            <a href="/contact" class="btn btn-primary">Get Free Estimate</a>
        </div>
    </div>
</section>





