<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="css/font-awesome.css" />
		<style type="text/css">
		span.the-icon {
			border: 1px solid #eee;
			color: #aaa;
			display: inline-block;
			height: 50px;
			margin: 2px 0;
			padding: 10px;
			text-align: center;
			width: 200px;
		}
		span.the-icon i.fa {
			color: #08f;
			font-size: 30px;
			line-height: 30px;
		}
		</style>
	</head>
	<body>
	<?php
		$cssFile = file_get_contents( 'css/font-awesome.css' );
		
		preg_match_all( '/(?<=\.)(.*?)(?=:before)/', $cssFile, $icons );
		if( !empty( $icons[1] ) ){
			foreach( $icons[1] as $i => $v ){
			?>
			<span class="the-icon">
				<i class="fa <?php echo $v; ?>"></i>
				<br />
				<?php echo "fa $v"; ?>
			</span>
			<?php
			}
		}
	?>
	</body>
</html>