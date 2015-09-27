<?php
class Application{
	
	public $id;
	public $student_id;
	public $school_id;
	public $subject_id;
	public $status;
	public $date_added;
	public $date_updated;
	
	public static function all( $student=null, $filter=array() ){
		
		$param = array();
		
		$strSQL = "SELECT application.*, application_status.name as app_status, school.name as school_name, subject.name as subject_name, student.full_name, student.matric_no
		FROM application 
		INNER JOIN application_status ON application_status.id = application.status 
		INNER JOIN school ON school.id = application.school_id 
		INNER JOIN subject ON subject.id = application.subject_id 
		INNER JOIN student ON student.id = application.student_id 
		WHERE 1=1";
		
		if( !empty( $student ) ){
			$strSQL .= " AND student_id=:student_id";
			$param[':student_id'] = $student;
		}else{
			
		}
		
		if( !empty( $filter ) ){
			if( !empty( $filter['status'] ) ){
				$strSQL .= " AND application.status=:status";
				$param[':status'] = $filter['status'];
			}
		}
		
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute( $param );
		
		$applications = array();
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$applications[] = $row;
		}
		return $applications;
	}
	
	public function submit(){
		$strSQL = "INSERT INTO application SET student_id=:student, school_id=:school, subject_id=:subject, status=1, date_added=:date_added";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute(array(
			':student' => $this->student_id,
			':school' => $this->school_id,
			':subject' => $this->subject_id,
			':date_added' => date('Y-m-d H:i:s')
		));
		return $result;
	}
	
	public function update(){
		$strSQL = "UPDATE application SET student_id=:student, school_id=:school, subject_id=:subject, date_updated=:date_updated, status=:status WHERE id=:id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute(array(
			':id' => $this->id,
			':student' => $this->student_id,
			':school' => $this->school_id,
			':subject' => $this->subject_id,
			':status' => $this->status,
			':date_updated' => date('Y-m-d H:i:s')
		));
		return $result;
	}
	
	public static function findById( $id ){
		$strSQL = "SELECT application.* FROM application WHERE id=:id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute( array( ':id' => $id ) );
		$row = $statement->fetch( PDO::FETCH_ASSOC );
		if( !empty( $row['id'] ) ){
			$app = new self;
			$app->id = $row['id'];
			$app->student_id = $row['student_id'];
			$app->school_id = $row['school_id'];
			$app->subject_id = $row['subject_id'];
			$app->status = $row['status'];
			$app->date_added = $row['date_added'];
			$app->date_updated = $row['date_updated'];
			
			return $app;
		}
		return false;
	}
	
	public static function isMyApplication( $id ){
		$strSQL = "SELECT 1 FROM application WHERE id=:id AND student_id=:student_id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute( array( ':id' => $id, ':student_id' => $_SESSION['student_id'] ) );
		$row = $statement->fetch( PDO::FETCH_ASSOC );
		
		if( is_array( $row ) && count( $row ) == 1 ){
			return true;
		}
		return false;
	}
	
	public function processApplication(){
		$strSQL = "UPDATE application SET status=:status WHERE id=:id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute( array( ':status' => $this->status, ':id' => $this->id ) );
		return $result;
	}
	
	public static function statuses(){
		$strSQL = "SELECT * FROM application_status";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statuses = [];
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$statuses[] = $row;
		}
		
		return $statuses;
	}
	
}
?>