<?php /* /includes/hero_preline.php */ ?>
<section class="relative overflow-hidden bg-white">
  <!-- Background Image -->
  <div class="absolute inset-0 top-0 z-0 pointer-events-none">
    <img src="/public/images/hero-section/siding-repair-home-hoosier-cladding.png" 
         alt="Professional siding repair and installation services" 
         class="w-full h-full object-cover opacity-25"
         loading="eager">
    <div class="absolute inset-0 bg-gradient-to-r from-white/70 via-white/60 to-white/50"></div>
  </div>
  <div class="relative z-10 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pt-safe pt-16 sm:pt-20 pb-safe">
    <div class="flex flex-col gap-4 sm:gap-6">
      <!-- Copy Section -->
      <div class="flex flex-col justify-center text-center lg:text-left">

        <!-- Main Headline -->
        <h1 class="text-3xl xs:text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight text-gray-900 leading-tight mb-3 sm:mb-6">
          <span class="text-blue-600">South Bend's</span><br>
          Premier Siding Experts
        </h1>

        <!-- Rotating Sub-headlines -->
        <div class="mb-3 sm:mb-6">
          <div id="hc-rotator"
               class="relative h-12 sm:h-16 overflow-hidden"
               aria-live="polite"
               aria-atomic="true">
            <span class="sr-only">Local service highlights:</span>

            <!-- Slides: all in DOM, not display:none (use translate/opacity for a11y & SEO) -->
            <div class="hc-rot-slide opacity-100 translate-y-0 text-base xs:text-lg sm:text-xl text-gray-600 leading-relaxed">Indiana's Premier Siding & Exterior Experts — Serving South Bend and Beyond</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-base xs:text-lg sm:text-xl text-gray-600 leading-relaxed">South Bend's Trusted Siding Contractors — Indiana's Exterior Specialists</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-base xs:text-lg sm:text-xl text-gray-600 leading-relaxed">Energy-Efficient Siding Installation & Repair Across Northern Indiana</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-base xs:text-lg sm:text-xl text-gray-600 leading-relaxed">Quality Craftsmanship for Indiana Homes — Free Local Estimates</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-base xs:text-lg sm:text-xl text-gray-600 leading-relaxed">Fiber Cement & Vinyl Siding Pros in South Bend, IN</div>
          </div>

        </div>

        <!-- Trust Signals -->
        <div class="flex flex-wrap gap-2 sm:gap-3 mb-4 sm:mb-6">
          <div class="flex items-center text-sm text-gray-600 bg-white/80 px-3 py-2 rounded-lg">
            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            Free estimates
          </div>
          <div class="flex items-center text-sm text-gray-600 bg-white/80 px-3 py-2 rounded-lg">
            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            Same-day response
          </div>
          <div class="flex items-center text-sm text-gray-600 bg-white/80 px-3 py-2 rounded-lg">
            <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            Licensed in Indiana
          </div>
        </div>

      </div>

      <!-- Chat Assistant Section -->
      <div class="max-w-sm w-full mx-auto px-3 sm:px-0 mt-8 sm:mt-10 mb-10">
        <div class="relative">
          
          <!-- Chat Card -->
          <div class="rounded-2xl shadow-lg bg-white/95 backdrop-blur-sm p-4 sm:p-6 space-y-4">
              <div>
                <h3 class="text-lg font-semibold text-gray-900">AI Home Expert</h3>
              </div>

            <div id="hc-thread" class="space-y-3 overflow-auto pr-1 min-h-[120px] sm:min-h-[150px]" aria-live="polite">
              <div class="bg-gray-50 rounded-lg p-3">
                <p class="text-base leading-relaxed text-gray-700">I'm your AI home intelligence system. I analyze exterior conditions, calculate energy efficiency metrics, and provide expert recommendations for your Indiana home. What exterior challenge can I solve for you today?</p>
              </div>
            </div>

            <form id="hc-form" class="flex items-center gap-2">
              <input id="hc-input" type="text" class="flex-1 min-w-0 h-10 sm:h-11 px-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none text-sm bg-white" placeholder="Describe your challenge...">
              <button type="submit" class="shrink-0 h-10 sm:h-11 px-5 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition-colors flex items-center justify-center">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
              </button>
            </form>

            <div class="flex flex-wrap gap-2 justify-center mt-2">
              <button type="button" data-suggest="Analyze my home's energy efficiency and recommend improvements" class="px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Energy</button>
              <button type="button" data-suggest="Evaluate whether to repair or replace my siding based on current condition" class="px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Repair</button>
              <button type="button" data-suggest="Assess storm damage and provide restoration strategy" class="px-3 py-1.5 rounded-full text-sm font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Storm</button>
            </div>

            <!-- Footer Attribution -->
            <div class="text-xs text-gray-500 text-center pt-2 border-t border-gray-100">
              <span>AI recommendations verified by licensed professionals.</span>
            </div>

          </div>
        </div>
      </div>
      <!-- /Right -->
    </div>
  </div>
</section>

<!-- Chat widget script (kept minimal; uses /api/chat.php backend) -->
<script>
(function(){
  const elForm   = document.getElementById('hc-form');
  const elInput  = document.getElementById('hc-input');
  const elThread = document.getElementById('hc-thread');
  const endpoint = '/api/chat.php';

  function addBubble(text, who) {
    const wrap = document.createElement('div');
    wrap.className = 'flex items-start gap-3';
    
    if (who === 'you') {
      wrap.innerHTML = `
        <div class="bg-blue-600 rounded-2xl rounded-tr-sm p-3 max-w-[85%] ml-auto">
          <p class="text-sm text-white">${esc(text)}</p>
        </div>
        <div class="w-6 h-6 bg-blue-600 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
          <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
        </div>
      `;
    } else {
      wrap.innerHTML = `
        <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
          <svg class="w-3 h-3 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
          </svg>
        </div>
        <div class="bg-gray-50 rounded-2xl rounded-tl-sm p-3 max-w-[85%]">
          <p class="text-sm text-gray-700">${fmt(text)}</p>
        </div>
      `;
    }
    
    elThread.appendChild(wrap);
    elThread.scrollTop = elThread.scrollHeight;
  }
  function esc(s){return s.replace(/[&<>"']/g,m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m]));}
  function fmt(s){
    return esc(s)
      .replace(/\*\*(.+?)\*\*/g,'<strong>$1</strong>')
      .replace(/(https?:\/\/\S+)/g,'<a class="underline" href="$1" target="_blank" rel="nofollow noopener">$1</a>')
      .replace(/\n/g,'<br/>');
  }

  async function ask(msg){
    addBubble(msg,'you');
    addBubble('Analyzing your home\'s exterior data...','bot');
    try {
      const res = await fetch(endpoint, { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({message: msg}) });
      const data = await res.json();
      const last = elThread.lastElementChild; if (last) last.remove();
      addBubble((data && data.reply) ? data.reply : 'Analysis incomplete. Please rephrase your query for optimal results.','bot');
    } catch(e){
      const last = elThread.lastElementChild; if (last) last.remove();
      addBubble('System temporarily unavailable. Please retry your analysis request.','bot');
    }
  }

  elForm.addEventListener('submit', e => {
    e.preventDefault();
    const msg = elInput.value.trim();
    if (!msg) return;
    elInput.value = '';
    ask(msg);
  });

  document.querySelectorAll('[data-suggest]').forEach(btn=>{
    btn.addEventListener('click', ()=> {
      elInput.value = btn.getAttribute('data-suggest');
      elInput.focus();
    });
  });
})();

// Rotating headlines functionality
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

<style>
/* Lightweight transition classes for rotating headlines */
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

