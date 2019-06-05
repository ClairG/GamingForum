<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$template['title'] = 'Create Thread';
$template['keywords'] = 'Create Thread';
$template['description'] = 'Create Thread';
$template['css'] = array('style/public.css','style/publish.css');
$link = connect();
if(!$member_id = is_login($link)){
    skip('login.php', 'error', 'Please sign in');
}
//submit
if(isset($_POST['submit'])){
    include 'inc/check_publish.inc.php';
    $_POST=escape($link,$_POST);
    $query="insert into bbs_thread(module_id,title,content,post_time,member_id) values({$_POST['module_id']},'{$_POST['title']}','{$_POST['content']}',now(),{$member_id})";
    execute($link, $query);
    if(mysqli_affected_rows($link)==1){
        skip('publish.php', 'ok', 'Created Successfully.');
    }else{
        skip('publish.php', 'error', 'Failed to create.');
    }
}
?>
<?php include_once 'inc/header.inc.php';?>
	<div id="position" class="auto">
		 <a href="index.php">Home</a> &gt; Create Thread
	</div>
	<div id="publish">
		<form method="post">
			<select name="module_id">
				<option value='-1'>====Please select a topic====</option>
				<?php 
				//create a thread in list_father
				$where='';
				if(isset($_GET['father_module_id']) && is_numeric($_GET['father_module_id'])){				    
				    $where = "where id={$_GET['father_module_id']} ";
				} 
				$query="select * from bbs_father_module $where order by sort";
				$result_father=execute($link, $query);
				while ($data_father = mysqli_fetch_assoc($result_father)){
					echo "<optgroup label='{$data_father['module_name']}'>";
					$query="select * from bbs_son_module where father_module_id={$data_father['id']} order by sort";
					$result_son=execute($link, $query);
					while ($data_son = mysqli_fetch_assoc($result_son)){
					    //create a thread in list_son
					    if(isset($_GET['son_module_id']) && $_GET['son_module_id']==$data_son['id']){
					        echo "<option value='{$data_son['id']}' selected='selected'>{$data_son['module_name']}</option>";
					    }
					    //default
					    else{
					        echo "<option value='{$data_son['id']}'>{$data_son['module_name']}</option>";
					    }						
					}
					echo "</optgroup>";
				}
				?>
			</select>
			<input class="title" placeholder="Subject..." name="title" type="text" />
			<textarea name="content" class="content"></textarea>
			<input class="publish" type="submit" name="submit" value="" />
			<div style="clear:both;"></div>
		</form>
	</div>
<?php include_once 'inc/footer.inc.php';?>
