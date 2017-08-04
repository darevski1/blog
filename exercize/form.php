<?php

if (isset($_POST['submit'])) {
    $name = array("darko", "admin");
    $password = $_POST['password'];
    $username = $_POST['username'];
    $minimum = 5;
    $maxmimum = 15;

    if (strlen($username) < $minimum) {
        echo "Username is to short min 5";
    }
    if (strlen($username) > $maxmimum) {
        echo "Username is to Long max 15";
    }

    if (!is_array($username)){
        echo "muda";
    }else{
        echo "Wellcome";
    }



}
