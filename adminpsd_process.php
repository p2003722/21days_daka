<?php
require 'permission/xcx.php';
require 'permission/superadmin.php';

    $length = 128;
    $characters = 'abcdef0123456789';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $salt = $randomString;

?>

<?php
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$password = hash('sha512', $password.$salt);

    $sql = "UPDATE users SET password = '$password', salt = '$salt' WHERE username = '$username'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('更改成功！');location.href='admin.php';</script>";
    } else {
        echo "<script>alert('更改失败，请重试！');location.href='adminpsd.php';</script>";
    }
$conn->close();
?>