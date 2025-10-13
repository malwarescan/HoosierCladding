<?php /* /includes/hero_preline.php */ ?>
<section class="relative overflow-hidden bg-white">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="grid lg:grid-cols-3 gap-8 items-start">
      <!-- Left: Copy -->
      <div class="lg:col-span-1 lg:order-1">
        <span class="inline-flex items-center gap-x-2 py-1 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mb-4">
          Hoosier Cladding
        </span>
        <h1 class="text-4xl sm:text-5xl font-bold tracking-tight text-gray-900">
          Siding Contractors in South Bend
        </h1>
        <p class="mt-5 text-gray-600 max-w-xl">
          Energy-efficient siding, storm-damage repair, and full replacements—done right. Get a fast, local estimate.
        </p>
        <div class="mt-8 flex flex-wrap gap-3">
          <a href="/contact" class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 text-white font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
            Get a Free Estimate
          </a>
          <a href="/service-area" class="inline-flex items-center justify-center rounded-lg border border-gray-300 px-6 py-3 text-gray-700 hover:bg-gray-50">
            View Services
          </a>
        </div>
      </div>

      <!-- Right: Chat Assistant (Preline Card) -->
      <div class="lg:col-span-2 lg:order-2 w-full">
        <div class="hs-card border border-gray-200 rounded-2xl shadow-sm bg-gradient-to-br from-blue-50 to-indigo-50">
          <div class="p-4 sm:p-6">
            <div class="flex items-center justify-between mb-4">
              <h3 class="text-xl font-bold text-gray-900">Ask our siding assistant</h3>
              <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Powered by AI
              </span>
            </div>

            <div id="hc-thread" class="space-y-3 max-h-80 overflow-auto pr-1" aria-live="polite">
              <div class="text-sm text-gray-700 p-3 bg-white rounded-lg border border-gray-200">
                What can we help with today? Drafts, storm damage, warped panels, or rising energy bills?
              </div>
            </div>

            <form id="hc-form" class="mt-4 flex gap-2">
              <input id="hc-input" type="text" class="grow border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-600 focus:border-blue-600 focus:outline-none text-sm" placeholder="Describe your issue (e.g., cold spots near exterior wall)">
              <button type="submit" class="px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 focus:ring-2 focus:ring-blue-600 focus:outline-none transition-colors">Ask</button>
            </form>

            <div class="mt-4 flex gap-2 flex-wrap">
              <button type="button" data-suggest="Why is my energy bill rising with the same thermostat settings?" class="text-xs border border-gray-300 rounded-lg px-3 py-2 hover:bg-blue-50 hover:border-blue-300 transition-colors">Energy bill rising</button>
              <button type="button" data-suggest="Should I repair or replace vinyl siding with cracks and gaps?" class="text-xs border border-gray-300 rounded-lg px-3 py-2 hover:bg-blue-50 hover:border-blue-300 transition-colors">Repair vs replace</button>
              <button type="button" data-suggest="How fast can you do siding repair after storm damage in South Bend?" class="text-xs border border-gray-300 rounded-lg px-3 py-2 hover:bg-blue-50 hover:border-blue-300 transition-colors">Storm damage</button>
            </div>

            <p class="mt-4 text-[11px] text-gray-500">
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
</script>

