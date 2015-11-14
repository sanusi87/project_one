<?php
$pelajar = new Student();
$pelajar->no_matrik = htmlentities( $_POST['no_matrik'], ENT_QUOTES );
$pelajar->no_kp = $_POST['no_kp'];
$pelajar->kata_laluan = $_POST['kata_laluan'];
$pelajar->program_major = (int)$_POST['program_major'];
// $pelajar->faculty = (int)$_POST['faculty'];
$pelajar->nama_penuh = htmlentities( $_POST['nama_penuh'], ENT_QUOTES );
$pelajar->jantina = $_POST['jantina'];
$pelajar->tarikh_lahir = date( 'Y-m-d H:i:s', strtotime( $_POST['tarikh_lahir'] ) );
$pelajar->bangsa = $_POST['bangsa'];
$pelajar->tarikh_dibuat = date('Y-m-d H:i:s');

if( $pelajar->register() ){
	header('Location: index.php?module=student');
}else{
	header('Location: index.php?module=student&action=register');
}
exit;
?>