<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$link = connect();
$member_id = is_login($link);
if(!$member_id){
    skip('index.php','error','already log out.');
}
setcookie('bbs[name]', "",time()-3600);
setcookie('bbs[pw]',  "",time()-3600);
skip('index.php', 'ok', 'Log out...')
?>