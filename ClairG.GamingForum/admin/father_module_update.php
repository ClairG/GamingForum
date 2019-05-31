<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title'] = 'Update Father Module';
$template['keywords'] = 'Update Father Module';
$template['description'] = 'Update Father Module';
$template['css'] = array('style/public2.css');
$link = connect();
//get info of original father module
//id is wrong
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('father_module.php', 'error', 'ID is wrong.');
}
$query = "select * from bbs_father_module where id = {$_GET['id']}";
$result = execute($link, $query);
//module doesn't exist
if(!mysqli_num_rows($result)){
    skip('father_module.php', 'error', 'The information of this father module does not exist');
}
//display info
$data = mysqli_fetch_assoc($result);

//function of update
if(isset($_POST['submit'])){
    //check input info
    $check_flag = 'update';
    include 'inc/check_father_module.inc.php';
    //update
    $query = "update bbs_father_module set module_name = '{$_POST['module_name']}', sort = {$_POST['sort']} where id = {$_GET['id']}";
    execute_bool($link, $query);
    if(mysqli_affected_rows($link)==1){
        skip('father_module.php', 'ok', 'Updated Successfully');
    }else{
        skip('father_module.php', 'error', 'Failed to update. Please try it again.');
    }
}
?>
<?php include 'inc/header.inc.php';?>
<div id="main">
	<div class="title">Update Father Module - <?php echo $data['module_name']?></div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Module Name</td>
				<td><input name="module_name" value = "<?php echo $data['module_name']?>" type="text" /></td>
				<td>
					required
				</td>
			</tr>
			<tr>
				<td>Sort Number</td>
				<td><input name="sort" value="<?php echo $data['sort']?>" type="text" /></td>
				<td>
					input a number
				</td>
			</tr>
		</table>
		<input style="margin:10px 0 0 450px; cursor: pointer;" class="btn" type="submit" name="submit" value="Update" />
	</form>	
</div>
<?php include 'inc/footer.inc.php';?>


