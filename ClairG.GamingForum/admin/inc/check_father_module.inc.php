<?php
//module name is required
if(empty($_POST['module_name'])){
    skip('father_module_add.php', 'error', 'Module Name is Required.');
}
//sort is a number
if(!is_numeric($_POST['sort'])){
    skip('father_module_add.php', 'error', 'Sort must be in the form of a number.');
}
//encode query string
$_POST = escape($link, $_POST);
//
switch ($check_flag){
    case 'add':
        //unique module name
        $query = "select * from bbs_father_module where module_name = '{$_POST['module_name']}'";
        break;
    case 'update':
        $query = "select * from bbs_father_module where module_name = '{$_POST['module_name']}'and id != {$_GET['id']}";
        break;
    default:
        skip('father_module_add.php', 'error', '$check_flag is wrong');
}
$result = execute($link, $query);
if(mysqli_num_rows($result)){
    skip('father_module_add.php', 'error', 'Module Exists.');
}    


?>