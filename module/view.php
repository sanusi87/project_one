<?php
class View{
	public static $stylesheets = array();
	public static $javascripts = array();
	public static $content = array();
	
	public static function addStylesheet( $css ){
		self::$stylesheets[] = $css;
	}

	public static function addJavascript( $js ){
		self::$javascripts[] = $js;
	}

	public static function addContent( $content ){
		self::$content[] = $content;
	}
	
	public static function stylesheets(){
		echo implode( '', self::$stylesheets );
	}

	public static function javascripts(){
		echo implode( '', self::$javascripts );
	}

	public static function content(){
		echo implode( '', self::$content );
	}
}
?>