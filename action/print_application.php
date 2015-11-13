<?php
	$id = $_GET['id'];
	
	ob_start();
	$app = Application::findById($id);
	$pelajar = Student::findById( $app->id_pelajar );
	$bangsa = Student::bangsa();
	
	$sekolahs = array();
	array_map(function( $sekolah ){
		global $sekolahs;
		$sekolahs[$sekolah['id']] = $sekolah['nama'];
	}, School::all());
	
	$subjeks = array();
	array_map(function( $subjek ){
		global $subjeks;
		$subjeks[$subjek['id']] = $subjek['nama'];
	}, Subject::ofSchool( $app->id_sekolah ));
	
	$statuses = array();
	array_map(function( $status ){
		global $statuses;
		$statuses[$status['id']] = $status['nama'];
	}, Application::statuses());
	
	$programmes = array();
	array_map( function( $programme ){
		global $programmes;
		return $programmes[$programme['id']] = $programme['nama_panjang'];
	}, Programme::all() );
	
	
?>
<div>
	<table class="table">
		<tbody>
			<tr>
				<th colspan="2">Student Details</th>
			</tr>
			<tr><td>Nama</td><td>: <?php echo $pelajar->nama_penuh; ?></td></tr>
			<tr><td>No. Matrik</td><td>: <?php echo $pelajar->no_matrik; ?></td></tr>
			<tr><td>Program</td><td>: <?php echo $programmes[$pelajar->program_major]; ?></td></tr>
			<tr><td>Jantina</td><td>: <?php echo $pelajar->jantina == Student::LELAKI ? 'Lelaki' : 'PEREMPUAN'; ?></td></tr>
			<tr><td>Tarikh Lahir</td><td>: <?php echo $pelajar->tarikh_lahir; ?></td></tr>
			<tr><td>Bangsa</td><td>: <?php echo $bangsa[$pelajar->bangsa]; ?></td></tr>
			<tr>
				<td colspan="2" height="30"></td>
			</tr>
		</tbody>
		
		<tbody>
			<tr>
				<th colspan="2">Application Details</th>
			</tr>
			<tr><td>Sekolah</td><td>: <?php echo $sekolahs[$app->id_sekolah]; ?></td></tr>
			<tr><td>Subjek</td><td>: <?php echo $subjeks[$app->id_subjek]; ?></td></tr>
			<tr><td>Submitted On</td><td>: <?php echo $app->tarikh_dibuat; ?></td></tr>
			<tr><td>Status</td><td>: <?php echo $statuses[$app->status]; ?></td></tr>
		</tbody>
	</table>
</div>
<?php
	$content = ob_get_clean();
	View::addContent( $content );
?>