<?php
class School{
	
	public static function all(){
		$school = array();
		$strSQL = "SELECT school.*, state.name as state_name, city.name as city_name, S.id as application_id FROM school
		INNER JOIN state ON state.id = school.state_id
		INNER JOIN city ON city.id = school.city_id
		LEFT JOIN (
			SELECT id, school_id FROM application WHERE status IN (1,2) AND YEAR(application.date_added) = ".date('Y')." ORDER BY application.date_added DESC
		) AS S ON S.school_id = school.id
		ORDER BY school.name ASC";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$school[] = $row;
		}
		return $school;
	}
}
?>