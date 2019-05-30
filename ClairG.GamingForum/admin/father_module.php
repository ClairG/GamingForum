<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link = connect();
$template['title'] = 'Father Module List';
$template['keywords'] = 'Father Module List';
$template['description'] = 'Father Module List';
$template['css'] = array('style/public2.css');

?>
<?php include 'inc/header.inc.php';?>
	<div id="main">
		<div class="title">Father Module List</div>
		<table class="list">
			<tr>
				<th>Sort</th>	 	 	
				<th>Module</th>
				<th>Operation</th>
			</tr>
			<?php 
			$query = "select * from bbs_father_module";
			$result = execute($link, $query);
			while ($data = mysqli_fetch_assoc($result)){
			    //delete confirm - yes
			    $url = urlencode("father_module_delete.php?id={$data['id']}");
			    //delete confirm - no
			    $return_url = urlencode($_SERVER['REQUEST_URI']);
			    //delete message
			    $message = "Are you sure you want to delete father module {$data['module_name']}?";
			    //$_GET
			    $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
$html=<<<A
                <tr>
                	<td><input class="sort" type="text" name="sort" /></td>
                	<td>{$data['module_name']}[id:{$data['id']}]</td>
                	<td><a href="#">[Visit]</a>&nbsp;&nbsp;<a href="#">[Edit]</a>&nbsp;&nbsp;<a href="$delete_url">[Delete]</a></td>
                </tr>
A;
                echo $html;
			}				
			?>
			
		</table>
	</div>
<?php include 'inc/footer.inc.php';?>


