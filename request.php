<?php
setcookie('request', 1, time() + 604800, '/');
echo "<script>alert('确认成功！');location.href='index.php';</script>";
?>