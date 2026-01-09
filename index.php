<?php
require 'db.php';
$stmt = $pdo->query("SELECT * FROM kiroku ORDER BY id DESC");
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>

<head>
    <title>勤怠一覧</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #fff5e6;
            font-family: sans-serif;
        }

        h1 {
            color: #fd7e14;
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
            text-align: center;
        }

        th {
            background-color: #ffca2c;
        }

        .nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn {
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            margin: 5px;
            border-radius: 5px;
        }

        .btn-shukkin {
            background: #28a745;
        }

        .btn-taikin {
            background: #007bff;
        }
    </style>
</head>

<body>
    <h1>全記録一覧</h1>
    <div class="nav">
        <a href="shukkin.php" class="btn btn-shukkin">出勤入力画面へ</a>
        <a href="taikin.php" class="btn btn-taikin">退勤入力画面へ</a>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>従業員ID</th>
            <th>出勤時刻</th>
            <th>退勤時刻</th>
        </tr>
        <?php foreach ($rows as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['jugyoin_id'] ?></td>
                <td><?= $row['start_work'] ?></td>
                <td><?= $row['end_work'] ?: '---' ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>