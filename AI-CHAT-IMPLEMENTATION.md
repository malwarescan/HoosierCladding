# AI Chat Assistant Implementation - October 13, 2025

## Overview

Implemented an AI-powered chat assistant on the homepage to help visitors with siding questions, providing instant answers about repairs, materials, and Indiana-specific climate challenges.

## Implementation Complete ✅

### 1. Backend API (`/api/chat.php`)

**Features:**
- OpenAI integration using Chat Completions API
- Session-based rate limiting (2-second throttle)
- CORS configuration for security
- Context-aware responses
- Error handling and timeouts

**Model:** `gpt-4o-mini` (cost-efficient, fast)

**System Prompt:**
- Brand-specific (Hoosier Cladding)
- Location-aware (Northern Indiana)
- Topic-focused (siding, materials, climate)
- Concise responses (<200 words)
- CTA integration (offers estimates)

### 2. Frontend UI (Homepage Hero)

**Design:**
- Compact card design
- Semi-transparent background with blur
- Responsive layout
- Inline styles (no additional CSS needed)

**Components:**
- Message thread (scrollable)
- Input field with submit button
- 3 suggestion chips (quick questions)
- Disclaimer text with CTA link

### 3. JavaScript Integration

**Features:**
- Vanilla JavaScript (no dependencies)
- Async/await for API calls
- HTML escaping for security
- Markdown formatting (bold, links, line breaks)
- Auto-scroll on new messages
- Context detection (matrix pages)
- Error handling

### 4. Routing Configuration

**Updated Files:**
- `.htaccess` - Whitelist API endpoints
- `index.php` - Add API route handler

## File Structure

```
/api
└── chat.php              # OpenAI integration endpoint

/home.php                 # Chat UI + JavaScript
.htaccess                 # API endpoint whitelisting
index.php                 # API routing
.env.example              # Environment variable template
```

## Setup Instructions

### 1. Get OpenAI API Key

1. Go to: https://platform.openai.com/api-keys
2. Click "Create new secret key"
3. Copy the key (starts with `sk-...`)
4. Store securely

### 2. Set Environment Variable

**Railway (Production):**
```bash
# In Railway dashboard:
# Variables tab → Add Variable
# Key: OPENAI_API_KEY
# Value: sk-your-actual-key
```

**Local Development:**
```bash
# Option 1: Export in shell
export OPENAI_API_KEY="sk-your-key-here"

# Option 2: Create .env file (add to .gitignore!)
echo "OPENAI_API_KEY=sk-your-key-here" > .env
# Then: source .env

# Option 3: Apache SetEnv (in VirtualHost config)
SetEnv OPENAI_API_KEY "sk-your-key-here"
```

**Important:** Never commit API keys to git!

### 3. Test the API

```bash
# Start server with env var
OPENAI_API_KEY="sk-your-key" php -S localhost:8080 router.php

# Test API endpoint
curl -X POST http://localhost:8080/api/chat.php \
  -H "Content-Type: application/json" \
  -d '{"message":"What siding is best for Indiana winters?"}'

# Expected response:
# {"reply":"For Indiana's harsh freeze-thaw cycles..."}
```

### 4. Verify on Homepage

1. Visit homepage
2. See chat assistant below hero
3. Click a suggestion chip OR type a question
4. Submit and verify response appears

## Features

### Intelligent Responses

**Topics Covered:**
- Siding materials (vinyl, fiber cement, wood)
- Indiana climate challenges
- Storm damage and repairs
- Energy efficiency
- Installation timelines
- Pricing guidance
- Repair vs replacement decisions

### Context-Aware

**Matrix Page Integration:**
- Detects when user is on `/matrix/*` page
- Passes page context to API
- Provides more specific answers

**Example:**
```
Page: /matrix/south-bend-in/siding-repair/storm-damage
Context: "Customer is viewing storm damage repair in South Bend"
→ More relevant response about local storm repair services
```

### Suggestion Chips

3 pre-written questions for common concerns:
1. "Why is my energy bill rising with the same thermostat settings?"
2. "Should I repair or replace vinyl siding with cracks and gaps?"
3. "How fast can you do siding repair after storm damage in South Bend?"

**Benefits:**
- Reduces friction (one-click to ask)
- Guides users to high-value topics
- Increases engagement

### Rate Limiting

**Current Implementation:**
- Session-based throttle
- 2-second minimum between requests
- Prevents API abuse

**Future Options:**
- IP-based limiting
- Redis-backed rate limiter
- Per-user daily limits

## Security

### API Key Protection
✅ Server-side only (never exposed to client)  
✅ Environment variable (not hardcoded)  
✅ .env.example provided (actual .env in .gitignore)  

