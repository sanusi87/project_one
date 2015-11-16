<?php ob_start(); ?>

<h1>Panduan Pelajar</h1>
<p>Panduan Pelajar boleh di dapat dalam fail PDF di pautan di bawah</p>
<p><a href="../doc/panduan_pelajar.pdf">PDF</a></p>

<?php
$content = ob_get_clean();
View::addContent( $content );
?>