<?php
if(mb_strlen($_POST['content'])<3){
    skip($_SERVER['REQUEST_URI'], 'error', 'Content must be more than 3 characters');
}
?>