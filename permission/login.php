<?php
session_start();
require_once "db_connection.php";
if (!isset($_COOKIE['cookie_id']) || empty($_COOKIE['cookie_id'])) { } else {
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $cookie_id = $_COOKIE['cookie_id'];
    $sql = "SELECT * FROM users WHERE cookie_id = '$cookie_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    $user_id = $user['id'];
    if ($user['password'] == '0') { } else {
        $sql = "UPDATE users SET last_login_date = '$date', last_login_time = '$time' WHERE cookie_id = '$cookie_id'";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('您已登录！');location.href='index.php';</script>";
            exit();
            } else { }// 如果用户已经登录，则重定向到主页面
        }
    }
?>