<?php
//<!--Select user information-->
if (isset($_GET['userID']))    {
    $user_id = $_GET['userID'];
    echo $user_id;
}
$query = "SELECT * from users WHERE user_id = '{$user_id}'";
$select_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_query)){
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    $randSalt = $row['randSalt'];


    if (isset($_POST['edit_user'])){
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];

        move_uploaded_file($user_image_temp, "../images/users/$user_image");

        if (empty($user_image)) {
            $query = "SELECT * FROM users WHERE user_id = $user_id";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_image)) {
                $user_image = $row['user_image'];
            }
        }

//        Select RandSalt Password
        $query = "SELECT randSalt FROM users";
        $select_salt_query = mysqli_query($connection, $query);
        if (!$select_salt_query){
            die("Errroro!!" . mysqli_error($connection));
        }
        $row = mysqli_fetch_array($select_salt_query);
        $salt = $row['randSalt'];

        $hashed_password = crypt($user_password, $salt);



        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$hashed_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE user_id = {$user_id}";

        $update_user_query = mysqli_query($connection, $query);
//    header('Location: users.php');

        if ($update_user_query) {
            header('Location: users.php');
            echo "sdfsdfds";
        }else{
            die("Error !!!!!!!!! " . mysqli_error($connection));
        }
    }
}

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Firstname</label>
        <input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname; ?>">
    </div>
    <div class="form-group">
        <label for="post_title">Lastname</label>
        <input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname; ?>">
    </div>
    <div class="form-group">
        <label for="userRole">User Role</label>
        <select name="user_role" id="" class="form-control">
            <option value='<?php echo $user_role; ?>''><?php echo $user_role; ?></option>";
            <?php
            if ($user_role == 'admin'){
                echo "<option value='subscriber''>Subscriber</option>";
            }else{
                echo "<option value='admin'>Admin</option>";
            }

            ?>

        </select>
    </div>
    <div class="form-group">
        <label for="post_title">Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <label for="post_title">Email</label>
        <input type="text" name="user_email" class="form-control" value="<?php echo $user_email; ?>">
    </div>
    <div class="form-group">
        <label for="post_title">Password</label>
        <input type="text" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
    </div>
    <div class="form-group">
        <img style="width: 120px;" src="../images/users/<?php echo $user_image; ?>" alt="">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <input type="submit" name="edit_user" value="Edit User" class="btn btn-block btn-success">
    </div>

</form>
