<?php
session_start();
require_once "db_connection.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
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
            $row = $result->fetch_assoc();
            
            $length = 128;
            $characters = 'abcdef0123456789';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            $salt = $randomString;
    
            $password = hash('sha512', $new_password.$salt);
            
            $sql = "UPDATE users SET password = '$password', salt = '$salt' WHERE username = '$username'";
            if ($conn->query($sql) === TRUE) {
                
                    if ($conn->query($sql) === TRUE) {
                        $cookie_id = md5(($username * 114514 + 233333) * ($username * 114514 + 233333));
                        setcookie('cookie_id', $cookie_id, time() + 604800, '/');
                        echo "<script>alert('更改成功！');location.href='index.php';</script>";
                    } else {
                    echo "<script>alert('更改成功，请返回登陆！');location.href='login.php';</script>";
                }
            } else {
                echo "<script>alert('更改失败，请重试！');location.href='password.php';</script>";
            }
        } else {
            echo "<script>alert('原密码错误！');location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('该账号未设置密码！');location.href='register.php';</script>";
    }
} else {
    echo "<script>alert('该账号不存在！');location.href='index.php';</script>";
}

$conn->close();
?>