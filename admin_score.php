<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>审核得分</title>
<link rel="icon" href="/image/favicon.ico">
</head>
<body>

  <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST["id"];
        $user_id = $_POST["user_id"];
        $admin_name = $_POST["admin_name"];
        $score = $_POST["score"];
        $sql = "SELECT * FROM daka_records WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['status'] == 0 || $row['status'] == 5) {
            // 更新数据表daka_records中的数据
            $sql = "UPDATE daka_records SET score = $score, status = 1, admin = '$admin_name', admin_date = '$date', admin_time = '$time' WHERE id = '$id'";
            if ($conn->query($sql) === TRUE) {
              // 更新数据表user中的points值
              $sql = "UPDATE users SET points = points + $score WHERE id = $user_id";
              if ($conn->query($sql) === TRUE) {
                echo "操作成功！";
                // 返回前一个界面
                header("Location: " . $_SERVER['HTTP_REFERER']);
                exit;
              } else {
                echo "<script>alert('操作失败！');location.href='". $_SERVER['HTTP_REFERER']. "';</script>";
              }
            } else {
              echo "<script>alert('操作失败！');location.href='". $_SERVER['HTTP_REFERER']. "';</script>";
            }
        } else {
            echo "<script>alert('该图片已审核！');location.href='". $_SERVER['HTTP_REFERER']. "';</script>";
        }
      }
  ?>

</body>
</html>