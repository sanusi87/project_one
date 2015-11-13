<?php
class Student{
	
	const LELAKI = 'L';
	const PEREMPUAN = 'P';
	
	public $id;
	public $no_matrik;
	public $kata_laluan;
	public $program_major;
	public $fakulti=0;
	public $nama_penuh;
	public $tarikh_dibuat;
	public $jantina;
	public $tarikh_lahir;
	public $bangsa;
	
	public function register(){
		$strSQL = "INSERT INTO pelajar SET no_matrik=:no_matrik, kata_laluan=:kata_laluan, program_major=:program_major, fakulti=:fakulti, nama_penuh=:nama_penuh, tarikh_dibuat=:tarikh_dibuat, jantina=:jantina, tarikh_lahir=:tarikh_lahir, bangsa=:bangsa";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		
		$row = $statement->execute(array(
			':no_matrik' => $this->no_matrik,
			':kata_laluan' => md5( $this->kata_laluan ),
			':program_major' => $this->program_major,
			':fakulti' => $this->fakulti,
			':nama_penuh' => $this->nama_penuh,
			':tarikh_dibuat' => $this->tarikh_dibuat,
			':jantina' => $this->jantina,
			':tarikh_lahir' => $this->tarikh_lahir,
			':bangsa' => $this->bangsa
		));
		
		if( $row ){
			$_SESSION['id_pelajar'] = DbConn::$dbConn->lastInsertId();
		}
		
		return $row;
	}
	
	public static function findById( $pelajar ){
		$strSQL = "SELECT pelajar.*, program_major.nama_panjang as nama_program, fakulti.nama_panjang as nama_fakulti FROM pelajar 
		LEFT JOIN program_major ON program_major.id = pelajar.program_major 
		LEFT JOIN fakulti ON fakulti.id = pelajar.fakulti 
		WHERE pelajar.id=:id_pelajar";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(':id_pelajar' => $pelajar));
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		
		$pelajar = new self;
		$pelajar->id = $row['id'];
		$pelajar->no_matrik = $row['no_matrik'];
		//$student->password = $row['password'];
		$pelajar->program_major = $row['program_major'];
		$pelajar->fakulti = $row['fakulti'];
		$pelajar->nama_penuh = $row['nama_penuh'];
		$pelajar->tarikh_dibuat = $row['tarikh_dibuat'];
		$pelajar->nama_fakulti = $row['nama_fakulti'];
		$pelajar->nama_program = $row['nama_program'];
		$pelajar->jantina = $row['jantina'];
		$pelajar->tarikh_lahir = $row['tarikh_lahir'];
		$pelajar->bangsa = $row['bangsa'];
		
		return $pelajar;
	}
	
	public function login(){
		$strSQL = "SELECT pelajar.* FROM pelajar WHERE no_matrik=:kata_nama AND kata_laluan=:kata_laluan";
		$statement = DbConn::$dbConn->prepare( $strSQL );
		$statement->execute(array(
			':kata_nama' => $this->no_matrik,
			':kata_laluan' => md5( $this->kata_laluan )
		));
		$row = $statement->fetch(PDO::FETCH_ASSOC);
		
		if( count( $row ) > 0 ){
			$_SESSION['id_pelajar'] = $row['id'];
			return true;
		}
		return false;
	}
	
	public static function bangsa(){
		return [
			1 => 'Melayu',
			2 => 'Cina',
			3 => 'India',
			4 => 'Lain-lain'
		];
	}
	
}
?>