<?php
$pageTitle = "Professional Siding Services in Northern Indiana | Hoosier Cladding LLC";
$pageDescription = "Expert siding installation, repair, and replacement in South Bend, Mishawaka, Elkhart, and throughout Michiana. Licensed & insured. Winter-ready installations. Call 574-931-2119 for a free estimate.";
include __DIR__ . '/partials/header.php';
?>

<section class="hero">
  <div class="container hero-inner">
    <div class="eyebrow">Professional Siding Services in Northern Indiana</div>
    <h1 class="h1">Expert installation, repair, and replacement across Michiana</h1>
    <p class="lead">
      Quality craftsmanship designed for Indiana winters—freeze–thaw cycles, lake-effect snow, wind, and hail. 
      Local crews, clean jobsites, honest timelines.
    </p>
    <div class="hero-cta">
      <a class="btn btn-primary" href="tel:<?= preg_replace('/[^0-9]/', '', $PHONE) ?>">Call <?= $PHONE ?></a>
      <a class="btn btn-outline" href="/contact.php">Get Free Estimate</a>
    </div>
    <div class="trust-strip">
      <span>Licensed & Insured</span> • 
      <span>Winter-Ready Installations</span> • 
      <span>Local Crews Only</span>
    </div>
    
    <!-- Hero Chat Assistant -->
    <div id="hc-chat" style="max-width: 600px; margin: 32px auto 0; background: rgba(255,255,255,0.9); backdrop-filter: blur(10px); border-radius: 12px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid var(--border);">
      <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 16px;">
        <h3 style="font-size: 18px; font-weight: 600; margin: 0;">Ask our siding assistant</h3>
        <span style="font-size: 11px; color: var(--body-light);">Powered by AI</span>
      </div>

      <div id="hc-thread" style="max-height: 300px; overflow-y: auto; margin-bottom: 16px; padding-right: 4px;" aria-live="polite">
        <div style="font-size: 14px; color: var(--body); padding: 12px; background: #f8f9fa; border-radius: 8px;">
          What can we help with today? Drafts, storm damage, warped panels, or an energy bill spike?
        </div>
      </div>

      <form id="hc-form" style="display: flex; gap: 8px; margin-bottom: 12px;">
        <input id="hc-input" type="text" style="flex: 1; border: 1px solid var(--border); border-radius: 8px; padding: 10px 12px; font-size: 14px;" placeholder="Describe the issue (e.g., cold spots near exterior wall)" />
        <button type="submit" style="padding: 10px 20px; border-radius: 8px; background: var(--primary); color: white; border: none; font-weight: 600; cursor: pointer;">Ask</button>
      </form>

      <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 12px;">
        <button type="button" data-suggest="Why is my energy bill rising with the same thermostat settings?" style="font-size: 12px; border: 1px solid var(--border); border-radius: 6px; padding: 6px 10px; background: white; cursor: pointer;">Energy bill rising</button>
        <button type="button" data-suggest="Should I repair or replace vinyl siding with cracks and gaps?" style="font-size: 12px; border: 1px solid var(--border); border-radius: 6px; padding: 6px 10px; background: white; cursor: pointer;">Repair vs replace</button>
        <button type="button" data-suggest="How fast can you do siding repair after storm damage in South Bend?" style="font-size: 12px; border: 1px solid var(--border); border-radius: 6px; padding: 6px 10px; background: white; cursor: pointer;">Storm damage</button>
      </div>

      <p style="margin: 0; font-size: 11px; color: var(--body-light);">
        This assistant provides general guidance. For a detailed quote, <a href="/contact" style="text-decoration: underline;">request a free estimate</a>.
      </p>
    </div>
  </div>
