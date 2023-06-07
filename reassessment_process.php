<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>撤回审核</title>
<link rel="icon" href="/image/favicon.ico">
</head>
<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"];
      $admin = $_POST["admin"];
      $sql = "SELECT * FROM daka_records WHERE id = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $sql = "SELECT * FROM daka_records WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['admin'] == "$admin") {
          if ($row['recheck'] == 0) {
            if ($row['status'] != 3) {
                // 更新数据表daka_records中的数据
                $sql = "UPDATE daka_records SET status = 0 WHERE id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    if ($row['status'] == 1) {
                      $user_id = $row['user_id'];
                      // 更新数据表user中的points值
                      $sql = "UPDATE users SET points = points - 1 WHERE id = $user_id";
                      if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('操作成功！');location.href=\"admin.php\";</script>";
                      } else {
                        echo "<script>alert('操作失败，请联系管理员！');location.href=\"admin.php\";</script>";
                      }
                    } else if ($row['status'] == 4) {
                        $user_id = $row['user_id'];
                        // 更新数据表user中的error值
                        $sql = "UPDATE users SET error = error - 1 WHERE id = $user_id";
                        if ($conn->query($sql) === TRUE) {
                          echo "<script>alert('操作成功！');location.href=\"admin.php\";</script>";
                        } else {
                          echo "<script>alert('操作失败，请联系管理员！');location.href=\"admin.php\";</script>";
                        }
                    } else {
                      echo "<script>alert('操作成功！');location.href=\"admin.php\";</script>";
                    }
                  } else {
                      echo "<script>alert('操作失败！');location.href=\"admin.php\";</script>";
                  }
            } else if ($row['status'] == 3) {
                echo "<script>alert('用户已撤回！');location.href=\"admin.php\";</script>";
            } else {
                echo "<script>alert('操作失败！');location.href=\"admin.php\";</script>";
            }
          } else {
            echo "<script>alert('复审任务不允许撤回！');location.href=\"admin.php\";</script>";
          }
        } else {
          echo "<script>alert('不是你审核！');location.href=\"admin.php\";</script>";
        }
      } else {
        echo "<script>alert('该记录不存在！');location.href=\"admin.php\";</script>";
      }
    }
    ?>

</body>
</html>