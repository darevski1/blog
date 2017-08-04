<?php include "includes/admin_header.php"; ?>
<?php include "../includes/db.php"; ?>
<?php include "function.php"; ?>

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
                            Categories Page
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

                        <div class="col-xs-6">
                            <?php insert_categories(); ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Category Title:</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add Category"
                                           class="btn btn-block btn-success">
                                </div>
                            </form>


                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Update Title:</label>
                                    <?php
                                    if (isset($_GET['edit'])) {
                                        $cat_id = $_GET['edit'];
                                        $query = "SELECT * FROM categories WHERE cat_id =$cat_id";
                                        $select_categories_id = mysqli_query($connection, $query);

                                        while ($row = mysqli_fetch_assoc($select_categories_id)) {
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];

                                            ?>
                             <input type="text" value="<?php if (isset($cat_title)) {echo $cat_title;
                                            } ?>" name="cat_title" class="form-control">
                                        <?php }} ?>
                                    <?php
                                    if (isset($_POST['update'])) {
                                        $the_cat_title = $_POST['cat_title'];
                                        $query = "UPDATE categories SET cat_title = '{$the_cat_title}' WHERE cat_id = $cat_id";
                                        $update_query = mysqli_query($connection, $query);
                                        if (!$update_query) {
                                            die("Query Faild" . mysqli_error($connection));
                                        }
                                    }

                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update" value="Update Category" class="btn btn-block btn-success">
                                </div>
                            </form>
                        </div>
                        <div class="col-xs-6">


                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Category Name</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //Select all Categories
                                $sql = "select  * from categories";
                                $query = mysqli_query($connection, $sql);

                                while ($res = mysqli_fetch_assoc($query)) {
                                    $cat_id = $res['cat_id'];
                                    $cat_title = $res['cat_title'];

                                    ?>
                                    <?php
                                    if (isset($_GET['delete'])) {
                                        $the_cat_id = $_GET['delete'];
                                        $delete_query = "DELETE from categories WHERE cat_id = $the_cat_id";
                                        $delete = mysqli_query($connection, $delete_query);
                                        header("Location: categories.php");
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $cat_id; ?></td>
                                        <td><?php echo $cat_title; ?></td>
                                        <td><a href="categories.php?delete=<?php echo $cat_id ?>">Delete</a></td>
                                        <td><a href="categories.php?edit=<?php echo $cat_id ?>">Edit</a></td>

                                    </tr>
                                <?php } ?>

                                </tbody>

                            </table>
                        </div>
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