<?php
$student = new Student();
$student->matric_no = $_POST['username'];
$student->password = $_POST['password'];
if( !$student->login() ){
	$_SESSION['error'] = 'Login Failed! Wrong username or password.';
}
header('Location: /');
?>