<?php
//Pagination
//call: $page = page (100, 10, 9)
/*
parameter
$count:# of threads
$page_size:# of threads per page
$num_btn: # of buttons
$page:?page=
return:array('limit','html')
*/
function page($count,$page_size,$num_btn=10,$page='page'){
    //no thread
    if($count==0){
        $data=array(
            'limit'=>'',
            'html'=>''
        );
        return $data;
    }
    //check
    if(!isset($_GET[$page]) || !is_numeric($_GET[$page]) || $_GET[$page]<1){
        $_GET[$page]=1;
    }
    //max page
    $page_num_all=ceil($count/$page_size);
    if($_GET[$page]>$page_num_all){
        $_GET[$page]=$page_num_all;
    }
    //=skip().take()
    $start=($_GET[$page]-1)*$page_size;
    $limit="limit {$start},{$page_size}";
    //url address
    $current_url=$_SERVER['REQUEST_URI'];//get url address
    $arr_current=parse_url($current_url);//seperate url
    $current_path=$arr_current['path'];///file path: xxx.php
    $url='';
    if(isset($arr_current['query'])){
        parse_str($arr_current['query'],$arr_query);
        unset($arr_query[$page]);
        if(empty($arr_query)){
            //xxx.php?page=
            $url="{$current_path}?{$page}=";
        }else{
            $other=http_build_query($arr_query);
            //xxx.php?id=1&a=1&page=
            $url="{$current_path}?{$other}&{$page}=";
        }
    }else{
        $url="{$current_path}?{$page}=";
    }
    $html=array();
    //# of btn > total page
    if($num_btn>=$page_num_all){
        //show all pages
        for($i=1;$i<=$page_num_all;$i++){
            //current page <span></span>
            if($_GET[$page]==$i){
                $html[$i]="<span>{$i}</span>";
            }
            //other pages <a></a>
            else{
                $html[$i]="<a href='{$url}{$i}'>{$i}</a>";
            }
        }
    }
    //# of btn <= total page
    else{
        $num_left=floor(($num_btn-1)/2);
        //first page
        $start=$_GET[$page]-$num_left;
        //last page
        $end=$start+($num_btn-1);
        //first page >=1
        if($start<1){
            $start=1;
        }
        //last page <= total page
        if($end>$page_num_all){
            $start=$page_num_all-($num_btn-1);
        }
        //show pages
        for($i=0;$i<$num_btn;$i++){
            if($_GET[$page]==$start){
                $html[$start]="<span>{$start}</span>";
            }else{
                $html[$start]="<a href='{$url}{$start}'>{$start}</a>";
            }
            $start++;
        }
        //ellipsis... if # of btn >=3
        if(count($html)>=3){
            reset($html);
            $key_first=key($html);
            end($html);
            $key_end=key($html);
            if($key_first!=1){
                array_shift($html);
                array_unshift($html,"<a href='{$url}=1'>1...</a>");
            }
            if($key_end!=$page_num_all){
                array_pop($html);
                array_push($html,"<a href='{$url}={$page_num_all}'>...{$page_num_all}</a>");
            }
        }
    }
    //prev.
    if($_GET[$page]!=1){
        $prev=$_GET[$page]-1;
        array_unshift($html,"<a href='{$url}{$prev}'>« Prev.</a>");
    }
    //next
    if($_GET[$page]!=$page_num_all){
        $next=$_GET[$page]+1;
        array_push($html,"<a href='{$url}{$next}'>Next »</a>");
    }
    //output
    $html=implode(' ',$html);
    $data=array(
        'limit'=>$limit,
        'html'=>$html
    );
    return $data;
}
?>