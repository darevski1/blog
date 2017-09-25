<ul class="nav navbar-right top-nav">
    <li><a href="">Users online:<span class="usersonline"></span></a></li>
    <li><a href="../index.php" target="_blank">Home Site</a></li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>

            <?php
            if (isset($_SESSION['username'])){
                //$username = $_GET['username'];
                echo $_SESSION['username'];
            }

    ?>

            <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li>
                <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
        </ul>
    </li>
</ul>
