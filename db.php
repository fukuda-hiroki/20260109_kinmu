<?php
$env_path = __DIR__ . '/.env';
if (!file_exists($env_path)) {
    exit('.envファイルが見つかりません: ' . $env_path);
}

$lines = file($env_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    if (strpos(trim($line), '#') === 0) continue;
    // 分割に失敗しないよう、より安全な記述に変更
    $parts = explode('=', $line, 2);
    if (count($parts) === 2) {
        putenv(trim($parts[0]) . "=" . trim($parts[1]));
    }
}

$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

// デバッグ用：何も表示されなければ、getenvに失敗しています
if (!$host) { exit('環境変数の読み込みに失敗しています。'); }

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
} catch (PDOException $e) {
    // 接続エラーの本当の理由を表示させる
    exit('DB接続エラー詳細: ' . $e->getMessage());
}

// 従業員一覧を取得する関数
function getJugyoinList($pdo) {
    $stmt = $pdo->query("SELECT * FROM jugyoin ORDER BY id ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>