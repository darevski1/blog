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

                <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $query = "SELECT * from comments WHERE comment_post_id =" .mysqli_real_escape_string($connection, $_GET['id'])."";
                        $select_posts = mysqli_query($connection, $query);


                        while($row = mysqli_fetch_assoc($select_posts)){
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_authot = $row['comment_author'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];
                            $comment_date = $row['comment_date'];

                            echo "<tr>";
                            echo "<td>$comment_id</td>";
                            echo "<td>$comment_authot</td>";
                            echo "<td>$comment_content</td>";
                            echo "<td>$comment_email</td>";
                            echo "<td>$comment_status</td>";

                            $query = "SELECT * from posts WHERE post_id = $comment_post_id";
                            $select_posts_id = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_assoc($select_posts_id)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];

                            }
                            echo "<td><a href='../post.php?p_id=$post_id' target='_blank'>$post_title</a></td>";

                            echo "<td>$comment_date</td>";
                            echo "<td><a href='post_comments.php?approve=$comment_id&id=". $_GET['id'] ."'>Approve</a></td>";
                            echo "<td><a href='post_comments.php?unapprove=$comment_id&id=". $_GET['id'] ."'>Unapprove</a></td>";
                            echo "<td><a href='post_comments.php?delete=$comment_id&id=". $_GET['id'] ."'>Delete</a></td>";
                            echo "</tr>";

                            if (isset($_GET['approve'])){
                                $comment_id= $_GET['approve'];
                                $query = "UPDATE comments SET comment_status ='approved' WHERE comment_id = $comment_id";
                                $approve_query = mysqli_query($connection, $query);
                                header("Location: post_comments.php?id=" . $_GET['id'] . "" );

                            }
                            if (isset($_GET['unapprove'])){
                                $comment_id= $_GET['unapprove'];
                                $query = "UPDATE comments SET comment_status ='unapproved' WHERE comment_id = $comment_id";
                                $unapprove_query = mysqli_query($connection, $query);
                                header("Location: post_comments.php?id=" . $_GET['id'] . "" );

                            }
                            if (isset($_GET['delete'])){
                                $comment_id = $_GET['delete'];
                                $query = "DELETE FROM comments WHERE comment_id = $comment_id";
                                $delete_query_comment = mysqli_query($connection, $query);

                                header("Location: post_comments.php?id=" . $_GET['id'] . "" );
                            }

                        }
                        ?>
                        </tbody>
                    </table>
                </form>
            </div>
            </div>

        </div>

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<?php include "includes/admin_footer.php"; ?>


<!-- Page Content -->
