<?php
if (isset($_GET['p_id'])){
    $post_id = $_GET['p_id'];
}
$query = "SELECT * FROM posts WHERE post_id = $post_id";
$select_query = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_query)) {
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = date("d-m-y");
    $post_status = $row['post_status'];


    $post_image = $row['post_image'];


    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = 4;




?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Title</label>
        <input type="text" name="post_title" class="form-control" value="<?php echo $post_title;?>">
    </div>
    <div class="form-group">

        <select name="post_category" id="" class="form-control">
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
        <input type="text" name="post_author" class="form-control" value="<?php echo $post_author;?>">
    </div>
    <div class="form-group">
        <img style="width: 120px;" src="../images/<?php echo $post_image;?>" alt="">
        <input type="file" name="post_image">
    </div>
    <div class="form-group">
        <label for="post_tags">Tags</label>
        <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags;?>">
    </div>
    <div class="form-group">
        <textarea name="post_content" class="form-control" cols="30" rows="10"><?php echo $post_content;?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="update_post" value="Send" class="btn btn-block btn-success">
    </div>

</form>






<?php

    if (isset($_POST['update_post'])){
        $post_titles = $_POST['post_title'];
//    $post_category = $_POST['post_category'];
//    $post_author = $_POST['post_author'];
//    $post_image = $_POST['post_image'];
//    $post_tags = $_POST['post_tags'];
//    $post_content = $_POST['post_content'];

        $query = "UPDATE posts SET post_titles = '{$post_title}', post_authors = '{$post_author}',  WHERE post_id = $post_id";
        $update_query = mysqli_query($connection, $query);

        if (!$update_query) {
            die("Query Faild" . mysqli_error($connection));
        }
    }}
echo $post_id;
//if (isset($_POST['update_post'])){
//    $post_title = $_POST['post_title'];
//    $post_category_id = $_POST['post_category'];
//    $post_author = $_POST['post_author'];
//    $post_status = $_POST['post_status'];
//    $post_images = $_FILES['image']['name'];
//    $post_images_temp = $_FILES['image']['tmp_name'];
//    $post_content = $_POST['post_content'];
//    $post_tags = $_POST['post_tags'];
//
//
//    move_uploaded_file($post_images_temp, "../images/$post_image");
//
//    $query = "UPDATE posts SET post_title = '{$post_title}', post_category = '{$post_category_id}', post_author='{$post_author}',
//    post_status='{$post_status}', post_tags= '{$post_tags}', post_content='{$post_content}', post_images = '{$post_images}', WHERE post_id = '{}";
//
////    $query .="post_title = '{$post_title}', ";
////    $query .="post_category = '{$post_category_id}', ";
////    $query .="post_date = now(), ";
////    $query .="post_author = '{$post_author}', ";
////    $query .="post_status = '{$post_status}', ";
////    $query .="post_tags = '{$post_tags}', ";
////    $query .="post_content = '{$post_content}', ";
////    $query .="post_image = '{$post_images}', ";
////    $query .= "WHERE post_id = $post_id}";
//
//    $update_post = mysqli_query($connection, $query);
//
//    if (!$update_post) {
//        die("Query Faild" . mysqli_error($connection));
//    }
//
//}
//?>