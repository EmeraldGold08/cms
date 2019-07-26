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
        <!--<div class="collapse navbar-collapse" id="collapse" >-->
        <ul class="nav navbar-nav navbar-right">
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
                                            <strong>John Smith</strong>
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
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
        </ul>
       <!-- </div> -->
	</div>
</nav>
<div class="line" style="height: 10px; background-color: #27aae1;"></div>