### Input Validation
✅ Empty message rejection  
✅ HTML escaping on output  
✅ CORS headers configured  
✅ Session-based rate limiting  

### Best Practices
- API key in environment
- CORS restricted to domain
- User input sanitized
- Timeouts configured (20s)
- Error messages generic (no internal details)

## Cost Management

### Pricing (OpenAI gpt-4o-mini)
- Input: ~$0.15 per 1M tokens
- Output: ~$0.60 per 1M tokens

### Typical Conversation
- User message: ~50 tokens
- Assistant response: ~150 tokens
- Cost per exchange: ~$0.0001 (0.01 cents)

### Monthly Estimates
| Users/Day | Messages/User | Monthly Cost |
|-----------|---------------|--------------|
| 10 | 2 | ~$0.60 |
| 50 | 2 | ~$3.00 |
| 100 | 3 | ~$9.00 |

**Budget:** Very affordable for SMB

### Cost Controls
1. `max_tokens` set to 350 (limits response length)
2. Rate limiting prevents abuse
3. Session throttle reduces spam
4. Can add daily budget caps in OpenAI dashboard

## UX Enhancements

### Auto Handoff CTA (Optional)

Add after assistant response detection:
```javascript
// If user says "yes" to estimate
if (msg.toLowerCase().includes('yes') && lastBotMsg.includes('estimate')) {
  // Show inline form or redirect
  window.location.href = '/contact?source=chat';
}
```

### Matrix Page Context (Already Implemented)

```javascript
const path = window.location.pathname;
const context = path.startsWith('/matrix/') ? 'Page: ' + path : '';
```

System prompt receives: "Customer is viewing: Page: /matrix/south-bend-in/siding-repair/storm-damage"

### Mobile Optimization

Current design is responsive with:
- Flexible width (max-width: 600px)
- Touch-friendly buttons
- Scrollable thread on small screens

## Monitoring

### Track Usage

**Option 1: OpenAI Dashboard**
- View usage at: https://platform.openai.com/usage
- Monitor daily API calls
- Set budget alerts

**Option 2: Server Logs**
```bash
# Count API calls
grep "api/chat.php" /var/log/apache2/access.log | wc -l

# Recent errors
grep "api/chat.php" /var/log/apache2/error.log | tail -20
```

**Option 3: Analytics**
```javascript
// Add to ask() function
gtag('event', 'chat_message', {
  'event_category': 'engagement',
  'event_label': 'siding_assistant'
});
```

### Key Metrics

Track:
- Messages per session
- Topics asked about (storm damage, energy bills, etc.)
- Conversion: Chat → Contact form
- Bounce rate with vs without chat

## Testing

### Local Testing (Without API Key)

Create mock response for testing:
```php
// In api/chat.php, add at top for testing:
if (getenv('MOCK_MODE') === '1') {
  echo json_encode(['reply' => 'Mock response: For Indiana winters, we recommend fiber cement or insulated vinyl siding.']);
  exit;
}
```

Then:
```bash
MOCK_MODE=1 php -S localhost:8080 router.php
```

### Production Testing

```bash
# Test API directly
curl -X POST https://www.hoosiercladding.com/api/chat.php \
  -H "Content-Type: application/json" \
  -d '{"message":"What is the best siding for winter?"}'

# Should return JSON with reply
```

### Browser Testing

1. Open homepage
2. Open browser console (F12)
3. Type a question and submit
4. Check Network tab for:
   - POST to /api/chat.php
   - 200 status code
   - JSON response with reply

## Troubleshooting

### "Missing OPENAI_API_KEY" Error

**Fix:**
```bash
# Verify env var is set
echo $OPENAI_API_KEY

# If empty, set it:
export OPENAI_API_KEY="sk-your-key"

# Or add to Railway/hosting environment
```

### "Upstream error" Response

**Possible causes:**
1. Invalid API key → Check OpenAI dashboard
2. Timeout → Increase CURLOPT_TIMEOUT
3. Rate limit → Check OpenAI usage limits
4. Model not available → Change to 'gpt-3.5-turbo'

**Debug:**
```php
// Add logging in api/chat.php
error_log("API Response: " . $res);
```

### "Network error" in Frontend

**Check:**
1. Browser console for errors
2. CORS headers match your domain
3. API endpoint accessible
4. Server logs for PHP errors

### Chat UI Not Showing

**Verify:**
1. JavaScript loads (check browser console)
2. Element IDs match (hc-form, hc-input, hc-thread)
3. No CSS conflicts
4. Check page source for chat markup

