<div class="col-sm-2">
			<br><br>
			<ul id="Side_Menu" class="nav nav-pills nav-stacked">
				<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-th"> Dashboard</span></a></li>
				<li>
					<a href="javascript:;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-list-alt"> Post </span><b class="caret"></b></a>
					<ul id="demo" class="collapse">
						<li><a href="addnewpost.php">Add New Post</a></li>
						<li><a  href="dashboard.php">All Post</a></li>
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
				<li><a href="../Logout.php"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>
			</ul>
		</div>