<?php
require 'permission/xcx.php';
require 'permission/user.php';
?>

<?php

$college = $_POST["college"];
$user_id = $_POST["user_id"];

$sql = "UPDATE users SET college = $college WHERE id = $user_id";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('设置成功！');location.href='index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>