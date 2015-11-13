<?php
class Application{
	
	public $id;
	public $id_pelajar;
	public $id_sekolah;
	public $id_subjek;
	public $status;
	public $tarikh_dibuat;
	public $tarikh_kemaskini;
	
	public static function all( $pelajar=null, $filter=array() ){
		
		$param = array();
		
		$strSQL = "SELECT permohonan.*, status_permohonan.nama as status_mohon, sekolah.nama as nama_sekolah, subjek.nama as nama_subjek, pelajar.nama_penuh, pelajar.no_matrik
		FROM permohonan 
		INNER JOIN status_permohonan ON status_permohonan.id = permohonan.status 
		INNER JOIN sekolah ON sekolah.id = permohonan.id_sekolah 
		INNER JOIN subjek ON subjek.id = permohonan.id_subjek 
		INNER JOIN pelajar ON pelajar.id = permohonan.id_pelajar 
		WHERE 1=1";
		
		if( !empty( $pelajar ) ){
			$strSQL .= " AND id_pelajar=:id_pelajar";
			$param[':id_pelajar'] = $pelajar;
		}else{
			
		}
		
		if( !empty( $filter ) ){
			if( !empty( $filter['status'] ) ){
				$strSQL .= " AND permohonan.status=:status";
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
		$strSQL = "INSERT INTO permohonan SET id_pelajar=:pelajar, id_sekolah=:sekolah, id_subjek=:subjek, status=1, tarikh_dibuat=:tarikh_dibuat";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute(array(
			':pelajar' => $this->id_pelajar,
			':sekolah' => $this->id_sekolah,
			':subjek' => $this->id_subjek,
			':tarikh_dibuat' => date('Y-m-d H:i:s')
		));
		return $result;
	}
	
	public function update(){
		$strSQL = "UPDATE application SET id_pelajar=:pelajar, id_sekolah=:sekolah, id_subjek=:subjek, tarikh_kemaskini=:tarikh_kemaskini, status=:status WHERE id=:id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute(array(
			':id' => $this->id,
			':pelajar' => $this->id_pelajar,
			':sekolah' => $this->id_sekolah,
			':subjek' => $this->id_subjek,
			':status' => $this->status,
			':tarikh_kemaskini' => date('Y-m-d H:i:s')
		));
		return $result;
	}
	
	public static function findById( $id ){
		$strSQL = "SELECT permohonan.* FROM permohonan WHERE id=:id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute( array( ':id' => $id ) );
		$row = $statement->fetch( PDO::FETCH_ASSOC );
		if( !empty( $row['id'] ) ){
			$app = new self;
			$app->id = $row['id'];
			$app->id_pelajar = $row['id_pelajar'];
			$app->id_sekolah = $row['id_sekolah'];
			$app->id_subjek = $row['id_subjek'];
			$app->status = $row['status'];
			$app->tarikh_dibuat = $row['tarikh_dibuat'];
			$app->tarikh_kemaskini = $row['tarikh_kemaskini'];
			
			return $app;
		}
		return false;
	}
	
	public static function isMyApplication( $id ){
		$strSQL = "SELECT 1 FROM permohonan WHERE id=:id AND id_pelajar=:id_pelajar";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute( array( ':id' => $id, ':id_pelajar' => $_SESSION['id_pelajar'] ) );
		$row = $statement->fetch( PDO::FETCH_ASSOC );
		
		if( is_array( $row ) && count( $row ) == 1 ){
			return true;
		}
		return false;
	}
	
	public function processApplication(){
		$strSQL = "UPDATE permohonan SET status=:status WHERE id=:id";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$result = $statement->execute( array( ':status' => $this->status, ':id' => $this->id ) );
		return $result;
	}
	
	public static function statuses(){
		$strSQL = "SELECT * FROM status_permohonan";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statuses = [];
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$statuses[] = $row;
		}
		
		return $statuses;
	}
	
}
?>