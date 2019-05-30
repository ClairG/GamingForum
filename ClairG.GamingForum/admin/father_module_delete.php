<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
//check
if(!isset($_GET['id'])|| !is_numeric($_GET['id'])){
    skip('father_module.php', 'error', 'id is wrong. Please try it again.');
}
$link = connect();
$query = "delete from bbs_father_module where id = {$_GET['id']}";
execute($link, $query);
if(mysqli_affected_rows($link)==1){
    skip('father_module.php', 'ok','Deleted Successfully');
}else{
    skip('father_module.php', 'error', 'Failed to delete. Please try it again.');
}
?>