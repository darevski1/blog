<?php include "includes/db.php";?>
<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/navigation.php";?>
    <!-- Page Content -->
    <!-- Page Content -->
    <div class="container">

    <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">


        <?php
        $per_page = 4;

        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else{
            $page = "";
        }
        if ($page == "" || $page == 1) {
            $page_1 = 0;
        }else{
            $page_1 = ($page * $per_page) - $per_page;
        }
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] = 'admin'){
            $post_query_count = "SELECT * FROM posts";
        }else{
            $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
        }

        $find_count = mysqli_query($connection, $post_query_count);

        $count  = mysqli_num_rows($find_count);
            if ($count < 1){
                echo "<h1 class='text-center'>No posts available</h1>";
            }else{
        $count = ceil($count / $per_page);


        $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
        $select_all_posts_query = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_all_posts_query)) {
            $post_id = $row['post_id'];
            $post_title = $row["post_title"];
            $post_author = $row["post_user"];
            $post_date = $row["post_date"];
            $post_image = $row["post_image"];
            $post_content = substr($row["post_content"],0,100);
            $post_status = $row["post_status"];

                ?>

                <!-- HTML/PHP for displaying POSTS -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author;?>&p_id=<?php echo $post_id;?>"><?php echo $post_author;?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $post_date ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content ?>...</p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                <hr>
            <?php }}?>
        <!--pagination-->
        <ul class="pager">
                <?php
                for ($i = 1; $i <= $count; $i++){
                    if($i ==$page){
                        echo "<li><a class='active_link'href='index.php?page={$i}'>$i</a></li>";
                    }else{
                        echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                    }
                }
                ?>
        </ul>
    </div>
<?php include "includes/sidebar.php";?>


