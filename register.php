<?php
require 'permission/xcx.php';
require 'permission/login.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>注册</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <div class="login-form">
    <h1>用户注册</h1>
    <form action="register_process.php" method="post" id="passwordForm">
        <a class="login-link">未设置密码用户重新注册不会清除打卡记录</a></br>
        <label for="username">学号：</label>
        <input type="number" id="username" name="username" min="10000000" max="9999999999999" step="1" required>
        <label for="username">姓名：</label>
        <input type="text" id="name" name="name" required>
        <label for="password">密码：</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">注册</button>
    </form>
        <a href="login.php" class="login-link">已有账号？点击登录</a>
    </div>
    
    <script>
        // 在表单提交前进行密码哈希
        document.getElementById("passwordForm").addEventListener("submit", function(event) {
            event.preventDefault(); // 阻止表单默认提交行为
    
            var password = document.getElementById("password").value;
    
            // 使用SHA256哈希函数对密码进行哈希
            var hashedPassword = CryptoJS.SHA512(password).toString();
    
            // 将编码后的密码赋值回表单字段
            document.getElementById("password").value = hashedPassword;
    
            // 提交表单
            this.submit();
        });
    </script>
    
</body>
</html>
