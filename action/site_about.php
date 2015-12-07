<?php
// boh goni dulu
ob_start();

// lp0s tu ikut mu nk boh gapo dale ni
?>

<div class="text-center">
	<div id="main-banner">
		<br />
		<br />
		<br />
		<!--<h1>Sistem Pendaftaran Latihan Mengajar</h1>-->
	</div>
	<?php echo Component::menuBar(); ?>
</div>

<h1>Tentang Kami</h1>
<p>Sistem Pendaftaran Latihan Mengajar (e-splm) ialah sistem yang dibina bagi memudahkan pelajar yang bakal menjalani latihan mengajar </p>
<p>khususnya untuk pelajar di bawah Fakulti Seni Komputeran dan Industri Kreatif.</p>
<p>&nbsp;</p>

<?php
// last skali boh goni wojib
$content = ob_get_clean();
View::addContent( $content );
?>