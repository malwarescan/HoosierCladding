# Hero Section Styling Analysis

## Overview
This document analyzes ALL styling affecting the hero section including the AI chat assistant. The hero section is located in `/includes/hero_preline.php`.

## File Structure
```
/includes/hero_preline.php - Main hero section with AI chat
/public/styles/output.css - Custom CSS overrides
/public/css/preline-theme-overrides.css - Preline theme overrides
```

## 1. Hero Section HTML Structure

### Main Container
```html
<section class="relative overflow-hidden bg-white">
  <!-- Background Image -->
  <div class="absolute inset-0 top-0 z-0 pointer-events-none">
    <img src="/public/images/hero-section/siding-repair-home-hoosier-cladding.png" 
         alt="Professional siding repair and installation services" 
         class="w-full h-full object-cover opacity-25"
         loading="eager">
    <div class="absolute inset-0 bg-gradient-to-r from-white/70 via-white/60 to-white/50"></div>
  </div>
  
  <!-- Content Container -->
  <div class="relative z-10 max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8 pt-safe pt-16 sm:pt-20 lg:pt-24 pb-safe">
    <!-- Two-column layout -->
    <div class="flex flex-col gap-4 sm:gap-6 lg:grid lg:grid-cols-2 lg:items-center lg:gap-10 xl:gap-14">
```

### Text Section (Left Column)
```html
<div class="flex flex-col justify-center text-center lg:text-left lg:pr-8">
  <!-- Main Headline -->
  <h1 class="text-4xl sm:text-5xl lg:text-7xl xl:text-8xl font-bold tracking-tight text-gray-900 leading-tight mb-3 sm:mb-6 lg:mb-8">
    <span class="text-blue-600">South Bend's</span><br>
    Premier Siding Experts
  </h1>

  <!-- Rotating Sub-headlines -->
  <div class="mb-3 sm:mb-6 lg:mb-8">
    <div id="hc-rotator" class="relative h-12 sm:h-16 lg:h-20 overflow-hidden" aria-live="polite" aria-atomic="true">
      <!-- Rotating text slides -->
      <div class="hc-rot-slide text-base sm:text-lg lg:text-xl text-gray-600 leading-relaxed">
        Indiana's Premier Siding & Exterior Experts — Serving South Bend and Beyond
      </div>
      <!-- More slides... -->
    </div>
  </div>

  <!-- Trust Signals -->
  <div class="flex flex-wrap gap-4 justify-start mb-4 sm:mb-6 lg:mb-8">
    <div class="flex items-center text-sm text-gray-600 bg-white/80 px-3 py-2 rounded-lg">
      <!-- Trust signal content -->
    </div>
    <!-- More trust signals... -->
  </div>
</div>
```

### Chat Assistant Section (Right Column)
```html
<div class="w-full max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl mx-auto lg:mx-0 lg:ml-auto px-3 sm:px-0 mt-8 sm:mt-10 lg:mt-0 lg:pl-8">
  <div class="relative">
    <!-- Chat Card -->
    <div class="rounded-2xl shadow-lg bg-white/95 backdrop-blur-sm p-4 sm:p-6 space-y-4">
      <!-- Chat Header -->
      <div>
        <h3 class="text-lg font-semibold text-gray-900">AI Home Expert</h3>
      </div>

      <!-- Chat Thread -->
      <div id="hc-thread" class="space-y-3 overflow-auto pr-1 min-h-[180px] sm:min-h-[200px] lg:min-h-[220px]" aria-live="polite">
        <div class="bg-gray-50 rounded-lg p-4">
          <p class="text-base leading-relaxed text-gray-700">
            I'm your AI home intelligence system. I analyze exterior conditions, calculate energy efficiency metrics, and provide expert recommendations for your Indiana home. What exterior challenge can I solve for you today?
          </p>
        </div>
      </div>

      <!-- Input Form -->
      <form id="hc-form" class="flex items-center gap-2">
        <input id="hc-input" type="text" class="flex-1 min-w-0 h-10 sm:h-11 lg:h-12 px-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none text-base bg-white" placeholder="Describe your challenge...">
        <button type="submit" class="shrink-0 h-10 sm:h-11 lg:h-12 px-6 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition-colors flex items-center justify-center">
          <!-- Send icon -->
        </button>
      </form>

      <!-- Suggestion Chips -->
      <div class="flex flex-wrap gap-3 justify-center mt-3">
        <button type="button" class="px-4 py-2 rounded-full text-base font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Energy</button>
        <button type="button" class="px-4 py-2 rounded-full text-base font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Repair</button>
        <button type="button" class="px-4 py-2 rounded-full text-base font-medium bg-blue-100 text-blue-700 hover:bg-blue-200 transition-colors">Storm</button>
      </div>

      <!-- Footer Attribution -->
      <div class="text-center text-xs text-gray-500 pt-2 border-t border-gray-100">
        <p>Powered by <span class="font-semibold text-gray-700">ChatGPT</span> & <span class="font-semibold text-blue-700">OurCasa.ai</span></p>
      </div>
    </div>
  </div>
</div>
```

