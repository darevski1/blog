<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
$select_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_query)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_status = $row['post_status'];
    $post_comment_count = 4;
    $post_date = $row['post_date'];


    if (isset($_POST['update_post'])) {

        $post_author = $_POST['post_author'];
        $post_title = $_POST['post_title'];
        $post_category_id = $_POST['post_category_id'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_content = $_POST['post_content'];
        $post_tags = $_POST['post_tags'];
        $post_status = $_POST['post_status'];

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if (empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
            $select_image = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_image)) {
                $post_image = $row['post_image'];
            }
        }

            $query = "UPDATE posts SET ";
            $query .= "post_title = '{$post_title}', ";
            $query .= "post_category_id = '{$post_category_id}', ";
            $query .= "post_date = now(), ";
            $query .= "post_author = '{$post_author}', ";
            $query .= "post_status = '{$post_status}', ";
            $query .= "post_tags = '{$post_tags}', ";
            $query .= "post_content = '{$post_content}', ";
            $query .= "post_image = '{$post_image}' ";
            $query .= "WHERE post_id = {$the_post_id}";

            $update_post = mysqli_query($connection, $query);

            if ($update_post) {
                echo "<div class=\"alert alert-success\">
                      <strong>Success! </strong>Post updated!!! View post.<a href='../post.php?p_id={$post_id}' target='_blank'>View Post</a> or <a href='posts.php'>View More Posts</a></a>
                    </div>";
            }else{
                die("Errrorrr   " . mysqli_error($connection));
            }
        }
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
    </div>
    <div class="form-group">
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
        <label for="post_author">Author</label>
        <input type="text" name="post_author" class="form-control" value="<?php echo $post_author; ?>">
    </div>
    <div class="form-group">
        <img style="width: 120px;" src="../images/<?php echo $post_image; ?>" alt="">
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
    </div>
    <div class="form-group">
         <select class="form-control" name="post_status">
             <option value="<?php echo $post_status;?>"><?php echo $post_status;?></option>
             <?php
                if ($post_status == 'published') {
                    echo "<option value='draft'>Draft</option>";
                }else{
                    echo "<option value='published'>Published</option>";
                }
             ?>
         </select>
    </div>
    <div class="form-group">
        <textarea name="post_content" class="form-control" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="update_post" value="Send" class="btn btn-block btn-success">
    </div>
</form>



