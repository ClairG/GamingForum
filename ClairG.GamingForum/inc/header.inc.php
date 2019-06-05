<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title><?php echo $template['title'] ?></title>
<meta name="keywords" content="<?php echo $template['keywords'] ?>" />
<meta name="description" content="<?php echo $template['description'] ?>" />
<?php foreach ($template['css'] as $css) {
            echo "<link rel='stylesheet' type='text/css' href='{$css}' />";
        }?>
</head>
<body>
	<div class="header_wrap">
		<div id="header" class="auto">
			<div class="logo"><a href="index.php" style="color: white; text-decoration:none;">Gaming Forum</a></div>
			<div class="nav">
				<a class="hover" href="index.php">Home</a>
			</div>
			<div class="serarch">
				<form>
					<input class="keyword" type="text" name="keyword" placeholder="Search for anything..." />
					<input class="submit" type="submit" name="submit" value="" />
				</form>
			</div>
			<div class="login">
				<?php if(isset($member_id) && $member_id){
				    echo "<span style = 'color:#fff;'>Hello, </span><a href='#'>{$_COOKIE['bbs']['name']}</a> <a href='logout.php'> | Log out</a>";
				}
				else{
				    echo "<a href='login.php'>Sign in</a>&nbsp;";
				    echo "<a href='register.php'>| Register</a>";
				}?>
				
				
			</div>
		</div>
	</div>
	<div style="margin-top:55px;"></div>
