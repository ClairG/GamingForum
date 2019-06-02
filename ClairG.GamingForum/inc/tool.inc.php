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
//login status
function is_login($link){
    if(isset($_COOKIE['bbs']['name'])&isset($_COOKIE['bbs']['pw'])){
        $query = "select * from bbs_member where name = '{$_COOKIE['bbs']['name']}' and pw='{$_COOKIE['bbs']['pw']}'";
        $result = execute($link, $query);
        if(mysqli_num_rows($result)==1){
            $data = mysqli_fetch_assoc($result);
            return $data['id'];
        }else{
            return false;
        }
    }else{
        return false;
    }
}
?>