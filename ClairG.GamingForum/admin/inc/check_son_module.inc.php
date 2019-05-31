<?php
//father module is required
if(!is_numeric($_POST['father_module_id'])){
    skip('son_module_add.php','error','Please select a father module.');
}
$query="select * from bbs_father_module where id={$_POST['father_module_id']}";
$result=execute($link,$query);
if(mysqli_num_rows($result)==0){
    skip('son_module_add.php','error','This father module does not exist');
}
//module name is required
if(empty($_POST['module_name'])){
    skip('son_module_add.php', 'error', 'Module name is required.');
}
//encode query string
$_POST = escape($link, $_POST);
//
switch ($check_flag){
    case 'add':
        //unique module name
        $query = "select * from bbs_son_module where module_name = '{$_POST['module_name']}'";
        break;
    case 'update':
        $query = "select * from bbs_son_module where module_name = '{$_POST['module_name']}'and id != {$_GET['id']}";
        break;
    default:
        skip('son_module_add.php', 'error', '$check_flag is wrong');
}
$result = execute($link, $query);
if(mysqli_num_rows($result)){
    skip('son_module_add.php', 'error', 'Module Exists.');
}    
//info is required
if(empty($_POST['info'])){
    skip('son_module_add.php', 'error', 'Description of module is required.');
}
if(mb_strlen($_POST['info'])>250){
    skip('son_module_add.php','error','Description must be less than 250 characters');
}
//sort is a number
if(!is_numeric($_POST['sort'])){
    skip('son_module_add.php', 'error', 'Sort must be in the form of a number.');
}

?>