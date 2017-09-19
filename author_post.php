<?php include "includes/db.php";?>
<?php include "includes/header.php";?>

<!-- Navigation -->
<?php include "includes/navigation.php";?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <?php
            if(isset($_GET['p_id'])){
                $the_post_id = $_GET['p_id'];
                $the_post_author = $_GET['author'];

            }

            $query = "SELECT * FROM posts WHERE post_author = '{$the_post_author}'";
            $query_resault = mysqli_query($connection, $query);


            while ($row = mysqli_fetch_assoc($query_resault)){
                $the_post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];
                ?>



                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo  $the_post_id;?>"><?php echo $post_title?></a>
                </h2>
                <p class="lead">
                    View All post by. <?php echo $post_author;?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on August <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p>
                    <?php echo $post_content;?>
                </p>

                <hr>
            <?php    }?>
            <!-- Blog Comments -->

            <!-- Comments Form -->



            <hr>

            <!-- Posted Comments -->


        </div>

        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php";?>

    </div>
    <!-- /.row -->

    <hr>

    <?php include "includes/footer.php";?>


