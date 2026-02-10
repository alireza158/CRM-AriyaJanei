<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  http_response_code(204);
  exit;
}

function clean($v){
  $v = trim((string)$v);
  $v = str_replace(["\r","\n","\t"], ' ', $v);
  return $v;
}

// ??????: GET (??? ?? ?????? ????????)
$src  = clean($_GET['src']  ?? '');
// ??? GET ????? ?? POST JSON ????
if ($src === '') {
  $raw = file_get_contents('php://input');
  $data = json_decode($raw, true) ?: [];
  $src  = clean($data['src'] ?? 'direct');
  $camp = clean($data['camp'] ?? 'none');
} else {
  $camp = clean($_GET['camp'] ?? 'none');
}

if ($src === '') $src = 'direct';
if ($camp === '') $camp = 'none';

$ts = date('Y-m-d H:i:s');

$dir = __DIR__ . '/data';
if (!is_dir($dir)) mkdir($dir, 0755, true);

$file = $dir . '/yalda_views.csv';
$isNew = !file_exists($file);

$fp = fopen($file, 'ab');
if (!$fp) {
  echo json_encode(['status'=>'error','message'=>'cannot_write'], JSON_UNESCAPED_UNICODE);
  exit;
}

if (flock($fp, LOCK_EX)) {
  if ($isNew) {
    fwrite($fp, "\xEF\xBB\xBF");
    fputcsv($fp, ['created_at','src','camp']);
  }
  fputcsv($fp, [$ts, $src, $camp]);
  fflush($fp);
  flock($fp, LOCK_UN);
}
fclose($fp);

echo json_encode(['status'=>'ok','src'=>$src,'camp'=>$camp], JSON_UNESCAPED_UNICODE);
