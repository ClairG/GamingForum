<?php 
    //$a = basename($_SERVER['SCRIPT_NAME']);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>adminstrator - <?php echo $template['title'] ?></title>
        <meta name="keywords" content="<?php echo $template['keywords'] ?>" />
        <meta name="description" content="<?php echo $template['description'] ?>" />
        <?php foreach ($template['css'] as $css) {
            echo "<link rel='stylesheet' type='text/css' href='{$css}' />";
        }?>
    </head>
    <body>
    	<!-- top bar -->
    	<div id="top">
		<div class="logo">
			Administrator Center
		</div>
		<div class="login_info">
			<a href="#" style="color:#fff;">Home Page</a>&nbsp;|&nbsp;
			Administrator: admin <a href="#">[logout]</a>
		</div>
	</div>
    	<!-- side bar -->
    	<div id="sidebar">
		<ul>
			<li>
				<div class="small_title">System</div>
				<ul class="child">
					<li><a href="#">System Information</a></li>
					<li><a href="#">Administrator</a></li>
					<li><a href="#">Add Administrator</a></li>
					<li><a href="#">Setting</a></li>
				</ul>
			</li>
			<li>
				<div class="small_title">Content Management</div>
				<ul class="child">
					<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='father_module.php'){echo 'class="current"';}?> href="father_module.php">Father Module List</a></li>
					<li><a <?php if(basename($_SERVER['SCRIPT_NAME'])=='father_module_add.php'){echo 'class="current"';}?> href="father_module_add.php">Add Father Module</a></li>
					<li><a href="#">Child Module List</a></li>
					<li><a href="#">Add Child Module</a></li>
					<li><a href="#">Thread Management</a></li>
				</ul>
			</li>
			<li>
				<div class="small_title">User Management</div>
				<ul class="child">
					<li><a href="#">User List</a></li>
				</ul>
			</li>
		</ul>
	</div>    	