<?php

if (!isset($_COOKIE['turnstile']) || $_COOKIE['turnstile'] != 1) {
    } else {
        echo "<script>location.href='/index.php';</script>";
    }
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>人机验证</title>
    <link rel="stylesheet" href="/css/turnstile.css">
    <link rel="icon" href="/image/favicon.ico">
    <style>
        .container {
            width: 310px;
            margin: 100px auto;
        }
        #msg {
            width: 100%;
            line-height: 40px;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-form">
    <h1>人机验证</h1>
    <form action="/turnstile/turnstile.php" method="post">
    <input type="hidden" id="success" name="success" value="1">
    <div class="container">
      <div id="captcha"></div>
      <div id="msg"></div>
    </div>
    <button type="submit" id="submit-button" disabled>提交</button>
    </form>
    </div>
    
<script>
if (!window.jigsaw) {
  document.write('<script src="./dist/jigsaw.min.js"><\/script>')
}
</script>
<script>
  // 在页面加载时，将提交按钮初始化为禁用信息
  document.getElementById('submit-button').innerText = '请先完成滑块验证';

  jigsaw.init({
    el: document.getElementById('captcha'),
    onSuccess: function() {
        document.getElementById('msg').innerHTML = '验证成功！';
        document.getElementById('submit-button').disabled = false; // 启用提交按钮
        document.getElementById('submit-button').innerText = '提交'; // 将按钮文本更改为'提交'
        document.getElementById('submit-button').style.cursor = "pointer"; // 将光标样式更改为指针
    },
    onFail: cleanMsg,
    onRefresh: cleanMsg
  })
  
  function cleanMsg() {
    document.getElementById('msg').innerHTML = '';
    document.getElementById('submit-button').innerText = '请先完成滑块验证'; // 将按钮文本更改回初始状态
    document.getElementById('submit-button').style.cursor = "not-allowed"; // 将光标样式更改为不允许
  }

</script>
</body>
</html>