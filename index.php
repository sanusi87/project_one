<?php
define( "ACTION", "action" );
define( "APPNAME", "e-SPLM" );
include_once("autoload.php");

ini_set("display_errors", 1);
ini_set("error_reporting", E_ALL & ~E_NOTICE);

new DbConn();
session_start();

$module = $_GET['module'];
$action = $_GET['action'];

if( !isset( $_SESSION['id_pelajar'] ) && !isset( $_SESSION['id_admin'] ) ){
	if( empty( $_POST ) ){
		$module = $module == 'site' ? $module : null;
	}
}
// var_dump( $module );
// var_dump( $action );
// var_dump( $_SESSION['id_pelajar'] );
// var_dump( $_SESSION['id_admin'] );

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
	case 'subjek':
		if( $action == 'load' ){
			$sekolah = (int)$_GET['sekolah'];
			header('Content-type: Application/json');
			echo json_encode( Subject::ofSchool( $sekolah ) );
			exit;
		}
		break;
	case 'logout':
		unset( $_SESSION['id_pelajar'] );
		unset( $_SESSION['id_admin'] );
		
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
			if( $_SESSION['id_admin'] ){
				include_once( ACTION.'/admin_edit_application.php' );
			}else{
				header('Location: /');
				exit;
			}
		}elseif( $action == 'print' ){
			// var_dump( Application::isMyApplication( $_GET['id'] ) );
			if( $_SESSION['id_pelajar'] ){
				if( !Application::isMyApplication( $_GET['id'] ) ){
					header('Location: /');
					exit;
				}
			}
			include_once( ACTION.'/print_application.php' );
		}elseif( $action == 'search' ){
			$filter = array();
			// where
			if( !empty( $_REQUEST['nama_pelajar'] ) ){
				$filter['nama_pelajar'] = $_REQUEST['nama_pelajar'];
			}
			
			if( !empty( $_REQUEST['sekolah'] ) ){
				$filter['sekolah'] = (int)$_REQUEST['sekolah'];
			}
			
			// order
			if( !empty( $_REQUEST['order'] ) ){
				$filter['order'] = $_REQUEST['order'];
				if( !empty( $_REQUEST['by'] ) ){
					$filter['by'] = $_REQUEST['by'];
				}
			}
			
			// limit+offset
			if( !empty( $_REQUEST['limit'] ) ){
				$filter['limit'] = (int)$_REQUEST['limit'];
			}
			
			if( !empty( $_REQUEST['page'] ) ){
				$filter['page'] = (int)$_REQUEST['page'];
			}
			
			$applications = Application::all(null, $filter);
			
			header('Content-type: Application/json');
			echo json_encode( $applications );
			exit;
		}
		break;
	default:
		if( $_SESSION['id_pelajar'] ){
			include_once( ACTION.'/student_view_application.php' );
		}elseif( $_SESSION['id_admin'] ){
			include_once( ACTION.'/admin_view_application.php' );
		}else{
			include_once(ACTION."/index_authenticate.php");
		}
}

if( $action == 'print' ){
	include_once("views/layouts/print.php");
}else{
	if( $_SESSION['id_pelajar'] ){
		include_once("views/layouts/student.php");
	}elseif( $_SESSION['id_admin'] ){
		include_once("views/layouts/admin.php");
	}else{
		include_once("views/layouts/main.php");
	}
}
?>