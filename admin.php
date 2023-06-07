<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>打卡审核</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    
    <h1>欢迎您，<?php echo $user['name']; ?></h1>
    <h2>当前日期：<?php echo $date; ?></h2>
    <h3>请选择您需要审核的项目：</h3>
    
    <table>
        <tr><td>
        <form action="admin_session.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" id="type" value="0">
        <button type="submit">每日步数</button></form>
        <?php
            $query = "SELECT COUNT(*) as resultCount FROM daka_records WHERE status = 0 AND type = 0";
            $queryResult = $conn->query($query);
            if ($queryResult && $queryResult->num_rows > 0) {
                $queryRow = $queryResult->fetch_assoc();
                $queryCount = $queryRow['resultCount'];
                echo "<h3>当前剩余审核量：$queryCount</h3>";
            } else {
                echo "<h3>计算剩余量时发生错误！</h3>";
            }
        ?>
        </td></tr><tr><td>
        <form action="admin_session.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" id="type" value="1">
        <button type="submit">健身动作</button></form>
        <?php
            $query = "SELECT COUNT(*) as resultCount FROM daka_records WHERE status = 0 AND type = 1";
            $queryResult = $conn->query($query);
            if ($queryResult && $queryResult->num_rows > 0) {
                $queryRow = $queryResult->fetch_assoc();
                $queryCount = $queryRow['resultCount'];
                echo "<h3>当前剩余审核量：$queryCount</h3>";
            } else {
                echo "<h3>计算剩余量时发生错误！</h3>";
            }
        ?>
        </td></tr><tr><td>
        <form action="admin_session.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" id="type" value="2">
        <button type="submit">校园跑</button></form>
        <?php
            $query = "SELECT COUNT(*) as resultCount FROM daka_records WHERE status = 0 AND type = 2";
            $queryResult = $conn->query($query);
            if ($queryResult && $queryResult->num_rows > 0) {
                $queryRow = $queryResult->fetch_assoc();
                $queryCount = $queryRow['resultCount'];
                echo "<h3>当前剩余审核量：$queryCount</h3>";
            } else {
                echo "<h3>计算剩余量时发生错误！</h3>";
            }
        ?>
        </td></tr>
    </table>
    
    <?php
    if ($permission == 2) {
    ?>
    
    <table>
        <tr><td>
        <form action="admin_session.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="type" id="type" value="3">
        <button type="submit">复审</button></form>
        <?php
            $query = "SELECT COUNT(*) as resultCount FROM daka_records WHERE status = 5";
            $queryResult = $conn->query($query);
            if ($queryResult && $queryResult->num_rows > 0) {
                $queryRow = $queryResult->fetch_assoc();
                $queryCount = $queryRow['resultCount'];
                echo "<h3>当前剩余审核量：$queryCount</h3>";
            } else {
                echo "<h3>计算剩余量时发生错误！</h3>";
            }
        ?>
        </td></tr>
    </table>
    
    <?php
    }
    ?>
    
    <div><a href="status.php"><input type=button value="审核记录" ></a></div>
    <!--<div><a href="reassessment.php"><input type=button value="重新审核" ></a></div>-->
    
    <?php
    if ($permission == 2) {
        echo "<div><a href=\"info.php\"><input type=button value=\"用户信息\" ></a></div>";
        echo "<div><a href=\"status_admin.php\"><input type=button value=\"审核信息\" ></a></div>";
        echo "<div><a href=\"score.php\"><input type=button value=\"操作积分\" ></a></div>";
        echo "<div><a href=\"adminpsd.php\"><input type=button value=\"用户改密\" ></a></div>";
    }
    ?>
    
    <div><a href="index.php"><input type=button value="主页" ></a><a href="logout.php"><input type=button value="登出" ></a></div>
    
</body>
</html>
