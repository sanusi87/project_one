<?php ob_start(); ?>

<h1>User Guide</h1>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus a sem magna. Pellentesque ut tincidunt mi. Pellentesque blandit augue sapien, at congue enim ultricies sed. Aliquam consequat finibus dictum. Aenean dignissim sagittis urna, id commodo nunc convallis a. Suspendisse tortor ex, commodo id dictum dictum, egestas id lorem.</p>
<p>Pellentesque et finibus mauris, eget tempor ex. Sed non ultrices lorem. Vivamus a justo vitae ante auctor tristique. Sed finibus ante sed pellentesque venenatis. Cras efficitur, ex et mollis imperdiet, magna ligula egestas libero, elementum vehicula metus eros eu arcu. Morbi dictum, justo et iaculis convallis, massa purus auctor orci, eu imperdiet purus ante id mauris. Duis hendrerit odio ac facilisis sagittis. Sed vel ornare leo. Maecenas laoreet fringilla tortor, quis varius orci laoreet id.</p>

<?php
$content = ob_get_clean();
View::addContent( $content );
?>