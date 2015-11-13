<?php
$id = $_GET['id'];

if( isset( $_POST ) && !empty( $_POST ) ){
	$application = Application::findById($id);
	$application->id_pelajar = (int)$_POST['id_pelajar'];
	$application->id_sekolah = (int)$_POST['sekolah'];
	$application->id_subjek = (int)$_POST['subjek'];
	$application->status = (int)$_POST['status'];
	
	if( $application->update() ){
		$_SESSION['success'] = 'Application submitted!';
		header('Location: index.php?module=admin');
		exit;
	}else{
		$_SESSION['error'] = 'Application failed!';
	}
}

ob_start();
	$app = Application::findById($id);
	$pelajar = Student::findById( $app->id_pelajar );
	
	$sekolahs = School::all();
	$subjeks = Subject::ofSchool( $app->id_sekolah );
	$statuses = Application::statuses();
?>
<div>
	<div>
		<h1>Update Applications <span class="text-muted">#<?php echo $id; ?></span></h1>
		<hr />
	</div>
	
	<form action="" class="form-horizontal" method="post" id="application-form">
		<input type="hidden" name="id_pelajar" value="<?php echo $pelajar->id; ?>" />
		<h3>Student Record</h3>
		<hr />
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="no_matrik">No. Matrik</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->no_matrik; ?>" name="no_matrik" readonly />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="full_name">Nama Penuh</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->nama_penuh; ?>" name="full_name" readonly />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="program_major">Program Major</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->program_major; ?>" name="program_major" readonly />
			</div>
		</div>
		
		<?php /* ?><div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="faculty">Faculty</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $student->faculty_name; ?>" name="faculty" readonly="readonly" />
			</div>
		</div><?php */ ?>
		
		<h3>School Record</h3>
		<hr />
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="sekolah">Sekolah</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="sekolah" id="sekolah" class="form-control">
					<option value="">-- select --</option>
				<?php
				foreach( $sekolahs as $sekolah ){
					if( $sekolah['id'] == $app->id_sekolah ){
						echo "<option value=\"$sekolah[id]\" selected=\"selected\">$sekolah[nama]</option>";
					}else{
						echo "<option value=\"$sekolah[id]\">$sekolah[nama]</option>";
					}
				}
				?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="subjek">Subjek</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="subjek" id="subjek" class="form-control">
					<?php
					if( !empty( $subjeks ) ){
						foreach( $subjeks as $subjek ){
							if( $subjek['id'] == $app->id_subjek ){
								echo "<option value=\"$subjek[id]\" selected=\"selected\">$subjek[nama]</option>";
							}else{
								echo "<option value=\"$subjek[id]\">$subjek[nama]</option>";
							}
						}
					}
					?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="status">Status</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="status" id="status" class="form-control">
					<option value="">-- select --</option>
				<?php
				foreach( $statuses as $status ){
					if( $status['id'] == $app->status ){
						echo "<option value=\"$status[id]\" selected=\"selected\">$status[nama]</option>";
					}else{
						echo "<option value=\"$status[id]\">$status[nama]</option>";
					}
				}
				?>
				</select>
			</div>
		</div>
		
		<button type="submit" class="btn btn-primary btn-md">
			<i class="fa fa-angle-double-right"></i> Submit
		</button>
		
	</form>
</div>

<?php
$content = ob_get_clean();
View::addContent( $content );

View::addStylesheet('<link rel="stylesheet" href="/assets/plugins/bootstrap-toastr/toastr.min.css" />');
View::addJavascript('<script type="text/javascript" src="/assets/plugins/bootstrap-toastr/toastr.min.js"></script>');

$js = <<<JS
	<script type="text/javascript">
	jQuery(function($){
		$('#application-form').submit(function(){
			var errors = [];
			
			if( $('#sekolah').val() == '' ){
				errors.push('Please select a school!');
			}
			
			if( $('#subjek').val() == '' ){
				errors.push('Please select a subject!');
			}
			
			if( errors.length > 0 ){
				$.each(errors, function(i,e){
					toastr.error(e, 'Notification');
				});
				return false;
			}
		});
		
		$('#sekolah').change(function(){
			var t = $(this).val();
			$.getJSON('index.php?module=subject&action=load&school='+t, function(resp){
				$('#subjek').empty();
				$.each(resp, function(i,e){
					$('#subjek').append('<option value="'+e.id+'">'+e.name+'</option>');
				});
			});
		});
JS;

if( !empty( $_SESSION['error'] ) ){
	$js .= <<<JS
		toastr.error( '$_SESSION[error]', 'Error Notification' );
JS;
	unset( $_SESSION['error'] );
}

$js .= <<<JS
	});
	</script>
JS;
View::addJavascript($js);
?>