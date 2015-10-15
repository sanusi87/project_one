<!DOCTYPE html>
<html>
	<head>
		<title><?php echo APPNAME; ?></title>
		<link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		<link href="/assets/css/style.css" rel="stylesheet" />
		<?php View::stylesheets(); ?>
	</head>
	<body>
		<div class="container" id="main-content">
			<?php View::content(); ?>
		</div>
		
		<footer class="text-center" id="footer">
			<hr />
			<small class="text-muted">Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</small>
		</footer>
		
		<script type="text/javascript" src="/assets/js/jquery-1.10.1.min.js"></script>
		<script type="text/javascript" src="/assets/bootstrap/js/bootstrap.min.js"></script>
		<?php View::javascripts(); ?>
	</body>
</html>