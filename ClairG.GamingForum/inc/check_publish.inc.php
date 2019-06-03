<?php 
if(empty($_POST['module_id']) || !is_numeric($_POST['module_id'])){
	skip('publish.php', 'error', '鎵�灞炵増鍧梚d涓嶅悎娉曪紒');
}
$query="select * from sfk_son_module where id={$_POST['module_id']}";
$result=execute($link, $query);
if(mysqli_num_rows($result)!=1){
	skip('publish.php', 'error', '鎵�灞炵増鍧椾笉瀛樺湪锛�');
}
if(empty($_POST['title'])){
	skip('publish.php', 'error', '鏍囬涓嶅緱涓虹┖锛�');
}
if(mb_strlen($_POST['title'])>255){
	skip('publish.php', 'error', '鏍囬涓嶅緱瓒呰繃255涓瓧绗︼紒');
}
?>