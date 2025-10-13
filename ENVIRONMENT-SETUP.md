# Environment Setup

## OpenAI API Key

The AI chat assistant requires an OpenAI API key.

### Getting Your API Key

1. Go to: https://platform.openai.com/api-keys
2. Click "Create new secret key"
3. Copy the key (starts with `sk-...`)
4. Store securely

### Setting the Environment Variable

**Railway (Production):**
```
Variables tab → Add Variable
Key: OPENAI_API_KEY
Value: sk-your-actual-key-here
```

**Local Development (macOS/Linux):**
```bash
export OPENAI_API_KEY="sk-your-key-here"
php -S localhost:8080 router.php
```

**Apache:**
```apache
<VirtualHost *:80>
    SetEnv OPENAI_API_KEY "sk-your-key-here"
</VirtualHost>
```

### Security Notes

- Never commit API keys to git
- Never expose keys in client-side code
- Use environment variables only
- Rotate keys if compromised

