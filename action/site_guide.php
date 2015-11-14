<?php ob_start(); ?>

<h1>Panduan Pelajar</h1>
<p>Panduan Pelajar boleh di dapat dalam fail PDF di pautan di bawah</p>
<p><a href="../error_log.txt">PDF</a></p>

<?php
$content = ob_get_clean();
View::addContent( $content );
?>