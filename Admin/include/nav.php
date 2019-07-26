<!--<div style="height: 10px; background-color: #27aae1;"></div>-->
<nav class="navbar navbar-inverse" role="navigation">
	<div class="container">
		<div class="navbar-header">
		<!--toggle navigation for small screen-->
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
			<span class="sr-only">Toggle Navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
			<a class="navbar-brand" href="blog.php?Page=1">
				Gold Admin
			</a>
		</div>
		<!--Top Header Navigation-->
        <ul class="nav navbar-nav navbar-right top-nav">
             <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-envelope"></span> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong><?php echo "{$_SESSION["Username"]}"; ?></strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-bell"></span> <b class="caret"></b></a>
                     <ul class="dropdown-menu alert-dropdown">
                        
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Welcome, <?php echo "{$_SESSION["Username"]}"; ?><b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-fw fa-user"></i>Profile</a></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Notifications</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../Logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
        </ul>
	</div>
</nav>
<div class="line" style="height: 10px; background-color: #27aae1;"></div>
<!--Start of Container Area-->
<div class="container-fluid">
    <!--Start of Row Area-->
    <div class="row">
        <!--Start of Side Area-->
        
        <div class="col-sm-2">
        <div class="collapse navbar-collapse" id="collapse" >
            <br><br>
            <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"> Dashboard</span></a></li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-list-alt"> Post </span><b class="caret"></b></a>
                    <ul id="demo" class="collapse">
                        <li>
                          <a href="#">Add New Post</a>
                        </li>
                        <li>
                          <a  href="#">All Post</a>
                        </li>
                    </ul>
                </li>
                <li><a href="addnewpost.php"><span class="glyphicon glyphicon-list-alt"> Add New Post</span></a></li>
                <li><a href="categories.php"><span class="glyphicon glyphicon-tags"> Categories</span></a></li>
                <li><a href="admins.php"><span class="glyphicon glyphicon-user"> Manage Admins</span></a></li>
                <li><a href="Comments.php">
                <span class="glyphicon glyphicon-comment"> Comments</span>
                  <?php
                        $DB;
                        $QueryDisapproved= "SELECT COUNT(*) FROM comments 
                        WHERE status='OFF'";
                        $ExecuteDisapproved = mysqli_query($DB, $QueryDisapproved);
                        $RowsDisapproved = mysqli_fetch_array($ExecuteDisapproved);
                        $TotalDisapproved = array_shift($RowsDisapproved);
                        if ($TotalDisapproved>0) {
                        ?>
                        <span class="label label-warning pull-right"><?php echo $TotalDisapproved; ?></span>
                        <?php } ?>
                </a></li>

                <li><a href="../blog.php?Page=1" target="_blank"><span class="glyphicon glyphicon-equalizer"> Live Blog</span></a></li>
            </ul>
        </div>
        </div>
        <!--End of Side Area-->