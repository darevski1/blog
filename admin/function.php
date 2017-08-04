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