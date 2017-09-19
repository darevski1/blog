<?php include "includes/admin_header.php"; ?>
<?php include "../includes/db.php"; ?>
<?php include "function.php"; ?>
<?php
    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $query = "SELECT * FROM users WHERE username = '{$username}'";

        $select_query = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname= $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_image = $row['user_image'];
            $user_email= $row['user_email'];
            $user_role = $row['user_role'];
        }
    }
?>
<?php
    if (isset($_POST['update_profile'])){
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

        $query = "UPDATE users SET ";
        $query .= "username = '{$username}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}', ";
        $query .= "user_image = '{$user_image}' ";
        $query .= "WHERE username = '{$username}'";

        $update_user_query = mysqli_query($connection, $query);
//    header('Location: users.php');

        if ($update_user_query) {
            header('Location: profile.php');
            echo "sdfsdfds";
        }else{
            die("Error !!!!!!!!! " . mysqli_error($connection));
        }
}

?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
            <?php include "includes/admin_topnavigation.php"; ?>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php include "includes/admin_sidebar.php"; ?>
            <!-- /.navbar-collapse -->
        </nav>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">

                            Posts Page
                            <small>Subheading</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i> <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>
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
                                <select name="user_role" id="" class="form-control">
                                    <option value='subscriber''><?php echo $user_role; ?></option>";
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
                                <input type="password" name="user_password" class="form-control" value="<?php echo $user_password; ?>">
                            </div>
                            <div class="form-group">
                                <img style="width: 120px;" src="../images/users/<?php echo $user_image; ?>" alt="">
                                <label for="image">Image</label>
                                <input type="file" name="image">
                            </div>

                            <div class="form-group">
                                <input type="submit" name="update_profile" value="Edit User" class="btn btn-block btn-success">
                            </div>

                        </form>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>