<?php
include_once '../inc/config.inc.php';
include_once '../inc/mysql.inc.php';
$link = connect();


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
$html=<<<A
                <tr>
                	<td><input class="sort" type="text" name="sort" /></td>
                	<td>{$data['module_name']}[id:{$data['id']}]</td>
                	<td><a href="#">[Visit]</a>&nbsp;&nbsp;<a href="#">[Edit]</a>&nbsp;&nbsp;<a href="#">[Delete]</a></td>
                </tr>
A;
                echo $html;
			}				
			?>
			
		</table>
	</div>
<?php include 'inc/footer.inc.php';?>


