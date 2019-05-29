<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link = connect();
$query = "delete from bbs_father_module where id = {$_GET['id']}";
execute($link, $query);
if(mysqli_affected_rows($link)==1){
    exit('Deleted Successfully');
}
?>