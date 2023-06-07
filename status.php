<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>审核记录</title>
    <link rel="stylesheet" href="/css/table.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <h1>审核记录</h1>
    
<?php
    
    $name = $user['name'];
    // 查询user_id为某一参数的数据并按时间排序
    $sql = "SELECT * FROM daka_records WHERE admin = '$name' ORDER BY id ASC";
    $result = $conn->query($sql);
    
    // 输出数据
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>打卡ID</th><th>打卡时间</th><th>打卡项目</th><th>审核状态</th><th>审核时间</th><th>查看图片</th></tr>
      ";
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        
        echo "<td>";
        echo $row["id"];
        echo "</td>";
        
        echo "<td>";
        echo $row["date"]. " ". $row["time"];
        echo "</td>";
        
        echo "<td>";
        if ($row["type"] == 0) {echo "每日步数";}
        else if ($row["type"] == 1) {echo "健身动作";}
        else if ($row["type"] == 2) {echo "校园跑";}
        else {echo "错误";}
        echo "</td>";
        
        echo "<td>";
        if ($row["status"] == 0) {echo "待审核";}
        else if ($row["status"] == 1) {echo "审核通过";}
        else if ($row["status"] == 2) {echo "审核拒绝";}
        else if ($row["status"] == 3) {echo "已撤回";}
        else if ($row["status"] == 4) {echo "恶意提交";}
        else if ($row["status"] == 5) {echo "等待复审";}
        else {echo "错误";}
        echo "</td>";
        
        echo "<td>";
        if ($row["status"] == 0) {echo "待审核";}
        else if ($row["status"] == 3) {echo "已撤回";}
        else {
            echo $row["admin_date"]. " ". $row["admin_time"];
        } echo "</td>";
        
        echo "<td>";
        if ($row["image_path"] != 0) {echo "<a href=\"/". $row["image_path"]. "\">查看图片</a>";}
        else {echo "错误";}
        echo "</td>";
        
        echo "</tr>
        ";
      }
      echo "</table>";
    } else {
      echo "0 results";
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
    <td><a href="admin.php"><input type=button value="返回" ></a></td>
    </div>

</body>
</html>
