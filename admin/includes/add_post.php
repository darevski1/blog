<?php
    if (isset($_POST['create_post'])){

        $post_category_id = $_POST['post_category_id'];
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_date = date("d-m-y");
        $post_status = $_POST['post_status'];


        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];


        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_comment_count = 4;

        move_uploaded_file($post_image_temp, "../images/$post_image");

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status)";
        $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}','{$post_status}')";

        $insert_query=mysqli_query($connection, $query);

//        Calling function
        confirm($insert_query);
    }


?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" name="post_title" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_category_id">Category Id</label>
        <input type="text" name="post_category_id" class="form-control">
    </div>
    <div class="form-group">
        <label for="post_author">Author</label>
        <input type="text" name="post_author" class="form-control">
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
        <textarea name="post_content" class="form-control" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="create_post" value="Send" class="btn btn-block btn-success">
    </div>

</form>