</section>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Hoosier Cladding LLC",
  "description": "Professional siding installation, repair, and replacement services in Michiana. Serving South Bend, Mishawaka, Elkhart, and surrounding areas with quality craftsmanship and local expertise.",
  "url": "https://www.hoosiercladding.com",
  "telephone": "+15749312119",
  "email": "david@hoosier.works",
  "address": {
    "@type": "PostalAddress",
    "addressLocality": "South Bend",
    "addressRegion": "IN",
    "addressCountry": "US"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 41.6764,
    "longitude": -86.2520
  },
  "areaServed": [
    {
      "@type": "City",
      "name": "South Bend"
    },
    {
      "@type": "City", 
      "name": "Mishawaka"
    },
    {
      "@type": "City",
      "name": "Elkhart"
    }
  ],
  "serviceArea": {
    "@type": "GeoCircle",
    "geoMidpoint": {
      "@type": "GeoCoordinates",
      "latitude": 41.6764,
      "longitude": -86.2520
    },
    "geoRadius": "50000"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Siding Services",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Siding Installation",
          "description": "Professional installation of vinyl, fiber cement, and other siding materials"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Siding Repair",
          "description": "Expert repair services for damaged siding"
        }
      },
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Service",
          "name": "Siding Replacement",
          "description": "Complete siding replacement services"
        }
      }
    ]
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "5.0",
    "reviewCount": "43",
    "bestRating": "5",
    "worstRating": "1"
  },
  "priceRange": "$$",
  "openingHours": "Mo-Fr 07:00-18:00",
  "sameAs": [
    "https://www.facebook.com/hoosiercladding",
    "https://www.instagram.com/hoosiercladding"
  ]
}
</script>

<section class="section">
  <div class="container">
    <h2 class="h2" style="text-align:center">Our Siding Services</h2>
    <p class="lead" style="text-align:center; margin:0 auto 28px">
      Comprehensive siding solutions for residential and commercial properties across Northern Indiana.
    </p>

    <div class="grid grid-3">
      <article class="card">
        <div class="icon">Installation</div>
        <p style="margin-bottom:12px">
          Premium materials selected for Indiana's climate. Precision flashing, house wrap integration, 
          and clean lines backed by strong warranties.
        </p>
        <a href="/service-area.php" style="font-weight:700">Learn More</a>
      </article>

      <article class="card">
        <div class="icon">Repair</div>
        <p style="margin-bottom:12px">
          Storm, moisture, or age—targeted repairs to protect the envelope. We color-match and restore performance.
        </p>
        <a href="/service-area.php" style="font-weight:700">Learn More</a>
      </article>

      <article class="card">
        <div class="icon">Replacement</div>
        <p style="margin-bottom:12px">
          Full tear-offs done right. Code-compliant details, improved energy performance, 
          and modern curb appeal built for Midwest weather.
        </p>
        <a href="/service-area.php" style="font-weight:700">Learn More</a>
      </article>
    </div>
  </div>
</section>

