<?php
    if (isset($_POST['create_user'])){

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/users/$user_image");

        $query = "SELECT randSalt FROM users";
        $select_randsalt_query = mysqli_query($connection, $query);
        if (!$select_randsalt_query) {
            die("errrr" . mysqli_error($connection));
        }
        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randSalt'];

        $user_password = crypt($user_password, $salt);

        $query = "INSERT INTO users(user_firstname, user_lastname, user_image, user_role, username, user_email, user_password)";
        $query .= "VALUES('{$user_firstname}', '{$user_lastname}', '{$user_image}', '{$user_role}', '{$username}', '{$user_email}', '{$user_password}')";

        $inset_query = mysqli_query($connection, $query);

        if ($inset_query){
            echo "<div class=\"alert alert-success\">
  <strong>Success!</strong> New users has been created!!!.
</div>";
        }else{
            echo "dick";
        }
    }


?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Firstname</label>
        <input type="text" name="user_firstname" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_title">Lastname</label>
        <input type="text" name="user_lastname" class="form-control">
    </div>
    <div class="form-group">
        <select name="user_role" id="" class="form-control">
            <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_title">Username</label>
        <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_title">Email</label>
        <input type="text" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_title">Password</label>
        <input type="text" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <input type="submit" name="create_user" value="Add User" class="btn btn-block btn-success">
    </div>

</form>