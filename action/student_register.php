<?php
$student = new Student();
$student->matric_no = htmlentities( $_POST['username'], ENT_QUOTES );
$student->password = $_POST['password'];
$student->programme = (int)$_POST['programme'];
$student->faculty = (int)$_POST['faculty'];
// $student->full_name
$student->date_created = date('Y-m-d H:i:s');

if( $student->register() ){
	header('Location: index.php?module=student');
}else{
	header('Location: index.php?module=student&action=register');
}
exit;
?>