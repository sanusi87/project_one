<?php
if( isset( $_POST ) && !empty( $_POST ) ){
	$application = new Application();
	$application->id_pelajar = (int)$_POST['id_pelajar'];
	$application->id_sekolah = (int)$_POST['sekolah'];
	$application->id_subjek = (int)$_POST['subjek'];
	
	if( $application->submit() ){
		$_SESSION['success'] = 'Permohonan Di Hantar!';
		header('Location: index.php?module=student');
		exit;
	}else{
		$_SESSION['error'] = 'Permohonan Gagal!';
	}
}

ob_start();
$pelajar = Student::findById( $_SESSION['id_pelajar'] );
$sekolahs = School::senaraiSekolah();
$application = Application::all( $_SESSION['id_pelajar'], array('status' => 1) );
?>

<div>
	<div>
		<h1>Permohonan Baru</h1>
		<hr />
	</div>
	
	<?php if( count( $application ) > 0 ){ ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> Permohonan baru tidak di benarkan kerana permohonan terdahulu anda masih dalam proses semakan. 
	</div>
	<?php } ?>
	
	<form action="" class="form-horizontal" method="post" id="application-form">
		<input type="hidden" name="id_pelajar" value="<?php echo $pelajar->id; ?>" />
		<h3>Rekod Pelajar</h3>
		<hr />
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="no_matrik">No. Matrik</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->no_matrik; ?>" name="no_matrik" readonly/>
			</div>
		</div>
        		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="no_kp">No. Kad Pengenalan</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->no_kp; ?>" name="no_kp" readonly/>
			</div>
		</div>
		 
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="nama_penuh">Nama Penuh</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->nama_penuh; ?>" name="nama_penuh" readonly />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="program_major">Program</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $pelajar->nama_program; ?>" name="program_major" readonly />
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
		
		<h3>Sekolah</h3>
		<hr />
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="sekolah">Sekolah</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="sekolah" id="sekolah" class="form-control">
					<option value="">-- sila pilih --</option>
				<?php
				foreach( $sekolahs as $sekolah ){
					// if( !empty( $school['application_id'] ) ){
						// echo "<option value=\"$school[id]\" disabled=\"disabled\">$school[name]</option>";
					// }else{
						echo "<option value=\"$sekolah[id]\">$sekolah[nama]</option>";
					// }
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
				<select name="subjek" id="subjek" class="form-control"></select>
			</div>
		</div>
		<?php if( count( $application ) == 0 ){ ?>
		<button type="submit" class="btn btn-primary btn-md">
			<i class="fa fa-angle-double-right"></i> Hantar
		</button>
		<?php } ?>
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
				errors.push('Sila pilih sekolah!');
			}
			
			if( $('#subjek').val() == '' ){
				errors.push('Sila pilih subjek!');
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
			$.getJSON('index.php?module=subjek&action=load&sekolah='+t, function(resp){
				$('#subjek').empty();
				$.each(resp, function(i,e){
					$('#subjek').append('<option value="'+e.id+'">'+e.nama+'</option>');
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