<?php
	$id = $_GET['id'];
	
	ob_start();
	$app = Application::findById($id);
	$student = Student::findById( $app->student_id );
	$races = Student::races();
	
	$schools = array();
	array_map(function( $school ){
		global $schools;
		$schools[$school['id']] = $school['name'];
	}, School::all());
	
	$subjects = array();
	array_map(function( $subject ){
		global $subjects;
		$subjects[$subject['id']] = $subject['name'];
	}, Subject::ofSchool( $app->school_id ));
	
	$statuses = array();
	array_map(function( $status ){
		global $statuses;
		$statuses[$status['id']] = $status['name'];
	}, Application::statuses());
	
	$programmes = array();
	array_map( function( $programme ){
		global $programmes;
		return $programmes[$programme['id']] = $programme['long_name'];
	}, Programme::all() );
	
	
?>
<div>
	<table class="table">
		<tbody>
			<tr>
				<th colspan="2">Student Details</th>
			</tr>
			<tr><td>Name</td><td>: <?php echo $student->full_name; ?></td></tr>
			<tr><td>Matric No.</td><td>: <?php echo $student->matric_no; ?></td></tr>
			<tr><td>Programme</td><td>: <?php echo $programmes[$student->programme]; ?></td></tr>
			<tr><td>Gender</td><td>: <?php echo $student->gender == Student::MALE ? 'Male' : 'Female'; ?></td></tr>
			<tr><td>Date of Birth</td><td>: <?php echo $student->dob; ?></td></tr>
			<tr><td>Race</td><td>: <?php echo $races[$student->race]; ?></td></tr>
			<tr>
				<td colspan="2" height="30"></td>
			</tr>
		</tbody>
		
		<tbody>
			<tr>
				<th colspan="2">Application Details</th>
			</tr>
			<tr><td>School</td><td>: <?php echo $schools[$app->school_id]; ?></td></tr>
			<tr><td>Subject</td><td>: <?php echo $subjects[$app->subject_id]; ?></td></tr>
			<tr><td>Submitted On</td><td>: <?php echo $app->date_added; ?></td></tr>
			<tr><td>Status</td><td>: <?php echo $statuses[$app->status]; ?></td></tr>
		</tbody>
	</table>
</div>
<?php
	$content = ob_get_clean();
	View::addContent( $content );
?>