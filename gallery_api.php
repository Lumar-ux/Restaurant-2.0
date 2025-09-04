<?php
header('Content-Type: application/json; charset=utf-8');

try {
  $pdo = new PDO(
    'mysql:host=localhost;dbname=db_tavola;charset=utf8',
    'root',
    '',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
} catch (Throwable $e) {
  echo json_encode([]);
  exit;
}

try {
  // Fetch latest 3 images from gallery table
  $stmt = $pdo->query('SELECT filename FROM gallery ORDER BY date1 DESC, id DESC LIMIT 3');
  $rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
  $basePath = 'images/uploads/';
  $out = [];
  foreach ($rows as $r) {
    if (!empty($r['filename'])) {
      $out[] = $basePath . $r['filename'];
    }
  }
  echo json_encode($out);
} catch (Throwable $e) {
  echo json_encode([]);
}