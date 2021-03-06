<?php
ob_start();
$applications = Application::all( $_SESSION['id_pelajar'] );
//$student = Student
?>

<div>
	<div>
		<h1>Permohonan</h1>
		<hr />
	</div>
	<?php
	if( empty( $applications ) ){
	?>
	<div class="alert alert-warning">
		<i class="fa fa-warning"></i> Tiada Permohonan di Hantar!
	</div>
	<?php
	}else{
	?>
	<div class="list-group">
		<div class="list-group-item">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="row">
						<div class="col-md-2 col-md-2 col-xs-1">#</div>
						<div class="col-md-5 col-md-5 col-xs-11">Sekolah</div>
						<div class="col-md-5 col-md-5 col-xs-12">Status</div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-4 col-md-4 col-xs-6">Tarikh Permohonan</div>
					<div class="col-md-4 col-md-4 col-xs-6">Tarikh Kemaskini</div>
					<div class="col-md-4 col-md-4 col-xs-12">&nbsp;</div>
				</div>
				
			</div>
		</div>
	<?php
		$i = 1;
		foreach( $applications as $application ){
	?>
		<div class="list-group-item">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="row">
						<div class="col-md-2 col-md-2 col-xs-1"><?php echo $i; ?></div>
						<div class="col-md-5 col-md-5 col-xs-11">
							<?php echo $application['nama_sekolah']; ?><br />
							<small class="text-muted"><?php echo $application['nama_subjek']; ?></small>
						</div>
						<div class="col-md-5 col-md-5 col-xs-12"><?php echo $application['status_mohon']; ?></div>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="col-md-4 col-md-4 col-xs-6"><?php echo $application['tarikh_dibuat'] ?></div>
					<div class="col-md-4 col-md-4 col-xs-6"><?php echo $application['tarikh_kemaskini'] ?></div>
					<div class="col-md-4 col-md-4 col-xs-12">
						<a class="btn btn-default btn-sm" href="index.php?module=application&action=print&id=<?php echo $application['id']; ?>" target="_blank">
							<i class="fa fa-print"></i> Print
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php
			$i++;
		}
	?>
	</div>
	<?php } ?>
</div>

<?php
$content = ob_get_clean();
View::addContent( $content );

if( isset( $_SESSION['success'] ) ){
	View::addStylesheet('<link rel="stylesheet" href="/assets/plugins/bootstrap-toastr/toastr.min.css" />');
	View::addJavascript('<script type="text/javascript" src="/assets/plugins/bootstrap-toastr/toastr.min.js"></script>');

	$js = <<<JS
	<script type="text/javascript">
	jQuery(function($){
		toastr.success('$_SESSION[success]', 'Success Notification');
	});
	</script>
JS;
	unset( $_SESSION['success'] );
	View::addJavascript($js);
}
?>