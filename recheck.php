<?php
require 'permission/xcx.php';
require 'permission/user.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>提交复审</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>

    <div class="login-form">
    <h1>提交复审</h1>
    <form action="recheck_process.php" method="post">
        <label for="username">打卡ID：</label>
        <input type="number" id="id" name="id" step="1" placeholder="请输入需要提交复审的打卡ID" required>
        <label for="username">复审理由：</label>
        <input type="text" id="adminresult" name="adminresult" placeholder="请输入申请提交复审的理由" required>
        <button type="submit">提交</button>
    </form>
        <a href="index.php" class="register-link">返回主页</a>
    </div>
    
</body>
</html>
