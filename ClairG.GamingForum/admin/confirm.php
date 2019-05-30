<?php
include_once '../inc/config.inc.php';
if(!isset($_GET['message']) || !isset($_GET['url']) || !isset($_GET['return_url'])){
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>confirm message</title>
<meta name="keywords" content="confirm message" />
<meta name="description" content="confirm message" />
<link rel="stylesheet" type="text/css" href="style/remind.css" />
</head>
<body>
<div class="notice">
<div class="notice"><span class="pic ask"></span> <?php echo $_GET['message']?> <a style="color:red;" href="<?php echo $_GET['url']?>">Yes</a> | <a style="color:#666;" href="<?php echo $_GET['return_url']?>">No</a></div>
</body>
</html>