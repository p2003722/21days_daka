<?php
session_start();
require_once "db_connection.php";

if (!isset($_COOKIE['cookie_id']) || empty($_COOKIE['cookie_id'])) {
    // 如果用户没有登录，则重定向到登录页面
    echo "<script>alert('请先登录！');location.href='login.php';</script>";
    exit();
} else {
    
}

$date = date("Y-m-d");
$time = date("H:i:s");

$cookie_id = $_COOKIE['cookie_id'];

$sql = "UPDATE users SET last_login_date = '$date', last_login_time = '$time' WHERE cookie_id = '$cookie_id'";
    if ($conn->query($sql) === TRUE) {
    } else {
    echo "<script>alert('请先登录！');location.href='login.php';</script>";
    exit();
    }

$sql = "SELECT * FROM users WHERE cookie_id = '$cookie_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$user_id = $user['id'];
if ($user['password'] == '0') {
    echo "<script>alert('请重新注册以设置密码！');location.href='register.php';</script>";
}

$error = $user['error'];
if ($error >= 3) {
    echo "<script>location.href='ban.php';</script>";
}

if ($user_id != 1) {
    $hour = date("H");
    if ($hour < 6) {
        echo "<script>location.href='error.php';</script>";
    }
}

echo "<script>location.href='end.php';</script>";

?>