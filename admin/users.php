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
                    <?php
                    if (isset($_GET['source'])){
                        $source = $_GET['source'];
                    }else{
                        $source =34;
                    }
                    switch ($source){

                        case "add_user";
                        include  "includes/add_user.php";
                        break;

                        case "edit_user";
                        include  "includes/edit_user.php";
                        break;

                        default:
                            include  "includes/view_all_users.php";
                        break;

                    }
                    ?>

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