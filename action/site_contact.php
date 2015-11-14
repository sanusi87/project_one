<?php ob_start(); ?>

<h1>Hubungi Kami</h1>
<p>
Hubungi kami di No Telefon :000000000
</p>

<?php
$content = ob_get_clean();
View::addContent( $content );
?>