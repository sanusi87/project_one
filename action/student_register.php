<?php
$pelajar = new Student();
$pelajar->no_matrik = htmlentities( $_POST['kata_nama'], ENT_QUOTES );
$pelajar->kata_laluan = $_POST['kata_laluan'];
$pelajar->program_major = (int)$_POST['program_major'];
// $pelajar->faculty = (int)$_POST['faculty'];
$pelajar->nama_penuh = htmlentities( $_POST['namapelajar'], ENT_QUOTES );
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