<?php
ob_start();
$faculties = Faculty::all();
$programmes = Programme::all();
$races = Student::races();
?>
	
	<div class="text-center">
		<div id="main-banner">
			<br />
			<br />
			<br />
			<h1><?php echo APPNAME; ?></h1>
		</div>
		
		<br />
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="#">UTAMA</a></li>
						<li><a href="#">TENTANG KAMI</a></li>
						<li><a href="#">PANDUAN</a></li>
						<li><a href="#">HUBUNGI KAMI</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<br />
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-12">
			<h2>Welcome to <?php echo APPNAME; ?></h2>
			<!-- slider -->
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/toystory.jpg" alt="" title="#htmlcaption1" />
					</a>
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/nemo.jpg" alt="" title="#htmlcaption2" />
					</a>
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/walle.jpg" alt="" title="#htmlcaption3" />
					</a>
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/up.jpg" alt="" title="#htmlcaption4" />
					</a>
				</div>
				
				<div id="html-caption-group">
					<div id="htmlcaption1" class="nivo-html-caption">
						<strong>This</strong> is an example of a <em>HTML</em> caption 1 with <a href="#">a link</a>. 
					</div>
					<div id="htmlcaption1" class="nivo-html-caption">
						<strong>This</strong> is an example of a <em>HTML</em> caption 2 with <a href="#">a link</a>. 
					</div>
					<div id="htmlcaption1" class="nivo-html-caption">
						<strong>This</strong> is an example of a <em>HTML</em> caption 3 with <a href="#">a link</a>. 
					</div>
					<div id="htmlcaption1" class="nivo-html-caption">
						<strong>This</strong> is an example of a <em>HTML</em> caption 4 with <a href="#">a link</a>. 
					</div>
				</div>
			</div>
			<!-- slider -->
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12">
			<!-- login form -->
			<h4>Student Login:</h4>
			<form action="index.php?module=student&action=login" class="form-vertical" method="post">
				<div class="form-group">
					<label for="username">Matric No.</label>
					<input type="text" class="form-control" name="username" />
				</div>
				
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" />
				</div>
				
				<button class="btn btn-md btn-primary">
					<i class="fa fa-sign-in"></i> Login
				</button>
			</form>
			<br />
			<a href="#administrator-login" class="btn btn-link" data-toggle="modal"><i class="fa fa-key"></i> Administrator Login</a>
			<!-- login form -->
		</div>
	</div>
	
	<?php /* ?>
	<div class="modal" id="student-login">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Student</h4>
				</div>
				<div class="modal-body">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane" id="login"></div>
						<div role="tabpanel" class="tab-pane active" id="register">
							<form action="index.php?module=student&action=register" class="form-horizontal" method="post">
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="studentname">Name</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="text" class="form-control" name="studentname" id="studentname" placeholder="Name" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="username">Matric No.</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="text" class="form-control" name="username" id="username" placeholder="Matric No." />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="password">Password</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="password" class="form-control" name="password" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="programme">Programme</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="programme" id="programme" class="form-control">
											<?php
											foreach( $programmes as $programme ){
												echo "<option value=\"$programme[id]\">$programme[long_name]</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="username">Gender</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-sm-6">
												<label for="gender_m">
													<input type="radio" name="gender" value="<?php echo Student::MALE; ?>" id="gender_m" /> Male
												</label>
											</div>
											<div class="col-md-6 col-sm-6 col-sm-6">
												<label for="gender_f">
													<input type="radio" name="gender" value="<?php echo Student::FEMALE; ?>" id="gender_f" /> Female
												</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="dob">Date of Birth</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="date" class="form-control" name="dob" id="dob" readonly="readonly" placeholder="dd-mm-yyyy" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="race">Race</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="race" id="race" class="form-control">
											<?php
											foreach( $races as $id => $race ){
												echo "<option value=\"$id\">$race</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<button class="btn btn-md btn-primary">
									<i class="fa fa-sign-in"></i> Register
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php */ ?>

	<div class="modal" id="administrator-login">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Administrator Login</h4>
				</div>
				<div class="modal-body">
					<form action="index.php?module=admin&action=login" class="form-horizontal" method="post">
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label for="username">Username</label>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" name="username" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label for="password">Password</label>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="password" class="form-control" name="password" />
							</div>
						</div>
						
						<button class="btn btn-md btn-primary">
							<i class="fa fa-sign-in"></i> Login
						</button>
					</form>
				</div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>

<?php
$content = ob_get_clean();
View::addContent( $content );

View::addStylesheet('
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker-1.4.0/css/bootstrap-datepicker3.standalone.min.css" />
<link rel="stylesheet" href="/assets/plugins/nivo-slider/themes/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/assets/plugins/nivo-slider/nivo-slider.css" />
');
View::addJavascript('
<script type="text/javascript" src="/assets/plugins/bootstrap-datepicker-1.4.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/assets/plugins/nivo-slider/jquery.nivo.slider.pack.js"></script>
');

$js = <<<JS
<script type="text/javascript">
jQuery(function($){
	// start date of birth datepicker
	$('#dob').datepicker({
		format: 'dd-mm-yyyy',
	});
	
	// start slider
	$('#slider').nivoSlider({
		affect: 'boxRainGrow',
		slices: 15,
		boxCols: 8,
		boxRows: 4,
		animSpeed: 500,
		pauseTime: 3000
	});
JS;

if( isset( $_SESSION['error'] ) ){
	View::addStylesheet('<link rel="stylesheet" href="/assets/plugins/bootstrap-toastr/toastr.min.css" />');
	
	View::addJavascript('<script type="text/javascript" src="/assets/plugins/bootstrap-toastr/toastr.min.js"></script>');

	$js .= <<<JS
		toastr.error('$_SESSION[error]', 'Error Notification');
JS;
	unset( $_SESSION['error'] );
}

$js .= <<<JS
});
</script>
JS;
View::addJavascript($js);
?>