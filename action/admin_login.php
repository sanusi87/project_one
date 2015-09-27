<?php
$admin = new Admin();
$admin->username = $_POST['username'];
$admin->password = $_POST['password'];
if( !$admin->login() ){
	$_SESSION['error'] = 'Login Failed! Wrong username or password.';
}
header('Location: /');
?>