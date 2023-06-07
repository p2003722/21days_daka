<?php
require 'permission/xcx.php';
require 'permission/user.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>提交复审</title>
<link rel="icon" href="/image/favicon.ico">
</head>
<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $id = $_POST["id"];
      $adminresult = $_POST["adminresult"];
      $sql = "SELECT * FROM daka_records WHERE id = '$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        $sql = "SELECT * FROM daka_records WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        if ($row['user_id'] == "$user_id") {
          if ($row['recheck'] == 0) {
              if ($row['status'] == 2 || $row['status'] == 4) {
                // 更新数据表daka_records中的数据
                $sql = "UPDATE daka_records SET status = 5 , recheck = 1 , result = '$adminresult' WHERE id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    if ($row['status'] == 2) {
                        echo "<script>alert('提交成功！');location.href=\"index.php\";</script>";
                    } else if ($row['status'] == 4) {
                        $user_id = $row['user_id'];
                        // 更新数据表user中的error值
                        $sql = "UPDATE users SET error = error - 1 WHERE id = $user_id";
                        if ($conn->query($sql) === TRUE) {
                          echo "<script>alert('提交成功！');location.href=\"index.php\";</script>";
                        } else {
                          echo "<script>alert('提交失败，请联系管理员！');location.href=\"index.php\";</script>";
                        }
                    } else {
                      echo "<script>alert('提交成功！');location.href=\"index.php\";</script>";
                    }
                  } else {
                      echo "<script>alert('提交失败！');location.href=\"index.php\";</script>";
                  }
            } else if ($row['status'] == 0) {
                echo "<script>alert('该打卡暂未审核！');location.href=\"index.php\";</script>";
            } else if ($row['status'] == 1) {
                echo "<script>alert('该打卡已审核通过！');location.href=\"index.php\";</script>";
            } else if ($row['status'] == 3) {
                echo "<script>alert('该打卡已删除！');location.href=\"index.php\";</script>";
            } else {
                echo "<script>alert('提交失败！');location.href=\"index.php\";</script>";
            }
          } else {
            $error = $row['error'];
            echo "<script>alert('$error');location.href=\"index.php\";</script>";
          }
        } else {
          echo "<script>alert('不是你提交的打卡！');location.href=\"index.php\";</script>";
        }
      } else {
        echo "<script>alert('该记录不存在！');location.href=\"index.php\";</script>";
      }
    }
    ?>

</body>
</html>