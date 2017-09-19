<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
        <div class="input-group">
            <input type="text" name="search" class="form-control">
            <span class="input-group-btn">
                <button class="btn btn-default" name="submit" type="submit">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
             </span>
        </div>
        </form><!--Search Form-->
        <!-- /.input-group -->
    </div>
    <div class="well">
        <h4>Blog Search</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" name="password" class="form-control" placeholder="Password">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" name="login" type="submit">Submit</button>
            </div>
        </form><!--Search Form-->
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->

    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM categories LIMIT 2";
                    $select_categories_sidebar = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_categories_sidebar)){
                        $cat_title =  $row['cat_title'];
                        $cat_id =  $row['cat_id'];

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
                    ?>
                </ul>
            </div>
            <!-- /.col-lg-6 -->

        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>