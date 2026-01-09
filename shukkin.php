<?php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO kiroku (jugyoin_id, start_work) VALUES (?, NOW())");
    $stmt->execute([$_POST['jugyoin_id']]);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>出勤入力</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #e6ffed;
            font-family: sans-serif;
            text-align: center;
        }

        .container {
            margin-top: 50px;
            padding: 20px;
            border: 2px solid #28a745;
            display: inline-block;
            background: white;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>おはようございます（出勤）</h2>
        <form method="post">
            従業員ID: <input type="number" name="jugyoin_id" required><br><br>
            <input type="submit" value="出勤を記録する">
        </form>
        <p><a href="index.php">一覧に戻る</a></p>
    </div>
</body>

</html>