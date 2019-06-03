<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$template['title'] = 'Sign In';
$template['keywords'] = 'Sign In';
$template['description'] = 'Sign In';
$template['css'] = array('style/public.css','style/register.css');
$link = connect();
if(is_login($link)){
    skip('index.php','error','already log in');
}
if(isset($_POST['submit'])){
    include 'inc/check_login.inc.php';
    //name&pw match
    $_POST = escape($link, $_POST);
    $query = "select * from bbs_member where name='{$_POST['name']}' and pw=md5('{$_POST['pw']}')";
    $result = execute($link, $query);
    if(mysqli_num_rows($result)==1){
        setcookie('bbs[name]', $_POST['name'],time()+$_POST['time']);
        setcookie('bbs[pw]',  md5($_POST['pw']),time()+$_POST['time']);
        skip('index.php', 'ok', 'Sign In...');
    }else{
        skip('login.php', 'error', 'The username or password is uncorrect.');
    }
}
?>
<?php include_once 'inc/header.inc.php';?>
	<div id="register" class="auto">
		<h2>Sign In</h2>
		<form method="post">
			<label>Username:<input type="text" name="name" /><span></span></label>
			<label>Password:<input type="password" name="pw" /><span></span></label>
			<label>Auto Login:
				<select style="width:225px;height:25px;" name="time">
					<option value="3600">in 1 hour</option>
					<option value="86400">in 1 day</option>
					<option value="259200">in 3 days</option>
					<option value="2592000">in 30 days</option>
				</select>
				<span>*This is a private computer</span>
			</label>
			<div style="clear:both;"></div>
			<input class="btn" type="submit" name="submit" value="Sign In" />
		</form>
	</div>
<?php include_once 'inc/footer.inc.php';?>