<?php
session_start();
require_once "db_connection.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$date = date("Y-m-d");
$time = date("H:i:s");

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    if ($row['password'] != '0') {
        
        $salt = $row['salt'];
        $password = hash('sha512', $password.$salt);
        
        if ($password == $row['password']) {
            $sql = "UPDATE users SET last_login_date = '$date', last_login_time = '$time' WHERE username = '$username'";
            if ($conn->query($sql) === TRUE) {
                $cookie_id = md5(($username * 114514 + 233333) * ($username * 114514 + 233333));
                setcookie('cookie_id', $cookie_id, time() + 604800, '/');
                echo "<script>alert('登录成功！');location.href='index.php';</script>";
            } else {
                echo "<script>alert('登录失败，请重试！');location.href='login.php';</script>";
            }
        } else {
            echo "<script>alert('账号或密码错误！');location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('该账号未设置密码\\n请重新注册！');location.href='register.php';</script>";
    }
} else {
    echo "<script>alert('该账号不存在！');location.href='login.php';</script>";
}

$conn->close();
?>