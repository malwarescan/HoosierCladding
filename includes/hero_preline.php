<?php /* /includes/hero_preline.php */ ?>
<section class="relative overflow-hidden bg-white">
  <!-- Background Image -->
  <div class="absolute inset-0 z-0">
    <img src="/public/images/hero-section/siding-repair-home-hoosier-cladding.png" 
         alt="Professional siding repair and installation services" 
         class="w-full h-full object-cover opacity-25"
         loading="eager">
    <div class="absolute inset-0 bg-gradient-to-r from-white/70 via-white/60 to-white/50"></div>
  </div>
  <div class="relative z-10 max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex flex-col gap-8">
      <!-- Copy Section -->
      <div class="flex flex-col justify-center text-center lg:text-left">

        <!-- Main Headline -->
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-gray-900 leading-tight mb-6">
          <span class="text-blue-600">South Bend's</span><br>
          Premier Siding Experts
        </h1>

        <!-- Rotating Sub-headlines -->
        <div class="mb-8">
          <div id="hc-rotator"
               class="relative h-16 overflow-hidden"
               aria-live="polite"
               aria-atomic="true">
            <span class="sr-only">Local service highlights:</span>

            <!-- Slides: all in DOM, not display:none (use translate/opacity for a11y & SEO) -->
            <div class="hc-rot-slide opacity-100 translate-y-0 text-lg text-gray-600 leading-relaxed">Indiana's Premier Siding & Exterior Experts — Serving South Bend and Beyond</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-lg text-gray-600 leading-relaxed">South Bend's Trusted Siding Contractors — Indiana's Exterior Specialists</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-lg text-gray-600 leading-relaxed">Energy-Efficient Siding Installation & Repair Across Northern Indiana</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-lg text-gray-600 leading-relaxed">Quality Craftsmanship for Indiana Homes — Free Local Estimates</div>
            <div class="hc-rot-slide opacity-0 translate-y-3 text-lg text-gray-600 leading-relaxed">Fiber Cement & Vinyl Siding Pros in South Bend, IN</div>
          </div>

          <!-- Controls for users & crawlers (visible, not spam) -->
          <div class="mt-4 flex items-center gap-3 text-sm text-gray-500">
            <button type="button" class="hc-rot-prev px-3 py-1 rounded-md border border-gray-300 hover:bg-gray-50 hover:border-gray-400 transition-colors">Prev</button>
            <button type="button" class="hc-rot-next px-3 py-1 rounded-md border border-gray-300 hover:bg-gray-50 hover:border-gray-400 transition-colors">Next</button>
            <span class="hc-rot-index text-xs text-gray-400" aria-live="off">(1/5)</span>
          </div>
        </div>

        <!-- Trust Signals -->
        <div class="flex flex-wrap gap-4 mb-8">
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
      <div class="w-full max-w-3xl mx-auto lg:max-w-none">
        <div class="relative">
          <!-- Feature Badge -->
          <div class="absolute -top-3 left-6 z-20">
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white shadow-lg">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
              NEW AI FEATURE
            </span>
          </div>
          
          <!-- Chat Card -->
          <div class="hs-card border-2 border-blue-200 rounded-3xl shadow-2xl bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 backdrop-blur-sm h-full">
            <div class="p-8 lg:p-10 h-full flex flex-col">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <h3 class="text-2xl font-bold text-gray-900 mb-1">Ask our siding assistant</h3>
                  <p class="text-sm text-gray-600">Get instant answers about your siding needs</p>
                </div>
                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                  <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M22.2819 9.8211a5.9847 5.9847 0 0 0-.5157-4.9108 6.0462 6.0462 0 0 0-6.5098-2.9A6.0651 6.0651 0 0 0 4.9807 4.1818a5.9847 5.9847 0 0 0-3.9977 2.9 6.0462 6.0462 0 0 0 .7427 7.0966 5.98 5.98 0 0 0 .511 4.9107 6.051 6.051 0 0 0 6.5146 2.9001A5.9847 5.9847 0 0 0 13.2599 24a6.0557 6.0557 0 0 0 5.7718-4.2058 5.9894 5.9894 0 0 0 3.9977-2.9001 6.0557 6.0557 0 0 0-.7475-7.0729zm-9.022 12.6081a4.4755 4.4755 0 0 1-2.8764-1.0408l.1419-.0804 4.7783-2.7582a.7948.7948 0 0 0 .3927-.6813v-6.7369l2.02 1.1686a.071.071 0 0 1 .038.052v5.5826a4.504 4.504 0 0 1-4.4945 4.4944zm-9.6607-4.1254a4.4708 4.4708 0 0 1-.5346-3.0137l.142.0852 4.783 2.7582a.7712.7712 0 0 0 .7806 0l5.8428-3.3685v2.3324a.0804.0804 0 0 1-.0332.0615L9.74 19.9502a4.4992 4.4992 0 0 1-6.1408-1.6464zm-2.4568-11.9288a4.4708 4.4708 0 0 1 2.3655-1.9728V8.2606a.7667.7667 0 0 0 .3879-.6765l2.02-1.1638.142-.0804a4.478 4.478 0 0 1-.5346-3.0137A4.504 4.504 0 0 1 1.1644 6.375zm16.5963 3.8558L18.8243 8.2606a.7712.7712 0 0 0-.7806 0l-5.8428 3.3685V9.2954a.0804.0804 0 0 1 .0332-.0615l4.783-2.7582a4.4992 4.4992 0 0 1 6.6802 4.66 4.4757 4.4757 0 0 1-.5346 3.0137zM2.8906 10.8642a4.4992 4.4992 0 0 1 6.1408-1.6464l4.783 2.7582a.0804.0804 0 0 1 .0332.0615v5.5352a4.504 4.504 0 0 1-4.4945 4.4944 4.4755 4.4755 0 0 1-2.8764-1.0408l-4.783-2.7582a.7712.7712 0 0 0-.7806 0l-5.8428 3.3685v-2.3324a.0804.0804 0 0 1 .0332-.0615z"/>
                  </svg>
                  Powered by OpenAI
                </span>
              </div>

            <div id="hc-thread" class="flex-1 space-y-3 overflow-auto pr-1 min-h-0" aria-live="polite">
              <div class="text-sm text-gray-700 p-4 bg-white rounded-lg border border-gray-200 shadow-sm">
                What can we help with today? Drafts, storm damage, warped panels, or rising energy bills?
              </div>
            </div>

            <form id="hc-form" class="mt-6 flex gap-3">
              <input id="hc-input" type="text" class="flex-1 border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:outline-none text-sm" placeholder="Describe your issue (e.g., cold spots near exterior wall)">
              <button type="submit" class="px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-600 focus:outline-none transition-colors whitespace-nowrap">Ask</button>
            </form>

            <div class="mt-4 flex gap-2 flex-wrap">
              <button type="button" data-suggest="Why is my energy bill rising with the same thermostat settings?" class="text-xs border border-gray-300 rounded-lg px-3 py-2 hover:bg-blue-50 hover:border-blue-300 transition-colors">Energy bill rising</button>
              <button type="button" data-suggest="Should I repair or replace vinyl siding with cracks and gaps?" class="text-xs border border-gray-300 rounded-lg px-3 py-2 hover:bg-blue-50 hover:border-blue-300 transition-colors">Repair vs replace</button>
              <button type="button" data-suggest="How fast can you do siding repair after storm damage in South Bend?" class="text-xs border border-gray-300 rounded-lg px-3 py-2 hover:bg-blue-50 hover:border-blue-300 transition-colors">Storm damage</button>
            </div>

            <p class="mt-4 text-xs text-gray-500">
              This assistant provides general guidance. For a detailed quote, <a href="/contact" class="underline">request a free estimate</a>.
            </p>
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
    wrap.className = 'text-sm';
    wrap.innerHTML = who === 'you'
      ? '<div class="bg-gray-100 rounded-lg p-2"><strong>You:</strong> '+esc(text)+'</div>'
      : '<div class="bg-blue-50 rounded-lg p-2 border border-blue-100"><strong>Assistant:</strong> '+fmt(text)+'</div>';
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
    addBubble('Typing…','bot');
    try {
      const res = await fetch(endpoint, { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify({message: msg}) });
      const data = await res.json();
      const last = elThread.lastElementChild; if (last) last.remove();
      addBubble((data && data.reply) ? data.reply : 'Sorry, I could not generate a reply just now.','bot');
    } catch(e){
      const last = elThread.lastElementChild; if (last) last.remove();
      addBubble('Network error. Please try again.','bot');
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