## 2. Tailwind CSS Classes Breakdown

### Container Classes
- `relative overflow-hidden bg-white` - Section container
- `max-w-screen-2xl mx-auto` - Content width and centering
- `px-4 sm:px-6 lg:px-8` - Responsive horizontal padding
- `pt-safe pt-16 sm:pt-20 lg:pt-24 pb-safe` - Safe area and responsive vertical padding

### Layout Classes
- `flex flex-col gap-4 sm:gap-6 lg:grid lg:grid-cols-2 lg:items-center lg:gap-10 xl:gap-14` - Responsive layout
- `lg:pr-8` - Right padding on desktop for text section
- `lg:pl-8` - Left padding on desktop for chat section

### Typography Classes
- `text-4xl sm:text-5xl lg:text-7xl xl:text-8xl` - Responsive headline sizing
- `font-bold tracking-tight text-gray-900 leading-tight` - Headline styling
- `text-base sm:text-lg lg:text-xl text-gray-600 leading-relaxed` - Subheadline styling
- `text-lg font-semibold text-gray-900` - Chat title styling

### Spacing Classes
- `mb-3 sm:mb-6 lg:mb-8` - Responsive bottom margins
- `gap-4 justify-start` - Trust signals spacing
- `mt-8 sm:mt-10 lg:mt-0` - Chat section top margin
- `space-y-4` - Internal chat card spacing

### Chat Card Classes
- `rounded-2xl shadow-lg bg-white/95 backdrop-blur-sm` - Card styling
- `p-4 sm:p-6` - Responsive padding
- `max-w-sm sm:max-w-md lg:max-w-lg xl:max-w-xl` - Responsive width constraints
- `mx-auto lg:mx-0 lg:ml-auto` - Responsive alignment

### Input/Button Classes
- `flex items-center gap-2` - Form layout
- `flex-1 min-w-0` - Input flexibility
- `h-10 sm:h-11 lg:h-12` - Responsive heights
- `px-4 rounded-lg border border-gray-300` - Input styling
- `bg-blue-700 text-white font-semibold hover:bg-blue-800` - Button styling

### Background Classes
- `absolute inset-0 top-0 z-0 pointer-events-none` - Background container
- `w-full h-full object-cover opacity-25` - Background image
- `bg-gradient-to-r from-white/70 via-white/60 to-white/50` - Overlay gradient

## 3. Custom CSS Overrides

### From `/public/styles/output.css`
```css
/* Mobile-specific overrides */
@media (max-width: 639px) {
  .w-full.mx-auto {
    margin-top: 1rem !important;
  }
  
  .hs-card {
    padding: 0.75rem !important;
  }
  
  input[type="text"] {
    padding: 0.625rem 0.75rem !important;
    height: 2.5rem !important;
    font-size: 0.75rem !important;
    max-width: calc(100% - 3rem) !important;
  }
  
  button[type="submit"] {
    width: 2.5rem !important;
    height: 2.5rem !important;
  }
  
  .text-xs.bg-gray-100.hover\:bg-gray-200.rounded-full {
    padding: 0.375rem 0.75rem !important;
    font-size: 0.75rem !important;
  }
  
  .flex.gap-2.sm\:gap-3.flex-wrap {
    gap: 0.5rem !important;
  }
  
  .min-h-\[120px\].sm\:min-h-\[150px\] {
    min-height: 7.5rem !important;
  }
}

/* Safe area padding */
.pt-safe {
  padding-top: env(safe-area-inset-top, 0) !important;
}

.pb-safe {
  padding-bottom: env(safe-area-inset-bottom, 0) !important;
}

/* Extra small screens */
@media (max-width: 399px) {
  .text-3xl.xs\:text-4xl.sm\:text-5xl.md\:text-6xl.lg\:text-7xl {
    font-size: 1.875rem !important;
    line-height: 2.25rem !important;
  }
  
  .text-base.xs\:text-lg.sm\:text-xl {
    font-size: 1rem !important;
    line-height: 1.5rem !important;
  }
}
```

### From `/public/css/preline-theme-overrides.css`
```css
/* Preline theme customizations */
/* (Content depends on what's in this file) */
```

## 4. JavaScript Functionality

### Rotating Headlines
```javascript
(function(){
  const root = document.getElementById('hc-rotator');
  if(!root) return;
  const slides = Array.from(root.querySelectorAll('.hc-rot-slide'));
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
    i = n;
  }

  function next(){ show((i+1) % slides.length); }
  function prev(){ show((i-1+slides.length) % slides.length); }

  let intervalMs = 4000;
  function reset(){ clearInterval(t); t = setInterval(next, intervalMs); }
  show(0); t = setInterval(next, intervalMs);

  // Pause on hover for UX
  root.addEventListener('mouseenter', ()=> clearInterval(t));
  root.addEventListener('mouseleave', reset);
})();
```

