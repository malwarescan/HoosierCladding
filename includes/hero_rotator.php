<?php /* /includes/hero_rotator.php */ ?>
<section class="relative bg-white">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Canonical H1 for SEO/LCP -->
    <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
      South Bend's Premier Siding Company
    </h1>

    <!-- Rotating sub-headlines (user-visible, accessible) -->
    <div class="mt-4">
      <div id="hc-rotator"
           class="relative h-14 sm:h-12 overflow-hidden"
           aria-live="polite"
           aria-atomic="true">
        <span class="sr-only">Local service highlights:</span>

        <!-- Slides: all in DOM, not display:none (use translate/opacity for a11y & SEO) -->
        <div class="hc-rot-slide opacity-100 translate-y-0">Indiana's Premier Siding & Exterior Experts — Serving South Bend and Beyond</div>
        <div class="hc-rot-slide opacity-0 translate-y-3">South Bend's Trusted Siding Contractors — Indiana's Exterior Specialists</div>
        <div class="hc-rot-slide opacity-0 translate-y-3">Energy-Efficient Siding Installation & Repair Across Northern Indiana</div>
        <div class="hc-rot-slide opacity-0 translate-y-3">Quality Craftsmanship for Indiana Homes — Free Local Estimates</div>
        <div class="hc-rot-slide opacity-0 translate-y-3">Fiber Cement & Vinyl Siding Pros in South Bend, IN</div>

        <!-- Controls for users & crawlers (visible, not spam) -->
        <div class="mt-3 flex items-center gap-2 text-sm text-gray-600">
          <button type="button" class="hc-rot-prev px-2 py-1 rounded border hover:bg-gray-50">Prev</button>
          <button type="button" class="hc-rot-next px-2 py-1 rounded border hover:bg-gray-50">Next</button>
          <span class="hc-rot-index text-xs text-gray-500" aria-live="off">(1/5)</span>
        </div>
      </div>
    </div>

    <!-- Primary CTAs -->
    <div class="mt-8 flex flex-wrap gap-3">
      <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
        Get a Free Estimate
      </a>
      <a href="/our-services" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-6 py-3 text-gray-700 hover:bg-gray-50">
        View Services
      </a>
    </div>

    <!-- noscript fallback lists all variants visibly (compliant, not cloaking) -->
    <noscript>
      <div class="mt-6 p-3 border rounded bg-gray-50">
        <strong>Local service highlights:</strong>
        <ul class="list-disc ml-5 mt-2 text-gray-700">
          <li>Indiana's Premier Siding & Exterior Experts — Serving South Bend and Beyond</li>
          <li>South Bend's Trusted Siding Contractors — Indiana's Exterior Specialists</li>
          <li>Energy-Efficient Siding Installation & Repair Across Northern Indiana</li>
          <li>Quality Craftsmanship for Indiana Homes — Free Local Estimates</li>
          <li>Fiber Cement & Vinyl Siding Pros in South Bend, IN</li>
        </ul>
      </div>
    </noscript>
  </div>
</section>

<style>
/* Lightweight transition classes (no Tailwind build required) */
#hc-rotator .hc-rot-slide {
  position: absolute;
  left: 0; right: 0;
  transition: opacity .45s ease, transform .45s ease;
  will-change: transform, opacity;
}
#hc-rotator .opacity-0 { opacity: 0; }
#hc-rotator .opacity-100 { opacity: 1; }
#hc-rotator .translate-y-0 { transform: translateY(0); }
#hc-rotator .translate-y-3 { transform: translateY(0.5rem); }
</style>

<script>
(function(){
  const root = document.getElementById('hc-rotator');
  if(!root) return;
  const slides = Array.from(root.querySelectorAll('.hc-rot-slide'));
  const btnPrev = root.querySelector('.hc-rot-prev');
  const btnNext = root.querySelector('.hc-rot-next');
  const idxEl   = root.querySelector('.hc-rot-index');
  let i = 0, t;

  function show(n){
    slides.forEach((el, k)=>{
      const active = k === n;
      el.classList.toggle('opacity-100', active);
      el.classList.toggle('translate-y-0', active);
      el.classList.toggle('opacity-0', !active);
      el.classList.toggle('translate-y-3', !active);
      el.setAttribute('aria-hidden', active ? 'false' : 'true');
      el.tabIndex = active ? 0 : -1;
    });
    if (idxEl) idxEl.textContent = `(${n+1}/${slides.length})`;
    i = n;
  }

  function next(){ show((i+1) % slides.length); }
  function prev(){ show((i-1+slides.length) % slides.length); }

  btnNext && btnNext.addEventListener('click', ()=>{ next(); reset(); });
  btnPrev && btnPrev.addEventListener('click', ()=>{ prev(); reset(); });

  let intervalMs = 4000;
  function reset(){ clearInterval(t); t = setInterval(next, intervalMs); }
  show(0); t = setInterval(next, intervalMs);

  // Pause on hover for UX
  root.addEventListener('mouseenter', ()=> clearInterval(t));
  root.addEventListener('mouseleave', reset);
})();
</script>