<section class="section" style="background:var(--surface); border-top:1px solid var(--border); border-bottom:1px solid var(--border)">
  <div class="container">
    <h2 class="h2" style="text-align:center; margin-bottom:8px">Why Choose Hoosier Cladding?</h2>
    <p class="lead" style="text-align:center; margin:0 auto 32px">
      Trusted by homeowners across Michiana for quality workmanship and reliable service.
    </p>
    
    <div class="grid grid-3">
      <div>
        <h3 class="h3" style="margin-bottom:6px">Local Expertise</h3>
        <p style="margin:0; color:var(--body)">
          We understand Northern Indiana's unique climate challenges—harsh winters, freeze-thaw cycles, 
          and lake-effect weather patterns.
        </p>
      </div>
      
      <div>
        <h3 class="h3" style="margin-bottom:6px">Premium Materials</h3>
        <p style="margin:0; color:var(--body)">
          We use only high-quality siding materials from trusted manufacturers, 
          designed for durability and long-term performance.
        </p>
      </div>
      
      <div>
        <h3 class="h3" style="margin-bottom:6px">Professional Installation</h3>
        <p style="margin:0; color:var(--body)">
          Our experienced craftsmen ensure proper installation techniques that protect your investment 
          and maintain your home's integrity.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="section" style="background-color: #f8f9fa;">
  <div class="container">
    <h2 class="h2" style="text-align:center; margin-bottom:2rem">What Our Customers Say</h2>
    
    <div class="grid grid-3">
      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;" itemscope itemtype="https://schema.org/Review">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;" itemprop="reviewBody">
            "Our heating bills dropped right after replacing our old siding. The crew was fast, professional, and cleaned up everything."
          </p>
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <p style="font-weight: 600; color: #01426A; margin: 0;" itemprop="name">Lisa Greene</p>
          </div>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;">South Bend, IN</p>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-09-12">
        </div>
      </article>

      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;" itemscope itemtype="https://schema.org/Review">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;" itemprop="reviewBody">
            "Winters in South Bend destroyed our last siding—this install already feels tighter and warmer."
          </p>
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <p style="font-weight: 600; color: #01426A; margin: 0;" itemprop="name">Mark Jensen</p>
          </div>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;">Mishawaka, IN</p>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-08-19">
        </div>
      </article>

      <article class="card" style="background: #ffffff; border: 1px solid #e9ecef;" itemscope itemtype="https://schema.org/Review">
        <div style="margin-bottom: 1rem;">
          <div style="color: #ffc107; font-size: 1.2rem; margin-bottom: 0.5rem;">★★★★★</div>
          <p style="font-style: italic; margin-bottom: 1rem; color: #495057;" itemprop="reviewBody">
            "Professional installation and honest pricing. They explained everything and delivered on time."
          </p>
          <div itemprop="author" itemscope itemtype="https://schema.org/Person">
            <p style="font-weight: 600; color: #01426A; margin: 0;" itemprop="name">Sarah Williams</p>
          </div>
          <p style="font-size: 0.9rem; color: #6c757d; margin: 0;">Elkhart, IN</p>
          <div itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
            <meta itemprop="ratingValue" content="5">
            <meta itemprop="bestRating" content="5">
          </div>
          <meta itemprop="datePublished" content="2024-10-03">
        </div>
      </article>
    </div>

    <!-- AggregateRating Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "AggregateRating",
      "itemReviewed": {
        "@type": "LocalBusiness",
        "name": "Hoosier Cladding LLC",
        "url": "https://www.hoosiercladding.com"
      },
      "ratingValue": "5.0",
      "bestRating": "5",
      "worstRating": "1",
      "ratingCount": "47",
      "reviewCount": "43"
    }
    </script>
  </div>
</section>

<section class="section" style="background-color: #ffffff;">
  <div class="container">
    <h2 class="h2" style="text-align:center; margin-bottom:2rem">Frequently Asked Questions</h2>
    
    <div style="max-width: 800px; margin: 0 auto;">
      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">How much can new siding save on energy bills?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          Many homeowners see 10-20% lower heating costs with properly insulated siding. Our insulated vinyl and fiber cement options provide significant R-value improvements that directly impact your energy bills, especially during Indiana's harsh winters.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">What are the signs my home siding needs replacement?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          Visible gaps, rising energy bills, cold spots, ice damming, warped panels, and moisture damage are key indicators. If your siding is over 15-20 years old or showing these signs, it's time for a professional assessment.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">How long does siding installation take?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          Most residential siding projects take 3-7 days depending on home size and complexity. We provide detailed timelines during your free estimate and always communicate any schedule changes immediately.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">Do you offer financing options?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          Yes, we work with several financing partners to offer flexible payment options. Our team can help you find a plan that fits your budget during your free consultation.
        </div>
      </details>

      <details style="margin-bottom: 1rem; padding: 1rem; border: 1px solid #e9ecef; border-radius: 0.5rem;">
        <summary style="font-weight: 600; color: #01426A; cursor: pointer; font-size: 1.1rem;">What siding materials do you recommend for Indiana winters?</summary>
        <div style="margin-top: 1rem; color: #495057; line-height: 1.6;">
          We recommend James Hardie fiber cement and insulated vinyl siding for Indiana's freeze-thaw cycles. Both materials resist warping, cracking, and moisture damage while providing excellent insulation against harsh winter weather.
        </div>
      </details>
    </div>

    <!-- FAQPage Schema -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "How much can new siding save on energy bills?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Many homeowners see 10-20% lower heating costs with properly insulated siding. Our insulated vinyl and fiber cement options provide significant R-value improvements that directly impact your energy bills, especially during Indiana's harsh winters."
          }
        },
        {
          "@type": "Question", 
          "name": "What are the signs my home siding needs replacement?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Visible gaps, rising energy bills, cold spots, ice damming, warped panels, and moisture damage are key indicators. If your siding is over 15-20 years old or showing these signs, it's time for a professional assessment."
          }
        },
        {
          "@type": "Question",
          "name": "How long does siding installation take?",
          "acceptedAnswer": {
            "@type": "Answer", 
            "text": "Most residential siding projects take 3-7 days depending on home size and complexity. We provide detailed timelines during your free estimate and always communicate any schedule changes immediately."
          }
        },
        {
          "@type": "Question",
          "name": "Do you offer financing options?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Yes, we work with several financing partners to offer flexible payment options. Our team can help you find a plan that fits your budget during your free consultation."
          }
        },
        {
          "@type": "Question",
          "name": "What siding materials do you recommend for Indiana winters?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "We recommend James Hardie fiber cement and insulated vinyl siding for Indiana's freeze-thaw cycles. Both materials resist warping, cracking, and moisture damage while providing excellent insulation against harsh winter weather."
          }
        }
      ]
    }
    </script>
  </div>
