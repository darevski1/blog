<?php

function confirm($result){
    global $connection;
    if (!$result){
        die("Errrrror" . mysqli_error($connection));
    }
}


function insert_categories(){
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field should not be empty";
        } else {
            $query = "INSERT into categories(cat_title)";
            $query .= "VALUES('{$cat_title}')";

            $create_category_query = mysqli_query($connection, $query);

            if (!$create_category_query) {
                die('QUERY FAIL') . mysqli_query($connection);
            }
        }
    }
}

function user_online(){
    if (isset($_GET['onLineusers'])){

        global $connection;

        if (!$connection){
            session_start();
            include ("../includes/db.php");

        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * from users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);

        if ($count == NULL) {
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
        } else {
            mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE SESSION = '$session'");
        }
        $users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
        echo $count_user = mysqli_num_rows($users_online);
        }
    }//get request isset
}
user_online();