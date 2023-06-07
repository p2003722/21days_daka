<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<?php
$type = $_SESSION['type'];
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title><?php
    if ($type == 0) {
        echo "每日步数审核";
    } else if ($type == 1) {
        echo "健身动作审核";
    } else if ($type == 2) {
        echo "校园跑审核";
    } else if ($type == 3) {
        echo "复审";
    } else {
        echo "错误！";
    }
    ?>    </title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    
    <h1>欢迎您，<?php echo $user['name']; ?></h1>
    <h2>当前审核项目：<?php
    if ($type == 0) {
        echo "每日步数";
    } else if ($type == 1) {
        echo "健身动作";
    } else if ($type == 2) {
        echo "校园跑";
    } else if ($type == 3) {
        echo "复审";
    } else {
        echo "错误！";
    }
    ?>
    </h2>
    <h1></br></h1>
    
    <?php
    
    if ($type != 3) {
        // 查询第一条status为0的数据
        $sql = "SELECT * FROM daka_records WHERE status = 0 and type = $type ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // 输出数据
          while($row = $result->fetch_assoc()) {
            $query = "SELECT COUNT(*) as resultCount FROM daka_records WHERE status = 0 AND type = '$type'";
            $queryResult = $conn->query($query);
            if ($queryResult && $queryResult->num_rows > 0) {
                $queryRow = $queryResult->fetch_assoc();
                $queryCount = $queryRow['resultCount'];
                echo "<h2>当前剩余审核量：$queryCount</h2>";
            } else {
                echo "<h2>计算剩余量时发生错误！</h2>";
            }
            
            echo ("<h3>当前审核图片上传时间</br>". $row["date"]. "  " .$row["time"]. "</h3>");
            echo ("<h3>当前审核图片ID：". $row["id"]. "</h3>");
            echo "<table><tr><td>";
            echo "<img src=\"/" . $row["image_path"] . "\">";
            echo "</td></tr></table>";
            ?>
            
            <link rel="stylesheet" href="/css/login.css">
            <div class="login-form">
            <form method="post" action="admin_score.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="admin_name" value="<?php echo $user['name']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <select id="score" name="score" required>
            <option value="" selected disabled hidden>请选择得分</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">通过</button>
            </form></div>
            
            <link rel="stylesheet" href="/css/login.css">
            <form method="post" action="admin_false.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="admin_name" value="<?php echo $user['name']; ?>">
            <button type="submit">拒绝</button>
            </form>
            
            <link rel="stylesheet" href="/css/login.css">
            <div class="login-form">
            <form method="post" action="admin_error.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="admin_name" value="<?php echo $user['name']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <input type="text" name="confirmation" placeholder="请输入&quot;恶意提交&quot;" required>
            <button type="submit">恶意提交</button>
            </form></td></tr></div>
            
            <?php
          }
        } else {
          echo "<h2>已完成全部审核任务</h2>";
        }
    } else if ($type == 3) {
        // 查询第一条status为0的数据
        $sql = "SELECT * FROM daka_records WHERE status = 5 ORDER BY RAND() LIMIT 1";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
          // 输出数据
          while($row = $result->fetch_assoc()) {
            $query = "SELECT COUNT(*) as resultCount FROM daka_records WHERE status = 5";
            $queryResult = $conn->query($query);
            if ($queryResult && $queryResult->num_rows > 0) {
                $queryRow = $queryResult->fetch_assoc();
                $queryCount = $queryRow['resultCount'];
                echo "<h2>当前剩余审核量：$queryCount</h2>";
            } else {
                echo "<h2>计算剩余量时发生错误！</h2>";
            }
            
            echo ("<h3>当前复审图片上传时间</br>". $row["date"]. "  " .$row["time"]. "</h3>");
            echo ("<h3>当前复审图片ID：". $row["id"]. "</h3>");
                if ($row["type"] == 0) {
                    echo "<h3>当前复审图片对应项目：每日步数</h3>";
                } else if ($row["type"] == 1) {
                    echo "<h3>当前复审图片对应项目：健身动作</h3>";
                } else if ($row["type"] == 2) {
                    echo "<h3>当前复审图片对应项目：校园跑</h3>";
                } else {
                    echo "<h3>当前复审图片对应项目：错误！</h3>";
                }
            echo ("<h3>当前图片复审理由：</br>". $row["result"]. "</h3>");
            echo "<table><tr><td>";
            echo "<img src=\"/" . $row["image_path"] . "\">";
            echo "</td></tr></table>";
            ?>
            
            <table><tr><td>
            <form method="post" action="admin_true.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="admin_name" value="<?php echo $user['name']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <button type="submit">通过</button>
            </form></table>
            
            <link rel="stylesheet" href="/css/login.css">
            <div class="login-form">
            <form method="post" action="admin_refalse.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="admin_name" value="<?php echo $user['name']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <label for="error">请输入拒绝理由：</label>
            <input type="text" name="error" required>
            <button type="submit">拒绝</button>
            </form></td></tr></div>
            
            <link rel="stylesheet" href="/css/login.css">
            <div class="login-form">
            <form method="post" action="admin_error.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="admin_name" value="<?php echo $user['name']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
            <input type="text" name="confirmation" placeholder="请输入&quot;恶意提交&quot;" required>
            <button type="submit">恶意提交</button>
            </form></td></tr></div>
            
            <?php
          }
        } else {
          echo "<h2>已完成全部审核任务</h2>";
        }
    }
    ?>
    
    <div>
    <a href="admin.php"><input type=button value="返回" ></a>
    </div>
    
</body>
</html>
