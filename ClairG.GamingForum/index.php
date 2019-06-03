<?php
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
$template['title'] = 'Home Page';
$template['keywords'] = 'Home Page';
$template['description'] = 'Home Page';
$template['css'] = array('style/public.css','style/index.css');
$link = connect();
if($member_id = is_login($link)){
    //skip('index.php','error','already log in');
}

?>
<?php include_once 'inc/header.inc.php';?>

	
	<?php 
	$query = "select * from bbs_father_module order by sort";
	$result_father = execute($link, $query);
	while($data_father=mysqli_fetch_assoc($result_father)):?>
	<div class="box auto">
        <div class="title">
            <?php echo "{$data_father['module_name']}"?>
        </div>
        <div class="classList">            
 			<?php 
 			$query = "select * from bbs_son_module where father_module_id={$data_father['id']} order by sort";
 			$result_son = execute($link, $query);
 			if(mysqli_num_rows($result_son)){
     			while($data_son=mysqli_fetch_assoc($result_son)){
     			    $query="select count(*) from bbs_thread where module_id={$data_son['id']} and post_time>CURDATE() ";
     			    $count_today=num($link,$query);
     			    $query="select count(*) from bbs_thread where module_id={$data_son['id']}";
     			    $count_all=num($link,$query);
$html=<<<A
                    <div class="childBox new">
                        <h2><a href="#">{$data_son['module_name']}</a><span> (Today: {$count_today})</span></h2>
                        Threads: {$count_all}
                    </div>
A;
echo $html;
 			    } 
 			}else{
 			    echo '<div style="padding:10px 0;">No Subtopic...</div>';
 			}
 			?>
 			<div style="clear:both;"></div>
		</div> 
	</div> 
	<?php endwhile;?>
<?php include_once 'inc/footer.inc.php';?>