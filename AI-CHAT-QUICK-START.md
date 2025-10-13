# AI Chat Assistant - Quick Start Guide

## What It Does

An AI-powered chat assistant that helps visitors with siding questions directly on your homepage.

## Setup (5 Minutes)

### Step 1: Get OpenAI API Key

1. Visit: https://platform.openai.com/api-keys
2. Click "Create new secret key"
3. Copy the key (starts with `sk-...`)

### Step 2: Set Environment Variable

**Railway:**
```
Dashboard → Variables → Add Variable
OPENAI_API_KEY = sk-your-key-here
```

**Local:**
```bash
export OPENAI_API_KEY="sk-your-key-here"
```

### Step 3: Test

```bash
# Test API endpoint
curl -X POST https://www.hoosiercladding.com/api/chat.php \
  -H "Content-Type: application/json" \
  -d '{"message":"What siding is best for Indiana?"}'

# Visit homepage and try the chat
```

## Features

✅ Instant answers to siding questions  
✅ Indiana climate expertise  
✅ Storm damage, repairs, materials  
✅ Energy efficiency advice  
✅ Free estimate offers  
✅ 3 suggestion chips for quick questions  

## Cost

**Model:** gpt-4o-mini  
**Typical Cost:** $3-10/month  
**Per Message:** ~$0.0001 (0.01 cents)

## Files

- `/api/chat.php` - Backend API
- `/home.php` - Chat UI + JavaScript
- `/.htaccess` - API routing
- `/index.php` - API route handler

## Testing

Visit homepage → See chat box → Type question → Get answer

## Documentation

- `AI-CHAT-IMPLEMENTATION.md` - Full technical docs
- `ENVIRONMENT-SETUP.md` - Environment variable setup

## Support

If chat not working:
1. Check OPENAI_API_KEY is set
2. Check browser console for errors
3. Test API endpoint with curl
4. Review server logs

---

**Ready to deploy!** Just set the OPENAI_API_KEY environment variable.

