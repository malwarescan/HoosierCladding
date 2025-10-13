<?php
// /api/chat.php
declare(strict_types=1);
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
$system = "You are Hoosier Cladding's siding assistant for Northern Indiana. Be concise, helpful, and knowledgeable about:
- Siding materials (vinyl, fiber cement, wood)
- Indiana climate challenges (freeze-thaw, lake-effect weather, harsh winters)
- Storm damage, repairs, and replacements
- Energy efficiency improvements

".($context ? "Customer is viewing: $context\n\n" : "")."Ask one clarifying question if needed. Offer to schedule a free estimate when appropriate. Avoid emojis. Keep responses under 200 words.";

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

