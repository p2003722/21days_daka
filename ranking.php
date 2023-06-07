<?php
require 'permission/xcx.php';
require 'permission/user.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>打卡排名</title>
    <link rel="stylesheet" href="/css/table.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <h1>打卡排名</h1>
    <table>
        <tr>
            <th>排名</th>
            <th>姓名</th>
            <th>积分</th>
        </tr>
        <?php
        $sql = "SELECT * FROM users WHERE error < 3 AND points != 0 ORDER BY points DESC";
        $result = $conn->query($sql);
        $rank = 0;
        $last_points = 0;
        while ($row = $result->fetch_assoc()) {
            $rank = $rank + 1;
            if ($row['points'] == $last_points) {
                echo "<tr><td>$last_rank</td><td>{$row['name']}</td><td>{$row['points']}</td></tr>";
                $last_points = $row['points'];
            } else {
                echo "<tr><td>$rank</td><td>{$row['name']}</td><td>{$row['points']}</td></tr>";
                $last_points = $row['points'];
                $last_rank = $rank;
            }
        }
        ?>
    </table>
    
    <style>
    a {
        border-radius: 5px;
        box-shadow: 0 0 0 2px #fff;
        text-decoration: none;
    }
    </style>
    <div>
    <td><a href="index.php"><input type=button value="返回" ></a></td>
    </div>
    
</body>
</html>
