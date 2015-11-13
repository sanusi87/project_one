<?php
class Faculty{
	
	public static function all(){
		$faculties = array();
		$strSQL = "SELECT * FROM fakulti ORDER BY nama_panjang DESC";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$faculties[] = $row;
		}
		return $faculties;
	}
}
?>