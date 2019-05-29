<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';

$link = connect();
$sql_count = 'select*from bbs_father_module';
var_dump(num($link, $sql_count));

?>