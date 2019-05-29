<?php
//数据库连接 connect to database
function connect($host = DB_HOST, $user = DB_USER, $password = DB_PASSWORD, $database = DB_DATABASE, $port = DB_PORT){
    $link = @mysqli_connect($host, $user, $password, $database, $port);
    if(mysqli_connect_errno()){
        exit(mysqli_connect_error());
    }
    mysqli_set_charset($link, 'utf8');
    return $link;
}
//执行一条SQL语句，返回结果集对象或布尔值
//execute an sql query, return object/boolean
function execute($link, $query){
    $result = mysqli_query($link, $query);
    if(mysqli_errno($link)){
        exit(mysqli_error($link));
    }
    return $result;
}
//执行一条SQL语句，只返回布尔值
//execute an sql query, return boolean
function execute_bool($link, $query){
    $bool = mysqli_real_query($link, $query);
    if(mysqli_errno($link)){
        exit(mysqli_error($link));
    }
    return $bool;
}
//一次性执行多条SQL语句 execute one or multiple queries
/*$arr_sqls=array(
    'select * from bbs_father_module',
    'select * from bbs_father_module2'
);
var_dump(execute_multi($link, $arr_sqls, $error));
echo $error;*/
function execute_multi($link,$arr_sqls,&$error){
    $sqls=implode(';',$arr_sqls).';';
    if(mysqli_multi_query($link,$sqls)){
        $data=array();
        $i=0;//count
        do {
            if($result=mysqli_store_result($link)){
                $data[$i]=mysqli_fetch_all($result);
                mysqli_free_result($result);
            }else{
                $data[$i]=null;
            }
            $i++;
            if(!mysqli_more_results($link)) break;
        }while (mysqli_next_result($link));
        if($i==count($arr_sqls)){
            return $data;
        }else{
            $error="Sql query statement is uncorrect! &nbsp; Query statement[{$i}]:&nbsp;{$arr_sqls[$i]} is wrong <br />Reason: ".mysqli_error($link);
            return false;
        }
    }else{
        $error='Sql query statement is uncorrect! Please check the first query statement!<br/>Reason: '.mysqli_error($link);
        return false;
    }
}
//获取记录数 get a result row as an enumerated array
function num($link,$sql_count){
    $result=execute($link,$sql_count);
    $count=mysqli_fetch_row($result);
    return $count[0];
}
//数据入库前进行转义，确保数据能够顺利入库
//encode a string to an escape SQL string to make sure the SQL string is legal and can be used in an SQL statement
function escape($link,$data){
    if(is_string($data)){
        return mysqli_real_escape_string($link,$data);
    }
    if(is_array($data)){
        foreach ($data as $key=>$val){
            $data[$key]=escape($link,$val); //Recursive
        }
    }
    return $data;
    //mysqli_real_escape_string($link,$data);
}
//关闭数据库的连接quit database
function close($link){
    mysqli_close($link);
}
?>