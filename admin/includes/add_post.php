<?php
    if (isset($_POST['create_post'])){

        $post_category_id = $_POST['post_category_id'];
        $post_title = $_POST['post_title'];
        $post_user = $_POST['post_user'];
        $post_date = date("d-m-y");
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
//        $post_comment_count = 0;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status)";
        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

        $insert_query=mysqli_query($connection, $query);

        $the_post_id = mysqli_insert_id($connection);

        if($insert_query){
            echo "<div class=\"alert alert-success\">
                      <strong>Success! </strong>New post created!!!!! View the <a href='../post.php?p_id=$the_post_id'>The Post</a> or <a href='posts.php'>View More Posts</a></a>
                    </div>";
        }else{
            die("Erorrr" . mysqli_error($connection));
        }
    }


?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="post_category_id" id="" class="form-control">
            <?php
            $query = "SELECT * from categories ";
            $select_query = mysqli_query($connection, $query);

            confirm($select_query);

            while ($row = mysqli_fetch_assoc($select_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="Users">Users</label>
        <select name="post_user" id="" class="form-control">
            <?php
            $users_query = "SELECT * from users ";
            $select_users = mysqli_query($connection, $users_query);

            confirm($select_users);

            while ($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];
                echo "<option value='{$username}'>{$username}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_author">Tags</label>
        <input type="text" name="post_tags" class="form-control">
    </div>
    <div class="form-group">
        <label for="Status">Status</label>
        <select name="post_status" id=""  class="form-control">
            <option value="draft">Select Option</option>
            <option value="published">published</option>
            <option value="draft">draft</option>

        </select>
    </div>
    <div class="form-group">
        <textarea name="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="create_post" value="Send" class="btn btn-block btn-success">
    </div>

</form>