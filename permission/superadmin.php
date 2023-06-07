<?php
session_start();
require_once "db_connection.php";

$date = date("Y-m-d");
$time = date("H:i:s");

if (!isset($_COOKIE['cookie_id']) || empty($_COOKIE['cookie_id'])) {
    // 如果用户没有登录，则重定向到登录页面
    echo "<script>alert('请先登录！');location.href='login.php';</script>";
    exit();
} else {
    $cookie_id = $_COOKIE['cookie_id'];
    $sql = "UPDATE users SET last_admin_date = '$date', last_admin_time = '$time' WHERE cookie_id = '$cookie_id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "SELECT * FROM users WHERE cookie_id = '$cookie_id'";
        $result = $conn->query($sql);
        $user = $result->fetch_assoc();
        $user_id = $user['id'];
        $permission = $user['permission'];
        if ($permission != 1 && $permission != 2) {
            echo "<script>alert('您没有管理权限！');location.href='index.php';</script>";
            exit();
        } else if ($permission != 2){
            echo "<script>alert('您没有访问权限！');location.href='admin.php';</script>";
        }
    } else {
        echo "<script>alert('登录失败！');location.href='index.php';</script>";
        exit();
    }
}

?>