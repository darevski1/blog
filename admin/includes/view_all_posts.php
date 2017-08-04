<table class="table">
    <thead>
    <tr>
        <th>post_id</th>
        <th>post_category_id</th>
        <th>post_title</th>
        <th>post_author</th>
        <th>post_date</th>
        <th>post_image</th>
        <th>post_content</th>
        <th>post_tags</th>
        <th>post_comment_count</th>
        <th>Delete</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * from posts";
    $select_posts = mysqli_query($connection, $query);


    while($row = mysqli_fetch_assoc($select_posts)){
    $post_id = $row['post_id'];
    $post_category_id = $row['post_category_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_date = $row['post_date'];
    $post_image = $row['post_image'];
    $post_content = $row['post_content'];
    $post_tags = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];

    ?>
    <tr>
        <td><?php echo $row['post_id'];?></td>
        <td><?php echo $row['post_category_id'];?></td>
        <td><?php echo $row['post_title'];?></td>
        <td><?php echo $row['post_author'];?></td>
        <td><?php echo $row['post_date'];?></td>
        <td><img class="placeholder" src="../images/<?php echo $row['post_image'];?>" alt="" style="width: 100px; height: "></td>
        <td><?php echo $row['post_content'];?></td>
        <td><?php echo $row['post_tags'];?></td>
        <td><?php echo $row['post_comment_count'];?></td>
        <td><a href='posts.php?delete=<?php echo $post_id; ?>'>Delete</a></td>
        <td><a href='posts.php?source=edit_post&p_id=<?php echo $post_id; ?>'>Edit</a></td>





        <?php   }?>
    </tr>
    </tbody>
</table>
<?php
    if (isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$post_id}";
        $delete_query = mysqli_query($connection, $query);

    }

?>