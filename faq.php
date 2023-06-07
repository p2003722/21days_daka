<?php
require 'permission/xcx.php';
require 'permission/user.php';
if (!isset($_COOKIE['faq']) || empty($_COOKIE['faq'])) {
    echo "<script>alert('该公告需要你确认收到！');</script>";
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>FAQ</title>
    <link rel="stylesheet" href="/css/index.css">
    <link rel="icon" href="/image/favicon.ico">
</head>
<body>
    <h1>打卡时间是什么</h1>
    <h3>打卡时间为每日6时至24时，0至6时为服务器维护时间，敬请谅解。</h3>
    <h1>如何进行打卡</h1>
    <h3>只需在首页选择打卡图片文件，随后点击“上传并打卡”按钮即可。</h3>
    <h1>打卡图片有什么要求</h1>
    <h2>每日步数（不少于10000步）</h2>
    <h3>推荐使用微信步数，点击步数排行榜后点击自己一栏进行截图保存，要求有当天日期和具体步数两个关键点。当日步数不少于10000步，如下图所示。</h3>
    <table><tr><td><img src="/image/bushu_1.jpg"></td></tr></table>
    <h3>如果不愿意使用微信步数，可以使用系统自带的健康app，如“Apple健康”、“SAMSUNG Health”、“华为运动健康”等，同样要求有当天日期和具体步数两个关键点，下图以SAMSUNG Health为例。</h3>
    <table><tr><td><img src="/image/bushu_2.jpg"></td></tr></table>
    <h2>健身动作（不少于10分钟）</h2>
    <h3>推荐使用Keep，进行任意一组动作后将记录截图上交即可。要求有运动日期和运动用时两个关键点，运动时长不少于10分钟，如下图所示。同时运动世界校园的AI运动，以及其他运动类app的健身功能均可作为打卡凭证。</h3>
    <table><tr><td><img src="/image/jianshen.jpg"></td></tr></table>
    <h2>校园跑（不少于2公里）</h2>
    <h3>推荐使用运动世界校园，进行一段不小于2公里，且成绩达标的校园跑。要求有运动日期、跑步距离和配速三个关键点，跑步距离不少于2公里，如下图所示。同时Keep等其他具有跑步记录功能的app运动截图均可作为打卡凭证，要求配速在3'00"至15'00"（同校园跑要求），不在该配速区间范围内的成绩无效</h3>
    <table><tr><td><img src="/image/xiaoyuanpao.jpg"></td></tr></table>
    <h1>上传错了图片怎么办</h1>
    <h3>只需在首页找到上传错图片的那一项，随后点击“删除记录”按钮即可。</h3>
    <table><tr><td><img src="/image/qq.png"></td></tr></table>
<?php
if (!isset($_COOKIE['faq']) || empty($_COOKIE['faq'])) {
?>
    <form action="faq_request.php" method="post" enctype="multipart/form-data">
        <button type="submit">确认收到</button>
    </form>
    <h1></br></h1>
<?php
} else {
?>
    <div><a href="index.php"><input type=button value="返回首页" ></a></div>"
<?php
}
?>

</body>
</html>