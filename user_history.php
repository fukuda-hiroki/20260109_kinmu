<?php
require 'db.php';
$id = $_GET['id'] ?? null;
$stmt = $pdo->prepare("SELECT k.*, j.name FROM kiroku k JOIN jugyoin j ON k.jugyoin_id = j.id WHERE k.jugyoin_id = ? ORDER BY k.start_work DESC");
$stmt->execute([$id]);
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
    <title>個人別履歴</title>
    <style>
        body {
            background-color: #fff5e6;
            font-family: sans-serif;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            border: 1px solid #ffca2c;
            padding: 10px;
        }

        th {
            background-color: #ffca2c;
        }
    </style>
</head>

<body>
    <h1><?= htmlspecialchars($rows[0]['name'] ?? '従業員') ?> さんの記録</h1>
    <a href="index.php">全体一覧に戻る</a>
    <table>
        <tr>
            <th>出勤</th>
            <th>退勤</th>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= $row['start_work'] ?></td>
                <td><?= $row['end_work'] ?: '勤務中' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>