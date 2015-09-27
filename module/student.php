<?php
class Student{
	
	public $id;
	public $matric_no;
	public $password;
	public $programme;
	public $faculty;
	public $full_name;
	public $date_created;
	
	public function register(){
		$strSQL = "INSERT INTO student SET matric_no=:matric_no, password=:password, programme=:programme, faculty=:faculty, full_name=:full_name, date_created=:date_created";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		
		$row = $statement->execute(array(
			':matric_no' => $this->matric_no,
			':password' => md5( $this->password ),
			':programme' => $this->programme,
			':faculty' => $this->faculty,
			':full_name' => $this->full_name,
			':date_created' => $this->date_created
		));
		
		if( $row ){
			$_SESSION['student_id'] = DbConn::$dbConn->lastInsertId();
		}
		
		return $row;
	}
	
	public static function findById( $student ){
		$strSQL = "SELECT student.*, programme.long_name as programme_name, faculty.long_name as faculty_name FROM student 
		LEFT JOIN programme ON programme.id = student.programme 
		LEFT JOIN faculty ON faculty.id = student.faculty 
		WHERE student.id=:student_id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(':student_id' => $student));
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		
		$student = new self;
		$student->id = $row['id'];
		$student->matric_no = $row['matric_no'];
		//$student->password = $row['password'];
		$student->programme = $row['programme'];
		$student->faculty = $row['faculty'];
		$student->full_name = $row['full_name'];
		$student->date_created = $row['date_created'];
		$student->faculty_name = $row['faculty_name'];
		$student->programme_name = $row['programme_name'];
		
		// var_dump( $row );
		
		return $student;
	}
	
	public function login(){
		$strSQL = "SELECT student.* FROM student WHERE matric_no=:username AND password=:password";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(
			':username' => $this->matric_no,
			':password' => md5( $this->password )
		));
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		
		if( count( $row ) > 0 ){
			$_SESSION['student_id'] = $row['id'];
			return true;
		}
		return false;
	}
}
?>