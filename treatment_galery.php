<?php
// Handle gallery image upload, persist to DB, and redirect back to gallery backoffice
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  try {
    $pdo = new PDO(
      'mysql:host=localhost;dbname=db_tavola;charset=utf8',
      'root',
      '',
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  } catch (Throwable $e) {
    http_response_code(500);
    echo 'Database connection error.';
    exit;
  }

  $date = $_POST['date1'] ?? date('Y-m-d H:i:s');
  $name = trim((string)($_POST['name'] ?? ''));
  if ($name === '' && !empty($_FILES['image']['name'] ?? '')) {
    $name = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME);
  }

  if (!isset($_FILES['image']) || ($_FILES['image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
    header('Location: galery_BackO.php?error=upload');
    exit;
  }

  $tmpPath = $_FILES['image']['tmp_name'];
  // Validate image type (prefer mime via fileinfo, fallback to extension)
  $allowed = [
    'image/jpeg' => 'jpg',
    'image/png'  => 'png',
    'image/gif'  => 'gif',
    'image/webp' => 'webp',
  ];
  $mime = null;
  if (class_exists('finfo')) {
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->file($tmpPath) ?: null;
  }
  $ext = null;
  if ($mime && isset($allowed[$mime])) {
    $ext = $allowed[$mime];
  } else {
    $pathExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $extMap = ['jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif', 'webp' => 'image/webp'];
    if (isset($extMap[$pathExt])) {
      $ext = $pathExt === 'jpeg' ? 'jpg' : $pathExt;
      $mime = $extMap[$pathExt];
    }
  }
  if (!$ext) {
    header('Location: galery_BackO.php?error=type');
    exit;
  }

  // Generate safe unique filename
  try {
    $base = bin2hex(random_bytes(8));
  } catch (Throwable $e) {
    $base = uniqid('img_', true);
  }
  $filename = $base . '.' . $ext;

  // Ensure upload directory exists
  $uploadDir = __DIR__ . '/images/uploads';
  if (!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
  }

  $destPath = $uploadDir . '/' . $filename;
  if (!move_uploaded_file($tmpPath, $destPath)) {
    header('Location: galery_BackO.php?error=move');
    exit;
  }

  // Ensure `gallery` table exists and insert record
  $pdo->exec(
    "CREATE TABLE IF NOT EXISTS gallery (
      id INT AUTO_INCREMENT PRIMARY KEY,
      date1 DATETIME NOT NULL,
      name VARCHAR(255) NOT NULL,
      filename VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
  );

  $stmt = $pdo->prepare('INSERT INTO gallery (date1, name, filename) VALUES (:date1, :name, :filename)');
  $stmt->execute([
    ':date1'    => $date,
    ':name'     => $name,
    ':filename' => $filename,
  ]);

  header('Location: galery_BackO.php?uploaded=1');
  exit;
}

// Handle delete requests
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'], $_POST['delete_id'])) {
  try {
    $pdo = new PDO(
      'mysql:host=localhost;dbname=db_tavola;charset=utf8',
      'root',
      '',
      [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
  } catch (Throwable $e) {
    header('Location: galery_BackO.php?error=db');
    exit;
  }

  $id = (int) $_POST['delete_id'];
  $stmt = $pdo->prepare('SELECT filename FROM gallery WHERE id = :id');
  $stmt->execute([':id' => $id]);
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $pdo->prepare('DELETE FROM gallery WHERE id = :id')->execute([':id' => $id]);
    $path = __DIR__ . '/images/uploads/' . $row['filename'];
    if (is_file($path)) {
      @unlink($path);
    }
  }

  header('Location: galery_BackO.php?deleted=1');
  exit;
}

// Fallback: redirect to backoffice gallery if accessed directly
header('Location: galery_BackO.php');
exit;