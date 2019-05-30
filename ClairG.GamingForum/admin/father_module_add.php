<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
if(isset($_POST['submit'])){
    $link = connect();
    //check input info 
    $check_flag = 'add';
    include 'inc/check_father_module.inc.php';
    //execute - add father module    
    $query = "insert into bbs_father_module(module_name, sort) values ('{$_POST['module_name']}',{$_POST['sort']}) ";
    execute($link, $query);
    if(mysqli_affected_rows($link)==1){
        skip('father_module.php', 'ok', 'Added Successfully');
    }else{
        skip('father_module_add.php', 'error', 'Failed to add. Please try it again.');
    }
}
$template['title'] = 'Add Father Module';
$template['keywords'] = 'Add Father Module';
$template['description'] = 'Add Father Module';
$template['css'] = array('style/public2.css');
?>
<?php include 'inc/header.inc.php';?>
<div id="main">
	<div class="title">Add Father Module</div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" type="text" /></td>
				<td>
					required
				</td>
			</tr>
			<tr>
				<td>Sort Number</td>
				<td><input name="sort" value="0" type="text" /></td>
				<td>
					input a number
				</td>
			</tr>
		</table>
		<input style="margin:10px 0 0 450px; cursor: pointer;" class="btn" type="submit" name="submit" value="Add" />
	</form>			
</div>
<?php include 'inc/footer.inc.php';?>


