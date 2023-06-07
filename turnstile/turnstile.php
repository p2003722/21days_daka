<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $success = $_POST['success'];
    
    if ($success == 1){
        setcookie('turnstile', 1, time() + 3600, '/');
        echo "<script>alert('验证成功！');location.href='/index.php';</script>";
    } else {
        echo "<script>alert('验证失败！');location.href='/turnstile/index.php';</script>";
    }
    
} else {
    echo "<script>alert('非法请求！');location.href='/turnstile/index.php';</script>";
}

?>
