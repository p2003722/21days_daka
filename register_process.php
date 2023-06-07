<?php
require_once "db_connection.php";

$username = mysqli_real_escape_string($conn, $_POST['username']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$date = date("Y-m-d");
$time = date("H:i:s");

    $length = 128;
    $characters = 'abcdef0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $salt = $randomString;

    $sql = "SELECT id FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        if ($row['password'] != '0'){
            echo "<script>alert('该学号已注册！');location.href='register.php';</script>";
        } else if ($row['password'] == '0') {
            $cookie_id = $row['cookie_id'];
            $password = hash('sha512', $password.$salt);
            $sql = "UPDATE users set password = '$password', salt = '$salt' WHERE id = {$row['id']}";
            if ($conn->query($sql) === TRUE) {
                $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                        $sql = "UPDATE users SET last_login_date = '$date', last_login_time = '$time' WHERE username = '$username'";
                        if ($conn->query($sql) === TRUE) {
                            setcookie('cookie_id', $cookie_id, time() + 604800, '/');
                            echo "<script>alert('注册成功！');location.href='index.php';</script>";
                        }
                } else {
                    echo "<script>alert('注册成功，请返回登陆！');location.href='login.php';</script>";
                }
                
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else { }
    } else {
        $cookie_id = md5(($username * 114514 + 233333) * ($username * 114514 + 233333));
        // 将新用户信息插入数据库
        $password = hash('sha512', $password.$salt);
        $sql = "INSERT INTO users (username, cookie_id, name, password, salt, register_date, register_time) VALUES ('$username', '$cookie_id', '$name', '$password', '$salt', '$date', '$time')";
        if ($conn->query($sql) === TRUE) {
            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                    $sql = "UPDATE users SET last_login_date = '$date', last_login_time = '$time' WHERE username = '$username'";
                    if ($conn->query($sql) === TRUE) {
                        setcookie('cookie_id', $cookie_id, time() + 604800, '/');
                        echo "<script>alert('注册成功！');location.href='index.php';</script>";
                    }
            } else {
                echo "<script>alert('注册成功，请返回登陆！');location.href='login.php';</script>";
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

$conn->close();
?>