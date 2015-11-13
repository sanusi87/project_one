<?php
class School{
	
	public static function all(){
		$sekolah = array();
		$strSQL = "SELECT sekolah.*, negeri.nama as nama_negeri, bandar.nama as nama_bandar, S.id as id_permohonan FROM sekolah
		INNER JOIN negeri ON negeri.id = sekolah.id_negeri
		INNER JOIN bandar ON bandar.id = sekolah.id_bandar
		LEFT JOIN (
			SELECT id, id_sekolah FROM permohonan WHERE status IN (1,2) AND YEAR(permohonan.tarikh_dibuat) = ".date('Y')." ORDER BY permohonan.tarikh_dibuat DESC
		) AS S ON S.id_sekolah = sekolah.id
		ORDER BY sekolah.nama ASC";
		$statement = DbConn::$dbConn->query( $strSQL );
		$statement->execute();
		
		while( $row = $statement->fetch(PDO::FETCH_ASSOC) ){
			$sekolah[] = $row;
		}
		return $sekolah;
	}
}
?>