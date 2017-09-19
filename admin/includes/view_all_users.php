<table class="table">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Image</th>
        <th>Email</th>
        <th>Role</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * from users";
    $select_users = mysqli_query($connection, $query);

     while($row = mysqli_fetch_assoc($select_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname= $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_image = $row['user_image'];
        $user_email= $row['user_email'];
        $user_role = $row['user_role'];


        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td><img src='../images/users/$user_image' class='img-circle' alt='' style='width:40px; height:40px;'></td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?change_to_admin={$user_id}'>Admim</a></td>";
        echo "<td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Delete</a></td>";
        echo "<td><a href='users.php?source=edit_user&userID={$user_id}'><i class=\"fa fa-trash\" aria-hidden=\"true\"></i> Edit</a></td>";

         echo "</tr>";


    }

    ?>
    </tbody>
</table>
<?php
if (isset($_GET['delete'])){
    $user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$user_id}";
    $delete_query = mysqli_query($connection, $query);
    header('Location: users.php');
    if ($delete_query){
        echo "Succes";
    }
}
//Change to admin
if (isset($_GET['change_to_admin'])){
    $user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$user_id}";
    $update_admin = mysqli_query($connection, $query);
    header('Location: users.php');
    if ($update_admin){
        echo "Succes";
    }
}
if (isset($_GET['change_to_sub'])){
    $user_id = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$user_id}";
    $update_admin_sub = mysqli_query($connection, $query);
    header('Location: users.php');
    if ($update_admin_sub){
        echo "Succes";
    }
}


?>