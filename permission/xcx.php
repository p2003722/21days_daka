<?php
    if (!isset($_COOKIE['cookie_id']) || $_COOKIE['cookie_id'] != 'a9914c3f1ac2825e5041a28f1f79ff641') {
?>

<!---->
<script>
    var ua = navigator.userAgent.toLowerCase();
    if(ua.match(/MicroMessenger/i)=="micromessenger") {
        //ios的ua中无miniProgram，但都有MicroMessenger（表示是微信浏览器）
        wx.miniProgram.getEnv((res)=>{
           if (res.miniprogram) {
           } else {
               location.href='xcx.php';
           }
        })
    }else{
        location.href='xcx.php';
    }
</script>
<!---->

<?php
    }
    if (!isset($_COOKIE['turnstile']) || $_COOKIE['turnstile'] != 1) {
        echo "<script>location.href='/turnstile';</script>";
    }
?>