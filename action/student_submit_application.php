<?php
if( isset( $_POST ) && !empty( $_POST ) ){
	$application = new Application();
	$application->student_id = (int)$_POST['student_id'];
	$application->school_id = (int)$_POST['school'];
	$application->subject_id = (int)$_POST['subject'];
	
	if( $application->submit() ){
		$_SESSION['success'] = 'Application submitted!';
		header('Location: index.php?module=student');
		exit;
	}else{
		$_SESSION['error'] = 'Application failed!';
	}
}


ob_start();
$student = Student::findById( $_SESSION['student_id'] );
$schools = School::all();
$application = Application::all( $_SESSION['student_id'], array('status' => 1) );
?>

<div>
	<div>
		<h1>Submit new Application</h1>
		<hr />
	</div>
	
	<?php if( count( $application ) > 0 ){ ?>
	<div class="alert alert-info">
		<i class="fa fa-info-circle"></i> New application is not permitted because you still have a pending approval application.
	</div>
	<?php } ?>
	
	<form action="" class="form-horizontal" method="post" id="application-form">
		<input type="hidden" name="student_id" value="<?php echo $student->id; ?>" />
		<h3>Student Record</h3>
		<hr />
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="matric_no">Matric No.</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $student->matric_no; ?>" name="matric_no" readonly="readonly" />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="full_name">Full Name</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $student->full_name; ?>" name="full_name" readonly="readonly" />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="programme">Programme</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $student->programme_name; ?>" name="programme" readonly="readonly" />
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="faculty">Faculty</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<input type="text" class="form-control" value="<?php echo $student->faculty_name; ?>" name="faculty" readonly="readonly" />
			</div>
		</div>
		
		<h3>School Record</h3>
		<hr />
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="school">School</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="school" id="school" class="form-control">
					<option value="">-- select --</option>
				<?php
				foreach( $schools as $school ){
					// if( !empty( $school['application_id'] ) ){
						// echo "<option value=\"$school[id]\" disabled=\"disabled\">$school[name]</option>";
					// }else{
						echo "<option value=\"$school[id]\">$school[name]</option>";
					// }
				}
				?>
				</select>
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label for="subject">Subject</label>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12">
				<select name="subject" id="subject" class="form-control"></select>
			</div>
		</div>
		<?php if( count( $application ) == 0 ){ ?>
		<button type="submit" class="btn btn-primary btn-md">
			<i class="fa fa-angle-double-right"></i> Submit
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
			
			if( $('#school').val() == '' ){
				errors.push('Please select a school!');
			}
			
			if( $('#subject').val() == '' ){
				errors.push('Please select a subject!');
			}
			
			if( errors.length > 0 ){
				$.each(errors, function(i,e){
					toastr.error(e, 'Notification');
				});
				return false;
			}
		});
		
		$('#school').change(function(){
			var t = $(this).val();
			$.getJSON('index.php?module=subject&action=load&school='+t, function(resp){
				$('#subject').empty();
				$.each(resp, function(i,e){
					$('#subject').append('<option value="'+e.id+'">'+e.name+'</option>');
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