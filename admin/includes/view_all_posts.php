<?php
include ("includes/delete_modal.php");
if (isset($_POST['checkBoxArray'])&& !empty($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $postvalueId) {

        $bulk_options = $_POST['bulk_options'];
        switch ($bulk_options) {

            case 'published':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE  post_id = {$postvalueId}";
                $update_published_status = mysqli_query($connection, $query);

                if (!$update_published_status){
                    die("Eroro" . mysqli_error());
                }
                break;
            case 'draft':
                $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE  post_id = {$postvalueId}";
                $draft_published_status = mysqli_query($connection, $query);

                if (!$draft_published_status){
                    die("Eroro" . mysqli_error());
                }
                break;
            case 'delete':
                $query = "DELETE FROM posts  WHERE  post_id = {$postvalueId}";
                $delete_query = mysqli_query($connection, $query);

                if (!$delete_query){
                    die("Eroro" . mysqli_error());
                }
                break;
            case 'clone':
                $query = "SELECT * FROM posts WHERE post_id = {$postvalueId}";
                $select_query_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($select_query_posts)){
                    $post_id = $row['post_id'];
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];
                    $post_comment_count = $row['post_comment_count'];

                }
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status)";
                $query .= "VALUES('{$post_category_id}', '{$post_title}', '{$post_author}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
                $insert_query=mysqli_query($connection, $query);
                $the_post_id = mysqli_insert_id($connection);
                break;
            default:
                echo "Error";
                break;
        }
        }

}
?>
<form action="" method="post">
<table class="table table-bordered">
   <div id="bulkOptionContainer" class="col-md-4">
       <select class="form-control" name="bulk_options" id="">
           <option value="">Select Option</option>
           <option value="published">Publish</option>
           <option value="draft">Draft</option>
           <option value="clone">Clone</option>
           <option value="delete">Delete</option>

       </select>
   </div>

    <div class="col-md-4">
    <input type="submit" name="submit" value="Apply" class="btn btn-success">
    <a href="posts.php?source=add_post" class="btn btn-primary">Add New Post</a>
</div>
    <thead>
    <tr>
        <th><input type="checkbox" id="selectAllBoxes"></th>
        <th>Id</th>
        <th>Category</th>
        <th>Title</th>
        <th>User</th>
        <th>Date</th>
        <th>Image</th>
        <th>Content</th>
        <th>Tags</th>
        <th>Status</th>
        <th>Comment</th>
        <th>Views</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
//    $query = "SELECT * from posts";
    $query = "SELECT posts.post_id, posts.post_category_id, posts.post_title, posts.post_author, posts.post_user, posts.post_date, posts.post_image, posts.post_content,";
    $query .="posts.post_tags, posts.post_status, posts.post_comment_count, posts.post_view_count, categories.cat_id, categories.cat_title";
    $query .= " FROM posts ";
    $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER by posts.post_id";

    $select_posts = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row['post_id'];
        $post_category_id = $row['post_category_id'];
        $post_title = $row['post_title'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
        $post_comment_count = $row['post_comment_count'];
        $post_view_count = $row['post_view_count'];
        $category_id = $row['cat_id'];
        $category_title = $row['cat_title'];

        echo "<tr>";
        ?>
        <td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value='<?php echo $post_id; ?>'></td>
        <?php
        echo "<td>$post_id</td>";

//        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id }";
//        $select_categories_id = mysqli_query($connection, $query);
//        while ($row = mysqli_fetch_assoc($select_categories_id)) {
//
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
//        }
        echo "<td>$category_title</td>";
        echo "<td><a href='../post.php?p_id=$post_id' target='_blank'>$post_title</a></td>";
        if (isset($post_author) && !empty($post_author)){
            echo "<td>$post_author</td>";
        }elseif( isset($post_user) && !empty($post_user)){
            echo "<td>$post_user</td>";
        }
        echo "<td>$post_date</td>";
        echo "<td><img src='../images/$post_image' alt='' style='width: 40px; height: 40px;'></td>";
        echo "<td>" . substr($post_content, 0, 10) ."..." ."</td>";
        echo "<td>$post_tags</td>";
        echo "<td>$post_status</td>";

        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_count = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($send_comment_count);
        $comment_id= $row['comment_id'];
        $count_comments = mysqli_num_rows($send_comment_count);

        echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a> </td>";
        echo "<td>$post_view_count</td>";
        echo "<td><a href='../post.php?p_id={$post_id}' target='_blank'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a rel='$post_id' href='javascript:void(0)' class='delete_link'>Delete</a></td>";

//        echo "<td><a onclick=\"return confirm('Are you sure you want to delete this item?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
         }?>
    </tbody>
</table>
<?php
    if (isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $delete_query = mysqli_query($connection, $query);
        header('Location: posts.php');
        if ($delete_query){
            echo "Succes";
        }
    }
?>
</form>



<script>
    $(document).ready(function(){
       $(".delete_link").on('click', function(){
          var id = $(this).attr("rel");
          var delete_url = "posts.php?delete=" + id + "";

          $(".modal_delete_link").attr("href", delete_url);
          $("#myModal").modal('show');

       });
    });
</script>