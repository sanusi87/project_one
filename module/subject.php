<?php
class Subject{
	public static function all( $sekolah=null ){
		$subjek = array();
		$strSQL = "SELECT * FROM subjek";
		if( !empty( $sekolah ) ){
			$strSQL .= " WHERE ";
		}
		
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$subjek[] = $row;
		}
		
		return $subjek;
	}
	
	public static function ofSchool( $sekolah ){
		$subjek = array();
		$strSQL = "SELECT subjek.* FROM subjek_sekolah
		INNER JOIN subjek ON subjek.id = subjek_sekolah.id_subjek 
		WHERE id_sekolah=:id_sekolah";
		
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(
			':id_sekolah' => $sekolah
		));
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$subjek[] = $row;
		}
		
		return $subjek;
	}
}
?>