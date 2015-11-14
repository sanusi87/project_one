<?php
// boh goni dulu
ob_start();

// lp0s tu ikut mu nk boh gapo dale ni
?>

<h1>Panduan Pelajar</h1>
<p>Panduan Pelajar boleh di dapat dalam fail PDF di pautan di bawah</p>
<p><a href="../error_log.txt">PDF</a></p>

<?php
// last skali boh goni wojib
$content = ob_get_clean();
View::addContent( $content );
?>