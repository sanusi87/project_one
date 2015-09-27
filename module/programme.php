<?php
class Programme{
	
	public static function all(){
		$programmes = array();
		$strSQL = "SELECT * FROM programme ORDER BY long_name DESC";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$programmes[] = $row;
		}
		return $programmes;
	}
}
?>