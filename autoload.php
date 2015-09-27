<?php
function __autoload( $class_name ){
	include "module/".$class_name.'.php';

}

?>