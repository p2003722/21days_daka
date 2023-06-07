<?php
require 'permission/user.php';
$username = $user['username'];
$name = $user['name'];
$college = $user['college'];
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>学院设置</title>
    <link rel="stylesheet" href="/css/login.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>

    <div class="login-form">
    <h1>学院设置</h1>
    <form action="college_process.php" method="post">
        <lable>姓名：<?php echo $name;?></lable></br>
        <lable>学号：<?php echo $username;?></lable></br>
        <lable>学院：
        <?php
            if ($college == 0) {
                echo "未设置";
            } else if ($college == 1) {
                echo "电气工程学院";
            } else if ($college == 2) {
                echo "能源与动力工程学院";
            } else if ($college == 3) {
                echo "自动化工程学院";
            } else if ($college == 4) {
                echo "化学工程学院";
            } else if ($college == 5) {
                echo "经济管理学院";
            } else if ($college == 6) {
                echo "建筑工程学院";
            } else if ($college == 7) {
                echo "计算机学院";
            } else if ($college == 8) {
                echo "机械工程学院";
            } else if ($college == 9) {
                echo "理学院";
            } else if ($college == 10) {
                echo "外国语学院";
            } else if ($college == 11) {
                echo "艺术学院";
            } else if ($college == 12) {
                echo "输变电技术学院";
            } else if ($college == 13) {
                echo "马克思主义学院";
            } else if ($college == 14) {
                echo "体育学院";
            } else if ($college == 15) {
                echo "媒体技术与传播系";
            }
        ;?></lable>
        
        <select id="college" name="college" required>
            <option value="" selected disabled hidden>请选择学院</option>
            <option value="1">电气工程学院</option>
            <option value="2">能源与动力工程学院</option>
            <option value="3">自动化工程学院</option>
            <option value="4">化学工程学院</option>
            <option value="5">经济管理学院</option>
            <option value="6">建筑工程学院</option>
            <option value="7">计算机学院</option>
            <option value="8">机械工程学院</option>
            <option value="9">理学院</option>
            <option value="10">外国语学院</option>
            <option value="11">艺术学院</option>
            <option value="12">输变电技术学院</option>
            <option value="13">马克思主义学院</option>
            <option value="14">体育学院</option>
            <option value="15">媒体技术与传播系</option>
        </select>
        
        </br>
        
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        
        <button type="submit">确认</button>
    </form>
    </form>
        <a href="index.php" class="register-link">返回主页</a>
    </div>
    
</body>
</html>
