<?php
//공통 DB연결 **변경 하지 마시오**
function db_conn(&$param_conn){
    $host = "localhost";
    $user = "root";
    $pass = "0809";
    $charset = "utf8mb4";
    $db_name = "first_pj";
    $dns = "mysql:host=".$host.";dbname=".$db_name.";charset=".$charset;
    $pdo_option = array(PDO::ATTR_EMULATE_PREPARES => false
                        ,PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                        );

    try{
        $param_conn = new PDO($dns,$user,$pass,$pdo_option);
    }catch(Exception $e){
        $param_conn = null;
        throw new Exception($e->getMessage());
    }
}
?>