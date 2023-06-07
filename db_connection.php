<?php
$servername = "localhost";
$username = "demo";//替换成你的数据库用户名
$password = "demo";//替换成你的数据库密码
$dbname = "demo";//替换成你的数据库名

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>