<?php
if (isset($_POST['change_comments'])){
    $selectOption = $_POST['bulk_options'];

   switch ($selectOption){
       case 'approved':
           echo 'approved';
           break;
       case 'unapproved':
            echo 'unapproved';
           break;
       default:
           echo "Error";
           break;
   }
}
?>
<form action="" method="post">
    <div class="form-group">
        <select id="" class="form-control" name="bulk_options">
            <option value="approved">Approved</option>
            <option value="unapproved">Unapproved</option>
        </select>
        <div class="form-group">
            <input type="submit" name="change_comments" value="Show" class="btn-success btn">

        </div>
    </div>



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
        <th>Status</th>
        <th>Delete</th>

    </tr>
    </thead>
    <tbody>
    <?php
    $query = "SELECT * from comments";
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
        echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete={}'>Status</a></td>";
        echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
        echo "</tr>";

        if (isset($_GET['approve'])){
            $comment_id= $_GET['approve'];
            $query = "UPDATE comments SET comment_status ='approved' WHERE comment_id = $comment_id";
            $approve_query = mysqli_query($connection, $query);
            header('Location: comments.php');

        }
        if (isset($_GET['unapprove'])){
            $comment_id= $_GET['unapprove'];
            $query = "UPDATE comments SET comment_status ='unapproved' WHERE comment_id = $comment_id";
            $unapprove_query = mysqli_query($connection, $query);
            header('Location: comments.php');

        }
        if (isset($_GET['delete'])){
            $comment_id = $_GET['delete'];
            $query = "DELETE FROM comments WHERE comment_id = $comment_id";
            $delete_query_comment = mysqli_query($connection, $query);

            header('Location: comments.php');
        }

    }
    ?>
    </tbody>
</table>
</form>
