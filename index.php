<?php
define( "ACTION", "action" );
define( "APPNAME", "Project One" );
include_once("autoload.php");

new DbConn();
session_start();

$module = $_GET['module'];
$action = $_GET['action'];

if( !isset( $_SESSION['student_id'] ) && !isset( $_SESSION['admin_id'] ) ){
	if( empty( $_POST ) ){
		$module = null;
	}
}
// var_dump( $module );
// var_dump( $action );
// var_dump( $_SESSION['student_id'] );
// var_dump( $_SESSION['admin_id'] );

switch( $module ){
	case 'student':
		if( $action == 'login' ){
			include_once( ACTION.'/student_login.php' );
		}elseif( $action == 'register' ){
			include_once( ACTION.'/student_register.php' );
		}elseif( $action == 'new-application' ){
			include_once( ACTION.'/student_submit_application.php' );
		}else{
			include_once( ACTION.'/student_view_application.php' );
		}
		break;
	case 'admin':
		if( $action == 'login' ){
			include_once( ACTION.'/admin_login.php' );
		}elseif( $action == 'approve' ){
			include_once( ACTION.'/admin_process_application.php' );
		}elseif( $action == 'reject' ){
			include_once( ACTION.'/admin_process_application.php' );
		}elseif( $action == 'edit-application' ){
			// update application
		}else{
			include_once( ACTION.'/admin_view_application.php' );
		}
		break;
	case 'subject':
		if( $action == 'load' ){
			$school = (int)$_GET['school'];
			header('Content-type: Application/json');
			echo json_encode( Subject::ofSchool( $school ) );
			exit;
		}
		break;
	case 'logout':
		unset( $_SESSION['student_id'] );
		unset( $_SESSION['admin_id'] );
		
		header('Location: /');
		exit;
	case 'site':
		include_once( ACTION."/$module"."_".$action.".php" );
		break;
	case 'application':
		if( $action == 'info' ){
			// get application info
			$app = Application::findById( $_GET['id'] );
			header('Content-type: Application/json');
			echo json_encode( $app );
			exit;
		}elseif( $action == 'edit' ){
			if( $_SESSION['admin_id'] ){
				include_once( ACTION.'/admin_edit_application.php' );
			}else{
				header('Location: /');
				exit;
			}
		}elseif( $action == 'print' ){
			include_once( ACTION.'/print_application.php' );
		}
		break;
	default:
		if( $_SESSION['student_id'] ){
			include_once( ACTION.'/student_view_application.php' );
		}elseif( $_SESSION['admin_id'] ){
			include_once( ACTION.'/admin_view_application.php' );
		}else{
			include_once(ACTION."/index_authenticate.php");
		}
}

if( $action == 'print' ){
	include_once("views/layouts/print.php");
}else{
	if( $_SESSION['student_id'] ){
		include_once("views/layouts/student.php");
	}elseif( $_SESSION['admin_id'] ){
		include_once("views/layouts/admin.php");
	}else{
		include_once("views/layouts/main.php");
	}
}
?>