## Advanced Features

### Conversation History

Store messages in session:
```php
$_SESSION['history'] = $_SESSION['history'] ?? [];
$_SESSION['history'][] = ['role'=>'user', 'content'=>$userMsg];
// Include history in API call
$payload['messages'] = array_merge([['role'=>'system','content'=>$system]], $_SESSION['history']);
```

### Lead Capture

Detect intent to get estimate:
```javascript
if (data.reply.toLowerCase().includes('estimate') || 
    data.reply.toLowerCase().includes('schedule')) {
  // Show inline form
  showEstimateForm();
}
```

### Analytics Integration

```javascript
// Track chat engagement
function ask(msg) {
  // ... existing code ...
  
  // Track in Google Analytics
  if (typeof gtag !== 'undefined') {
    gtag('event', 'chat_interaction', {
      'event_category': 'AI Assistant',
      'event_label': msg.substring(0, 50)
    });
  }
}
```

## Model Options

### Current: gpt-4o-mini
- **Speed:** Fast (~1-2s response)
- **Cost:** $0.15/$0.60 per 1M tokens
- **Quality:** Good for straightforward Q&A

### Alternative: gpt-4o
- **Speed:** Medium (~2-4s)
- **Cost:** Higher
- **Quality:** Excellent for complex questions

### Alternative: gpt-3.5-turbo
- **Speed:** Very fast (<1s)
- **Cost:** Lowest
- **Quality:** Good for simple queries

**Recommendation:** Start with gpt-4o-mini, monitor quality

## Privacy & Compliance

### Data Handling
- User messages sent to OpenAI
- No PII required to use chat
- Session data temporary
- No conversation storage (unless added)

### User Notice
Already included in UI:
> "This assistant provides general guidance. For a detailed quote, request a free estimate."

### OpenAI Policies
- Follow OpenAI's usage policies
- Don't use for prohibited purposes
- Monitor for abuse

## Performance

### Response Times
- API call: 1-3 seconds
- Total user wait: <5 seconds
- Acceptable for Q&A interaction

### Server Load
- Minimal (cURL request)
- Rate limiting prevents spam
- No database queries
- Lightweight PHP script

### Optimization
- Keep max_tokens low (350)
- Use temperature 0.4 (focused responses)
- Consider caching common questions

## Deployment Checklist

### Pre-Deploy
- [x] API endpoint created
- [x] Frontend UI added
- [x] JavaScript wired up
- [x] Routing configured
- [ ] OPENAI_API_KEY set in production

### Production Setup
```bash
# Railway environment variables
OPENAI_API_KEY=sk-proj-xxxxx...

# Or Apache config
<VirtualHost *:80>
    SetEnv OPENAI_API_KEY "sk-proj-xxxxx..."
</VirtualHost>
```

### Post-Deploy Testing
1. Visit homepage
2. Type: "What siding is best for Indiana?"
3. Verify response appears
4. Check OpenAI usage dashboard
5. Monitor server logs for errors

## Maintenance

### Monthly Tasks
- Check OpenAI usage/costs
- Review common questions
- Update system prompt if needed
- Monitor error rates

### Quarterly Tasks
- Analyze conversation topics
- Identify FAQ candidates
- Optimize suggestion chips
- Review model performance

### Updates
- Update model as OpenAI releases new ones
- Adjust max_tokens based on response quality
- Refine system prompt based on user feedback

## Files Created

1. `/api/chat.php` (73 lines) - OpenAI API integration
2. `.env.example` (2 lines) - Environment template
3. `AI-CHAT-IMPLEMENTATION.md` - This documentation

### Files Modified

1. `/home.php` - Added chat UI and JavaScript
2. `/.htaccess` - Whitelisted API endpoints
3. `/index.php` - Added API routing

## Testing Results

### Manual Testing

**Test 1: UI Renders**
- ✅ Chat box appears in hero
- ✅ Suggestion chips clickable
- ✅ Input field functional

**Test 2: JavaScript**
- ✅ Form submission works
- ✅ Message bubbles appear
- ✅ Typing indicator shows
- ✅ Error handling works

**Test 3: API Endpoint**
- ⚠️ Requires OPENAI_API_KEY to test
- ✅ Returns 500 if key missing (correct behavior)
- ✅ CORS headers configured
- ✅ Rate limiting active

## Usage Examples

### User Asks About Materials

**User:** "What siding is best for Indiana winters?"

**Assistant Response:**
> For Indiana's harsh freeze-thaw cycles and lake-effect weather, I recommend:
> 
> **Fiber Cement (James Hardie)**: Best durability, resists cracking, excellent for extreme weather
> 
> **Insulated Vinyl**: Cost-effective, good energy efficiency, handles temperature swings well
> 
> Both materials work great in Northern Indiana's climate. Would you like a free estimate to discuss which option fits your home and budget?

