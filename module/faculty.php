<?php
class Faculty{
	
	public static function all(){
		$faculties = array();
		$strSQL = "SELECT * FROM faculty ORDER BY long_name DESC";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$faculties[] = $row;
		}
		return $faculties;
	}
}
?>