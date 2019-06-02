<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link = connect();
if(is_login($link)){
    skip('index.php','error','already log in');
}
if(isset($_POST['submit'])){
    //check
    include_once 'inc/check_register.inc.php';
    //encode
    $_POST = escape($link, $_POST);
    //post
    $query = "insert into bbs_member (name, pw, register_time) values ('{$_POST['name']}', md5('{$_POST['pw']}'), now())"; 
    execute($link, $query);
    if(mysqli_affected_rows($link)==1){
        setcookie('bbs[name]', $_POST['name']);
        setcookie('bbs[pw]',  md5($_POST['name']));
        skip('index.php', 'ok', 'Registered Successfully');
    }else{
        skip('register.php', 'error', 'Failed to register. Please try it again.');
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link rel="stylesheet" type="text/css" href="style/public.css" />
<link rel="stylesheet" type="text/css" href="style/register.css" />
</head>
<body>
	<div class="header_wrap">
		<div id="header" class="auto">
			<div class="logo">Gaming Forum</div>
			<div class="nav">
				<a class="hover">Home</a>
			</div>
			<div class="serarch">
				<form>
					<input class="keyword" type="text" name="keyword" placeholder="Search for anything..." />
					<input class="submit" type="submit" name="submit" value="" />
				</form>
			</div>
			<div class="login">
				<a>Sign in</a>&nbsp;
				<a>| Register</a>
			</div>
		</div>
	</div>
	<div style="margin-top:55px;"></div>
	<div id="register" class="auto">
		<h2>Register</h2>
		<form method="post">
			<label>Username:<input type="text" name="name" /><span></span></label>
			<label>Password:<input type="password" name="pw" /><span>*at least 6 characters</span></label>
			<label>Re-type Password:<input type="password" name="confirm_pw" /><span></span></label>
			<div style="clear:both;"></div>
			<input class="btn" type="submit" name="submit" value="Register" />
		</form>
	</div>
	<div id="footer" class="auto">
		<div class="bottom">
			<a>GamingForum</a>
		</div>
		<div class="copyright">Powered by ClairG ©2019 clair.geng0111@hotmail.com</div>
	</div>
</body>
</html>