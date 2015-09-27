<?php
class Subject{
	public static function all( $school=null ){
		$subject = array();
		$strSQL = "SELECT * FROM subject";
		if( !empty( $school ) ){
			$strSQL .= " WHERE ";
		}
		
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$subject[] = $row;
		}
		
		return $subject;
	}
	
	public static function ofSchool( $school ){
		$subject = array();
		$strSQL = "SELECT subject.* FROM school_subject 
		INNER JOIN subject ON subject.id = school_subject.subject_id 
		WHERE school_id=:school_id";
		
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(
			':school_id' => $school
		));
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$subject[] = $row;
		}
		
		return $subject;
	}
}
?>