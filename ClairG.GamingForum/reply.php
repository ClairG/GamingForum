<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link=connect();
//login status
if(!$member_id=is_login($link)){
	skip('login.php', 'error', 'Please sign in first');
}
//check
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', 'error', 'id is incorrect');
}
//show thread
$query="select bt.id,bt.title,bm.name from bbs_thread bt,bbs_member bm where bt.id={$_GET['id']} and bt.member_id=bm.id";
$result_content=execute($link, $query);
if(mysqli_num_rows($result_content)!=1){
	skip('index.php', 'error', 'This thread does not exist');
}
//submit reply
if(isset($_POST['submit'])){
	include 'inc/check_reply.inc.php';
	$_POST=escape($link,$_POST);
	$query="insert into bbs_reply(content_id,content,time,member_id) values({$_GET['id']},'{$_POST['content']}',now(),{$member_id})";
	execute($link, $query);
	if(mysqli_affected_rows($link)==1){
		skip("show.php?id={$_GET['id']}", 'ok', 'Reply Successfully!');
	}else{
		skip($_SERVER['REQUEST_URI'], 'error', 'Failed to reply. Please try it again...');
	}
}

$data_content=mysqli_fetch_assoc($result_content);
$data_content['title']=htmlspecialchars($data_content['title']);
$template['title']='Reply a thread';
$template['keywords'] = 'Reply a thread';
$template['description'] = 'Reply a thread';
$template['css']=array('style/public.css','style/publish.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="position" class="auto">
	 <a href="index.php">Home</a> &gt; Reply a thread
</div>
<div id="publish">
	<div>Reply: <?php echo $data_content['title']?> published by <?php echo $data_content['name']?></div>
	<form method="post">
		<textarea name="content" class="content"></textarea>
		<input class="reply" type="submit" name="submit" value="" />
		<div style="clear:both;"></div>
	</form>
</div>
<?php include 'inc/footer.inc.php'?>