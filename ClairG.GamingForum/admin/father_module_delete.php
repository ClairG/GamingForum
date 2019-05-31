<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
//check if id is valid
if(!isset($_GET['id'])|| !is_numeric($_GET['id'])){
    skip('father_module.php', 'error', 'id is wrong. Please try it again.');
}
$link = connect();
//check if father module contains any child module
$query = "select * from bbs_son_module where father_module_id = {$_GET['id']}";
$result = execute($link, $query);
if(mysqli_num_rows($result)){
    skip('father_module.php','error','This father module contains one or more child modules');
}
//delete
$query = "delete from bbs_father_module where id = {$_GET['id']}";
execute($link, $query);
if(mysqli_affected_rows($link)==1){
    skip('father_module.php', 'ok','Deleted Successfully');
}else{
    skip('father_module.php', 'error', 'Failed to delete. Please try it again.');
}
?>