<?php
if(empty($_POST['name'])){
    skip('login.php', 'error', 'The username field is required.');
}
if(mb_strlen($_POST['name'])>32){
    skip('login.php', 'error', 'The username must be less than 32 characters.');
}
if(empty($_POST['pw'])){
    skip('login.php', 'error', 'The password field is required.');
}
if(empty($_POST['time']) || !is_numeric($_POST['time']) || $_POST['time']>2592000){
    $_POST['time']=2592000;
}

?>
