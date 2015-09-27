<!DOCTYPE html>
<html>
	<head>
		<title>Project One</title>
		<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/assets/css/style.css" rel="stylesheet" />
		<?php View::stylesheets(); ?>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">xxx System</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index.php?module=student">All Applications</a></li>
						<li><a href="index.php?module=student&action=new-application">Submit Application</a></li>
						<li><a href="index.php?module=logout">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container" id="main-content">
			<?php View::content(); ?>
		</div>
		
		<footer class="text-center" id="footer">
			<hr />
			<small class="text-muted">xxx Application System</small>
		</footer>
		
		<script type="text/javascript" src="/assets/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<?php View::javascripts(); ?>
	</body>
</html>