<?php include "includes/footer.php";?>




        <div class="row">
            <div class="col-md-9 col-sm-8">
                <div class="content-area">
                    <h2 class="medium-title">Job Information</h2>
                    <div class="box">
                        <div class="text-left">
                            <h3><a href="#">Web Developer</a></h3>
                            <p>LemonKids LLC <em>(View All Jobs)</em></p>
                            <div class="meta">
                                <span><a href="#"><i class="ti-location-pin"></i> Nationwide</a></span>
                                <span><a href="#"><i class="ti-calendar"></i> Dec 30, 2017 - Feb 20, 2018</a></span>
                            </div>
                            <strong class="price"><i class="fa fa-money"></i>$7000 - $7500</strong>
                            <a href="#" class="btn btn-border btn-sm">Freelance</a>
                            <a href="#" class="btn btn-common btn-sm">Apply For This Job</a>
                        </div>
                        <div class="clearfix">
                            <h4>Overview</h4>
                            <p>LemonKids LLC. In marketing communications, we dream it and create it. All of the company’s promotional and communication needs are completed in-house by these “creatives” in an advertising agency-based set-up. This includes everything from advertising, promotions and print production to media relations, exhibition coordination and website maintenance. Everyone from artists, writers, designers, media buyers, event coordinators, video producers/editors and public relations specialists work together to bring campaigns and product-centric promotions to life.</p>
                            <p>If you’re a dreamer, gather up your portfolio and show us your vision. Garmin is adding one more enthusiastic individual to our in-house Communications expert team.</p>
                            <h4>Qualification</h4>
                            <p>Minimum of 5 years creative experience in a graphic design studio or advertising ad agency environment is required. Qualified candidates for this role will possess the following education, experience and skills:</p>
                            <ul>
                                <li><i class="ti-check-box"></i>Demonstrated strong and effective verbal, written, and interpersonal communication skills</li>
                                <li><i class="ti-check-box"></i>Must be team-oriented, possess a positive attitude and work well with others</li>
                                <li><i class="ti-check-box"></i>Ability to prioritize and multi-task in a flexible, fast paced and challenging environment</li>
                            </ul>
                            <h4>Key responsibilities also include</h4>
                            <ul>
                                <li><i class="ti-check-box"></i>Provide technical health advice to Head of Country Programmes and field advisors at all key stages of the project management cycle including needs assessment.</li>
                                <li><i class="ti-check-box"></i>Technical strategy and design, implementation as well as sector specific monitoring and evaluation.</li>
                                <li><i class="ti-check-box"></i>This includes travel to field programmes as well as review of proposals, key reports and surveys prior to external submission.</li>
                                <li><i class="ti-check-box"></i>Stay abreast of current best practice. Research and stay informed on academic and technical health and nutrition issues, techniques, and guidelines to inform and improve programming.</li>
                            </ul>
                            <h4>Requirements</h4>
                            <ul>
                                <li><i class="ti-check-box"></i>Must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.</li>
                                <li><i class="ti-check-box"></i>Must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.
                                    Strongly prefer candidates with High School Diploma</li>
                                <li><i class="ti-check-box"></i>Must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.</li>
                            </ul>
                            <h4>Benefits</h4>
                            <ul>
                                <li><i class="ti-check-box"></i>Must have minimum of 3 years experience running, maneuvering, driving, and navigating equipment such as bulldozer, excavators, rollers, and front-end loaders.</li>
                                <li><i class="ti-check-box"></i>Strongly prefer candidates with High School Diploma</li>
                                <li><i class="ti-check-box"></i>Must be able to perform physical activities that require considerable use of your arms and legs and moving your whole body, such as climbing, lifting, balancing, walking, stooping, and handling of materials.</li>
                            </ul>
                            <a href="#" class="btn btn-common">Apply for this Job Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <aside>
                    <div class="sidebar">
                        <h2 class="medium-title">Company Details</h2>
                        <div class="box">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/jobs/recent-job-detail.jpg" alt="img"></a>
                            </div>
                            <div class="text-box">
                                <h4><a href="#">LemonKids LLC</a></h4>
                                <p>LemonKids LLC. In marketing communications, we dream it and create it. All of the company’s promotional and communication needs are completed in-house.
                                </p>
                                <strong>Industry</strong>
                                <p>Insurance</p>
                                <strong>Type of Business Entity</strong>
                                <p>Sole Proprietorship</p>
                                <strong>Established In</strong>
                                <p>01 January, 2000</p>
                                <strong>No. of Employees</strong>
                                <p>105</p>
                                <strong>Location</strong>
                                <p>New York, NY </p>
                            </div>
                        </div>
                        <h2 class="medium-title">Featured Jobs</h2>
                        <div class="box">
                            <div class="thumb">
                                <a href="#"><img src="assets/img/jobs/features-img-1.jpg" alt="img"></a>
                            </div>
                            <div class="text-box">
                                <h4><a href="#">Web Development</a></h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. maiores aperiam quam perspiciatis.</p>
                                <a href="#" class="text"><i class="fa fa-map-marker"></i>Moorgate, London</a>
                                <a href="#" class="text"><i class="fa fa-calendar"></i>Dec 22, 2017 - Mar 17, 2018 </a>
                                <strong class="price"><i class="fa fa-money"></i>$4000 - $5000</strong>
                                <a href="#" class="btn btn-common btn-sm">Apply for this Job</a>
                            </div>
                        </div>
                        <h2 class="medium-title">Jobs Gallery</h2>
                        <div class="sidebar-jobs box">
                            <ul>
                                <li>
                                    <a href="#">General Compliance Officer</a>
                                    <span><i class="fa fa-map-marker"></i>Arlington, VA </span>
                                    <span><i class="fa fa-calendar"></i>Dec 22, 2017 - Mar 17, 2018 </span>
                                </li>
                                <li>
                                    <a href="#">Medical Transcrption</a>
                                    <span><i class="fa fa-map-marker"></i>San Francisco, CA</span>
                                    <span><i class="fa fa-calendar"></i>Dec 22, 2017 - Mar 17, 2018 </span>
                                </li>
                                <li>
                                    <a href="#">Support Coordinator</a>
                                    <span><i class="fa fa-map-marker"></i>Moorgate, London</span>
                                    <span><i class="fa fa-calendar"></i>Dec 22, 2017 - Mar 17, 2018 </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
