<?php
ob_start();
$faculties = Faculty::all();
$programmes = Programme::all();
$bangsa = Student::bangsa();
?>
	
	<div class="text-center">
		<div id="main-banner">
			<img src="/assets/plugins/nivo-slider/demo/images/banner.jpg" alt="" class="img-responsive" />
		</div>
		<?php echo Component::menuBar(); ?>
	</div>
	<div class="row">
		<div class="col-md-9 col-sm-9 col-xs-12">
			<!--<h2>Selamat Datang ke <?php echo APPNAME; ?></h2>-->
			<!-- slider -->
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/m1.jpg" alt="" class="img-responsive" title="#htmlcaption1" />
					</a>
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/m2.jpg" alt="" class="img-responsive" title="#htmlcaption2" />
					</a>
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/m3.jpg" alt="" class="img-responsive" title="#htmlcaption3" />
					</a>
					<a href="#">
						<img src="/assets/plugins/nivo-slider/demo/images/m4.jpg" alt="" class="img-responsive" title="#htmlcaption4" />
					</a>
				</div>
				
				<!--<div id="html-caption-group">
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
				</div>-->
			</div>
			<!-- slider -->
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12">
			<!-- login form -->
			<h4>Log Masuk Pelajar:</h4>
			<form action="index.php?module=student&action=login" class="form-vertical" method="post">
				<div class="form-group">
					<label for="kata_nama">No. Matrik</label>
					<input type="text" class="form-control" name="kata_nama" />
				</div>
				
				<div class="form-group">
					<label for="kata_laluan">Kata Laluan</label>
					<input type="password" class="form-control" name="kata_laluan" />
				</div>
				
				<button class="btn btn-md btn-primary">
					<i class="fa fa-sign-in"></i> Login
				</button>
			</form>
			<br />
            <a href="#student-register" class="btn btn-link" data-toggle="modal"><i class="fa fa-key"></i> Pendaftaran Pelajar</a>
			<a href="#administrator-login" class="btn btn-link" data-toggle="modal"><i class="fa fa-key"></i> Log Masuk Pentadbir</a>
            
			<!-- login form -->
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
					<h4 class="modal-title">Log Masuk Pentadbir</h4>
				</div>
				<div class="modal-body">
					<form action="index.php?module=admin&action=login" class="form-horizontal" method="post">
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label for="username">Kata Nama</label>
							</div>
							<div class="col-md-9 col-sm-9 col-xs-12">
								<input type="text" class="form-control" name="username" />
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12">
								<label for="password">Kata Laluan</label>
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
    
    <div class="modal" id="student-register">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span>
						<span class="sr-only">Close</span>
					</button>
					<h4 class="modal-title">Pendaftaran Baru</h4>
				</div>
				<div class="modal-body">
					<form action="index.php?module=student&action=register" class="form-horizontal" method="post">
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="nama_penuh">Nama Pelajar</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="text" class="form-control" name="nama_penuh" id="nama_penuh" placeholder="Nama Penuh" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="no_matrik">No. Matrik</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="text" class="form-control" name="no_matrik" id="no_matrik" placeholder="No. Matrik" />
									</div>
								</div>
                                
									<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="no_kp">No. Kad Pengenalan</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="text" class="form-control" name="no_kp" id="no_kp" placeholder="No. Kad Pengenalan" />
									</div>
								</div>
                                
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="kata_laluan">Kata Laluan</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="password" class="form-control" name="kata_laluan" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="program_major">Program</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="program_major" id="program_major" class="form-control">
											<?php
											foreach( $programmes as $program_major ){
												echo "<option value=\"$program_major[id]\">$program_major[nama_panjang]</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="jantina">Jantina</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-sm-6">
												<label for="gender_m">
													<input type="radio" name="jantina" value="<?php echo Student::LELAKI; ?>" id="gender_m" /> Lelaki
												</label>
											</div>
											<div class="col-md-6 col-sm-6 col-sm-6">
												<label for="gender_f">
													<input type="radio" name="jantina" value="<?php echo Student::PEREMPUAN; ?>" id="gender_f" /> Perempuan
												</label>
											</div>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="tarikh_lahir">Tarikh Lahir</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<input type="date" class="form-control" name="tarikh_lahir" id="tarikh_lahir" readonly placeholder="dd-mm-yyyy" />
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-3 col-sm-3 col-xs-12">
										<label for="bangsa">Bangsa</label>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12">
										<select name="bangsa" id="bangsa" class="form-control">
											<?php
											foreach( $bangsa as $id => $bangsa ){
												echo "<option value=\"$id\">$bangsa</option>";
											}
											?>
										</select>
									</div>
								</div>
								
								<button class="btn btn-md btn-primary">
									<i class="fa fa-sign-in"></i> Daftar
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
	$('#tarikh_lahir').datepicker({
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