<?php
    //Database connection

    $db['db_host'] = "127.0.0.1";
    $db['db_user'] = "root";
    $db['db_password'] = "";
    $db['db_name'] = "cms";


    foreach($db as $key => $value){
        define(strtoupper($key), $value);
    }




$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

//    if ($connection){
//        echo  "We are connected";
//    }else{
//        echo "Error.....";
//    }


?>

