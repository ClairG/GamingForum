<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link = connect();
$template['title'] = 'Child Module List';
$template['keywords'] = 'Child Module List';
$template['description'] = 'Child Module List';
$template['css'] = array('style/public2.css');

?>
<?php include 'inc/header.inc.php';?>
	<div id="main">
		<div class="title">Child Module List</div>
		<table class="list">
			<tr>
				<th>Sort</th> 	 	
				<th>Module</th>
				<th>Father Module</th>	
				<th>Moderator</th>
				<th>Operation</th>
			</tr>
			<?php 
			$query = "select bsm.id, bsm.module_name, bfm.module_name bfn, bsm.member_id from bbs_son_module bsm, bbs_father_module bfm where bsm.father_module_id=bfm.id order by bfm.id";
			$result = execute($link, $query);
			while ($data = mysqli_fetch_assoc($result)){
			    //delete confirm - yes
			    $url = urlencode("son_module_delete.php?id={$data['id']}");
			    //delete confirm - no
			    $return_url = urlencode($_SERVER['REQUEST_URI']);
			    //delete message
			    $message = "Are you sure you want to delete Child module {$data['module_name']}?";
			    //$_GET
			    $delete_url = "confirm.php?url={$url}&return_url={$return_url}&message={$message}";
$html=<<<A
                <tr>
                	<td><input class="sort" type="text" name="sort" /></td>                    
                	<td>{$data['module_name']}[id:{$data['id']}]</td>
                    <td>{$data['bfn']}</td>
                    <td>{$data['member_id']}</td>
                	<td><a href="#">[Visit]</a>&nbsp;&nbsp;<a href="son_module_update.php?id={$data['id']}">[Edit]</a>&nbsp;&nbsp;<a href="$delete_url">[Delete]</a></td>
                </tr>
A;
                echo $html;
			}				
			?>
			
		</table>
	</div>
<?php include 'inc/footer.inc.php';?>


