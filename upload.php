<?php
require 'permission/xcx.php';
require 'permission/user.php';
?>

<?php

$type = $_POST["type"];
$name = $_POST["name"];
$username = $_POST["username"];
$max_file_size = 5 * 1024 * 1024;
if ($_FILES["image"]["size"] > $max_file_size) {
    echo "<script>alert('图片大小超过了限制，请上传不超过5MB的图片！');location.href='index.php';</script>";
    exit();
}

    $length = 16;
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

$sql = "SELECT COUNT(*) FROM daka_records WHERE user_id='$user_id' AND date='$date' AND type='$type' AND status!='3'";
$result = mysqli_query($conn, $sql);
$count = mysqli_fetch_array($result)[0];
if ($count > 0 ) {
    echo "<script>alert('图片已上传，请勿重复提交！');location.href='index.php';</script>";
} else {
    $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); //获取上传文件的扩展名
    if ($extension != "jpeg" && $extension != "jpg" && $extension != "png" && $extension != "gif" && $extension != "bmp" && $extension != "tiff") {
        echo "<script>alert('请选择图片文件！');location.href='index.php';</script>";
        exit();
    }
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "uploads/$user_id/";
        if (!file_exists($target_dir)) { mkdir($target_dir); }//检查目录是否已存在并创建目录
        $target_dir = "uploads/$user_id/$date/";
        if (!file_exists($target_dir)) { mkdir($target_dir); }//检查目录是否已存在并创建目录
        $filename = $randomString . '.' . $extension; //生成对应的文件名
        $target_file = $target_dir . $filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            
            $sql = "INSERT INTO daka_records (user_id, username, name, image_path, status, type, date, time) VALUES ('$user_id', '$username', '$name', '$target_file', '0', '$type', '$date', '$time')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('图片上传成功，等待审核！');location.href='index.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('图片上传失败，请重试！');location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('请选择图片文件！');location.href='index.php';</script>";
    }
}


$conn->close();
?>
