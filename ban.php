<?php
session_start();
require_once "db_connection.php";
require 'permission/xcx.php';
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>您已被封号</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <h1 style="color: red;">您已被封号！</h1>
    
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