</section>

<?php include __DIR__ . '/includes/home_internal_links.html.php'; ?>

<?php include __DIR__ . '/partials/cta-strip.php'; ?>

<!-- Chat Assistant JavaScript -->
<script>
(function(){
  const elForm   = document.getElementById('hc-form');
  const elInput  = document.getElementById('hc-input');
  const elThread = document.getElementById('hc-thread');
  const endpoint = '/api/chat.php';

  function addBubble(text, who) {
    const wrap = document.createElement('div');
    wrap.style.marginBottom = '12px';
    wrap.innerHTML = who === 'you'
      ? '<div style="background: #e9ecef; border-radius: 8px; padding: 12px; font-size: 14px;"><strong>You:</strong> '+escapeHtml(text)+'</div>'
      : '<div style="background: #e3f2fd; border-radius: 8px; padding: 12px; border: 1px solid #90caf9; font-size: 14px;"><strong>Assistant:</strong> '+formatMd(text)+'</div>';
    elThread.appendChild(wrap);
    elThread.scrollTop = elThread.scrollHeight;
  }

  function escapeHtml(s){return s.replace(/[&<>"']/g,m=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' }[m]));}
  function formatMd(s){
    // very light Markdown to HTML (bold + links + line breaks)
    return escapeHtml(s)
      .replace(/\*\*(.+?)\*\*/g,'<strong>$1</strong>')
      .replace(/(https?:\/\/\S+)/g,'<a style="text-decoration: underline;" href="$1" target="_blank" rel="nofollow noopener">$1</a>')
      .replace(/\n/g,'<br/>');
  }

  async function ask(msg){
    addBubble(msg,'you');
    addBubble('Typing…','bot');
    
    // Get context from page if on matrix page
    const path = window.location.pathname;
    const context = path.startsWith('/matrix/') ? 'Page: ' + path : '';
    
    try {
      const res = await fetch(endpoint, {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({message: msg, context: context})
      });
      const data = await res.json();
      const last = elThread.lastElementChild;
      if (last && last.textContent.includes('Typing')) last.remove();
      if (data && data.reply) addBubble(data.reply,'bot');
      else if (data && data.error) addBubble('Error: ' + data.error,'bot');
      else addBubble('Sorry, I could not generate a reply just now.','bot');
    } catch(e){
      const last = elThread.lastElementChild;
      if (last && last.textContent.includes('Typing')) last.remove();
      addBubble('Network error. Please try again.','bot');
    }
  }

  if (elForm) {
    elForm.addEventListener('submit', function(e){
      e.preventDefault();
      const msg = elInput.value.trim();
      if (!msg) return;
      elInput.value = '';
      ask(msg);
    });
  }

  // suggestion chips
  document.querySelectorAll('#hc-chat [data-suggest]').forEach(btn=>{
    btn.addEventListener('click', ()=> {
      elInput.value = btn.getAttribute('data-suggest');
      elInput.focus();
    });
  });
})();
</script>

<?php include __DIR__ . '/partials/footer.php'; ?>

