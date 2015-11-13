<?php
class Admin{
	public $username;
	public $password;
	
	public function login(){
		$strSQL = "SELECT admin.* FROM admin WHERE username=:username AND password=:password";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(
			':username' => $this->username,
			':password' => md5( $this->password )
		));
		
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		
		if( count( $row ) > 0 ){
			$_SESSION['id_admin'] = $row['id'];
			return true;
		}
		return false;
	}
}
?>