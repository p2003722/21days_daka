<?php
require 'permission/xcx.php';
require 'permission/superadmin.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>用户信息</title>
    <link rel="stylesheet" href="/css/table.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <h1>用户信息</h1>
    
<?php

    // 查询user_id为某一参数的数据并按时间排序
    $sql = "SELECT * FROM users ORDER BY id ASC";
    $result = $conn->query($sql);
    
    // 输出数据
    if ($result->num_rows > 0) {
      echo "<table>";
      echo "<tr><th>用户ID</th><th>学号</th><th>姓名</th><th>积分</th><th>权限</th><th>上次登录时间</th><th>上次管理时间</th><th>注册时间</th></tr>
      ";
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        
        echo "<td>";
        echo $row["id"];
        echo "</td>";
        
        echo "<td>";
        echo $row["username"];
        echo "</td>";
        
        echo "<td>";
        echo $row["name"];
        echo "</td>";
        
        echo "<td>";
        echo $row["points"];
        echo "</td>";
        
        echo "<td>";
        if ($row["permission"] == 0) {echo "普通用户";}
        else if ($row["permission"] == 1) {echo "审核员";}
        else if ($row["permission"] == 2) {echo "管理员";}
        else {echo "错误";}
        echo "</td>";
        
        echo "<td>";
        echo $row["last_login_date"]. " ". $row["last_login_time"];
        echo "</td>";
        
        echo "<td>";
        if ($row["permission"] == 0) {echo "非管理";}
        else {echo $row["last_admin_date"]. " ". $row["last_admin_time"];}
        echo "</td>";
        
        echo "<td>";
        echo $row["register_date"]. " ". $row["register_time"];
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
