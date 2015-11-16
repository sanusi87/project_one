<?php ob_start(); ?>

<h1>Carian</h1>
<p>Sila Masukkan No Matrik Pelajar</p>
<p><input type="text" maxlength="12"><input type="submit" name="cari" value="Cari">

<?php
$content = ob_get_clean();
View::addContent( $content );
?>