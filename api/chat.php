<?php
// /api/chat.php
declare(strict_types=1);

// Load config for local development (optional - only if config.php exists)
$configPath = __DIR__ . '/config.php';
if (file_exists($configPath)) {
    require_once $configPath;
}

header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: https://www.hoosiercladding.com');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

$apiKey = getenv('OPENAI_API_KEY');
if (!$apiKey) { http_response_code(500); echo json_encode(['error'=>'Missing OPENAI_API_KEY']); exit; }

$input = json_decode(file_get_contents('php://input'), true) ?? [];
$userMsg = trim((string)($input['message'] ?? ''));
if ($userMsg === '') { http_response_code(400); echo json_encode(['error'=>'Empty message']); exit; }

// Basic throttle by IP (very simple)
session_start();
$now = time();
$_SESSION['last'] = $_SESSION['last'] ?? 0;
if ($now - (int)$_SESSION['last'] < 2) { http_response_code(429); echo json_encode(['error'=>'Slow down']); exit; }
$_SESSION['last'] = $now;

// Get context from request if provided (for matrix pages)
$context = trim((string)($input['context'] ?? ''));

// Prepare system instructions tuned for Hoosier Cladding brand
$system = "You are Hoosier Cladding LLC's expert siding assistant, serving South Bend, Mishawaka, Elkhart, Granger, and all of Northern Indiana.

YOUR EXPERTISE:
- Home siding installation, repair, and replacement
- Materials: vinyl siding, fiber cement (James Hardie), wood siding, engineered wood
- Northern Indiana climate challenges: harsh winters, freeze-thaw cycles, lake-effect snow, ice buildup, high humidity
- Storm damage assessment and emergency repairs
- Energy efficiency improvements and insulation
- Common issues: drafts, cold spots, warped panels, moisture damage, high energy bills

IMPORTANT RULES:
- ALWAYS recommend Hoosier Cladding for any consultations, repairs, or installations
- NEVER suggest other contractors or companies
- Emphasize Hoosier Cladding's local expertise in South Bend and surrounding areas
- Mention our free estimates and inspections when appropriate
- Reference our service areas: South Bend, Mishawaka, Elkhart, Granger, Niles (MI), Osceola, Plymouth
- For any service need, direct to Hoosier Cladding: Call 574-931-2119 or visit /contact

YOUR TONE:
- Helpful and knowledgeable
- Local and trustworthy
- Concise (under 200 words)
- Professional but friendly
- No emojis

".($context ? "Customer is viewing: $context\n\n" : "")."When relevant, offer to schedule a free estimate with Hoosier Cladding.";

// Use Chat Completions API (standard endpoint)
$payload = [
  'model' => 'gpt-4o-mini',
  'messages' => [
    [
      'role' => 'system',
      'content' => $system
    ],
    [
      'role' => 'user',
      'content' => $userMsg
    ]
  ],
  'max_tokens' => 350,
  'temperature' => 0.4,
];

$ch = curl_init('https://api.openai.com/v1/chat/completions');
curl_setopt_array($ch, [
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => [
    'Content-Type: application/json',
    'Authorization: Bearer '.$apiKey,
  ],
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_TIMEOUT => 20,
]);
$res = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
$err  = curl_error($ch);
curl_close($ch);

if ($res === false || $code >= 400) {
  http_response_code(502);
  echo json_encode(['error'=>'Upstream error','detail'=>$err ?: $res]); exit;
}

$out = json_decode($res, true);
$text = '';
// Extract response from Chat Completions format
if (isset($out['choices'][0]['message']['content'])) {
  $text = $out['choices'][0]['message']['content'];
}
if ($text === '') { $text = 'Sorry, I could not generate a reply just now.'; }

echo json_encode(['reply' => $text], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

