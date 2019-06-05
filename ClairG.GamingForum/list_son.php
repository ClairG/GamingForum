<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';

$link=connect();
//login status
$member_id=is_login($link);
//check son module id
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', 'error', 'id is uncorrect');
}
//get subtopic info by id
$query="select * from bbs_son_module where id={$_GET['id']}";
$result_son=execute($link,$query);
if(mysqli_num_rows($result_son)!=1){
	skip('index.php', 'error', 'This subtopic does not exist');
}
//$data_son
$data_son=mysqli_fetch_assoc($result_son);
$query="select * from bbs_father_module where id={$data_son['father_module_id']}";
$result_father=execute($link,$query);
$data_father=mysqli_fetch_assoc($result_father);
//today:...,threads:...
$query="select count(*) from bbs_thread where module_id={$_GET['id']}";
$count_all=num($link,$query);
$query="select count(*) from bbs_thread where module_id={$_GET['id']} and post_time>CURDATE()";
$count_today=num($link,$query);
//get moderator info by member_id
$query="select * from bbs_member where id={$data_son['member_id']}";
$result_member=execute($link, $query);

$template['title']='Subtopic';
$template['keywords'] = '';
$template['description'] = '';
$template['css']=array('style/public.css','style/list.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="position" class="auto">
	 <a href="index.php">Home</a> &gt; 
	 <a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a> &gt; 
	 <?php echo $data_son['module_name']?>
</div>
<div id="main" class="auto">
	<div id="left">
		<div class="box_wrap">
			<h3><?php echo $data_son['module_name']?></h3>
			<div class="num">
			  Today: <span><?php echo $count_today?></span>&nbsp;&nbsp;&nbsp;
			  Threads: <span><?php echo $count_all?></span>
			</div>
			<div class="moderator">Moderator:
				<span>
					<?php
						if(mysqli_num_rows($result_member)==0){
							echo 'N/A';
						}else{
							$data_member=mysqli_fetch_assoc($result_member);
							echo $data_member['name'];
						}
					?>
				</span>
			</div>
			<div class="notice"><?php echo $data_son['info']?></div>
<!-- 			Pagination -->
			<div class="pages_wrap">
<!-- 				Create Thread -->
				<a class="btn publish" href="publish.php?son_module_id=<?php echo $_GET['id']?>" target="_blank"></a>
				<div class="pages">
					<?php 
					$page=page($count_all,2);
					echo $page['html'];
					?>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div style="clear:both;"></div>
<!-- 		Show Threads -->
		<ul class="postsList">
			<?php 
			$query="select
			bbs_thread.title,bbs_thread.id,bbs_thread.post_time,bbs_thread.view_times,bbs_member.name,bbs_member.photo
			from bbs_thread,bbs_member where
			bbs_thread.module_id={$_GET['id']} and
			bbs_thread.member_id=bbs_member.id {$page['limit']}";
			$result_content=execute($link,$query);
		    while($data_thread=mysqli_fetch_assoc($result_content)):?>
			<li>
				<div class="smallPic">
					<a href="#">
						<img width="45" height="45"src="
						    <?php if($data_thread['photo']!=''){
						        echo $data_thread['photo'];
						    }else{echo 'style/photo.jpg';}?>">
					</a>
				</div>					
				<div class="subject">
					<div class="titleWrap">						
					<h2><a href="#"><?php echo "{$data_thread['title']}" ?></a></h2></div>
					<p>
						<?php echo "{$data_thread['name']}" ?>&nbsp;<?php echo "{$data_thread['post_time']}" ?>&nbsp;&nbsp;&nbsp;&nbsp;Last reply: time
					</p>
				</div>
				<div class="count">
					<p>
						Replies<br /><span>000</span>
					</p>
					<p>
						Views<br /><span><?php echo "{$data_thread['view_times']}" ?></span>
					</p>
				</div>
				<div style="clear:both;"></div>
			</li>
			<?php endwhile;?>	
		</ul>
<!-- 		Pagination -->
		<div class="pages_wrap">
			<a class="btn publish" href="publish.php?son_module_id=<?php echo $_GET['id']?>" target="_blank"></a>
			<div class="pages">
				<?php 
				echo $page['html'];
				?>
			</div>
			<div style="clear:both;"></div>
		</div>
	</div>
<!-- 	Navigation -->
	<div id="right">
		<div class="classList">
			<div class="title">Topic List</div>
			<ul class="listWrap">
				<?php 
				$query="select * from bbs_father_module";
				$result_father=execute($link, $query);
				while($data_father=mysqli_fetch_assoc($result_father)):?>
				<li>
					<h2><a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a></h2>
					<ul>
						<?php 
						$query="select * from bbs_son_module where father_module_id={$data_father['id']}";
						$result_son=execute($link, $query);
						while($data_son=mysqli_fetch_assoc($result_son)){
						?>
						<li><h3><a href="list_son.php?id=<?php echo $data_son['id']?>"><?php echo $data_son['module_name']?></a></h3></li>
						<?php 
						}
						?>
					</ul>
				</li>
				<?php endwhile;?>
			</ul>
		</div>
	</div>
	<div style="clear:both;"></div>
</div>
<?php include 'inc/footer.inc.php'?>