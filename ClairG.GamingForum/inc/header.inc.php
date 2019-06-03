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
			<div class="logo">Gaming Forum</div>
			<div class="nav">
				<a class="hover">Home</a>
			</div>
			<div class="serarch">
				<form>
					<input class="keyword" type="text" name="keyword" placeholder="Search for anything..." />
					<input class="submit" type="submit" name="submit" value="" />
				</form>
			</div>
			<div class="login">
				<?php if($member_id){
				    echo "<span style = 'color:#fff;'>Hello, </span><a href='#'>{$_COOKIE['bbs']['name']}</a>";
				}
				else{
				    echo "<a href='login.php'>Sign in</a>&nbsp;";
				    echo "<a href='register.php'>| Register</a>";
				}?>
				
				
			</div>
		</div>
	</div>
	<div style="margin-top:55px;"></div>
