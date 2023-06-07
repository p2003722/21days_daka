<?php
require 'permission/xcx.php';
require 'permission/user.php';

if (!isset($_COOKIE['faq']) || $_COOKIE['faq'] != '1') {
    echo "<script>alert('请查看FAQ并确认收到！');location.href='faq.php';</script>";
} else {
    setcookie('faq', 1, time() + 604800, '/');
}

if (!isset($_COOKIE['request']) || $_COOKIE['request'] != '1') {
    echo "<script>alert('请勿上传PS照片！\\n达到三次将永久封号！');location.href='request.php';</script>";
} else {
    setcookie('request', 1, time() + 604800, '/');
}

$serverTime = date('Y-m-d H:i:s');
echo "<script>var serverTime = new Date('$serverTime');</script>";

?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>打卡页面</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    
    <?php
    if ($error == 1) {
        echo "<h1 style=\"color: red;\">您已有一次恶意提交</br>请注意</br>达到三次将会封禁帐号</h1>";
    } else if ($error == 2) {
        echo "<h1 style=\"color: red;\">您已有两次恶意提交</br>请注意</br>达到三次将会封禁帐号</h1>";
    }
    ?>
    
    
    
    <h1>欢迎您，<?php echo $user['name']; ?></h1>
    <h2>当前积分：<?php echo $user['points']; ?></h2>
    <h1 id="countdown"></h1>
    <?php
        if ($user['college'] == 0) {
            echo "<script>alert('请设置学院信息！');location.href='college.php';</script>";
        } else {
            echo "<div><a href=\"college.php\"><input type=\"button\" value=\"设置学院\"></a></div>";
        }
    ?>
    
    <div><a href="ranking.php"><input type="button" value="打卡排行"></a></div>
    <div><a href="record.php"><input type="button" value="打卡记录"></a></div>
    <div><a href="faq.php"><input type="button" value="FAQ"></a></div>
    
    <style>
    table {
      background-color: rgba(255, 255, 255);
    }
    </style>
    
    <?php
    $sql = "SELECT COUNT(*) FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='0' AND status != 3 ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count > 0 ) {
        $sql = "SELECT * FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='0' ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['status'] <= 2) {
            if ($row['status'] == 0) {
                echo "<h3>今日步数打卡待审核</h3>";
            } else if ($row['status'] == 1) {
                echo "<h3>今日步数打卡审核通过</h3>";
            } else if ($row['status'] == 2) {
                echo "<h3>今日步数打卡审核拒绝</h3>";
            }
    ?>
    <form action="delete.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="image_path" id="image_path" value="<?php echo $row['image_path']; ?>">
        <input type="hidden" name="type" id="type" value="<?php echo $row['type']; ?>">
        <input type="hidden" name="status" id="status" value="<?php echo $row['status']; ?>">
        <button type="submit">删除记录</button>
    </form>
    <?php
        } else if ($row['status'] == 4) {
        echo "<h2 style=\"color: red;\">今日步数打卡恶意提交</br>不允许重新提交</h2>";
        } else if ($row['status'] == 5) {
        echo "<h3>今日步数打卡复审中</h3>";
        }
    } else {
    ?>
    <table><tr><td><form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">每日步数：</label>
        <input type="hidden" name="name" id="name" value="<?php echo $user['name']; ?>">
        <input type="hidden" name="username" id="username" value="<?php echo $user['username']; ?>">
        <input type="hidden" name="type" id="type" value="0">
        <input type="file" name="image" id="image" accept="image/*" maxlength="5242880" required><br>
        <button type="submit">上传并打卡</button>
    </form></td></tr></table>
    <?php
    }
    
    
    
    $sql = "SELECT COUNT(*) FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='1' AND status != 3 ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count > 0 ) {
        $sql = "SELECT * FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='1' ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['status'] <= 2) {
            if ($row['status'] == 0) {
                echo "<h3>今日健身动作打卡待审核</h3>";
            } else if ($row['status'] == 1) {
                echo "<h3>今日健身动作打卡审核通过</h3>";
            } else if ($row['status'] == 2) {
                echo "<h3>今日健身动作打卡审核拒绝</h3>";
            }
    ?>
    <form action="delete.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="image_path" id="image_path" value="<?php echo $row['image_path']; ?>">
        <input type="hidden" name="type" id="type" value="<?php echo $row['type']; ?>">
        <input type="hidden" name="status" id="status" value="<?php echo $row['status']; ?>">
        <button type="submit">删除记录</button>
    </form>
    <?php
        } else if ($row['status'] == 4) {
        echo "<h2 style=\"color: red;\">今日健身动作打卡恶意提交</br>不允许重新提交</h2>";
        } else if ($row['status'] == 5) {
        echo "<h3>今日健身动作打卡复审中</h3>";
        }
    } else {
    ?>
    <table><tr><td><form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">健身动作：</label>
        <input type="hidden" name="name" id="name" value="<?php echo $user['name']; ?>">
        <input type="hidden" name="username" id="username" value="<?php echo $user['username']; ?>">
        <input type="hidden" name="type" id="type" value="1">
        <input type="file" name="image" id="image" accept="image/*" maxlength="5242880" required><br>
        <button type="submit">上传并打卡</button>
    </form></td></tr></table>
    <?php
    }
    
    
    $sql = "SELECT COUNT(*) FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='2' AND status != 3 ";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];
    if ($count > 0 ) {
        $sql = "SELECT * FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='2' ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['status'] <= 2) {
            if ($row['status'] == 0) {
                echo "<h3>今日校园跑打卡待审核</h3>";
            } else if ($row['status'] == 1) {
                echo "<h3>今日校园跑打卡审核通过</h3>";
            } else if ($row['status'] == 2) {
                echo "<h3>今日校园跑打卡审核拒绝</h3>";
            }
    ?>
    <form action="delete.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="<?php echo $row['id']; ?>">
        <input type="hidden" name="image_path" id="image_path" value="<?php echo $row['image_path']; ?>">
        <input type="hidden" name="type" id="type" value="<?php echo $row['type']; ?>">
        <input type="hidden" name="status" id="status" value="<?php echo $row['status']; ?>">
        <button type="submit">删除记录</button>
    </form>
    <?php
        } else if ($row['status'] == 4) {
        echo "<h2 style=\"color: red;\">今日校园跑打卡恶意提交</br>不允许重新提交</h2>";
        } else if ($row['status'] == 5) {
        echo "<h3>今日校园跑打卡复审中</h3>";
        }
    } else {
    ?>
    <table><tr><td><form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="image">校园跑：</label>
        <input type="hidden" name="name" id="name" value="<?php echo $user['name']; ?>">
        <input type="hidden" name="username" id="username" value="<?php echo $user['username']; ?>">
        <input type="hidden" name="type" id="type" value="2">
        <input type="file" name="image" id="image" accept="image/*" maxlength="5242880" required><br>
        <button type="submit">上传并打卡</button>
    </form></td></tr></table>
    <?php
    }
    echo "</br></br></br></br></br>";
    echo "<div><a href=\"recheck.php\"><input type=button value=\"申请复审\" ></a></div>";
    echo "<h1></br></h1>";
    if ($user['permission'] != 0) {
    echo "<div><a href=\"admin.php\"><input type=button value=\"审核\" ></a></div>";
    }
    
    ?>
    
    <h3>打卡图片限制格式为</br>jpeg、jpg、png、gif、bmp、tiff</br>且大小不超过5MB</h3>
    
    <div>
    <a href="password.php"><input type=button value="改密" ></a>
    <a href="logout.php"><input type=button value="登出" ></a>
    </div>

<script>
    function countdown() {
        var targetTime = new Date(2023, 5, 6, 23, 59, 59);
        var currentTime = new Date();
        var remainingTime = targetTime - currentTime;
        if (remainingTime <= 0) {
            document.getElementById('countdown').innerHTML = '打卡已经结束！';
            return;
        }
        var days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
        var seconds = Math.floor((remainingTime / 1000) % 60);
        var minutes = Math.floor((remainingTime / 1000 / 60) % 60);
        var hours = Math.floor((remainingTime / (1000 * 60 * 60)) % 24);
        document.getElementById('countdown').innerHTML = '距离打卡结束还有</br>' + days + '天' + hours + '时' + minutes + '分' + seconds + '秒';
    }
    
    setInterval(countdown, 1000);
</script>

</body>
</html>