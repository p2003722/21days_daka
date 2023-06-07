<?php
session_start();
session_destroy();
setcookie('cookie_id', 0, 0, '/');
echo "<script>alert('登出成功！');location.href='login.php';</script>";
?>
