<?php
if(empty($_POST['name'])){
    skip('register.php', 'error', 'The username field is required.');
}
if(mb_strlen($_POST['name'])>32){
    skip('register.php', 'error', 'The username is less than 32 characters.');
}
if(mb_strlen($_POST['pw'])<6){
    skip('register.php', 'error', 'The password must have at least 6 characters.');
}
if(($_POST['pw'])!=($_POST['confirm_pw'])){
    skip('register.php', 'error', 'The two passwords do not match.');
}

//usename exists
$_POST = escape($link, $_POST);
$query = "select * from bbs_member where name='{$_POST['name']}'";
$result = execute($link, $query);
if(mysqli_num_rows($result)){
    skip('register.php', 'error', 'This username exists.');
}
?>
