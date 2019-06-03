<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$template['title'] = 'Register';
$template['keywords'] = 'Register';
$template['description'] = 'Register';
$template['css'] = array('style/public.css','style/register.css');
$link = connect();
if($member_id = is_login($link)){
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
        //set cookie
        setcookie('bbs[name]', $_POST['name'],time()+600);
        setcookie('bbs[pw]',  md5($_POST['pw']),time()+600);
        skip('index.php', 'ok', 'Registered Successfully');
    }else{
        skip('register.php', 'error', 'Failed to register. Please try it again.');
    }
}
?>
<?php include_once 'inc/header.inc.php';?>
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
<?php include_once 'inc/footer.inc.php';?>