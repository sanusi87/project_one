<?php
class DbConn{
	public static $dbConn;
	public function DbConn(){
		$connStr = 'mysql:host=localhost;dbname=projectone';
		$dbConn = new PDO($connStr, 'root', '');
		$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		self::$dbConn = $dbConn;
	}
}