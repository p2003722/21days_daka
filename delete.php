<?php
require 'permission/xcx.php';
require 'permission/user.php';

$id = $_POST['id'];
$image_path = $_POST['image_path'];
$type = $_POST['type'];
$status = $_POST['status'];

    $length = 16;
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $extension = pathinfo($image_path, PATHINFO_EXTENSION);
    $target_dir = "uploads/$user_id/$date/backup/";
    
    $source_path = "$image_path"; // 原文件的路径
    $target_path = "$target_dir$randomString.$extension";
    
    if (!file_exists($target_dir)) { mkdir($target_dir); }
    
    if ($status == 1) {
        echo "<script>alert('审核通过无需删除！');location.href='index.php';</script>";
    } else if ($status != 1) {
        if (rename($source_path, $target_path)) {
            $sql = "UPDATE daka_records SET status = 3, image_path = '$target_path' WHERE id = '$id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('删除成功！');location.href='index.php';</script>";
                    }
                else {
                    echo "<script>alert('删除失败，请联系管理员！');location.href='index.php';</script>";
                }
        } else {
            echo "<script>alert('删除失败！');location.href='index.php';</script>";
        } 
    }

?>