<?php
//go back to previous page 
function skip($url, $pic, $message){
$html=<<<A
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
    <meta http-equiv="refresh" content="3; URL={$url}" />
    <title>go back to...</title>
    <link rel="stylesheet" type="text/css" href="style/remind.css" />
    </head>
    <body>
        <div class="notice">
            <span class="pic {$pic}"></span> {$message}! <a href="{$url}">Go back automatically to previous page...</a>
        </div>
    </body>
</html>
A;
echo $html;
exit();
}
?>