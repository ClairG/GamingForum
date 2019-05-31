<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
include_once '../inc/tool.inc.php';
$link = connect();
if(isset($_POST['submit'])){
    //check input info
    $check_flag = 'add';
    include 'inc/check_son_module.inc.php';
    //execute - add son module
    $query = "insert into bbs_son_module(father_module_id, module_name, info, member_id, sort) values ({$_POST['father_module_id']}, '{$_POST['module_name']}', '{$_POST['info']}', {$_POST['member_id']}, {$_POST['sort']}) ";
    execute($link, $query);
    if(mysqli_affected_rows($link)==1){
        skip('son_module.php', 'ok', 'Added Successfully');
    }else{
        skip('son_module_add.php', 'error', 'Failed to add. Please try it again.');
    }
}
$template['title'] = 'Add Child Module';
$template['keywords'] = 'Add Child Module';
$template['description'] = 'Add Child Module';
$template['css'] = array('style/public2.css');
?>
<?php include 'inc/header.inc.php';?>
<div id="main">
	<div class="title">Add Child Module</div>
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
						foreach ($result as $opt):?>
						    <option value="<?php echo $opt['id']?>"><?php echo $opt['module_name'] ?></option>						
						<?php endforeach;?>
					</select>
				</td>
				<td>required</td>
			</tr>
			<tr>
				<td>Child Module Name</td>
				<td><input name="module_name" type="text" /></td>
				<td>
					required
				</td>
			</tr>
			<tr>
				<td>Description of Module</td>
				<td><textarea name="info"></textarea></td>
				<td>required, less than 250 characters</td>
			</tr>
			<tr>
				<td>Moderator</td>
				<td>
					<select name="member_id">
						<option value="0">====Please select a moderator====</option>
						<?php ?>
					</select>
				</td>
				<td></td>
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


