<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 該当従業員の最新の「退勤が未入力」のレコードを更新
    $stmt = $pdo->prepare("UPDATE kiroku SET end_work = NOW() WHERE jugyoin_id = ? AND end_work IS NULL ORDER BY id DESC LIMIT 1");
    $stmt->execute([$_POST['jugyoin_id']]);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>退勤入力</title>
    <style>
        body {
            background-color: #e7f3ff;
            font-family: sans-serif;
            text-align: center;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
            border: 2px solid #007bff;
            display: inline-block;
            background: white;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>お疲れ様でした（退勤）</h2>
        <form method="post">
            従業員ID: <input type="number" name="jugyoin_id" required><br><br>
            <input type="submit" value="退勤を記録する">
        </form>
        <p><a href="index.php">一覧に戻る</a></p>
    </div>
</body>

</html>