### Chat Widget
```javascript
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
```

## 5. CSS Transitions for Rotating Headlines
```css
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
```

## 6. Responsive Breakpoints

### Mobile (375px - iPhone SE)
- Single column layout
- Chat card: `max-w-sm` (384px)
- Typography: `text-4xl` headline
- Spacing: `gap-4`, `mb-3`
- Padding: `p-4` on chat card

### Tablet (640px+)
- Single column layout
- Chat card: `max-w-md` (448px)
- Typography: `text-5xl` headline
- Spacing: `gap-6`, `mb-6`
- Padding: `p-6` on chat card

### Desktop (1024px+)
- Two-column grid layout
- Chat card: `max-w-lg` (512px)
- Typography: `text-7xl` headline
- Spacing: `gap-10`, `mb-8`
- Right-aligned chat card

### Large Desktop (1280px+)
- Two-column grid layout
- Chat card: `max-w-xl` (576px)
- Typography: `text-8xl` headline
- Spacing: `gap-14`

## 7. Color Scheme

### Primary Colors
- `text-blue-600` - Accent text
- `bg-blue-700` - Primary button
- `hover:bg-blue-800` - Button hover
- `bg-blue-100` - Suggestion chips
- `text-blue-700` - Chip text
- `hover:bg-blue-200` - Chip hover

### Neutral Colors
- `text-gray-900` - Primary text
- `text-gray-700` - Secondary text
- `text-gray-600` - Tertiary text
- `text-gray-500` - Footer text
- `bg-gray-50` - Message bubbles
- `border-gray-300` - Input borders
- `bg-white/95` - Card background

### Background
- `bg-white` - Section background
- `opacity-25` - Background image
- `from-white/70 via-white/60 to-white/50` - Overlay gradient

## 8. Accessibility Features

### ARIA Labels
- `aria-live="polite"` - Chat thread
- `aria-live="polite" aria-atomic="true"` - Rotating headlines
- `aria-hidden="true/false"` - Rotating slides
- `tabindex="0/-1"` - Focus management

### Screen Reader Support
- `<span class="sr-only">` - Hidden descriptive text
- Semantic HTML structure
- Proper heading hierarchy

### Focus Management
- `focus:ring-2 focus:ring-blue-500` - Input focus
- `focus:border-blue-500` - Input border focus
- `focus:outline-none` - Remove default outline

## 9. Performance Optimizations

### Image Loading
- `loading="eager"` - Hero background image
- `object-cover` - Proper image scaling

### CSS Optimizations
- `will-change: transform, opacity` - Rotating headlines
- `backdrop-blur-sm` - Modern blur effect
- `pointer-events-none` - Background interaction prevention

### JavaScript Optimizations
- Event delegation for suggestion chips
- Debounced form submission
- Efficient DOM manipulation

## 10. Known Issues & Potential Problems

### CSS Specificity Conflicts
- Custom CSS overrides using `!important` may conflict with Tailwind
- Mobile-specific overrides may affect desktop layout

### Responsive Layout Issues
- Grid layout may not work properly on older browsers
- Safe area padding may not be supported on all devices

### JavaScript Dependencies
- Chat functionality depends on `/api/chat.php` endpoint
- Rotating headlines require JavaScript to be enabled

### Performance Considerations
- Background image may be large and affect loading time
- Multiple CSS files may cause render blocking
- JavaScript execution may delay interactive elements

## 11. Debugging Checklist

### Mobile Issues
- [ ] Check if `max-w-sm` is constraining chat card
- [ ] Verify `pt-safe` is working on notched devices
- [ ] Ensure `gap-4` spacing is appropriate
- [ ] Test `h-10` input height on touch devices

### Desktop Issues
- [ ] Verify `lg:grid lg:grid-cols-2` is active
- [ ] Check `lg:mx-0 lg:ml-auto` alignment
- [ ] Ensure `lg:gap-10 xl:gap-14` spacing
- [ ] Test `lg:text-7xl xl:text-8xl` typography

### Cross-browser Issues
- [ ] Test CSS Grid support
- [ ] Verify backdrop-blur support
- [ ] Check safe area padding support
- [ ] Test JavaScript functionality

### Performance Issues
- [ ] Check image loading performance
- [ ] Verify CSS file loading order
- [ ] Test JavaScript execution time
- [ ] Monitor render blocking resources

## 12. Recommended Changes

### Immediate Fixes
1. Remove conflicting `!important` rules in custom CSS
2. Consolidate responsive breakpoints
3. Optimize background image size
4. Add error handling for chat API

### Long-term Improvements
1. Implement CSS-in-JS for better maintainability
2. Add progressive enhancement for JavaScript features
3. Implement lazy loading for non-critical resources
4. Add comprehensive testing for all breakpoints

---

**Last Updated:** October 13, 2025
**File Location:** `/includes/hero_preline.php`
**Related Files:** `/public/styles/output.css`, `/public/css/preline-theme-overrides.css`
