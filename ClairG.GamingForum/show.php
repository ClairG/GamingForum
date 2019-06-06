<?php 
include_once 'inc/config.inc.php';
include_once 'inc/mysql.inc.php';
include_once 'inc/tool.inc.php';
include_once 'inc/page.inc.php';
$link=connect();
$member_id=is_login($link);
//check id
if(!isset($_GET['id']) || !is_numeric($_GET['id'])){
	skip('index.php', 'error', 'id is uncorrect');
}
//get thread info 
$query="select bt.id bid,bt.module_id,bt.title,bt.content,bt.post_time,bt.member_id,bt.view_times,bm.name,bm.photo from bbs_thread bt,bbs_member bm where bt.id={$_GET['id']} and bt.member_id=bm.id";
$result_content=execute($link,$query);
if(mysqli_num_rows($result_content)!=1){
	skip('index.php', 'error', 'This thread does not exist');
}
//view_times+1
$query="update bbs_thread set view_times = view_times+1 where id={$_GET['id']}";
execute($link,$query);
//$data_content
$data_content=mysqli_fetch_assoc($result_content);
$data_content['view_times']=$data_content['view_times']+1;
$data_content['title']=htmlspecialchars($data_content['title']);
$data_content['content']=nl2br(htmlspecialchars($data_content['content']));
//$data_son
$query="select * from bbs_son_module where id={$data_content['module_id']}";
$result_son=execute($link,$query);
$data_son=mysqli_fetch_assoc($result_son);
//$data_father
$query="select * from bbs_father_module where id={$data_son['father_module_id']}";
$result_father=execute($link,$query);
$data_father=mysqli_fetch_assoc($result_father);

$template['title']='Thread';
$template['keywords'] = '';
$template['description'] = '';
$template['css']=array('style/public.css','style/show.css');
?>
<?php include 'inc/header.inc.php'?>
<div id="position" class="auto">
	 <a href="index.php">Home</a> &gt; 
	 <a href="list_father.php?id=<?php echo $data_father['id']?>"><?php echo $data_father['module_name']?></a> &gt; 
	 <a href="list_son.php?id=<?php echo $data_son['id']?>"><?php echo $data_son['module_name']?></a> &gt; 
	 <?php echo $data_content['title']?>
</div>
<div id="main" class="auto">
	<!-- Pagination -->
	<div class="wrap1">
		<div class="pages">
			<?php 
			$query="select count(*) from bbs_reply where content_id={$_GET['id']}";
			$count_reply=num($link, $query);
			$page=page($count_reply,2);
			echo $page['html'];
			?>
		</div>
		<a class="btn reply" href="reply.php?id=<?php echo $_GET['id']?>" target="_blank"></a>
		<div style="clear:both;"></div>
	</div>
	<!-- Show Thread Info -->
	<div class="wrapContent">
		<!-- Member Info -->
		<div class="left">
			<div class="face">
				<a target="_blank" href="">
					<img width=120 height=120 src="<?php if($data_content['photo']!=''){echo $data_content['photo'];}else{echo 'style/photo.jpg';}?>" />
				</a>
			</div>
			<div class="name">
				<a href=""><?php echo $data_content['name']?></a>
			</div>
		</div>
		<!-- Thread Info -->
		<div class="right">
			<div class="title">
				<h2><?php echo $data_content['title']?></h2>
				<span>Views: <?php echo $data_content['view_times']?>&nbsp;|&nbsp;Replies: 15</span>
				<div style="clear:both;"></div>
			</div>
			<div class="pubdate">
				<span class="date"><?php echo $data_content['post_time']?> </span>
			</div>
			<!-- Content -->
			<div class="content">
				 <?php echo $data_content['content']?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<!-- Show Reply Info -->
	<?php 
	$query="select bm.name,br.member_id,bm.photo,br.time,br.id,br.content from bbs_reply br,bbs_member bm where br.member_id=bm.id and br.content_id={$_GET['id']} {$page['limit']}";
	$result_reply=execute($link, $query);
	while ($data_reply=mysqli_fetch_assoc($result_reply)):?>
	<?php $data_reply['content']=nl2br(htmlspecialchars($data_reply['content']));?>
	<div class="wrapContent">
		<!-- Member Info -->
		<div class="left">
			<div class="face">
				<a target="_blank" href="">
					<img width=120 height=120 src="<?php if($data_content['photo']!=''){echo $data_content['photo'];}else{echo 'style/photo.jpg';}?>" />
				</a>
			</div>
			<div class="name">
				<a href=""><?php echo $data_reply['name']?></a>
			</div>
		</div>
<!-- 		Content -->
		<div class="right">			
			<div class="pubdate">
				<span class="date"><?php echo $data_reply['time']?></span>
				<span class="floor">#1&nbsp;|&nbsp;<a href="#">quote</a></span>
			</div>
			<div class="content">
				<?php 
				echo $data_reply['content'];
				?>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
	<?php endwhile;?>
<!-- 	Show Quote Info -->

	<!-- Pagination -->
	<div class="wrap1">
		<div class="pages">
			<?php 
			echo $page['html'];
			?>
		</div>
		<a class="btn reply" href="reply.php?id=<?php echo $_GET['id']?>" target="_blank"></a>
		<div style="clear:both;"></div>
	</div>
</div>
<?php include 'inc/footer.inc.php'?>