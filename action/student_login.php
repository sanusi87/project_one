<?php
$pelajar = new Student();
$pelajar->no_matrik = $_POST['kata_nama'];
$pelajar->kata_laluan = $_POST['kata_laluan'];
if( !$pelajar->login() ){
	$_SESSION['error'] = 'LOg Masuk Gagal! No Matrik dan kata laluan salah.';
}
header('Location: /');
?>