<?php
function __autoload( $class_name ){
	include "module/".strtolower($class_name).'.php';

}

?>