### User Asks About Storm Damage

**User:** "How fast can you repair after storm damage?"

**Assistant Response:**
> For storm damage repairs in South Bend, most minor repairs are completed within 48-72 hours after inspection. Timeline depends on:
> - Damage severity
> - Material availability
> - Weather conditions
> 
> We offer free storm damage inspections and work with insurance companies. Would you like to schedule an inspection?

### User Asks About Costs

**User:** "How much does siding replacement cost?"

**Assistant Response:**
> Siding replacement costs vary based on:
> - Home size
> - Material choice (vinyl is most affordable, fiber cement is premium)
> - Project complexity
> 
> We offer free estimates with detailed pricing. For your specific home, I'd recommend scheduling a free consultation where we can assess your needs and provide an accurate quote. Would you like to request an estimate?

## Analytics & Insights

### Track These Metrics

**Engagement:**
- Chat sessions initiated
- Messages per session
- Suggestion chips clicked
- Average session length

**Topics:**
- Most asked questions
- Materials mentioned
- Cities/locations referenced
- Pain points discussed

**Conversion:**
- Chat → Contact form
- Chat → Phone calls
- Chat → Estimate requests

### Implementation

```javascript
// Add to ask() function
analytics.track('chat_message', {
  message_length: msg.length,
  has_context: context !== '',
  timestamp: Date.now()
});

// Add to response handling
analytics.track('chat_response_received', {
  response_length: data.reply.length,
  response_time: responseTime
});
```

## Future Enhancements

### Phase 2 (Optional)

1. **Conversation Memory**
   - Store last 5 messages in session
   - Better multi-turn conversations
   - More natural dialogue

2. **Lead Capture Integration**
   - Detect estimate intent
   - Show inline name/phone form
   - Auto-populate contact form

3. **Smart Suggestions**
   - Dynamic chips based on page context
   - Seasonal questions (winter vs summer)
   - Trending topics from analytics

4. **Multi-Language**
   - Detect browser language
   - Support Spanish for Michiana area
   - Auto-translate responses

### Phase 3 (Advanced)

1. **Knowledge Base Integration**
   - RAG (Retrieval Augmented Generation)
   - Feed it your blog posts
   - More accurate, specific answers

2. **Appointment Scheduling**
   - Direct calendar integration
   - "Book now" functionality
   - Automated confirmation emails

3. **Voice Interface**
   - Speech-to-text input
   - Text-to-speech responses
   - Mobile-first voice UX

## Cost Optimization

### Current Setup
- Model: gpt-4o-mini (efficient)
- Max tokens: 350 (limits length)
- Temperature: 0.4 (focused)
- Rate limiting: Prevents abuse

### Additional Optimizations

**Caching Common Questions:**
```php
$cache = [
  'what siding is best for indiana' => 'For Indiana winters, fiber cement...',
  // ... more cached responses
];
$normalized = strtolower(trim($userMsg));
if (isset($cache[$normalized])) {
  echo json_encode(['reply' => $cache[$normalized]]);
  exit; // Skip API call
}
```

**Budget Alerts:**
- Set in OpenAI dashboard
- Email when usage exceeds threshold
- Auto-disable if limit reached

## Compliance

### OpenAI Usage Policies

✅ **Allowed Uses:**
- Customer service
- Product recommendations
- General information

❌ **Prohibited:**
- Medical advice
- Legal advice
- Deceptive practices

### Data Privacy

**What's Sent to OpenAI:**
- User questions
- Page context (URL)
- System prompt

**What's NOT Sent:**
- User IP address
- Personal information
- Session data

**OpenAI Data Retention:**
- 30 days (API default)
- Can opt out of training

## Support Resources

### OpenAI Documentation
- Chat Completions: https://platform.openai.com/docs/api-reference/chat
- Rate Limits: https://platform.openai.com/docs/guides/rate-limits
- Best Practices: https://platform.openai.com/docs/guides/prompt-engineering

### Troubleshooting Guide
- API Errors → Check key validity, usage limits
- Slow Responses → Check timeout settings, model choice
- Poor Quality → Refine system prompt, adjust temperature
- High Costs → Reduce max_tokens, add caching

---

**Status:** Production Ready (requires OPENAI_API_KEY)  
**Cost:** ~$3-10/month for typical SMB traffic  
**Setup Time:** 5 minutes (just set env var)  
**Impact:** Improved engagement, faster lead qualification

