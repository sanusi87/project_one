<?php
ob_start();
$faculties = Faculty::all();
$programmes = Programme::all();
$races = Student::races();
?>
	
	<div class="text-center">
		<h1><?php echo APPNAME; ?></h1>
		<hr />
	</div>
	
	<div class="row">
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="text-center">
				<a href="#student-login" data-toggle="modal">
					<span style="font-size:32px"><i class="fa fa-user"></i></span>
					<h2>Student</h2>
				</a>
			</div>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="text-center">
				<a href="#administrator-login" data-toggle="modal">
					<span style="font-size:32px"><i class="fa fa-key"></i></span>
					<h2>Administrator</h2>
				</a>	
			</div>
		</div>
	</div>

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
						<li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
						<li role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="login">
							<form action="index.php?module=student&action=login" class="form-horizontal" method="post">
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="username">Matric No.</label>
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
						
						<div role="tabpanel" class="tab-pane" id="register">
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
								
								<?php /* ?>
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="faculty">Faculty</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="faculty" id="faculty" class="form-control">
											<?php
											foreach( $faculties as $faculty ){
												echo "<option value=\"$faculty[id]\">$faculty[long_name]</option>";
											}
											?>
										</select>
									</div>
								</div><?php */ ?>
								
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

View::addStylesheet('<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker-1.4.0/css/bootstrap-datepicker3.standalone.min.css" />');
View::addJavascript('<script type="text/javascript" src="/assets/plugins/bootstrap-datepicker-1.4.0/js/bootstrap-datepicker.min.js"></script>');

$js = <<<JS
<script type="text/javascript">
jQuery(function($){
	$('#dob').datepicker({
		format: 'dd-mm-yyyy',
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