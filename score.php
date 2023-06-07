<?php
require 'permission/xcx.php';
require 'permission/superadmin.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更改用户积分</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <div class="login-form">
    <h1>更改用户积分</h1>
    <form action="score_process.php" method="post">
        <label for="username">学号：</label>
        <input type="number" id="username" name="username" min="10000000" max="9999999999999" step="1" required>
        <label for="option">操作：</label>
        <select id="option" name="option">
            <option value="+">增加</option>
            <option value="-">减少</option>
        </select></br></br></br>
        <label for="score">积分：</label>
        <input type="number" id="score" name="score" step="1" required>
        <button type="submit">确定</button>
    </form>
        <a href="admin.php" class="register-link">返回审核</a>
    </div>
</body>
</html>
