<?php include "includes/db.php"; ?>
    <?php include "includes/header.php"; ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if (isset($_GET['p_id'])) {
                    $the_post_id = $_GET['p_id'];

                    $view_query = "UPDATE posts SET post_view_count = post_view_count + 1 WHERE post_id = $the_post_id";
                    $send_query = mysqli_query($connection, $view_query);
                    if (!$send_query){
                        die("query feild");
                    }
                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                    }else{
                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";
                    }
                    $query_resault = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_resault) < 1){
                        echo "<h1 class='text-center'>No posts!!!</h1>";
                    }else{
                    while ($row = mysqli_fetch_assoc($query_resault)) {
                        $the_post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_comment_count = $row['post_comment_count'];
                        $post_status = $row['post_status'];
                        ?>
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by
                            <a href="author_post.php?author=<?php echo $post_author; ?>&p_id=<?php echo $the_post_id; ?>"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on August <?php echo $the_post_id; ?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                        <hr>
                        <p>
                            <?php echo $post_content; ?>
                        </p>
                        <hr>
                    <?php } ?>
                    <!-- Blog Comments -->
                    <!-- Comments Form -->
                    <?php
                    if (isset($_POST['create_comment'])) {

                        $the_post_id = $_GET['p_id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if (!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                            $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                            $query .= "VALUES('{$the_post_id}', '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";
                            $insert_query = mysqli_query($connection, $query);

                            if (!$insert_query) {
                                die("Errorr" . mysqli_error($connection));
                            }

                            $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                            $query .= "WHERE post_id = $the_post_id";
                            $update_comments_count = mysqli_query($connection, $query);

                        } else {

                            echo "<div class=\"alert alert-danger\">
                      <strong>Info! </strong>All fields are required!!!
                    </div>";
                        }
                    }
                    ?>
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" class="form-control" name="comment_author">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="comment_email">
                            </div>
                            <div class="form-group">
                                <label for="comment">Your Comment</label>
                                <textarea class="form-control" rows="3" name="comment_content"></textarea>
                            </div>
                            <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                    <hr>
                    <!-- Posted Comments -->
                    <?php
                    $query = "SELECT * FROM comments WHERE comment_post_id = '{$the_post_id}'";
                    $query .= "AND comment_status = 'approved'";
                    $query .= "ORDER BY comment_id DESC";
                    $query_comments = mysqli_query($connection, $query);
                    if (!$query_comments) {
                        die("Errrrror" . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($query_comments)) {
                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
                        ?>
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>
                    <?php }}} else {
                    header("Location: index.html");
                } ?>
            </div>
            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>
        </div>
        <!-- /.row -->
        <hr>
        <?php include "includes/footer.php"; ?>


