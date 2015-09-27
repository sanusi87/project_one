<?php
ob_start();
$applications = Application::all();
//$student = Student
?>

<div>
	<div>
		<h1>Applications</h1>
		<hr />
	</div>
	<?php
	if( empty( $applications ) ){
	?>
	<div class="alert alert-warning">
		<i class="fa fa-warning"></i> No application submitted!
	</div>
	<?php
	}else{
	?>
	<div class="list-group">
		<div class="list-group-item">
			<div class="row">
				<div class="col-md-1 col-md-1 col-xs-1">#</div>
				<div class="col-md-4 col-md-4 col-xs-11">School</div>
				<div class="col-md-2 col-md-2 col-xs-6">Applied On</div>
				<div class="col-md-2 col-md-2 col-xs-6">Updated On</div>
				<div class="col-md-3 col-md-3 col-xs-12">Action</div>
			</div>
		</div>
	<?php
		$i = 1;
		foreach( $applications as $application ){
	?>
		<div class="list-group-item">
			<div class="row">
				<div class="col-md-1 col-md-1 col-xs-1"><?php echo $i; ?></div>
				<div class="col-md-4 col-md-4 col-xs-11">
					<strong><?php echo empty( $application['full_name'] ) ? $application['matric_no'] : $application['full_name']; ?></strong><br />
					<small><?php echo $application['school_name']; ?></small><br />
					<small><small class="text-muted"><?php echo $application['subject_name']; ?></small></small>
				</div>
				<div class="col-md-2 col-md-2 col-xs-6"><?php echo $application['date_added'] ?></div>
				<div class="col-md-2 col-md-2 col-xs-6"><?php echo $application['date_updated'] ?></div>
				<div class="col-md-3 col-md-3 col-xs-12">
					<div class="btn btn-group btn-group-xs">
					<?php if( $application['status'] == 1 ){ ?>
						<a class="btn btn-primary" href="index.php?module=admin&action=approve&id=<?php echo $application['id']; ?>">
							<i class="fa fa-check"></i> Approve
						</a>
						
						<?php /* ?><a class="btn btn-default" data-href="index.php?module=application&action=info&id=<?php echo $application['id']; ?>" href="#edit-application" data-toggle="modal">
							<i class="fa fa-edit"></i> Edit
						</a><?php */ ?>
						
						<a class="btn btn-default" href="index.php?module=application&action=edit&id=<?php echo $application['id']; ?>">
							<i class="fa fa-edit"></i> Edit
						</a>
						
						<a class="btn btn-danger" href="index.php?module=admin&action=reject&id=<?php echo $application['id']; ?>">
							<i class="fa fa-ban"></i> Reject
						</a>
					<?php
						}else{
							if( $application['status'] == 2 ){
					?>
						<button type="button" disabled="disabled" class="btn btn-primary">
							<i class="fa fa-check"></i> Approve
						</button>
					<?php
							}elseif( $application['status'] == 3 ){
					?>
						<button type="button" disabled="disabled" class="btn btn-danger">
							<i class="fa fa-ban"></i> Reject
						</button>
					<?php
							}
						}
					?>
						
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

<div class="modal" id="edit-application">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Edit Application</h4>
			</div>
			<div class="modal-body">
				
			</div>
		</div>
	</div>
</div>


<?php
$content = ob_get_clean();
View::addContent( $content );

// if( isset( $_SESSION['success'] ) ){
	// View::addStylesheet('<link rel="stylesheet" href="/assets/plugins/bootstrap-toastr/toastr.min.css" />');
	// View::addJavascript('<script type="text/javascript" src="/assets/plugins/bootstrap-toastr/toastr.min.js"></script>');

	$js = <<<JS
	<script type="text/javascript">
	jQuery(function($){
		$('#edit-application').on('show.bs.modal', function(e){
			var t = $(e.relatedTarget);
			$.getJSON(t.attr('data-href'), function(resp){
				
			});
		});
	});
	</script>
JS;
	// unset( $_SESSION['success'] );
	View::addJavascript($js);
// }
?>