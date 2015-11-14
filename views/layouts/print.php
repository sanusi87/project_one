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
    <h3 align="center">Sistem Pendaftaran Latihan Mengajar</h3>
		<div class="container" id="main-content">
			<?php View::content(); ?>
		</div>
		
		<footer class="text-center" id="footer">
			<hr />
			<small class="text-muted">Copyright &copy; <?php echo date('Y'); ?>. All Rights Reserved.</small>
		</footer>
	</body>
</html>