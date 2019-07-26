<div style="height: 10px; background-color: #27aae1;"></div>
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
				Gold
			</a>
		</div>
		<div class="collapse navbar-collapse" id="collapse" >
		<ul class="nav navbar navbar-nav">
			<li><a href="index.php?Page=1">Home</a></li>
			<li class="active"><a href="blog.php?Page=1">Blog</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Feature</a></li>
		</ul>
		<form action="blog.php" class="navbar-form navbar-right">
			<div class="form-group">
				<input class="form-control" type="text" placeholder="Search" name="Search">
			</div>
			<button class="btn btn-default" name="Searchbutton">Go</button>
		</form>
		</div>
	</div>
</nav>
