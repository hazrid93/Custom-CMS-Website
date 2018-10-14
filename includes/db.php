<?php

    $db['db_host'] = "localhost";
    $db['db_user'] = "root";
    $db['db_pass'] = "";
    $db['db_name'] = "cms";

    foreach($db as $key => $value){
        //create constant with define
        define(strtoupper($key), $value);
    }
               
    $connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    $query_setUTF = "SET NAMES 'utf8'";
    mysqli_query($connection,$query_setUTF);

    if($connection){
       // echo "We are connected";
    }else{
        
    }






?>