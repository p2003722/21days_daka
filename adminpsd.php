<?php
require 'permission/xcx.php';
require 'permission/superadmin.php';
?>

<?php
$length = 8; // 设置密码长度为8个字符
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$password = '';
for ($i = 0; $i < $length; $i++) {
  $password .= $characters[rand(0, strlen($characters) - 1)];
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更改用户密码</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <div class="login-form">
    <h1>更改用户密码</h1>
    <form action="adminpsd_process.php" method="post" id="passwordForm">
        <label for="username">学号：</label>
        <input type="number" id="username" name="username" min="10000000" max="9999999999999" step="1" required>
        <label for="password">密码：</label>
        <input type="text" id="password" name="password" value="<?php echo $password;?>" required>
        <button type="submit">确定</button>
    </form>
        <a href="admin.php" class="register-link">返回审核</a>
    </div>
    
    <script>
        // 在表单提交前进行密码哈希
        document.getElementById("passwordForm").addEventListener("submit", function(event) {
            event.preventDefault(); // 阻止表单默认提交行为
    
            var password = document.getElementById("password").value;
    
            // 使用SHA512哈希函数对密码进行哈希
            var hashedPassword = CryptoJS.SHA512(password).toString();
    
            // 将编码后的密码赋值回表单字段
            document.getElementById("password").value = hashedPassword;
    
            // 提交表单
            this.submit();
        });
    </script>
    
</body>
</html>
