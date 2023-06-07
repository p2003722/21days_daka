<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>重新审核</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>

    <div class="login-form">
    <h1>重新审核</h1>
    <form action="reassessment_process.php" method="post">
        <label for="username">ID：</label>
        <input type="number" id="id" name="id" step="1" required>
        <input type="hidden" id="admin" name="admin" value="<?php echo $user['name']; ?>">
        <button type="submit">确认</button>
    </form>
        <a href="admin.php" class="register-link">返回审核</a>
    </div>
    
</body>
</html>
