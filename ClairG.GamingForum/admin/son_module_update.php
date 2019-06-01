<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$template['title'] = 'Update Child Module';
$template['keywords'] = 'Update Child Module';
$template['description'] = 'Update Child Module';
$template['css'] = array('style/public2.css');
$link = connect();
//get info of original child module
//id is wrong
if(!isset($_GET['id'])||!is_numeric($_GET['id'])){
    skip('son_module.php', 'error', 'ID is wrong.');
}
$query = "select * from bbs_son_module where id = {$_GET['id']}";
$result = execute($link, $query);
//module doesn't exist
if(!mysqli_num_rows($result)){
    skip('son_module.php', 'error', 'This child module does not exist');
}
//display info
$data = mysqli_fetch_assoc($result);

//function of update
if(isset($_POST['submit'])){
    //check input info
    $check_flag = 'update';
    include 'inc/check_son_module.inc.php';
    //update
    $query = "update bbs_son_module set father_module_id={$_POST['father_module_id']}, module_name = '{$_POST['module_name']}', info='{$_POST['info']}', member_id={$_POST['member_id']}, sort = {$_POST['sort']} where id = {$_GET['id']}";
    execute_bool($link, $query);
    if(mysqli_affected_rows($link)==1){
        skip('son_module.php', 'ok', 'Updated Successfully');
    }else{
        skip('son_module.php', 'error', 'Failed to update. Please try it again.');
    }
}
?>
<?php include 'inc/header.inc.php';?>
<div id="main">
	<div class="title">Update Child Module - <?php echo $data['module_name']?></div>
	<form method="post">
		<table class="au">
			<tr>
				<td>Father Module</td>
				<td>
					<select name="father_module_id">
						<option value="0">====Please select a father module====</option>
						<?php 
						$query = "select * from bbs_father_module";
						$result = execute($link, $query);
						foreach ($result as $opt){
							if($opt['id']==$data['father_module_id']){
							    echo "<option selected='selected' value='{$opt['id']}'>{$opt['module_name']}</option>";
							}else{
							    echo "<option value='{$opt['id']}'>{$opt['module_name']}</option>";	
							}						    				
						}?>
					</select>
				</td>
				<td>required</td>
			</tr>
			<tr>
				<td>Child Module Name</td>
				<td><input name="module_name" type="text" value="<?php echo $data['module_name']?>" /></td>
				<td>
					required
				</td>
			</tr>
			<tr>
				<td>Description of Module</td>
				<td><textarea name="info"><?php echo $data['info']?></textarea></td>
				<td>required, less than 250 characters</td>
			</tr>
			<tr>
				<td>Moderator</td>
				<td>
					<select name="member_id">
						<option value="<?php echo $data['member_id']?>">====Please select a moderator====</option>
					</select>
				</td>
				<td></td>
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


