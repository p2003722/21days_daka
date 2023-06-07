<?php
session_start();
require_once "db_connection.php";
require 'permission/xcx.php';
$hour = date("H");
$minute = date("i");
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>打卡结束</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <h1>打卡结束</h1>
    <h2>打卡日期为5月15日至6月6日</h2>
    <h2>打卡成绩审核校对中，请耐心等待</h2>
    
<?php
    $cookie_id = $_COOKIE['cookie_id'];
    $sql = "SELECT * FROM users WHERE cookie_id = '$cookie_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
    if ($user['permission'] != 0) {
    echo "<div><a href=\"admin.php\"><input type=button value=\"审核\" ></a></div>";
    }
?>
    
</body>
</html>