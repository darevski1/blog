<?php
    //Database connection

    $db['db_host'] = "62.108.40.88";
    $db['db_user'] = "admin";
    $db['db_password'] = "123mafijaX";
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

