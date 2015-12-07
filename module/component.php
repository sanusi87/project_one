<?php
class Component{
	public static function menuBar(){
		$html = <<<HTML
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Utama</a></li>
						<li><a href="index.php?module=site&action=about">Tentang Kami</a></li>
						<li><a href="index.php?module=site&action=guide">Panduan</a></li>
						<li><a href="index.php?module=site&action=contact">Hubungi Kami</a></li>
					</ul>
				</div>
			</div>
		</nav>
HTML;
		return $html;
	}
}
?>