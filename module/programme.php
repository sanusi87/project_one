<?php
class Programme{
	
	public static function all(){
		$programmes = array();
		$strSQL = "SELECT * FROM program_major ORDER BY nama_panjang DESC";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$programmes[] = $row;
		}
		return $programmes;
	}
}
?>