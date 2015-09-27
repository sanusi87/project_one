<?php
$application = Application::findById( $_GET['id'] );
// var_dump( $application );
if( $application instanceof Application ){	
	if( $action == 'approve' ){
		$application->status = 2;
	}else{
		$application->status = 3;
	}

	if( $application->processApplication() ){
		
	}else{
		// ??
	}
}
header('Location: /');
?>