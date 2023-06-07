<?php
require 'permission/xcx.php';
require 'permission/superadmin.php';
?>

<?php
$username = mysqli_real_escape_string($conn, $_POST['username']);
$option = mysqli_real_escape_string($conn, $_POST['option']);
$score = mysqli_real_escape_string($conn, $_POST['score']);

$sql = "SELECT id FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "UPDATE users SET points = points $option $score WHERE username = '$username'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('更改成功！');location.href='admin.php';</script>";
    } else {
        echo "<script>alert('更改失败，请重试！');location.href='score.php';</script>";
    }
} else {
    echo "<script>alert('无此用户，请重试！');location.href='score.php';</script>";
}

$conn->close();
?>