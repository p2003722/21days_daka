<?php
require 'permission/xcx.php';
require 'permission/admin.php';
?>

<?php
$type = $_POST["type"];
$_SESSION['type'] = $type;
header("Location: review_last.php");
?>