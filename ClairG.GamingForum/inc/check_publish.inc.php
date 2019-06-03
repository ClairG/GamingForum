<?php 
if(empty($_POST['module_id']) || !is_numeric($_POST['module_id'])){
	skip('publish.php', 'error', 'Topic id is uncorrect');
}
$query="select * from bbs_son_module where id={$_POST['module_id']}";
$result=execute($link, $query);
if(mysqli_num_rows($result)!=1){
	skip('publish.php', 'error', 'Topic does not exit');
}
if(empty($_POST['title'])){
	skip('publish.php', 'error', 'Subject is required');
}
if(mb_strlen($_POST['title'])>60){
	skip('publish.php', 'error', 'Subject must be less than 60 characters');
}
?>