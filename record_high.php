<?php
require_once 'db_connection.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>打卡5分记录</title>
    <link rel="stylesheet" href="/css/table.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
<?php

    // 查询user_id为某一参数的数据并按时间排序
    $sql = "SELECT * FROM daka_records WHERE score = 5 ORDER BY id ASC";
    $result = $conn->query($sql);
    
    // 输出数据
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>打卡ID</th><th>姓名</th><th>打卡时间</th><th>审核时间</th><th>审核人员</th><th>打卡项目</th><th>审核状态</th><th>查看图片</th></tr>
      ";
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        
        echo "<td>";
        echo $row["id"];
        echo "</td>";
        
        echo "<td>";
        echo $row["name"];
        echo "</td>";
        
        echo "<td>";
        echo $row["date"]. " ". $row["time"];
        echo "</td>";
        
        echo "<td>";
        echo $row["admin_date"]. " ". $row["admin_time"];
        echo "</td>";
        
        echo "<td>";
        echo $row["admin"];
        echo "</td>";
        
        echo "<td>";
        if ($row["type"] == 0) {echo "每日步数";}
        else if ($row["type"] == 1) {echo "健身动作";}
        else if ($row["type"] == 2) {echo "校园跑";}
        else {echo "错误";}
        echo "</td>";
        
        echo "<td>";
        if ($row["status"] == 0) {echo "待审核";}
        else if ($row["status"] == 1) {
            if ($row["score"] == 0) {
                echo "审核通过";
            } else if ($row["score"] != 0) {
                echo "审核：". $row["score"]. "分";
            }
        }
        else if ($row["status"] == 2) {echo "审核拒绝";}
        else if ($row["status"] == 3) {echo "记录删除";}
        else if ($row["status"] == 4) {echo "恶意提交";}
        else if ($row["status"] == 5) {echo "等待复审";}
        else {echo "错误";}
        echo "</td>";
        
        echo "<td>";
        if ($row["image_path"] != 0 && $row["status"] != 3) {echo "<a href=\"/". $row["image_path"]. "\">查看图片</a>";}
        else if ($row["status"] == 3) {echo "记录删除";}
        else {echo "错误";}
        echo "</td>";
        
        echo "</tr>
        ";
      }
      echo "</table>";
    } else {
      echo "<div><h2>暂无打卡记录！</h2></div>";
    }

?>

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
